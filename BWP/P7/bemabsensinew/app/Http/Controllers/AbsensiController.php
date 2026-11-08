<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    public function login(): View|RedirectResponse
    {
        return session()->has('auth_user_id') ? redirect()->route('dashboard') : view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        foreach ($this->data('users') as $user) {
            if ($user['username'] === $credentials['username'] && password_verify($credentials['password'], $user['password'])) {
                session()->regenerate();
                session([
                    'auth_user_id' => $user['id'],
                    'auth_user_name' => $user['nama'],
                    'can_switch' => $user['role'] === 'ketua' && $user['nrp'] !== null,
                    'active_mode' => $user['role'] === 'ketua' && $user['nrp'] ? 'mahasiswa' : $user['role'],
                ]);

                return redirect()->route('dashboard')->with('success', 'Login berhasil.');
            }
        }

        return back()->withInput()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function storeRegistration(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nrp' => ['required', 'string', 'max:30'],
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $users = $this->data('users');
        foreach ($users as $user) {
            if ($user['username'] === $input['username'] || $user['nrp'] === $input['nrp']) {
                return back()->withInput()->withErrors(['username' => 'Username atau NRP sudah digunakan.']);
            }
        }

        $users[] = [
            'id' => $this->nextId($users),
            'username' => $input['username'],
            'password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'nama' => $input['nama'],
            'nrp' => $input['nrp'],
            'role' => 'mahasiswa',
        ];
        $this->putData('users', $users);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['auth_user_id', 'auth_user_name', 'active_mode', 'can_switch']);
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }

    public function dashboard(): RedirectResponse
    {
        $user = $this->user();
        if ($user === null) {
            return redirect()->route('login');
        }

        $mode = session('active_mode', $user['role']);
        if ($mode === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($mode === 'ketua') {
            return redirect()->route('chairman.dashboard');
        }

        return redirect()->route('student.dashboard');
    }

    public function switchMode(string $mode): RedirectResponse
    {
        $user = $this->user();
        if ($user === null || ! in_array($mode, ['ketua', 'mahasiswa'], true) || ($mode === 'ketua' && $user['role'] !== 'ketua')) {
            abort(403);
        }

        session(['active_mode' => $mode]);

        return redirect()->route('dashboard');
    }

    public function adminDashboard(): View
    {
        $this->ensureRole('admin');
        $organizations = $this->organizationsWithCounts();
        $schedules = $this->schedulesWithOrganizations();
        $attendance = $this->attendanceWithDetails();

        return view('admin.dashboard', [
            'organizations' => $organizations,
            'schedules' => $schedules,
            'attendance' => $attendance,
            'stats' => [
                'ukm' => count(array_filter($organizations, fn (array $organization): bool => $organization['type'] === 'UKM')),
                'ukk' => count(array_filter($organizations, fn (array $organization): bool => $organization['type'] === 'UKK')),
                'members' => count(array_unique(array_column($this->data('memberships'), 'user_id'))),
                'open' => count(array_filter($organizations, fn (array $organization): bool => $organization['status'] === 'Open Recruitment')),
                'attendance' => count($attendance),
            ],
        ]);
    }

    public function organizations(string $type = 'all'): View
    {
        $this->ensureRole('admin');
        $organizations = $this->organizationsWithCounts();
        if (in_array($type, ['UKM', 'UKK'], true)) {
            $organizations = array_values(array_filter($organizations, fn (array $organization): bool => $organization['type'] === $type));
        }

        return view('admin.organizations.index', compact('organizations', 'type'));
    }

    public function createOrganization(): View
    {
        $this->ensureRole('admin');

        return view('admin.organizations.create');
    }

    public function storeOrganization(Request $request): RedirectResponse
    {
        $this->ensureRole('admin');
        $input = $request->validate([
            'type' => ['required', 'in:UKM,UKK'],
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:50'],
            'status' => ['required', 'in:Open Recruitment,Coming Soon,Closed'],
            'activities' => ['required', 'string'],
            'chairman_name' => ['required', 'string', 'max:100'],
            'chairman_username' => ['required', 'string', 'max:50'],
            'chairman_password' => ['required', 'string', 'min:6'],
        ]);

        $users = $this->data('users');
        foreach ($users as $user) {
            if ($user['username'] === $input['chairman_username']) {
                return back()->withInput()->withErrors(['chairman_username' => 'Username Ketua sudah digunakan.']);
            }
        }

        $organizationId = $this->nextId($this->data('organizations'));
        $chairmanId = $this->nextId($users);
        $users[] = [
            'id' => $chairmanId,
            'username' => $input['chairman_username'],
            'password' => password_hash($input['chairman_password'], PASSWORD_DEFAULT),
            'nama' => $input['chairman_name'],
            'nrp' => null,
            'role' => 'ketua',
            'organization_id' => $organizationId,
        ];
        $organizations = $this->data('organizations');
        $organizations[] = [
            'id' => $organizationId,
            'chairman_user_id' => $chairmanId,
            'chairman_name' => $input['chairman_name'],
            'type' => $input['type'],
            'name' => $input['name'],
            'category' => $input['category'],
            'icon' => $input['icon'],
            'status' => $input['status'],
            'description' => $input['description'],
            'activities' => array_values(array_filter(array_map('trim', explode("\n", $input['activities'])))),
        ];
        $this->putData('users', $users);
        $this->putData('organizations', $organizations);

        return redirect()->route('admin.organizations')->with('success', 'Organisasi dan akun Ketua berhasil dibuat.');
    }

    public function organizationShow(int $id): View
    {
        $this->ensureRole('admin');
        $organization = $this->find($this->data('organizations'), $id);
        abort_if($organization === null, 404);

        return view('admin.organizations.show', [
            'organization' => $organization,
            'members' => $this->membersFor($id),
            'availableStudents' => $this->availableStudents($id),
            'requests' => $this->pendingRequests($id),
            'schedules' => array_values(array_filter($this->schedulesWithOrganizations(), fn (array $schedule): bool => $schedule['organization_id'] === $id)),
            'attendance' => array_values(array_filter($this->attendanceWithDetails(), fn (array $record): bool => $record['organization_id'] === $id)),
        ]);
    }

    public function addMember(Request $request, int $id): RedirectResponse
    {
        $this->ensureRole('admin');
        $request->validate(['user_id' => ['required', 'integer']]);
        $organization = $this->find($this->data('organizations'), $id);
        $user = $this->find($this->data('users'), (int) $request->integer('user_id'));
        abort_if($organization === null || $user === null || $user['nrp'] === null, 404);

        $memberships = $this->data('memberships');
        foreach ($memberships as $membership) {
            if ($membership['organization_id'] === $id && $membership['user_id'] === $user['id']) {
                return back()->with('error', 'Mahasiswa sudah menjadi anggota organisasi ini.');
            }
        }
        $memberships[] = ['user_id' => $user['id'], 'organization_id' => $id];
        $this->putData('memberships', $memberships);

        return back()->with('success', 'Mahasiswa berhasil ditambahkan sebagai anggota.');
    }

    public function schedules(): View
    {
        $this->ensureRole('admin');

        return view('admin.schedules.index', ['schedules' => $this->schedulesWithOrganizations()]);
    }

    public function createSchedule(): View
    {
        $this->ensureRole('admin');

        return view('admin.schedules.create', ['organizations' => $this->data('organizations')]);
    }

    public function storeSchedule(Request $request): RedirectResponse
    {
        $this->ensureRole('admin');
        $input = $request->validate([
            'organization_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'location' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
        ]);
        abort_if($this->find($this->data('organizations'), (int) $input['organization_id']) === null, 404);

        $schedules = $this->data('schedules');
        $schedules[] = ['id' => $this->nextId($schedules)] + $input;
        $this->putData('schedules', $schedules);

        return redirect()->route('admin.schedules')->with('success', 'Jadwal kegiatan berhasil dibuat.');
    }

    public function storeAttendance(Request $request, int $scheduleId): RedirectResponse
    {
        $this->ensureRole('admin');
        $input = $request->validate([
            'user_id' => ['required', 'integer'],
            'status' => ['required', 'in:Lengkap,Belum Check-out,Tidak Hadir'],
            'check_in' => ['nullable', 'date_format:H:i'],
            'check_out' => ['nullable', 'date_format:H:i'],
        ]);
        abort_if($this->find($this->data('schedules'), $scheduleId) === null, 404);

        $attendance = $this->data('attendance');
        foreach ($attendance as $record) {
            if ($record['schedule_id'] === $scheduleId && $record['user_id'] === (int) $input['user_id']) {
                return back()->with('error', 'Attendance untuk mahasiswa dan jadwal tersebut sudah dicatat.');
            }
        }
        $attendance[] = [
            'id' => $this->nextId($attendance),
            'schedule_id' => $scheduleId,
            'user_id' => (int) $input['user_id'],
            'status' => $input['status'],
            'check_in' => $input['check_in'] ?: null,
            'check_out' => $input['check_out'] ?: null,
        ];
        $this->putData('attendance', $attendance);

        return back()->with('success', 'Attendance berhasil dicatat.');
    }

    public function studentDashboard(): View
    {
        $this->ensureStudentMode();
        $user = $this->user();
        $attendance = array_values(array_filter($this->attendanceWithDetails(), fn (array $record): bool => $record['user_id'] === $user['id']));

        return view('student.dashboard', [
            'user' => $user,
            'organizations' => $this->organizationsForUser($user['id']),
            'schedules' => $this->schedulesForUser($user['id']),
            'attendance' => $attendance,
            'stats' => [
                'total' => count($attendance),
                'complete' => count(array_filter($attendance, fn (array $record): bool => $record['status'] === 'Lengkap')),
                'absent' => count(array_filter($attendance, fn (array $record): bool => $record['status'] === 'Tidak Hadir')),
                'open' => count(array_filter($attendance, fn (array $record): bool => $record['status'] === 'Belum Check-out')),
            ],
        ]);
    }

    public function studentOrganizations(): View
    {
        $this->ensureStudentMode();
        $user = $this->user();

        return view('student.organizations', ['organizations' => $this->organizationsForUser($user['id']), 'user' => $user]);
    }

    public function explore(Request $request): View
    {
        $this->ensureStudentMode();
        $user = $this->user();
        $type = $request->string('type')->toString();
        $search = mb_strtolower($request->string('search')->toString());
        $organizations = $this->organizationsWithCounts();
        $memberships = $this->data('memberships');
        $requests = $this->data('join_requests');
        foreach ($organizations as &$organization) {
            $organization['joined'] = $this->isMember($user['id'], $organization['id']);
            $organization['requested'] = $this->hasRequest($requests, $user['id'], $organization['id']);
        }
        unset($organization);
        $organizations = array_values(array_filter($organizations, function (array $organization) use ($type, $search): bool {
            return ($type === '' || $organization['type'] === $type)
                && ($search === '' || str_contains(mb_strtolower($organization['name']), $search));
        }));

        return view('student.explore', compact('organizations', 'user', 'type', 'search', 'memberships'));
    }

    public function joinOrganization(int $id): RedirectResponse
    {
        $this->ensureStudentMode();
        $user = $this->user();
        $organization = $this->find($this->data('organizations'), $id);
        abort_if($organization === null, 404);
        if ($this->isMember($user['id'], $id)) {
            return back()->with('error', 'Kamu sudah menjadi anggota organisasi ini.');
        }

        $requests = $this->data('join_requests');
        if (! $this->hasRequest($requests, $user['id'], $id)) {
            $requests[] = [
                'id' => $this->nextId($requests),
                'user_id' => $user['id'],
                'organization_id' => $id,
                'created_at' => now()->format('Y-m-d H:i'),
            ];
            $this->putData('join_requests', $requests);
        } else {
            return back()->with('error', 'Permintaan bergabung sudah pernah dikirim.');
        }

        return back()->with('success', 'Permintaan bergabung dikirim ke Ketua.');
    }

    public function studentSchedules(): View
    {
        $this->ensureStudentMode();
        $user = $this->user();

        return view('student.schedules', ['user' => $user, 'schedules' => $this->schedulesForUser($user['id'])]);
    }

    public function studentAttendance(): View
    {
        $this->ensureStudentMode();
        $user = $this->user();

        return view('student.attendance', ['user' => $user, 'attendance' => array_values(array_filter($this->attendanceWithDetails(), fn (array $record): bool => $record['user_id'] === $user['id']))]);
    }

    public function chairmanDashboard(): View
    {
        $this->ensureRole('ketua');
        $user = $this->user();
        $organizationId = $user['organization_id'] ?? null;
        abort_if($organizationId === null, 403);
        $organization = $this->find($this->data('organizations'), $organizationId);

        return view('chairman.dashboard', [
            'user' => $user,
            'organization' => $organization,
            'requests' => $this->pendingRequests($organizationId),
            'members' => $this->membersFor($organizationId),
            'schedules' => array_values(array_filter($this->schedulesWithOrganizations(), fn (array $schedule): bool => $schedule['organization_id'] === $organizationId)),
        ]);
    }

    private function ensureRole(string $role): void
    {
        $user = $this->user();
        abort_if($user === null || $user['role'] !== $role, 403);
    }

    private function ensureStudentMode(): void
    {
        $user = $this->user();
        abort_if($user === null || $user['nrp'] === null || session('active_mode') !== 'mahasiswa', 403);
    }

    private function user(): ?array
    {
        $id = session('auth_user_id');
        if ($id === null) {
            return null;
        }

        return $this->find($this->data('users'), (int) $id);
    }

    private function data(string $key): array
    {
        if (! session()->has('app_'.$key)) {
            $defaults = [
                'users' => DataController::getUsersData(),
                'organizations' => DataController::getOrganizationsData(),
                'memberships' => DataController::getMembershipsData(),
                'schedules' => DataController::getSchedulesData(),
                'join_requests' => DataController::getJoinRequestsData(),
                'attendance' => DataController::getAttendancesData(),
            ];
            session(['app_'.$key => $defaults[$key]]);
        }

        return session('app_'.$key, []);
    }

    private function putData(string $key, array $value): void
    {
        session(['app_'.$key => $value]);
    }

    private function find(array $items, int $id): ?array
    {
        foreach ($items as $item) {
            if ((int) $item['id'] === $id) {
                return $item;
            }
        }

        return null;
    }

    private function nextId(array $items): int
    {
        return empty($items) ? 1 : max(array_map(fn (array $item): int => (int) $item['id'], $items)) + 1;
    }

    private function organizationsWithCounts(): array
    {
        $memberships = $this->data('memberships');
        $organizations = $this->data('organizations');
        foreach ($organizations as &$organization) {
            $organization['members'] = count(array_filter($memberships, fn (array $membership): bool => $membership['organization_id'] === $organization['id']));
        }
        unset($organization);

        return $organizations;
    }

    private function membersFor(int $organizationId): array
    {
        $users = $this->data('users');
        $memberships = array_filter($this->data('memberships'), fn (array $membership): bool => $membership['organization_id'] === $organizationId);

        return array_values(array_filter($users, function (array $user) use ($memberships): bool {
            foreach ($memberships as $membership) {
                if ($membership['user_id'] === $user['id']) {
                    return true;
                }
            }

            return false;
        }));
    }

    private function availableStudents(int $organizationId): array
    {
        $members = array_column($this->membersFor($organizationId), 'id');

        return array_values(array_filter($this->data('users'), fn (array $user): bool => $user['nrp'] !== null && ! in_array($user['id'], $members, true)));
    }

    private function pendingRequests(int $organizationId): array
    {
        $requests = $this->data('join_requests');
        $members = array_column($this->membersFor($organizationId), 'id');
        $users = $this->data('users');
        $pending = array_values(array_filter($requests, function (array $request) use ($organizationId, $members): bool {
            return $request['organization_id'] === $organizationId && ! in_array($request['user_id'], $members, true);
        }));
        foreach ($pending as &$request) {
            $user = $this->find($users, $request['user_id']);
            $request['name'] = $user['nama'] ?? 'Mahasiswa';
            $request['nrp'] = $user['nrp'] ?? '-';
        }
        unset($request);

        return $pending;
    }

    private function schedulesWithOrganizations(): array
    {
        $organizations = $this->data('organizations');
        $schedules = $this->data('schedules');
        foreach ($schedules as &$schedule) {
            $organization = $this->find($organizations, $schedule['organization_id']);
            $schedule['organization_name'] = $organization['name'] ?? 'Organisasi';
        }
        unset($schedule);

        return $schedules;
    }

    private function schedulesForUser(int $userId): array
    {
        $organizationIds = array_column(array_filter($this->data('memberships'), fn (array $membership): bool => $membership['user_id'] === $userId), 'organization_id');

        return array_values(array_filter($this->schedulesWithOrganizations(), fn (array $schedule): bool => in_array($schedule['organization_id'], $organizationIds, true)));
    }

    private function attendanceWithDetails(): array
    {
        $users = $this->data('users');
        $schedules = $this->schedulesWithOrganizations();
        $attendance = $this->data('attendance');
        foreach ($attendance as &$record) {
            $user = $this->find($users, $record['user_id']);
            $schedule = $this->find($schedules, $record['schedule_id']);
            $record['nrp'] = $user['nrp'] ?? '-';
            $record['name'] = $user['nama'] ?? 'Mahasiswa';
            $record['organization_id'] = $schedule['organization_id'] ?? 0;
            $record['organization_name'] = $schedule['organization_name'] ?? 'Organisasi';
            $record['title'] = $schedule['title'] ?? 'Kegiatan';
            $record['date'] = $schedule['date'] ?? '-';
        }
        unset($record);

        return $attendance;
    }

    private function organizationsForUser(int $userId): array
    {
        $ids = array_column(array_filter($this->data('memberships'), fn (array $membership): bool => $membership['user_id'] === $userId), 'organization_id');

        return array_values(array_filter($this->organizationsWithCounts(), fn (array $organization): bool => in_array($organization['id'], $ids, true)));
    }

    private function isMember(int $userId, int $organizationId): bool
    {
        return count(array_filter($this->data('memberships'), fn (array $membership): bool => $membership['user_id'] === $userId && $membership['organization_id'] === $organizationId)) > 0;
    }

    private function hasRequest(array $requests, int $userId, int $organizationId): bool
    {
        return count(array_filter($requests, fn (array $request): bool => $request['user_id'] === $userId && $request['organization_id'] === $organizationId)) > 0;
    }
}
