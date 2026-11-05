<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\GeneralSettings;
use App\Models\Backend\Theme;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::orderBy('id')->get();

        return view('backend.theme.index', compact('themes'));
    }

    public function activate(Request $request)
    {
        $request->validate([
            'theme_id' => 'required|exists:themes,id',
        ]);

        $theme = Theme::findOrFail($request->theme_id);

        Theme::query()->update(['is_active' => false]);
        $theme->update(['is_active' => true]);

        $settings = GeneralSettings::find(1);
        if ($settings) {
            if ($theme->primary_color) {
                $settings->primary_color = $theme->primary_color;
            }

            if ($theme->text_color) {
                $settings->text_color = $theme->text_color;
            }

            $settings->save();
        }

        Cache::forget('active_theme');

        Toastr::success(__('theme.activated_successfully'), __('message.success'));

        return redirect()->route('theme.index');
    }
}
