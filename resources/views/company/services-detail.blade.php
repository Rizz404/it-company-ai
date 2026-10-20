<x-company-stage :company="$company" :locale="$locale" :supported-locales="$supportedLocales" :labels="$labels" :stage-copy="$stageCopy" :narration="$narration" :scene="$scene" :backdrop="$backdrop" :nav-items="$navItems" :terms="$terms" :title="$serviceOffering->translatedName($locale).' · '.$company->name">
    @if($serviceOfferings->isNotEmpty())
        <x-slot:sidebar>@include('company.services-nav')</x-slot:sidebar>
    @endif

    <div class="stage-panels">
        @include('company.services-scene')
    </div>
</x-company-stage>
