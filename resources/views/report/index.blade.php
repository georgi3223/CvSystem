@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold">Generate Report</h1>
    <form action="{{ route('report.generate') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4 w-1/4">
            <label class="block text-sm font-medium text-gray-700">Start Date:</label>
            <input type="date" name="start_date"
                class="mt-1 px-4 py-2 border rounded w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>
        <div class="mb-4 w-1/4">
            <label class="block text-sm font-medium text-gray-700">End Date:</label>
            <input type="date" name="end_date"
                class="mt-1 px-4 py-2 border rounded w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>
        <button type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
            Generate Report
        </button>
    </form>
</div>
@endsection
