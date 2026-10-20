<?php

namespace App\Modules\Assistant\Tools\Support;

use App\Models\Company;
use App\Models\Consultant;
use App\Models\ServiceOffering;

/**
 * The compact facts about a service or consultant that both the model and
 * the guest's cards are given.
 */
final class CatalogSummaries
{
    /**
     * @return array<string, mixed>
     */
    public static function serviceOffering(ServiceOffering $item, Company $company, string $locale): array
    {
        return [
            'service_offering_slug' => $item->slug,
            'name' => $item->translatedName($locale),
            'category' => $item->category,
            'price' => (float) $item->price,
            'price_type' => 'estimate',
            'delivery_days_estimate' => $item->delivery_days,
            'currency' => $company->currency,
            'delivery_model' => $item->delivery_model,
            'tags' => $item->tags ?? [],
            'prerequisites' => $item->prerequisites ?? [],
            'is_unavailable' => $item->is_unavailable,
            'image_url' => $item->image_source,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function consultant(Consultant $area, Company $company, string $locale): array
    {
        return [
            'name' => $area->translatedName($locale),
            'specialty' => $area->specialty,
            'min_participants' => $area->min_participants,
            'max_participants' => $area->max_participants,
            'features' => $area->features ?? [],
            'consultation_fee' => (float) $area->consultation_fee,
            'project_budget_from' => $area->project_budget_from !== null ? (float) $area->project_budget_from : null,
            'currency' => $company->currency,
            'thumbnail_url' => $area->images->first()?->image_source,
        ];
    }

    public static function serviceOfferingBySlug(Company $company, string $slug): ?ServiceOffering
    {
        return $company->serviceOfferings()->where('is_active', true)->where('slug', $slug)->first();
    }

    public static function consultantBySlug(Company $company, string $slug): ?Consultant
    {
        return $company->consultants()->where('is_active', true)->where('slug', $slug)->first();
    }
}
