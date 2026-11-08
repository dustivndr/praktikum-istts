<?php


$users = [
    ['id' => 1, 'username' => 'admin', 'password' => 'admin123', 'nama' => 'Admin ITFest',  'role' => 'admin'],
    ['id' => 2, 'username' => 'rina',  'password' => 'rina123',  'nama' => 'Rina Wijaya',   'role' => 'pendaftar'],
    ['id' => 3, 'username' => 'budi',  'password' => 'budi123',  'nama' => 'Budi Santoso',  'role' => 'pendaftar'],
];

$lomba = [
    ['id' => 1, 'nama' => 'Web Development Contest', 'kuota' => 20, 'terisi' => 18, 'biaya' => 75000],
    ['id' => 2, 'nama' => 'UI/UX Design Challenge',  'kuota' => 15, 'terisi' => 9,  'biaya' => 50000],
    ['id' => 3, 'nama' => 'Competitive Programming', 'kuota' => 30, 'terisi' => 25, 'biaya' => 40000],
    ['id' => 4, 'nama' => 'Mobile App Hackathon',    'kuota' => 10, 'terisi' => 10, 'biaya' => 100000],
];

$pendaftaran = [
    ['id' => 1, 'tim' => 'Pixel Crafters',   'lomba_id' => 1, 'anggota' => 3, 'kontak' => '081234567890', 'user_id' => 2],
    ['id' => 2, 'tim' => 'Debug Squad',      'lomba_id' => 3, 'anggota' => 2, 'kontak' => '082345678901', 'user_id' => 2],
    ['id' => 3, 'tim' => 'Figma Fanatics',   'lomba_id' => 2, 'anggota' => 2, 'kontak' => '083456789012', 'user_id' => 3],
    ['id' => 4, 'tim' => 'Null Pointers',    'lomba_id' => 1, 'anggota' => 3, 'kontak' => '084567890123', 'user_id' => 3],
    ['id' => 5, 'tim' => 'Binary Brothers',  'lomba_id' => 3, 'anggota' => 1, 'kontak' => '085678901234', 'user_id' => 3],
];
