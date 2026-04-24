<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        
        $catDesign = Category::create(['name' => 'Design & UI/UX', 'slug' => 'design-uiux']);
        $catTech = Category::create(['name' => 'Technology & AI', 'slug' => 'tech-ai']);
        $catGaming = Category::create(['name' => 'E-Sports', 'slug' => 'e-sports']);

        
        $events = [
            [
                'category_id' => $catDesign->id,
                'title' => 'UI/UX Masterclass: From Zero to Hero',
                'description' => 'Belajar fundamental desain produk dan prototyping menggunakan Figma.',
                'date' => '2026-06-15 09:00:00',
                'location' => 'Lab ICT Amikom',
                'price' => 75000,
                'stock' => 50,
                'poster_path' => 'posters/uiux.png',
            ],
            [
                'category_id' => $catDesign->id,
                'title' => 'Graphic Design Workshop',
                'description' => 'Eksplorasi kreativitas dalam desain visual untuk branding modern.',
                'date' => '2026-06-20 13:00:00',
                'location' => 'Cinema Unit 6',
                'price' => 45000,
                'stock' => 100,
                'poster_path' => 'posters/graphic.png',
            ],
            [
                'category_id' => $catTech->id,
                'title' => 'Deep Learning with Python',
                'description' => 'Implementasi Neural Networks untuk pemula hingga tingkat lanjut.',
                'date' => '2026-07-05 10:00:00',
                'location' => 'Inkubator Amikom',
                'price' => 120000,
                'stock' => 30,
                'poster_path' => 'posters/ai-tech.png',
            ],
            [
                'category_id' => $catTech->id,
                'title' => 'Cloud Computing Essential',
                'description' => 'Mengenal infrastruktur AWS dan Google Cloud untuk scalability apps.',
                'date' => '2026-07-10 08:00:00',
                'location' => 'Daring via Zoom',
                'price' => 0,
                'stock' => 500,
                'poster_path' => 'posters/cloud.png',
            ],
            [
                'category_id' => $catGaming->id,
                'title' => 'E-Sport U-Champ: Valorant Tournament',
                'description' => 'Turnamen bergengsi antar mahasiswa Amikom memperebutkan hadiah jutaan rupiah.',
                'date' => '2026-08-01 10:00:00',
                'location' => 'Basement Unit 3',
                'price' => 250000,
                'stock' => 16,
                'poster_path' => 'posters/valorant.png',
            ],
            [
                'category_id' => $catGaming->id,
                'title' => 'Mobile Legends National Series',
                'description' => 'Ajang seleksi tim pro-player untuk mewakili kampus di kancah nasional.',
                'date' => '2026-08-05 09:00:00',
                'location' => 'Amikom Baru',
                'price' => 150000,
                'stock' => 32,
                'poster_path' => 'posters/mlbb.png',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}