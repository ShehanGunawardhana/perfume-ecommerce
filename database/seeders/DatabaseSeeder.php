<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Perfume;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::create([
            'name' => 'Admin',
            'email' => 'admin@maisonnoir.example',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Sample customer
        User::create([
            'name' => 'Sample Customer',
            'email' => 'customer@maisonnoir.example',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Categories
        $categories = collect(['Floral', 'Woody', 'Oriental', 'Fresh', 'Gourmand', 'Citrus'])->map(
            fn ($name) => Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => "Fragrances built around a {$name} accord.",
                'is_active' => true,
            ])
        );

        // Sample perfumes
        $samples = [
            ['name' => 'Velvet Oud', 'brand' => 'Maison Noir', 'gender' => 'unisex', 'price' => 145, 'family' => 'Oriental'],
            ['name' => 'Amber Dusk', 'brand' => 'Maison Noir', 'gender' => 'women', 'price' => 120, 'family' => 'Oriental'],
            ['name' => 'Cedar & Salt', 'brand' => 'Maison Noir', 'gender' => 'men', 'price' => 98, 'family' => 'Woody'],
            ['name' => 'Neroli Bloom', 'brand' => 'Maison Noir', 'gender' => 'women', 'price' => 110, 'family' => 'Floral'],
            ['name' => 'Citrus Verte', 'brand' => 'Maison Noir', 'gender' => 'unisex', 'price' => 85, 'family' => 'Citrus'],
            ['name' => 'Vanilla Smoke', 'brand' => 'Maison Noir', 'gender' => 'unisex', 'price' => 130, 'family' => 'Gourmand'],
        ];

        foreach ($samples as $i => $sample) {
            Perfume::create([
                'category_id' => $categories->firstWhere('name', $sample['family'])->id,
                'name' => $sample['name'],
                'slug' => Str::slug($sample['name']),
                'brand' => $sample['brand'],
                'description' => "{$sample['name']} is a signature composition from Maison Noir, built to last from first spray to final dry-down.",
                'price' => $sample['price'],
                'stock' => 25,
                'gender' => $sample['gender'],
                'volume' => '100ml',
                'fragrance_family' => $sample['family'],
                'concentration' => 'Eau de Parfum',
                'top_notes' => 'Bergamot, Pink Pepper',
                'middle_notes' => 'Jasmine, Iris',
                'base_notes' => 'Sandalwood, Amber, Musk',
                'longevity' => '8+ hours',
                'season' => 'All Season',
                'occasion' => 'Evening',
                'is_featured' => $i < 4,
                'is_active' => true,
            ]);
        }
    }
}
