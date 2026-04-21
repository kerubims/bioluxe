<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'receipt_footer' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '', 'group' => 'general']
            );
        }

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
