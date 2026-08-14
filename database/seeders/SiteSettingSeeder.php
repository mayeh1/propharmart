<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'PROPHAMART', 'group' => 'general'],
            ['key' => 'tagline', 'value' => 'Health • Care • Delivered', 'group' => 'general'],
            ['key' => 'phone', 'value' => '+44 20 5555 0142', 'group' => 'general'],
            ['key' => 'email', 'value' => 'hello@propharmat.com', 'group' => 'general'],
            ['key' => 'address', 'value' => '45 Regent Street, London, UK', 'group' => 'general'],
            ['key' => 'hero_title', 'value' => 'Trusted pharmacy essentials for everyday wellbeing.', 'group' => 'general'],
            ['key' => 'hero_subtitle', 'value' => 'Fast delivery, discreet service, and specialist wellness support for your health routine.', 'group' => 'general'],
            ['key' => 'footer_text', 'value' => 'PROPHAMART brings modern pharmacy care, wellbeing products, and trusted specialist support to your doorstep.', 'group' => 'general'],
            ['key' => 'shipping_message', 'value' => 'Free shipping on orders over £60', 'group' => 'general'],
            ['key' => 'welcome_message', 'value' => 'Welcome to PROPHAMART — your trusted health and wellness partner.', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
