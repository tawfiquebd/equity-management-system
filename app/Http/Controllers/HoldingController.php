<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoldingRequest;
use App\Models\Client;
use App\Models\Holding;
use Illuminate\Http\Request;

class HoldingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holdings = Holding::with('client')
            ->latest()
            ->paginate(10);

        return view('holdings.index', compact('holdings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all(); // for dropdown

        return view('holdings.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HoldingRequest $request)
    {
        Holding::query()->create($request->validated());

        return redirect()
            ->route('holdings.index')
            ->with('success', 'Holding created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Holding $holding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holding $holding)
    {
        $clients = \App\Models\Client::all();
        return view('holdings.edit', compact('holding', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HoldingRequest $request, Holding $holding)
    {
        $holding->update($request->validated());

        return redirect()
            ->route('holdings.index')
            ->with('success', 'Holding updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holding $holding)
    {
        $holding->delete();

        return redirect()
            ->route('holdings.index')
            ->with('success', 'Holding deleted.');
    }
}
