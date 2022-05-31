<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoriler')->insert([
            ['id' => 1, 'link' => 'cografya', 'isim' => 'Coğrafya', 'renk' => 'bg-blue-400', 'icon' => '/storage/img/cografya.svg'],
            ['id' => 2, 'link' => 'tarih', 'isim' => 'Tarih', 'renk' => 'bg-yellow-600', 'icon' => '/storage/img/1043546.svg'],
            ['id' => 3, 'link' => 'yemek', 'isim' => 'Yemek', 'renk' => 'bg-green-500', 'icon' => '/storage/img/yemek.svg'],
            ['id' => 4, 'link' => 'moda', 'isim' => 'Moda', 'renk' => 'bg-red-300', 'icon' => '/storage/img/3050253.svg'],
            ['id' => 5, 'link' => 'burclar', 'isim' => 'Burçlar', 'renk' => 'bg-indigo-400', 'icon' => '/storage/img/2647288.svg'],
            ['id' => 6, 'link' => 'bilim', 'isim' => 'Bilim', 'renk' => 'bg-green-400', 'icon' => '/storage/img/3081530.svg'],
            ['id' => 7, 'link' => 'teknoloji', 'isim' => 'Teknoloji', 'renk' => 'bg-blue-300', 'icon' => '/storage/img/538807.svg'],
            ['id' => 8, 'link' => 'genel-kultur', 'isim' => 'Genel Kültür', 'renk' => 'bg-red-400', 'icon' => '/storage/img/3100752.svg'],
            ['id' => 9, 'link' => 'yabanci-dil', 'isim' => 'Yabancı Dil', 'renk' => 'bg-blue-400', 'icon' => '/storage/img/1973739.svg'],
            ['id' => 10, 'link' => 'egitim', 'isim' => 'Eğitim', 'renk' => 'bg-blue-400', 'icon' => '/storage/img/2987867.svg'],
            ['id' => 11, 'link' => 'oyunlar', 'isim' => 'Oyunlar', 'renk' => 'bg-blue-500', 'icon' => '/storage/img/2949874.svg'],
            ['id' => 12, 'link' => 'dizi-film', 'isim' => 'Dizi-Film', 'renk' => 'bg-red-500', 'icon' => '/storage/img/3163478.svg'],
            ['id' => 13, 'link' => 'sanat', 'isim' => 'Sanat', 'renk' => 'bg-red-500', 'icon' => '/storage/img/2970785.svg'],
            ['id' => 14, 'link' => 'iliskiler', 'isim' => 'İlişkiler', 'renk' => 'bg-red-500', 'icon' => '/storage/img/4003343.svg'],
            ['id' => 15, 'link' => 'muzik', 'isim' => 'Müzik', 'renk' => 'bg-green-400', 'icon' => '/storage/img/music.svg'],
        ]);
    }
}
