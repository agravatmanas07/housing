<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of houses with filters and sorting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = House::query();

        // Price Range Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Location Filter (city extracted from location field)
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Property Type Filter (keywords in description)
        if ($request->filled('property_type')) {
            $query->where('description', 'like', '%' . $request->property_type . '%');
        }

        // Sorting by Price
        if ($request->filled('sort')) {
            $direction = $request->sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $direction);
        }

        $houses = $query->get();
        return view('houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new house.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('houses.create');
    }

    /**
     * Store a newly created house in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
        ]);

        $description = $this->generateDescription($request->name, $request->price, $request->location);
        House::create([
            'name' => $request->name,
            'description' => $description,
            'price' => $request->price,
            'location' => $request->location,
        ]);

        return redirect()->route('houses.index')->with('success', 'House added successfully.');
    }

    /**
     * Show the form for editing the specified house.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\View\View
     */
    public function edit(House $house)
    {
        return view('houses.edit', compact('house'));
    }

    /**
     * Update the specified house in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, House $house)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
        ]);

        $description = $request->input('regenerate_description')
            ? $this->generateDescription($request->name, $request->price, $request->location)
            : $request->description;

        $house->update([
            'name' => $request->name,
            'description' => $description,
            'price' => $request->price,
            'location' => $request->location,
        ]);

        return redirect()->route('houses.index')->with('success', 'House updated successfully.');
    }

    /**
     * Remove the specified house from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(House $house)
    {
        $house->delete();
        return redirect()->route('houses.index')->with('success', 'House deleted successfully.');
    }

    /**
     * Generate a house description using an AI API.
     *
     * @param  string  $name
     * @param  float  $price
     * @param  string  $location
     * @return string
     */
    private function generateDescription($name, $price, $location)
    {
        $prompt = "Generate a creative house description for a property named '$name' located in $location with a price of $$price.";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.ai.key'),
                'Content-Type' => 'application/json',
            ])->post(config('services.ai.url'), [
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 100,
                'temperature' => 0.7,
            ]);

            return $response->successful()
                ? trim($response->json()['choices'][0]['text'])
                : "A lovely home in $location.";
        } catch (\Exception $e) {
            return "Beautiful property in $location.";
        }
    }
}