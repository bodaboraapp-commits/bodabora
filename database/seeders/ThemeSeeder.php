<?php

namespace Database\Seeders;

use App\Models\Backend\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        $themes = [
            [
                'theme_name' => 'Theme 1',
                'thumbnail'  => 'images/theme/theme-1.png',
                'is_active'  => true,
                'file_path'  => 'frontend/theme-1',
                'primary_color' => '#7e0095',
                'text_color' => '#ffffff',
            ],
            [
                'theme_name' => 'Theme 2',
                'thumbnail'  => 'images/theme/theme-2.png',
                'is_active'  => false,
                'file_path'  => 'frontend/theme-2',
                'primary_color' => '#16a34a',
                'text_color' => '#ffffff',
            ],
            [
                'theme_name' => 'Theme 3',
                'thumbnail'  => 'images/theme/theme-3.png',
                'is_active'  => false,
                'file_path'  => 'frontend/theme-3',
                'primary_color' => '#22c55e',
                'text_color' => '#ffffff',
            ],
            [
                'theme_name' => 'Theme 4',
                'thumbnail'  => 'images/theme/theme-4.png',
                'is_active'  => false,
                'file_path'  => 'frontend/theme-4',
                'primary_color' => '#16a34a',
                'text_color' => '#ffffff',
            ],
            [
                'theme_name' => 'Theme 5',
                'thumbnail'  => 'images/theme/theme-5.png',
                'is_active'  => false,
                'file_path'  => 'frontend/theme-5',
                'primary_color' => '#0ea5e9',
                'text_color' => '#ffffff',
            ],
        ];

        foreach ($themes as $theme) {
            Theme::updateOrCreate(
                ['file_path' => $theme['file_path']],
                $theme
            );
        }
    }
}
