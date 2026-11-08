<?php

namespace App\Http\Controllers;

// Data dummy berbentuk ARRAY, sama seperti pola pada Tutor7.
// Tidak ada Model, Eloquent, query SQL, migration, maupun database.
class DataController extends Controller
{
    public static function getUsersData(): array
    {
        return [
            ['id' => 1, 'username' => 'admin', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'nama' => 'Admin BEM', 'nrp' => null, 'role' => 'admin'],
            ['id' => 2, 'username' => 'rina',  'password' => password_hash('rina123', PASSWORD_DEFAULT),  'nama' => 'Rina Wijaya', 'nrp' => '222117001', 'role' => 'mahasiswa'],
            ['id' => 3, 'username' => 'budi',  'password' => password_hash('budi123', PASSWORD_DEFAULT),  'nama' => 'Budi Santoso', 'nrp' => '222117002', 'role' => 'ketua', 'organization_id' => 1],
            // Budi: satu akun (NRP mahasiswa) sekaligus Ketua UKM Basket.
            // Ketua dengan NRP dapat berpindah Dashboard Ketua / Mahasiswa.
            // Akun Ketua lain yang tidak memiliki NRP hanya membuka Dashboard Ketua.
            ['id'=>5, 'username'=>'ketua_musik', 'password'=>password_hash('ketua123', PASSWORD_DEFAULT), 'nama'=>'Nadia Putri', 'nrp'=>null, 'role'=>'ketua', 'organization_id'=>2],
            ['id'=>6, 'username'=>'ketua_foto', 'password'=>password_hash('ketua123', PASSWORD_DEFAULT), 'nama'=>'Dimas Santoso', 'nrp'=>null, 'role'=>'ketua', 'organization_id'=>3],
            ['id'=>7, 'username'=>'ketua_coding', 'password'=>password_hash('ketua123', PASSWORD_DEFAULT), 'nama'=>'Fajar Ramadhan', 'nrp'=>null, 'role'=>'ketua', 'organization_id'=>4],
            ['id'=>8, 'username'=>'ketua_kristen', 'password'=>password_hash('ketua123', PASSWORD_DEFAULT), 'nama'=>'Clara Wijaya', 'nrp'=>null, 'role'=>'ketua', 'organization_id'=>5],
            ['id'=>9, 'username'=>'ketua_katolik', 'password'=>password_hash('ketua123', PASSWORD_DEFAULT), 'nama'=>'Maria Anastasia', 'nrp'=>null, 'role'=>'ketua', 'organization_id'=>6],
        ];
    }

    public static function getOrganizationsData(): array
    {
        // Tiap organisasi memiliki akun Ketua dengan ID tertentu dari array users.

        return [
            ['id'=>1, 'chairman_user_id'=>3, 'chairman_name'=>'Budi Santoso', 'type'=>'UKM', 'name'=>'UKM Basket', 'category'=>'Olahraga', 'icon'=>'bi-dribbble', 'status'=>'Open Recruitment', 'description'=>'Komunitas olahraga basket yang rutin berlatih dan mengikuti kompetisi.', 'activities'=>['Latihan Rutin','Friendly Match','Turnamen Basket']],
            ['id'=>2, 'chairman_user_id'=>5, 'chairman_name'=>'Nadia Putri', 'type'=>'UKM', 'name'=>'UKM Musik', 'category'=>'Seni', 'icon'=>'bi-music-note-beamed', 'status'=>'Coming Soon', 'description'=>'Tempat pengembangan bakat musik mahasiswa.', 'activities'=>['Latihan Band','Music Workshop','Konser Kampus']],
            ['id'=>3, 'chairman_user_id'=>6, 'chairman_name'=>'Dimas Santoso', 'type'=>'UKM', 'name'=>'UKM Fotografi', 'category'=>'Seni', 'icon'=>'bi-camera', 'status'=>'Closed', 'description'=>'Wadah mahasiswa yang berminat dalam fotografi.', 'activities'=>['Photo Hunting','Photography Workshop','Pameran Foto']],
            ['id'=>4, 'chairman_user_id'=>7, 'chairman_name'=>'Fajar Ramadhan', 'type'=>'UKM', 'name'=>'UKM Coding', 'category'=>'Teknologi', 'icon'=>'bi-code-slash', 'status'=>'Open Recruitment', 'description'=>'Komunitas belajar pemrograman dan pengembangan aplikasi.', 'activities'=>['Coding Class','Hackathon','Project Collaboration']],
            ['id'=>5, 'chairman_user_id'=>8, 'chairman_name'=>'Clara Wijaya', 'type'=>'UKK', 'name'=>'UKK Kerohanian Kristen', 'category'=>'Kerohanian', 'icon'=>'bi-heart', 'status'=>'Open Recruitment', 'description'=>'Kegiatan pembinaan dan kebersamaan mahasiswa Kristen.', 'activities'=>['Persekutuan','Retreat','Kegiatan Sosial']],
            ['id'=>6, 'chairman_user_id'=>9, 'chairman_name'=>'Maria Anastasia', 'type'=>'UKK', 'name'=>'UKK Kerohanian Katolik', 'category'=>'Kerohanian', 'icon'=>'bi-people', 'status'=>'Coming Soon', 'description'=>'Kegiatan pembinaan dan kebersamaan mahasiswa Katolik.', 'activities'=>['Misa Kampus','Rekoleksi','Bakti Sosial']],
        ];
    }

