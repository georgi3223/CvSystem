@extends('layouts.app') @section('content') <div class="p-6">
 <h1 class="text-2xl font-semibold">Create CV</h1> @if(session('success')) <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
  {{ session('success') }}
 </div> @endif <form id="cvForm" method="POST" class="mt-4"> @csrf <div class="mb-4">
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
   <label class="block text-sm font-medium text-gray-700">University:</label>
   <select name="university_id" class="mt-1 px-4 py-2 border rounded w-full" required> @foreach($universities as $university) <option value="{{ $university->id }}">{{ $university->name }}</option> @endforeach </select>
   <button type="button" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" onclick="showUniversityModal()"> Add New University </button>
  </div>
  <div class="mb-4">
   <label class="block text-sm font-medium text-gray-700">Technologies:</label>
   <select name="technologies[]" class="mt-1 px-4 py-2 border rounded w-full" multiple> @foreach($technologies as $technology) <option value="{{ $technology->id }}">{{ $technology->name }}</option> @endforeach </select>
   <button type="button" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" onclick="showTechnologyModal()"> Add New Technology </button>
  </div>
  <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"> Create CV </button>
 </form>
</div>
<!-- University Modal -->
<div id="universityModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
 <!-- Modal content -->
</div>
<!-- Technology Modal -->
<div id="technologyModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
 <!-- Modal content -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function() {
   // Handle form submission using AJAX
   $('#cvForm').submit(function(event) {
    event.preventDefault();
    // Serialize form data
    var formData = $(this).serialize();
    // Send AJAX request
    $.ajax({
     url: '{{ route("cv.store") }}',
     type: 'POST',
     data: formData,
     success: function(response) {
      // Display success message and reset form
      alert('CV created successfully');
      $('#cvForm')[0].reset();
     },
     error: function(xhr) {
      // Display error message
      alert('Error creating CV. Please try again.');
     }
    });
   });
   // Add University using AJAX
   function addUniversity() {
    var newUniversityName = $('#newUniversityName').val().trim();
    if (newUniversityName !== '') {
     var select = $('[name="university_id"]');
     var newOption = $(' < option > ', {
      text: newUniversityName, selected: true
     });
    select.append(newOption);
    closeUniversityModal();
   }
  }
  // Add Technology using AJAX
  function addTechnology() {
   var newTechnologyName = $('#newTechnologyName').val().trim();
   if (newTechnologyName !== '') {
    var select = $('[name="technologies[]"]');
    var newOption = $(' < option > ', {
     text: newTechnologyName, selected: true
    });
   select.append(newOption);
   closeTechnologyModal();
  }
 }
 // Show/Hide Modals
 function showUniversityModal() {
  $('#universityModal').removeClass('hidden');
 }

 function closeUniversityModal() {
  $('#universityModal').addClass('hidden');
 }

 function showTechnologyModal() {
  $('#technologyModal').removeClass('hidden');
 }

 function closeTechnologyModal() {
  $('#technologyModal').addClass('hidden');
 }
 // Bind modal buttons to functions
 $('#universityModal').on('click', '.bg-blue-500', addUniversity);
 $('#technologyModal').on('click', '.bg-blue-500', addTechnology);
 $('#universityModal, #technologyModal').on('click', '.bg-gray-300', function() {
 $(this).closest('.bg-white').addClass('hidden');
 });
 });
</script> @endsection