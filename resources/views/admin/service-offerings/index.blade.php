<x-layouts.admin title="Catalog">
    <x-slot:actions>
        <x-ui.link-button :href="route('admin.service-offerings.create')" size="sm">Add service</x-ui.link-button>
    </x-slot:actions>

    <x-ui.table :columns="['Name', 'Category', 'Price', 'Status', '']" :empty="$serviceOfferings->isEmpty()" empty-text="No services yet.">
        @foreach ($serviceOfferings as $serviceOffering)
            <tr>
                <td class="px-4 py-3 font-medium text-text">{{ $serviceOffering->name }}@if ($serviceOffering->is_featured)<x-ui.badge tone="warning" class="ml-2">Featured</x-ui.badge>@endif</td>
                <td class="px-4 py-3 text-muted">{{ \Illuminate\Support\Str::headline($serviceOffering->category) }}</td>
                <td class="px-4 py-3">{{ $company->currency }} {{ number_format((float) $serviceOffering->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3">
                    <x-ui.badge :tone="$serviceOffering->is_active ? 'success' : 'neutral'">{{ $serviceOffering->is_active ? 'Active' : 'Hidden' }}</x-ui.badge>
                    @if ($serviceOffering->is_unavailable)
                        <x-ui.badge tone="danger" class="ml-1">Unavailable</x-ui.badge>
                    @endif
                </td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.service-offerings.edit', $serviceOffering) }}" class="text-muted hover:underline">Edit</a>
                    <x-ui.confirm-form :action="route('admin.service-offerings.destroy', $serviceOffering)" message="Delete this service?" confirm-label="Delete" trigger-class="ml-3 text-danger hover:underline">Delete</x-ui.confirm-form>
                </td>
            </tr>
        @endforeach
    </x-ui.table>
</x-layouts.admin>
