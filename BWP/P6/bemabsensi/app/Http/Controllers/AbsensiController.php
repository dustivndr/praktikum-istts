<?php

namespace App\Http\Controllers;

class AbsensiController extends Controller
{
    public function home()
    {
        $organizations = $this->getOrganizations();
        $members = $this->getMembers();

        $totalUkm = 0;
        $totalUkk = 0;
        $openRecruitment = 0;

        foreach ($organizations as $organization) {
            if ($organization['type'] == 'UKM') {
                $totalUkm++;
            }

            if ($organization['type'] == 'UKK') {
                $totalUkk++;
            }

            if ($organization['status'] == 'Open Recruitment') {
                $openRecruitment++;
            }
        }

        return view('home', [
            'totalUkm' => $totalUkm,
            'totalUkk' => $totalUkk,
            'totalMembers' => count($members),
            'openRecruitment' => $openRecruitment,
        ]);
    }

    public function ukm()
    {
        return $this->index('UKM');
    }

    public function ukk()
    {
        return $this->index('UKK');
    }

    public function index($type)
    {
        $allOrganizations = $this->getOrganizations();
        $members = $this->getMembers();
        $organizations = [];

        foreach ($allOrganizations as $organization) {
            if ($organization['type'] == $type) {
                $memberCount = 0;

                foreach ($members as $member) {
                    if ($member['organization_id'] == $organization['id']) {
                        $memberCount++;
                    }
                }

                $organization['members'] = $memberCount;
                $organizations[] = $organization;
            }
        }

        return view('organizations.index', [
            'organizations' => $organizations,
            'type' => $type,
        ]);
    }

    public function show($id)
    {
        $organizations = $this->getOrganizations();
        $allMembers = $this->getMembers();
        $allAttendance = $this->getAttendanceRecords();
        $organization = null;
        $members = [];
        $attendance = [];

        foreach ($organizations as $item) {
            if ($item['id'] == $id) {
                $organization = $item;
                break;
            }
        }

        if ($organization == null) {
            abort(404);
        }

        foreach ($allMembers as $member) {
            if ($member['organization_id'] == $id) {
                $members[] = $member;
            }
        }

        foreach ($allAttendance as $record) {
            if ($record['organization_id'] == $id) {
                $attendance[] = $record;
            }
        }

        return view('organizations.show', [
            'organization' => $organization,
            'members' => $members,
            'attendance' => $attendance,
        ]);
    }

    private function getOrganizations()
    {
        return [
            [
                'id' => 1,
                'name' => 'UKM Basket',
                'type' => 'UKM',
                'category' => 'Olahraga',
                'icon' => 'bi-dribbble',
                'status' => 'Open Recruitment',
                'description' => 'Organisasi mahasiswa yang bergerak di bidang olahraga basket.',
                'activities' => ['Latihan Rutin', 'Friendly Match', 'Turnamen Basket'],
            ],
            [
                'id' => 2,
                'name' => 'UKM Musik',
                'type' => 'UKM',
                'category' => 'Seni',
                'icon' => 'bi-music-note-beamed',
                'status' => 'Coming Soon',
                'description' => 'Wadah mahasiswa untuk mengembangkan bakat musik.',
                'activities' => ['Latihan Band', 'Music Workshop', 'Konser Kampus'],
            ],
            [
                'id' => 3,
                'name' => 'UKM Fotografi',
                'type' => 'UKM',
                'category' => 'Seni',
                'icon' => 'bi-camera',
                'status' => 'Closed',
                'description' => 'Organisasi yang berfokus pada fotografi dan videografi.',
                'activities' => ['Photo Hunting', 'Photography Workshop', 'Pameran Foto'],
            ],
            [
                'id' => 4,
                'name' => 'UKM Coding',
                'type' => 'UKM',
                'category' => 'Teknologi',
                'icon' => 'bi-code-slash',
                'status' => 'Open Recruitment',
                'description' => 'Komunitas mahasiswa yang tertarik dengan programming.',
                'activities' => ['Coding Class', 'Hackathon', 'Project Collaboration'],
            ],
            [
                'id' => 5,
                'name' => 'UKK Kerohanian Kristen',
                'type' => 'UKK',
                'category' => 'Kerohanian',
                'icon' => 'bi-people',
                'status' => 'Open Recruitment',
                'description' => 'Organisasi kegiatan kerohanian mahasiswa Kristen.',
                'activities' => ['Persekutuan', 'Retreat', 'Kegiatan Sosial'],
            ],
            [
                'id' => 6,
                'name' => 'UKK Kerohanian Katolik',
                'type' => 'UKK',
                'category' => 'Kerohanian',
                'icon' => 'bi-heart',
                'status' => 'Coming Soon',
                'description' => 'Organisasi kegiatan kerohanian mahasiswa Katolik.',
                'activities' => ['Misa Kampus', 'Rekoleksi', 'Bakti Sosial'],
            ],
        ];
    }

