<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\BusinessSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        // General settings logic (e.g. site title, maintenance mode)
        return back()->with('success', 'Settings updated.');
    }

    public function business()
    {
        $business = BusinessSetting::first();
        return view('admin.settings.business', compact('business'));
    }

    public function businessUpdate(Request $request)
    {
        $business = BusinessSetting::first();
        if (!$business)
            $business = new BusinessSetting();

        $business->company_name = $request->company_name;
        $business->company_email = $request->company_email;
        // ... other fields
        $business->save();

        return back()->with('success', 'Business Info updated.');
    }
}
