@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-semibold">Create CV</h1>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
        {{ session('success') }}
    </div>
    @endif
    <form id="cvForm" method="POST" action="{{ route('cv.store') }}" class="mt-4">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">First Name:</label>
            <input type="text" name="first_name" class="mt-1 px-4 py-2 border rounded w-full" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Last Name:</label>
            <input type="text" name="last_name" class="mt-1 px-4 py-2 border rounded w-full" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Birth Date:</label>
            <input type="date" name="birth_date" class="mt-1 px-4 py-2 border rounded w-full" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">University Name:</label>
            <input type="text" id="newUniversityName" class="mt-1 px-4 py-2 border rounded w-full" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Technologies:</label>
            <input type="text" id="newTechnologyName" class="mt-1 px-4 py-2 border rounded w-full"
                placeholder="Enter technologies separated by commas">
        </div>
        <div class="mb-4 md:flex md:justify-between">
            <button type="submit"
                class="w-full md:w-auto px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create
                CV</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>
@endsection
