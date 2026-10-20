<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ResolvesCurrentCompany;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceOfferingRequest;
use App\Models\ServiceOffering;
use App\Modules\Catalog\Actions\SaveServiceOffering;
use App\Modules\Catalog\Enums\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ServiceOfferingController extends Controller
{
    use ResolvesCurrentCompany;

    public function index(Request $request): View
    {
        $company = $this->currentCompany($request);

        $serviceOfferings = $company->serviceOfferings()->orderBy('category')->orderBy('sort_order')->get();

        return view('admin.service-offerings.index', compact('company', 'serviceOfferings'));
    }

    public function create(Request $request): View
    {
        $company = $this->currentCompany($request);

        return view('admin.service-offerings.form', [
            'company' => $company,
            'serviceOffering' => new ServiceOffering(['category' => ServiceOffering::CATEGORY_WEB, 'is_active' => true]),
            'categories' => ServiceCategory::values(),
        ]);
    }

    public function store(ServiceOfferingRequest $request, SaveServiceOffering $save): RedirectResponse
    {
        $serviceOffering = $save->handle($this->currentCompany($request), $request->serviceOfferingAttributes());

        return redirect()->route('admin.service-offerings.index')->with('status', "Service \"{$serviceOffering->name}\" created.");
    }

    public function edit(Request $request, ServiceOffering $serviceOffering): View
    {
        $company = $this->currentCompany($request);
        Gate::authorize('update', $serviceOffering);

        return view('admin.service-offerings.form', [
            'company' => $company,
            'serviceOffering' => $serviceOffering,
            'categories' => ServiceCategory::values(),
        ]);
    }

    public function update(ServiceOfferingRequest $request, ServiceOffering $serviceOffering, SaveServiceOffering $save): RedirectResponse
    {
        $save->handle($this->currentCompany($request), $request->serviceOfferingAttributes(), $serviceOffering);

        return redirect()->route('admin.service-offerings.index')->with('status', "Service \"{$serviceOffering->name}\" updated.");
    }

    public function destroy(Request $request, ServiceOffering $serviceOffering): RedirectResponse
    {
        $this->currentCompany($request);
        Gate::authorize('delete', $serviceOffering);

        $serviceOffering->delete();

        return redirect()->route('admin.service-offerings.index')->with('status', 'Service deleted.');
    }
}