    public static function getMembershipsData(): array
    {
        // Satu mahasiswa bisa menjadi anggota lebih dari satu organisasi.
        return [
            ['user_id'=>2,'organization_id'=>1],
            ['user_id'=>2,'organization_id'=>3],
            ['user_id'=>2,'organization_id'=>6],
            ['user_id'=>3,'organization_id'=>1],
            ['user_id'=>3,'organization_id'=>4],
            ['user_id'=>3,'organization_id'=>5],
        ];
    }

    public static function getSchedulesData(): array
    {
        return [
            ['id'=>1, 'organization_id'=>1, 'title'=>'Latihan Basket', 'date'=>today()->toDateString(), 'start_time'=>'15:00', 'end_time'=>'17:00', 'location'=>'GOR Kampus', 'description'=>'Latihan teknik dan pertandingan persahabatan'],
            ['id'=>2, 'organization_id'=>3, 'title'=>'Photo Hunting', 'date'=>today()->addDay()->toDateString(), 'start_time'=>'09:00', 'end_time'=>'11:00', 'location'=>'Taman Kampus', 'description'=>'Latihan komposisi dan teknik fotografi'],
            ['id'=>3, 'organization_id'=>5, 'title'=>'Persekutuan', 'date'=>today()->addDays(2)->toDateString(), 'start_time'=>'18:00', 'end_time'=>'19:30', 'location'=>'Ruang Serbaguna', 'description'=>'Pertemuan anggota UKK'],
            ['id'=>4, 'organization_id'=>6, 'title'=>'Misa Kampus', 'date'=>today()->addDays(3)->toDateString(), 'start_time'=>'07:00', 'end_time'=>'08:30', 'location'=>'Kapel Kampus', 'description'=>'Misa bersama mahasiswa'],
            ['id'=>5, 'organization_id'=>4, 'title'=>'Coding Class', 'date'=>today()->addDays(1)->toDateString(), 'start_time'=>'13:00', 'end_time'=>'15:00', 'location'=>'Lab Komputer', 'description'=>'Belajar membuat aplikasi Laravel'],
        ];
    }

    public static function getJoinRequestsData(): array
    {
        // Permintaan bergabung dibuat oleh mahasiswa dan dibaca oleh Ketua.
        // Belum ada permintaan pada data awal.
        return [];
    }

    public static function getAttendancesData(): array
    {
        return [
            ['id'=>1, 'schedule_id'=>1, 'user_id'=>2, 'status'=>'Lengkap', 'check_in'=>'15:00', 'check_out'=>'17:00'],
            ['id'=>2, 'schedule_id'=>1, 'user_id'=>3, 'status'=>'Belum Check-out', 'check_in'=>'15:10', 'check_out'=>null],
            ['id'=>3, 'schedule_id'=>2, 'user_id'=>2, 'status'=>'Tidak Hadir', 'check_in'=>null, 'check_out'=>null],
        ];
    }
}
