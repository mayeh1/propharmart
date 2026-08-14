<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorefrontTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_brand_and_demo_products(): void
    {
        Product::create([
            'name' => 'Vitamin C Plus',
            'slug' => 'vitamin-c-plus',
            'sku' => 'PRO-VC-001',
            'description' => 'Daily immune support formula.',
            'short_description' => 'Immune support formula',
            'price' => 29.99,
            'compare_price' => 39.99,
            'stock' => 25,
            'status' => 'published',
            'featured' => true,
            'category' => 'Wellness',
            'image' => 'https://images.unsplash.com/...',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('PROPHAMART');
        $response->assertSee('Vitamin C Plus');
    }

    public function test_customer_can_add_product_to_cart_and_checkout(): void
    {
        Product::create([
            'name' => 'Omega 3 Fish Oil',
            'slug' => 'omega-3-fish-oil',
            'sku' => 'PRO-OM-002',
            'description' => 'High-quality omega 3 support.',
            'short_description' => 'Omega 3 support',
            'price' => 34.99,
            'compare_price' => 44.99,
            'stock' => 15,
            'status' => 'published',
            'featured' => true,
            'category' => 'Supplements',
            'image' => 'https://images.unsplash.com/...',
        ]);

        $this->post('/cart/add/omega-3-fish-oil', ['quantity' => 2])
            ->assertRedirect('/cart');

        $this->get('/cart')->assertOk()->assertSee('Omega 3 Fish Oil');

        $this->post('/checkout', [
            'customer_name' => 'Jane Buyer',
            'customer_email' => 'jane@example.com',
            'customer_phone' => '+44 7711 000111',
            'shipping_address' => '12 Wellness Road, London',
        ])->assertRedirect();

        $this->assertDatabaseHas('orders', ['customer_email' => 'jane@example.com']);
    }
}
