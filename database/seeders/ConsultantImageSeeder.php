<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class ConsultantImageSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('slug', 'it-company-ai')->firstOrFail();
        foreach ($company->consultants as $consultant) {
            $consultant->images()->updateOrCreate(['image_url' => 'images/scenes/meeting.png'], [
                'alt_text' => 'Illustrated consultation studio', 'tags' => ['video_call', 'consultation'], 'sort_order' => 0,
            ]);
        }
    }
}
