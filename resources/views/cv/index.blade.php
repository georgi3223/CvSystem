@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-semibold">CV List</h1>
        
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">First Name</th>
                    <th class="px-4 py-2">Last Name</th>
                    <th class="px-4 py-2">Birth Date</th>
                    <th class="px-4 py-2">University</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($cvs as $cv)
                    <tr>
                        <td class="px-4 py-2">{{ $cv->candidate->first_name }}</td>
                        <td class="px-4 py-2">{{ $cv->candidate->last_name }}</td>
                        <td class="px-4 py-2">{{ $cv->candidate->birth_date }}</td>
                        <td class="px-4 py-2">{{ $cv->university->name }}</td>
                        <!-- Add more columns if needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
