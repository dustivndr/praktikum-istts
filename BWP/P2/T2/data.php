<?php

if (!isset($_COOKIE['users'])) {
    $users = [
        [
            'id'       => 1,
            'nid'      => 'D001',
            'email'    => 'superAdmin@example.com',
            'nama'     => 'superAdmin',
            'password' => 'admin123',
            'role'     => 'admin',
            'banned'   => 0,
        ],
        [
            'id'       => 2,
            'nid'      => 'D002',
            'email'    => 'agus@istts.ac.id',
            'nama'     => 'Dr. Agus Suryawan',
            'password' => 'dosen123',
            'role'     => 'dosen',
            'banned'   => 0,
        ], 
        [
            'id'       => 3,
            'nid'      => 'D003',
            'email'    => 'john@istts.ac.id',
            'nama'     => 'John Doe',
            'password' => 'dosen123',
            'role'     => 'dosen',
            'banned'   => 0,
        ],
        [
            'id'       => 4,
            'nid'      => 'D004',
            'email'    => 'jane@istts.ac.id',
            'nama'     => 'Jane Smith',
            'password' => 'dosen123',
            'role'     => 'dosen',
            'banned'   => 0,
        ],
        [
            'id'       => 5,
            'nid'      => 'D005',
            'email'    => 'jessica@istts.ac.id',
            'nama'     => 'Jessica Brown',
            'password' => 'dosen123',
            'role'     => 'dosen',
            'banned'   => 0,
        ],

        [
            'id'            => 6,
            'nim'           => '224117190',
            'nama'          => 'Andi Wijaya',
            'email'         => 'andi@istts.ac.id',
            'password'      => 'mhs123',
            'role'          => 'mahasiswa',
            'banned'        => 0,
            'dosen_wali_id' => 2,
            'ipk'           => '3.85',
            'sks'           => 12,
            'poin'          => 1500,
            'krs'           => ['MK001', 'MK002']
        ], 
        [
            'id'            => 7,
            'nim'           => '224117191',
            'nama'          => 'Budi Santoso',
            'email'         => 'budi@istts.ac.id',
            'password'      => 'mhs123',
            'role'          => 'mahasiswa',
            'banned'        => 0,
            'dosen_wali_id' => null,
            'ipk'           => '3.40',
            'sks'           => 0,
            'poin'          => 900,
            'krs'           => []
        ],
        [
            'id'            => 8,
            'nim'           => '224117192',
            'nama'          => 'Citra Dewi',
            'email'         => 'citra@istts.ac.id',
            'password'      => 'mhs123',
            'role'          => 'mahasiswa',
            'banned'        => 0,
            'dosen_wali_id' => null,
            'ipk'           => '3.90',
            'sks'           => 0,
            'poin'          => 200,
            'krs'           => []
        ],
        [
            'id'            => 9,
            'nim'           => '224117193',
            'nama'          => 'David Lee',
            'email'         => 'david@istts.ac.id',
            'password'      => 'mhs123',
            'role'          => 'mahasiswa',
            'banned'        => 0,
            'dosen_wali_id' => null,
            'ipk'           => '3.25',
            'sks'           => 0,
            'poin'          => 800,
            'krs'           => []
        ],
        [
            'id'            => 10,
            'nim'           => '224117194',
            'nama'          => 'Fernando',
            'email'         => 'fernando@istts.ac.id',
            'password'      => 'mhs123',
            'role'          => 'mahasiswa',
            'banned'        => 1,
            'dosen_wali_id' => null,
            'ipk'           => '3.50',
            'sks'           => 0,
            'poin'          => 1100,
            'krs'           => []
        ]
    ];

    $usersCookie = json_encode($users);
    setcookie('users', $usersCookie, time() + (86400 * 30), '/');
    $_COOKIE['users'] = $usersCookie;
}

if (!isset($_COOKIE['matakuliah'])) {
    $matakuliah = [
        [
            'kode'      => 'MK001',
            'nama_mk'   => 'Pemrograman Web Lanjut',
            'sks'       => 6,
            'hari'      => 'Senin',
            'jam'       => '08:00 - 12:00',
            'ruangan'   => 'L-302',
            'dosen_id'  => 2
        ],
        [
            'kode'      => 'MK002',
            'nama_mk'   => 'Basis Data Lanjut',
            'sks'       => 6,
            'hari'      => 'Rabu',
            'jam'       => '10:00 - 14:00',
            'ruangan'   => 'L-201',
            'dosen_id'  => 4
        ],
        [
            'kode'      => 'MK003',
            'nama_mk'   => 'Kecerdasan Buatan',
            'sks'       => 3,
            'hari'      => 'Kamis',
            'jam'       => '13:00 - 15:30',
            'ruangan'   => 'L-101',
            'dosen_id'  => 3
        ]
    ];

    $matakuliahCookie = json_encode($matakuliah);
    setcookie('matakuliah', $matakuliahCookie, time() + (86400 * 30), '/');
    $_COOKIE['matakuliah'] = $matakuliahCookie;
}
?>