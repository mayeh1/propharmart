<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $groups = [
            'site_name',
            'tagline',
            'phone',
            'email',
            'address',
            'hero_title',
            'hero_subtitle',
            'footer_text',
            'shipping_message',
            'welcome_message',
        ];

        foreach ($groups as $key) {
            if ($request->has($key)) {
                SiteSetting::setValue($key, $request->input($key), 'general');
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Website settings updated successfully.');
    }
}
