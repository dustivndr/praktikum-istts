<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChageeController extends Controller
{
    public function index()
    {
        $teaCards = [
            [
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/752318e3-107a-4466-8e5f-9a0107fbd808.jpeg',
                'title' => 'Fresh Milk Tea',
                'desc' => 'Freshly brewed whole tea leaves mixed with pure fresh milk.'
            ],
            [
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/ce722714-97e2-4dff-89cf-ce7d80ba89a4.jpeg',
                'title' => 'Snow Cap Milk Tea',
                'desc' => 'Silky smooth whipped cream layer topped over aromatic tea.'
            ],
            [
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/fe61570f-6646-43b6-99a1-e324781ad189.jpeg',
                'title' => 'Fruit Tea Series',
                'desc' => 'Handpicked fresh fruits blended with freshly brewed tea.'
            ],
            [
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/93833d23-308e-4bce-a4a2-085058863286.jpeg',
                'title' => 'Brewed Tea',
                'desc' => 'Authentic original brewed tea extracted from premium leaves.'
            ],
            [
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/4f3d01b5-9d7d-4a6d-8418-636dabb6f264.jpeg',
                'title' => 'Teaspresso Latte',
                'desc' => 'Rich concentrated tea espresso paired with velvety milk.'
            ]
        ];

        return view('home', [
            'teaCards' => $teaCards
        ]);
    }

    public function about()
    {
        $pageData = [
            'hero_title' => 'OUR STORY',
            'hero_bg' => 'https://prod-chagee-official-vietnam.chagee.com/web/uploads/20240923/99fb684f-d9a3-48e3-9255-efb20c4a0b02.jpg',
            'intro_title' => 'TRADITIONAL TEA MADE MODERN',
            'intro_desc' => 'At CHAGEE, we leverage innovative methods to reimagine traditional oriental tea, creating a modern tea culture. Brewed with whole tea leaves and a commitment to health, we craft a tea-drinking experience that bridges heritage and is perfectly suited for modern taste buds.',
            'beginning_title' => 'THE BEGINNING',
            'beginning_desc' => 'CHAGEE\'s first store opened on 17 November 2017 in Yunnan, China. Drawing inspiration from the Ancient Tea and Horse Caravan Road, CHAGEE gradually expanded its footprint across and beyond China, establishing itself as one of the leading international tea beverage companies with over 6,000+ stores worldwide today.',
            'beginning_bg' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/c774eb1a-ade2-42c6-8361-eed7dd16e98b.jpeg',
            'mission_title' => 'BRAND MISSION',
            'mission_cn' => '以东方茶 会世界友',
            'mission_en' => 'CHAGEE TOGETHER!',
            'mission_img' => 'https://prod-chagee-official-vietnam.chagee.com/web/uploads/20240711/6d976ed2-c141-44f6-9778-0f903d4b8ce7.png',
            'goal_title' => 'OUR GOAL',
            'goals' => [
                'To serve tea lovers in 100 countries,',
                'To generate 300,000 employment opportunities worldwide,',
                'and deliver 15 billion cups of freshly brewed tea annually.'
            ]
        ];

        return view('about', [
            'data' => $pageData
        ]);
    }

    public function menu()
    {
        // Data Kategori Menu
        $menuSeries = [
            [
                'id' => 'fresh-milk-tea',
                'title' => 'Fresh Milk Tea',
                'desc' => 'The pillar of CHAGEE, the Fresh Milk Series. Freshly brewed with whole tea leaves and fresh milk, our fresh milk tea offers a healthy, low-calorie tea beverage with no toppings, making it suitable for everyday.',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/752318e3-107a-4466-8e5f-9a0107fbd808.jpeg'
            ],
            [
                'id' => 'snow-cap-milk-tea',
                'title' => 'Snow Cap Milk Tea',
                'desc' => 'Fresh milk tea paired with silky and light fresh cream topping, offering a rich and layered taste experience.',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/ce722714-97e2-4dff-89cf-ce7d80ba89a4.jpeg'
            ],
            [
                'id' => 'brewed-tea',
                'title' => 'Brewed Tea',
                'desc' => 'Freshly brewed tea made from original tea leaves, offering an aromatic fragrance and memorable aftertaste.',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/93833d23-308e-4bce-a4a2-085058863286.jpeg'
            ],
            [
                'id' => 'teaspresso-latte',
                'title' => 'Teaspresso Latte',
                'desc' => 'By using innovative extraction brewing techniques to prepare our tea, it allows for both the teas\' natural fragrance as well as the nutrition from the tea leaves to be wholly preserved.',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/4f3d01b5-9d7d-4a6d-8418-636dabb6f264.jpeg'
            ],
            [
                'id' => 'teaspresso-frappe',
                'title' => 'Teaspresso Frappé',
                'desc' => 'Treat yourself to the perfect blend of tea and frosty delight swirled with creamy layers, crafted to bring a little extra joy to your everyday.',
                'image' => 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?auto=format&fit=crop&w=1200&q=80'
            ],
            [
                'id' => 'fruit-tea-series',
                'title' => 'Fruit Tea Series',
                'desc' => 'Crafted with real fruit and freshly brewed tea leaves, every sip delivers a naturally refreshing taste, vibrant fruit notes, and a clean, lingering finish.',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/fe61570f-6646-43b6-99a1-e324781ad189.jpeg'
            ]
        ];

        return view('menu', [
            'menuSeries' => $menuSeries
        ]);
    }

    public function media()
    {
        // Menggunakan URL direct yang sudah diperbaiki
        $articles = [
            [
                'title' => 'CHAGEE Plans to Offer Modern Oriental Tea to 100 Countries and Regions',
                'desc' => 'On the Occasion of the International Tea Day 2024 – Modern Oriental Tea Innovation Forum, CHAGEE Plans to Offer Modern Oriental Tea to 100 Countries and Regions.',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/uploads/20240714/663dc1fd-6ea2-4f22-bd60-abc647d2f1f6.png'
            ],
            [
                'title' => 'A Healthier Cup of Tea',
                'desc' => 'Calling all tea lovers! Did you know that all CHAGEE beverages contain 3 zeroes?',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/uploads/20240828/7b16fa76-c83b-4652-9e6c-72798d6cb9b5.jpg'
            ],
            [
                'title' => 'CHAGEE Visited UNESCO Headquarters, Connecting the World Through Tea',
                'desc' => 'UNESCO Headquarters in Paris saw the commencement of the Tenth Bonjour Brand Forum on June 21. CHAGEE offered its products to global guests at the summit.',
                'image' => 'https://prod-chagee-official-vietnam.chagee.com/web/uploads/20240714/0c0e1a8e-0edc-40f8-8d26-6a067acd7a20.png'
            ]
        ];

        $jumbotronBg = 'https://prod-chagee-official-vietnam.chagee.com/web/uploads/20240711/85bd1a12-6a21-4266-b9d8-615b966debe3.jpg';

        return view('media', [
            'articles' => $articles,
            'jumbotronBg' => $jumbotronBg
        ]);
    }

    public function contact()
    {
        $contactData = [
            'title' => 'CONTACT US',
            'email' => 'support.id@chagee.com',
            'bg_image' => 'https://prod-chagee-official-vietnam.chagee.com/web/id/uploads/20260713/bb255577-3fa5-4bd3-b2e5-b69c609daf63.jpeg'
        ];

        return view('contact', [
            'contactData' => $contactData
        ]);
    }
}