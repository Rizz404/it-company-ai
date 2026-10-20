<?php

namespace App\Http\Requests\Admin;

use App\Modules\Catalog\Enums\ServiceCategory;
use App\Support\Text;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Create or update a service. The route model binding and the policy decide
 * whose service it is; this decides what may be written.
 */
class ServiceOfferingRequest extends FormRequest
{
    /**
     * A record of another company is "not found" before anything is validated.
     */
    public function authorize(): bool
    {
        $record = $this->route('service_offering');

        if ($record) {
            Gate::authorize('update', $record);
        }

        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'category' => ['required', 'string', Rule::in(ServiceCategory::values())],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'translations.en.name' => ['nullable', 'string'],
            'translations.en.description' => ['nullable', 'string'],
            'translations.ja.name' => ['nullable', 'string'],
            'translations.ja.description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'tags' => ['nullable', 'string'],
            'prerequisites' => ['nullable', 'string'],
            'delivery_model' => ['nullable', Rule::in(['remote', 'hybrid', 'onsite'])],
            'delivery_days' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'is_featured' => ['sometimes', 'boolean'],
            'is_unavailable' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * The columns to write, without the slug (which only a new item gets).
     *
     * @return array<string, mixed>
     */
    public function serviceOfferingAttributes(): array
    {
        $data = $this->validated();

        return [
            'category' => $data['category'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'translations' => [
                'en' => ['name' => $data['translations']['en']['name'] ?? null, 'description' => $data['translations']['en']['description'] ?? null],
                'ja' => ['name' => $data['translations']['ja']['name'] ?? null, 'description' => $data['translations']['ja']['description'] ?? null],
            ],
            'price' => $data['price'],
            'image_url' => $data['image_url'] ?? null,
            'tags' => Text::slugList($data['tags'] ?? null),
            'prerequisites' => Text::slugList($data['prerequisites'] ?? null),
            'delivery_model' => filled($data['delivery_model'] ?? null) ? Str::of($data['delivery_model'])->trim()->slug('_')->toString() : null,
            'delivery_days' => $data['delivery_days'] ?? null,
            'is_featured' => $this->boolean('is_featured'),
            'is_unavailable' => $this->boolean('is_unavailable'),
            'is_active' => $this->boolean('is_active'),
            'sort_order' => $data['sort_order'] ?? 0,
        ];
    }
}
