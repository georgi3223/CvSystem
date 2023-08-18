@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-semibold">Create CV</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('cv.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">First Name:</label>
                <input type="text" name="first_name" class="mt-1 px-4 py-2 border rounded w-full" required>
            </div>
            
            <!-- Add fields for last_name, birth_date, and other form elements -->
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">University:</label>
                <select name="university_id" class="mt-1 px-4 py-2 border rounded w-full" required>
                    @foreach($universities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" onclick="showUniversityModal()">
                    Add New University
                </button>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Technologies:</label>
                <select name="technologies[]" class="mt-1 px-4 py-2 border rounded w-full" multiple>
                    @foreach($technologies as $technology)
                        <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" onclick="showTechnologyModal()">
                    Add New Technology
                </button>
            </div>
            
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Create CV
            </button>
        </form>
    </div>

    <!-- University Modal -->
    <div id="universityModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Add New University</h2>
            <input type="text" id="newUniversityName" class="border rounded px-2 py-1 w-full mb-2" placeholder="University Name">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="addUniversity()">Add University</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" onclick="closeUniversityModal()">Cancel</button>
        </div>
    </div>

    <!-- Technology Modal -->
    <div id="technologyModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Add New Technology</h2>
            <input type="text" id="newTechnologyName" class="border rounded px-2 py-1 w-full mb-2" placeholder="Technology Name">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="addTechnology()">Add Technology</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" onclick="closeTechnologyModal()">Cancel</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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

        function addUniversity() {
            const newUniversityName = $('#newUniversityName').val().trim();
            if (newUniversityName !== '') {
                // Perform AJAX request to add university to database
                // You can use $.ajax or $.post here
                // You can use $.ajax or $.post here
                $.post('{{ route('universities.store') }}', { name: newUniversityName, _token: '{{ csrf_token() }}' })
                    .done(function(response) {
                        // Add the new option to the select element
                        const select = $('[name="university_id"]');
                        const newOption = $('<option>', {
                            value: response.id,
                            text: response.name,
                            selected: true
                        });
                        select.append(newOption);
                        closeUniversityModal();
                    })
                    .fail(function(error) {
                        console.error('Failed to add university:', error);
                    });
            }

        function addTechnology() {
            const newTechnologyName = $('#newTechnologyName').val().trim();
            if (newTechnologyName !== '') {
                // Perform AJAX request to add technology to database
                // You can use $.ajax or $.post here
                $.post('{{ route('technologies.store') }}', { name: newTechnologyName, _token: '{{ csrf_token() }}' })
                    .done(function(response) {
                        // Add the new option to the select element
                        const select = $('[name="technologies[]"]');
                        const newOption = $('<option>', {
                            value: response.id,
                            text: response.name,
                            selected: true
                        });
                        select.append(newOption);
                        closeTechnologyModal();
                    })
                    .fail(function(error) {
                        console.error('Failed to add technology:', error);
                    });
            }
        }
    </script>
@endsection