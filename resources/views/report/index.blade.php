@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-semibold">Generate Report</h1>
        
        <form action="{{ route('report.generate') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4 w-1/4">
                <label class="block text-sm font-medium text-gray-700">Start Date:</label>
                <input type="date" name="start_date" class="mt-1 px-4 py-2 border rounded w-full" required>
            </div>
            
            <div class="mb-4 w-1/4">
                <label class="block text-sm font-medium text-gray-700">End Date:</label>
                <input type="date" name="end_date" class="mt-1 px-4 py-2 border rounded w-full" required>
            </div>
            
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Generate Report
            </button>
        </form>
    </div>
@endsection
