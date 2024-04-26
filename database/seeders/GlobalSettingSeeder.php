<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GlobalSetting;

class GlobalSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $globalSettings = [
            [
                'name'        => 'Receive notifications',
                'value'       => true,
                'confirmable' => true,
            ],
            [
                'name'        => 'Profile name',
                'value'       => null,
                'confirmable' => false,
            ]
        ];

        GlobalSetting::insert($globalSettings);
    }
}
