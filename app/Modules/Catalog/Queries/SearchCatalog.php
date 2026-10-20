<?php

namespace App\Modules\Catalog\Queries;

use App\Models\Company;
use App\Models\ServiceOffering;
use App\Support\SearchText;
use Illuminate\Support\Collection;

/**
 * The active services, narrowed by keyword, category, solution need or budget.
 */
class SearchCatalog
{
    /**
     * @return Collection<int, ServiceOffering>
     */
    public function handle(Company $company, string $query = '', ?string $category = null, ?string $solution = null, ?float $maxPrice = null, int $limit = 6): Collection
    {
        $query = SearchText::normalize($query);

        return $company->serviceOfferings()
            ->where('is_active', true)
            ->when($category, fn ($q) => $q->where('category', $category))
            ->orderBy('sort_order')
            ->get()
            ->filter(fn (ServiceOffering $item) => ! $solution || $item->hasTag($solution))
            ->filter(fn (ServiceOffering $item) => $maxPrice === null || (float) $item->price <= $maxPrice)
            ->filter(fn (ServiceOffering $item) => SearchText::matches(implode(' ', [
                $item->name,
                $item->description,
                $item->category,
                implode(' ', $item->tags ?? []),
                collect($item->translations ?? [])->flatten()->implode(' '),
            ]), $query))
            ->take($limit);
    }
}
