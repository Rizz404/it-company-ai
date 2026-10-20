<?php

namespace App\Modules\Catalog\Actions;

use App\Models\Company;
use App\Models\ServiceOffering;
use Illuminate\Support\Str;

/**
 * Creates a service or updates one. A new item gets a slug from its name; an
 * existing one keeps its slug so guest links never break.
 */
class SaveServiceOffering
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(Company $company, array $attributes, ?ServiceOffering $serviceOffering = null): ServiceOffering
    {
        if ($serviceOffering) {
            $serviceOffering->update($attributes);

            return $serviceOffering;
        }

        return $company->serviceOfferings()->create([...$attributes, 'slug' => $this->uniqueSlug($company, $attributes['name'])]);
    }

    private function uniqueSlug(Company $company, string $name): string
    {
        $base = Str::slug($name) ?: 'item';
        $slug = $base;
        $suffix = 1;

        while ($company->serviceOfferings()->withTrashed()->where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
