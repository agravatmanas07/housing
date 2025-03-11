@extends('layouts.app')

@section('title', 'Houses')

@section('content')
<h1 class="mb-4 animate__animated animate__fadeInDown">House Listings</h1>

<!-- Filter Form -->
<div class="card mb-4 animate__animated animate__fadeIn">
    <div class="card-body">
        <form method="GET" action="{{ route('houses.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="min_price" class="form-label">Min Price</label>
                <input type="number" step="0.01" class="form-control" id="min_price" name="min_price" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-3">
                <label for="max_price" class="form-label">Max Price</label>
                <input type="number" step="0.01" class="form-control" id="max_price" name="max_price" value="{{ request('max_price') }}">
            </div>
            <div class="col-md-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ request('location') }}" placeholder="e.g., Malibu">
            </div>
            <div class="col-md-3">
                <label for="property_type" class="form-label">Property Type</label>
                <input type="text" class="form-control" id="property_type" name="property_type" value="{{ request('property_type') }}" placeholder="e.g., villa">
            </div>
            <div class="col-md-3">
                <label for="sort" class="form-label">Sort by Price</label>
                <select class="form-select" id="sort" name="sort">
                    <option value="">Default</option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Low to High</option>
                    <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>High to Low</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </form>
    </div>
</div>

<a href="{{ route('houses.create') }}" class="btn btn-primary mb-3 animate__animated animate__pulse">Add New House</a>
<table class="table table-bordered animate__animated animate__fadeInUp">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($houses as $house)
        <tr>
            <td>{{ $house->name }}</td>
            <td>{{ $house->description }}</td>
            <td>${{ number_format($house->price, 2) }}</td>
            <td>{{ $house->location }}</td>
            <td>
                <a href="{{ route('houses.edit', $house) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('houses.destroy', $house) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection