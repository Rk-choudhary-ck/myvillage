<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        foreach ($inputs as $key => $value) {
            if ($request->hasFile($key)) {
                $old = Setting::where('key', $key)->value('value');
                if ($old) Storage::disk('public')->delete($old);
                $value = $request->file($key)->store('settings', 'public');
            }
            Setting::set($key, $value);
        }

        // Clear all setting caches
        Cache::flush();

        return back()->with('success', 'Settings saved successfully!');
    }

    public function clearCache()
    {
        Cache::flush();
        return back()->with('success', 'Cache cleared!');
    }
}
