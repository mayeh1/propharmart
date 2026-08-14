<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Vitamin C Plus',
                'slug' => 'vitamin-c-plus',
                'sku' => 'PRO-VC-001',
                'category' => 'Supplements',
                'image' => 'https://images.unsplash.com/photo-1723951174326-2a97221d3b7f?auto=format&fit=crop&w=900&q=80',
                'description' => 'A premium immune-support formula with vitamin C, zinc, and elderberry for everyday wellbeing.',
                'short_description' => 'Daily immune support',
                'price' => 29.99,
                'compare_price' => 39.99,
                'stock' => 36,
                'status' => 'published',
                'featured' => true,
            ],
            [
                'name' => 'Omega 3 Fish Oil',
                'slug' => 'omega-3-fish-oil',
                'sku' => 'PRO-OM-002',
                'category' => 'Supplements',
                'image' => 'https://images.unsplash.com/photo-1624362772755-4d5843e67047?auto=format&fit=crop&w=900&q=80',
                'description' => 'High-quality omega 3 support for heart and brain health, sourced from sustainably caught fish.',
                'short_description' => 'Heart and brain support',
                'price' => 34.99,
                'compare_price' => 44.99,
                'stock' => 15,
                'status' => 'published',
                'featured' => true,
            ],
            [
                'name' => 'Calcium & D3 Strong',
                'slug' => 'calcium-d3-strong',
                'sku' => 'PRO-CD-003',
                'category' => 'Bone Health',
                'image' => 'https://images.unsplash.com/photo-1588718889344-f7bd7a565d20?auto=format&fit=crop&w=900&q=80',
                'description' => 'A daily calcium and vitamin D3 formula to support strong bones and teeth.',
                'short_description' => 'Bone strength support',
                'price' => 24.99,
                'compare_price' => 29.99,
                'stock' => 40,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'name' => 'Probiotic Balance',
                'slug' => 'probiotic-balance',
                'sku' => 'PRO-PB-004',
                'category' => 'Gut Health',
                'image' => 'https://images.unsplash.com/photo-1664956617328-c2491040fa2c?auto=format&fit=crop&w=900&q=80',
                'description' => 'A multi-strain probiotic blend to support digestive wellness and gut balance.',
                'short_description' => 'Digestive wellness',
                'price' => 27.99,
                'compare_price' => 34.99,
                'stock' => 28,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'name' => 'Magnesium Sleep Care',
                'slug' => 'magnesium-sleep-care',
                'sku' => 'PRO-MS-005',
                'category' => 'Wellness',
                'image' => 'https://images.unsplash.com/photo-1649333243484-df91ff7b73ad?auto=format&fit=crop&w=900&q=80',
                'description' => 'A calming magnesium supplement to support relaxation and nighttime wind-down.',
                'short_description' => 'Nighttime relaxation',
                'price' => 22.99,
                'compare_price' => 27.99,
                'stock' => 32,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'name' => 'Protein Recovery Plus',
                'slug' => 'protein-recovery-plus',
                'sku' => 'PRO-PR-006',
                'category' => 'Fitness',
                'image' => 'https://images.unsplash.com/photo-1693996045300-521e9d08cabc?auto=format&fit=crop&w=900&q=80',
                'description' => 'A high-quality protein blend to support muscle recovery after training.',
                'short_description' => 'Muscle recovery support',
                'price' => 39.99,
                'compare_price' => 49.99,
                'stock' => 20,
                'status' => 'published',
                'featured' => true,
            ],
            [
                'name' => 'Joint Care Formula',
                'slug' => 'joint-care-formula',
                'sku' => 'PRO-JC-007',
                'category' => 'Mobility',
                'image' => 'https://images.unsplash.com/photo-1702353531290-8fe0bfbf2732?auto=format&fit=crop&w=900&q=80',
                'description' => 'A glucosamine and chondroitin blend to support joint comfort and mobility.',
                'short_description' => 'Joint mobility support',
                'price' => 32.99,
                'compare_price' => 39.99,
                'stock' => 24,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'name' => 'Daily Greens Boost',
                'slug' => 'daily-greens-boost',
                'sku' => 'PRO-DG-008',
                'category' => 'Nutrition',
                'image' => 'https://images.unsplash.com/photo-1781377012601-93162be3a433?auto=format&fit=crop&w=900&q=80',
                'description' => 'A daily greens blend packed with vitamins, minerals, and antioxidants.',
                'short_description' => 'Daily nutrition blend',
                'price' => 26.99,
                'compare_price' => 32.99,
                'stock' => 30,
                'status' => 'published',
                'featured' => true,
            ],
        ];

        foreach ($products as $item) {
            $imageUrl = $item['image'];
            unset($item['image']);

            $product = Product::updateOrCreate(['sku' => $item['sku']], $item);

            $product->images()->firstOrCreate(['sort_order' => 0], ['url' => $imageUrl]);
        }
    }
}