    private function getMembers()
    {
        return [
            ['nrp' => '1001', 'name' => 'Andi Pratama', 'organization_id' => 1],
            ['nrp' => '1002', 'name' => 'Budi Santoso', 'organization_id' => 1],
            ['nrp' => '1003', 'name' => 'Citra Putri', 'organization_id' => 1],
            ['nrp' => '1004', 'name' => 'Dina Amelia', 'organization_id' => 1],
            ['nrp' => '1005', 'name' => 'Rizky Saputra', 'organization_id' => 1],
            ['nrp' => '2001', 'name' => 'Kevin Wijaya', 'organization_id' => 2],
            ['nrp' => '2002', 'name' => 'Maria Jessica', 'organization_id' => 2],
            ['nrp' => '2003', 'name' => 'Clara Felicia', 'organization_id' => 2],
            ['nrp' => '2004', 'name' => 'Samuel Wijaya', 'organization_id' => 2],
            ['nrp' => '3001', 'name' => 'Steven Nathan', 'organization_id' => 3],
            ['nrp' => '3002', 'name' => 'Rachel Olivia', 'organization_id' => 3],
            ['nrp' => '3003', 'name' => 'Ardi Setiawan', 'organization_id' => 3],
            ['nrp' => '4001', 'name' => 'Felix Alexander', 'organization_id' => 4],
            ['nrp' => '4002', 'name' => 'Bella Christina', 'organization_id' => 4],
            ['nrp' => '4003', 'name' => 'Dimas Pratama', 'organization_id' => 4],
            ['nrp' => '4004', 'name' => 'Ivan Jonathan', 'organization_id' => 4],
            ['nrp' => '4005', 'name' => 'Angela Putri', 'organization_id' => 4],
            ['nrp' => '5001', 'name' => 'Grace Olivia', 'organization_id' => 5],
            ['nrp' => '5002', 'name' => 'Olivia Patricia', 'organization_id' => 5],
            ['nrp' => '5003', 'name' => 'Daniel Christian', 'organization_id' => 5],
            ['nrp' => '6001', 'name' => 'Michael Jonathan', 'organization_id' => 6],
            ['nrp' => '6002', 'name' => 'Jonathan Samuel', 'organization_id' => 6],
            ['nrp' => '6003', 'name' => 'Natasha Clarissa', 'organization_id' => 6],
        ];
    }

    private function getAttendanceRecords()
    {
        return [
            ['organization_id' => 1, 'nrp' => '1001', 'name' => 'Andi Pratama', 'date' => '2026-10-28', 'check_in' => '08:00', 'check_out' => '10:15', 'status' => 'Lengkap', 'duration' => '2j 15m'],
            ['organization_id' => 1, 'nrp' => '1002', 'name' => 'Budi Santoso', 'date' => '2026-10-28', 'check_in' => '08:05', 'check_out' => '10:15', 'status' => 'Lengkap', 'duration' => '2j 10m'],
            ['organization_id' => 1, 'nrp' => '1003', 'name' => 'Citra Putri', 'date' => '2026-10-28', 'check_in' => '08:10', 'check_out' => null, 'status' => 'Belum Check-out', 'duration' => null],
            ['organization_id' => 1, 'nrp' => '1004', 'name' => 'Dina Amelia', 'date' => '2026-10-28', 'check_in' => null, 'check_out' => null, 'status' => 'Tidak Hadir', 'duration' => null],
            ['organization_id' => 2, 'nrp' => '2001', 'name' => 'Kevin Wijaya', 'date' => '2026-10-28', 'check_in' => '13:00', 'check_out' => '15:00', 'status' => 'Lengkap', 'duration' => '2j 0m'],
            ['organization_id' => 2, 'nrp' => '2002', 'name' => 'Maria Jessica', 'date' => '2026-10-28', 'check_in' => '13:10', 'check_out' => null, 'status' => 'Belum Check-out', 'duration' => null],
            ['organization_id' => 3, 'nrp' => '3001', 'name' => 'Steven Nathan', 'date' => '2026-10-28', 'check_in' => '09:00', 'check_out' => '11:30', 'status' => 'Lengkap', 'duration' => '2j 30m'],
            ['organization_id' => 4, 'nrp' => '4001', 'name' => 'Felix Alexander', 'date' => '2026-10-28', 'check_in' => '10:00', 'check_out' => '12:00', 'status' => 'Lengkap', 'duration' => '2j 0m'],
            ['organization_id' => 5, 'nrp' => '5001', 'name' => 'Grace Olivia', 'date' => '2026-10-28', 'check_in' => '16:00', 'check_out' => '18:00', 'status' => 'Lengkap', 'duration' => '2j 0m'],
            ['organization_id' => 6, 'nrp' => '6001', 'name' => 'Michael Jonathan', 'date' => '2026-10-28', 'check_in' => null, 'check_out' => null, 'status' => 'Tidak Hadir', 'duration' => null],
        ];
    }
}
