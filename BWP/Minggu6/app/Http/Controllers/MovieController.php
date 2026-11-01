<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    private function getMovieList()
    {
        return [
            [
                'id' => 1,
                'title' => 'Agak Laen 2',
                'genre' => 'Comedy, Horror',
                'tags' => ['Komedi', 'Horor', 'Indonesia', 'Lokal'],
                'duration' => '119 Menit',
                'age_rating' => '13+',
                'rating' => 9.2,
                'director' => 'Muhadkly Acho',
                'description' => 'Kelanjutan petualangan kocak dan menegangkan empat sekawan penjaga rumah hantu pasar malam yang kini menghadapi misteri baru yang jauh lebih tak terduga.',
                'poster' => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=500&auto=format&fit=crop&q=80',
                'format' => '2D'
            ],
            [
                'id' => 2,
                'title' => 'Dune: Part Two',
                'genre' => 'Action, Sci-Fi',
                'tags' => ['Sci-Fi', 'Petualangan', 'Epik', 'Space'],
                'duration' => '166 Menit',
                'age_rating' => '13+',
                'rating' => 9.5,
                'director' => 'Denis Villeneuve',
                'description' => 'Paul Atreides bersatu dengan Chani dan bangsa Fremen saat ia merencanakan balas dendam terhadap para konspirator yang telah menghancurkan keluarganya.',
                'poster' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=500&auto=format&fit=crop&q=80',
                'format' => 'IMAX 2D'
            ],
            [
                'id' => 3,
                'title' => 'Spider-Man: Beyond',
                'genre' => 'Animation, Action',
                'tags' => ['Animasi', 'Superhero', 'Multiverse', 'Aksi'],
                'duration' => '140 Menit',
                'age_rating' => 'SU',
                'rating' => 9.4,
                'director' => 'Joaquim Dos Santos',
                'description' => 'Miles Morales melintasi dimensi alternatif untuk melindungi keberadaan seluruh manusia laba-laba dari ancaman musuh multiverse yang sangat kuat.',
                'poster' => 'https://images.unsplash.com/photo-1635805737707-575885ab0820?w=500&auto=format&fit=crop&q=80',
                'format' => '2D'
            ],
            [
                'id' => 4,
                'title' => 'Kingdom of the Planet',
                'genre' => 'Action, Adventure',
                'tags' => ['Aksi', 'Sci-Fi', 'Survival'],
                'duration' => '145 Menit',
                'age_rating' => '13+',
                'rating' => 8.7,
                'director' => 'Wes Ball',
                'description' => 'Bertahun-tahun setelah masa kepemimpinan Caesar, seekor kera muda memulai perjalanan yang menantang semua hal yang ia ketahui tentang masa lalu.',
                'poster' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=500&auto=format&fit=crop&q=80',
                'format' => '2D'
            ],
            [
                'id' => 5,
                'title' => 'A Quiet Place: Day One',
                'genre' => 'Drama, Horror, Sci-Fi',
                'tags' => ['Horor', 'Monster', 'Thriller', 'Survival'],
                'duration' => '100 Menit',
                'age_rating' => '17+',
                'rating' => 8.9,
                'director' => 'Michael Sarnoski',
                'description' => 'Menyaksikan hari pertama ketika monster asing yang peka terhadap suara mulai menginvasi kota New York dan melumpuhkan peradaban manusia.',
                'poster' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=500&auto=format&fit=crop&q=80',
                'format' => '2D'
            ],
            [
                'id' => 6,
                'title' => 'Kung Fu Panda 4',
                'genre' => 'Animation, Adventure, Comedy',
                'tags' => ['Animasi', 'Komedi', 'Keluarga', 'Martial Arts'],
                'duration' => '94 Menit',
                'age_rating' => 'SU',
                'rating' => 8.8,
                'director' => 'Mike Mitchell',
                'description' => 'Po ditunjuk untuk menjadi Pemimpin Spiritual Lembah Damai, namun ia harus segera menemukan dan melatih seorang Dragon Warrior baru sebelum musuh penyihir jahat beraksi.',
                'poster' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=500&auto=format&fit=crop&q=80',
                'format' => '2D'
            ],
            [
                'id' => 7,
                'title' => 'Deadpool & Wolverine',
                'genre' => 'Action, Comedy, Sci-Fi',
                'tags' => ['Aksi', 'Komedi', 'Marvel', 'Dewasa'],
                'duration' => '127 Menit',
                'age_rating' => '17+',
                'rating' => 9.3,
                'director' => 'Shawn Levy',
                'description' => 'Wade Wilson dipaksa kembali beraksi bersama Wolverine yang enggan membantunya dalam misi berbahaya yang menentukan nasib semesta mereka.',
                'poster' => 'https://images.unsplash.com/photo-1568876694728-451bbf694b83?w=500&auto=format&fit=crop&q=80',
                'format' => 'IMAX 3D'
            ],
            [
                'id' => 8,
                'title' => 'Inside Out 2',
                'genre' => 'Animation, Adventure, Comedy',
                'tags' => ['Animasi', 'Keluarga', 'Emosi', 'Disney'],
                'duration' => '96 Menit',
                'age_rating' => 'SU',
                'rating' => 9.0,
                'director' => 'Kelsey Mann',
                'description' => 'Riley menginjak usia remaja, dan ruang kendali emosinya kedatangan tamu tak terduga: Anxiety (Kecemasan) dan teman-teman emosi barunya.',
                'poster' => 'https://images.unsplash.com/photo-1514565131-fce0801e5785?w=500&auto=format&fit=crop&q=80',
                'format' => '2D'
            ],
        ];
    }

    public function index()
    {
        $movies = $this->getMovieList();

        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        //nyari yang idnya kepencet
        $movie = collect($this->getMovieList())->firstWhere('id', (int) $id);

        if (!$movie) {
            abort(404, 'Film tidak ditemukan');
        }

        return view('movies.show', compact('movie'));
    }
}
