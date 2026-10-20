<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public const NAME = 'IT Company AI';

    public function run(): void
    {
        Company::firstOrCreate(['slug' => 'it-company-ai'], [
            'name' => 'IT Company AI',
            'slug' => 'it-company-ai',
            'description' => 'Demo perusahaan teknologi: dari ide bisnis menjadi solusi digital yang terukur.',
            'translations' => [
                'en' => [
                    'description' => 'A technology company demo: turning business ideas into measurable digital solutions.',
                ],
                'ja' => [
                    'description' => 'IT企業のデモ。ビジネスのアイデアを、成果につながるデジタルソリューションへ。',
                ],
            ],
            'city' => 'Jakarta',
            'country' => 'Indonesia',
            'address' => null,
            'phone' => null,
            'whatsapp' => null,
            'email' => 'hello@itcompanyai.test',
            'instagram' => null,
            'timezone' => 'Asia/Jakarta',
            'currency' => 'IDR',
            'default_locale' => 'id',
            'opening_time' => '09:00',
            'closing_time' => '17:00',
            'public_status' => 'published',
        ]);
    }
}
