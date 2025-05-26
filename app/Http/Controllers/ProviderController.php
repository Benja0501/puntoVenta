<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::get();
        return view('admin.provider.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.provider.create');
    }

    public function store(StoreProviderRequest $request)
    {
        Provider::create($request->all());
        return redirect()->route('providers.index')->with('success', 'Provider created successfully');
    }

    public function show(Provider $provider)
    {
        return view('admin.provider.show', compact('provider'));
    }

    public function edit(Provider $provider)
    {
        return view('admin.provider.edit', compact('provider'));
    }

    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        return redirect()->route('providers.index')->with('success', 'Provider updated successfully');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')->with('success', 'Provider deleted successfully');
    }
}
