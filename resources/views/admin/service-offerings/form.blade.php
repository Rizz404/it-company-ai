@php($isEdit = $serviceOffering->exists)

<x-layouts.admin :title="$isEdit ? 'Edit service' : 'Add service'">
    <form method="POST" action="{{ $isEdit ? route('admin.service-offerings.update', $serviceOffering) : route('admin.service-offerings.store') }}" class="space-y-8">
        @csrf
        @if ($isEdit) @method('PUT') @endif

        <x-ui.card heading="Basics">
            <div class="mt-4 grid grid-cols-2 gap-4">
                <x-ui.select name="category" label="Category">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" @selected(old('category', $serviceOffering->category) === $category)>{{ \Illuminate\Support\Str::headline($category) }}</option>
                    @endforeach
                </x-ui.select>
                <x-ui.input name="price" type="number" label="Initial estimate" step="500" :value="old('price', $serviceOffering->price)" required />
                <x-ui.input name="name" label="Name (Indonesian, default)" :value="old('name', $serviceOffering->name)" required class="col-span-2" />
                <x-ui.textarea name="description" label="Description (Indonesian, default)" :value="old('description', $serviceOffering->description)" class="col-span-2" />
                <x-ui.input name="translations[en][name]" label="Name (English)" :value="old('translations.en.name', $serviceOffering->translations['en']['name'] ?? '')" />
                <x-ui.input name="translations[ja][name]" label="Name (Japanese)" :value="old('translations.ja.name', $serviceOffering->translations['ja']['name'] ?? '')" />
                <x-ui.textarea name="translations[en][description]" label="Description (English)" :value="old('translations.en.description', $serviceOffering->translations['en']['description'] ?? '')" />
                <x-ui.textarea name="translations[ja][description]" label="Description (Japanese)" :value="old('translations.ja.description', $serviceOffering->translations['ja']['description'] ?? '')" />
            </div>
        </x-ui.card>

        <x-ui.card heading="Details">
            <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-4">
                <x-ui.input name="delivery_model" label="Delivery model" :value="old('delivery_model', $serviceOffering->delivery_model)" placeholder="remote, hybrid, onsite" />
                <x-ui.input name="delivery_days" type="number" label="Estimated working days" min="0" :value="old('delivery_days', $serviceOffering->delivery_days)" />
                <x-ui.input name="sort_order" type="number" label="Sort order" :value="old('sort_order', $serviceOffering->sort_order)" />
            </div>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <x-ui.input name="tags" label="Tags (comma-separated)" :value="old('tags', implode(', ', $serviceOffering->tags ?? []))" placeholder="scalable, secure, automation" />
                <x-ui.input name="prerequisites" label="Prerequisites (comma-separated)" :value="old('prerequisites', implode(', ', $serviceOffering->prerequisites ?? []))" placeholder="business_brief, api_access" />
                <x-ui.input name="image_url" label="Image path or URL" :value="old('image_url', $serviceOffering->image_url)" placeholder="images/scenes/lab.png or https://…" class="sm:col-span-2" />
            </div>
            <div class="mt-4 flex flex-wrap gap-6">
                <x-ui.checkbox name="is_featured" label="Featured" :checked="old('is_featured', $serviceOffering->is_featured)" />
                <x-ui.checkbox name="is_unavailable" label="Temporarily unavailable" :checked="old('is_unavailable', $serviceOffering->is_unavailable)" />
                <x-ui.checkbox name="is_active" label="Published (visible on the website)" :checked="old('is_active', $serviceOffering->is_active)" />
            </div>
        </x-ui.card>

        <div class="flex justify-end gap-3">
            <x-ui.link-button :href="route('admin.service-offerings.index')" variant="secondary">Cancel</x-ui.link-button>
            <x-ui.button type="submit">Save service</x-ui.button>
        </div>
    </form>
</x-layouts.admin>
