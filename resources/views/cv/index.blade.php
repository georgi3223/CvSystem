@extends('layouts.app') @section('content') <div class="max-w-4xl mx-auto bg-white rounded shadow p-6">
 <h2 class="text-2xl font-semibold mb-4">CV List</h2>
 <table class="w-full border-collapse border border-gray-300">
  <thead>
   <tr class="bg-gray-100">
    <th class="border p-2">Candidate Name</th>
    <th class="border p-2">University</th>
    <th class="border p-2">Skills</th>
    <!-- Add more table headers for other CV information -->
   </tr>
  </thead>
  <tbody> @foreach ($cvs as $cv) <tr>
    <td class="border p-2">{{ $cv->candidate->name }}</td>
    <td class="border p-2">{{ $cv->university->name }}</td>
    <td class="border p-2">{{ implode(', ', $cv->skills->pluck('name')->toArray()) }}</td>
    <!-- Add more table cells for other CV information -->
   </tr> @endforeach </tbody>
 </table>
</div> @endsection