<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        //commented this syntax because getting error
        //DB::statement('ALTER TABLE languages AUTO_INCREMENT = 1');

        DB::table('languages')->insert([
            [
                'code' => 'en',
                'name' => 'English',
                'direction' => 'ltr',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'emoji' => 'flag-icon-us',
            ],
            [
                'code' => 'ur',
                'name' => 'Urdu',
                'direction' => 'rtl',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'emoji' => 'flag-icon-pk',
            ],
            [
                'code' => 'ar',
                'name' => 'Arabic',
                'direction' => 'rtl',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'emoji' => 'flag-icon-ae',
            ],
            [
                'code' => 'hi',
                'name' => 'Hindi',
                'direction' => 'ltr',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'emoji' => 'flag-icon-in',
            ],

            // Add more records as needed

        ]);
    }
}
