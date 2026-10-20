<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class ConsultationSlotSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('company:open-slots', ['--company' => 'it-company-ai']);
    }
}
