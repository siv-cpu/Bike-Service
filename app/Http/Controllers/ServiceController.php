<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all(); //retrive all service
        return view('services.index', compact('services')); //pass data to view
    }

    public function create()
    {
        return view('services.create'); //Show service create form
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        Service::create($request->all()); //// Insert new service

        return redirect()->route('services.index')->with('success', 'Service added successfully!');
    }


    public function edit($id)
    {
        $service = Service::findOrFail($id); // Find the service by ID
        return view('services.edit', compact('service'));  // Pass the data to edit form
    }


    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id); // Fetch service by ID
        $service->update($request->all()); // Update new data
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }


    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete(); // Delete the record 
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
