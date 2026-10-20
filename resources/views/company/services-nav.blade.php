{{-- On the services scenes the side card becomes the services index, so the guest can step between services without going back. --}}
<aside class="stage-services" aria-label="{{ $labels['services_heading'] }}">
    <a href="{{ route('company.show', ['companySlug' => $company->slug, 'lang' => $locale]) }}" data-stage-exit data-tour-line="{{ $narration['tour_home'] }}" class="stage-services-back"><span aria-hidden="true">‹</span> {{ $stageCopy['explore'] }}</a>
    <p class="stage-eyebrow">{{ $labels['services_heading'] }}</p>
    <nav class="item-nav">
        @foreach ($serviceOfferings->groupBy('category') as $category => $group)
            <p class="item-nav-heading">{{ $terms['category'][$category] ?? Str::headline($category) }}</p>
            @foreach ($group as $item)
                <a href="{{ route('company.service-offering', ['companySlug' => $company->slug, 'itemSlug' => $item->slug, 'lang' => $locale]) }}"
                    data-stage-exit
                    @if (($serviceOffering ?? null)?->slug === $item->slug) aria-current="page" @endif>
                    @if ($item->image_source)
                        <img class="item-nav-thumb" src="{{ $item->image_source }}" alt="" loading="lazy">
                    @endif
                    <span class="item-nav-text">
                        <span class="item-nav-name">{{ $item->translatedName($locale) }}</span>
                        <span class="item-nav-price">{{ $company->currency }} {{ number_format((float) $item->price, 0, ',', '.') }}@if ($item->is_unavailable)<span class="item-nav-badge">{{ $stageCopy['sold_out'] }}</span>@endif</span>
                    </span>
                </a>
            @endforeach
        @endforeach
    </nav>
    <span class="stage-services-footer">{{ $stageCopy['available'] }} · IT COMPANY AI</span>
</aside>
