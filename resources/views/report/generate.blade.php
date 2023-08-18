@extends('layouts.app') @section('content') <div class="p-6">
 <h1 class="text-2xl font-semibold">Generated Report</h1>
 <p class="mt-2">Report for {{ $startDate }} to {{ $endDate }}</p>
 <div class="overflow-x-auto mt-4">
  <table class="min-w-full">
   <thead>
    <tr>
     <th class="px-4 py-2">First Name</th>
     <th class="px-4 py-2">Last Name</th>
     <th class="px-4 py-2">Birth Date</th>
     <th class="px-4 py-2">University</th>
     <!-- Add more columns as needed -->
    </tr>
   </thead>
   <tbody> @foreach($cvs as $cv) <tr>
     <td class="px-4 py-2">{{ $cv->candidate->first_name }}</td>
     <td class="px-4 py-2">{{ $cv->candidate->last_name }}</td>
     <td class="px-4 py-2">{{ $cv->candidate->birth_date }}</td>
     <td class="px-4 py-2">{{ $cv->university->name }}</td>
     <!-- Add more columns as needed -->
    </tr> @endforeach </tbody>
  </table>
 </div>
</div> @endsection