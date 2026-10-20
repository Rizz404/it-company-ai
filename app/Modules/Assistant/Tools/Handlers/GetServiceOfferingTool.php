<?php

namespace App\Modules\Assistant\Tools\Handlers;

use App\Modules\Assistant\Tools\Support\CatalogSummaries;
use App\Modules\Assistant\Tools\Tool;
use App\Modules\Assistant\Tools\ToolContext;
use App\Modules\Assistant\Tools\ToolResult;

final class GetServiceOfferingTool implements Tool
{
    public function name(): string
    {
        return 'get_service_offering';
    }

    public function definition(): array
    {
        return [
            'type' => 'function',
            'function' => [
                'name' => $this->name(),
                'description' => 'Read one IT service by its slug from search_services. Return its scope, indicative estimate, prerequisites, delivery model, and availability. Use for questions about a specific service.',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'service_offering_slug' => ['type' => 'string'],
                    ],
                    'required' => ['service_offering_slug'],
                ],
            ],
        ];
    }

    public function execute(ToolContext $context, array $arguments): ToolResult
    {
        $item = CatalogSummaries::serviceOfferingBySlug($context->company, (string) ($arguments['service_offering_slug'] ?? ''));

        if (! $item) {
            return new ToolResult('Service not found.');
        }

        $detail = [
            ...CatalogSummaries::serviceOffering($item, $context->company, $context->locale),
            'description' => $item->translatedDescription($context->locale),
            'delivery_days' => $item->delivery_days,
            'note' => 'price is an initial estimate; final scope, access requirements, timeline and fees must be agreed with the team.',
        ];

        return ToolResult::json($detail, ['type' => 'services_detail', 'item' => $detail]);
    }
}
