@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow-md md:w-1/2 lg:w-1/3 m-auto">
 <h1 class="text-2xl font-semibold">Create CV</h1> @if(session('success')) <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
  {{ session('success') }}
 </div> @endif <form x-data="cvForm()" x-init="init()" class="mt-4"> @csrf <div class="mb-4">
   <label class="block text-sm font-medium text-gray-700">First Name:</label>
   <input type="text" x-model="formData.first_name" class="mt-1 px-4 py-2 border rounded w-full" required>
  </div>
  <div class="mb-4">
   <label class="block text-sm font-medium text-gray-700">Last Name:</label>
   <input type="text" x-model="formData.last_name" class="mt-1 px-4 py-2 border rounded w-full" required>
  </div>
  <!-- ... Other input fields ... -->
  <!-- University Section -->
  <div class="mb-4">
   <label class="block text-sm font-medium text-gray-700">University:</label>
   <select name="university_id" x-model="selectedUniversity" class="mt-1 px-4 py-2 border rounded w-full" required>
    <option value="" selected disabled>Select University</option> @foreach($universities as $university) <option value="{{ $university->id }}">{{ $university->name }}</option> @endforeach
   </select>
   <button type="button" @click="showUniversityPopup = true" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"> Add New University </button>
  </div>
  <!-- University Popup -->
  <div x-show="showUniversityPopup" class="fixed inset-0 flex items-center justify-center">
   <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
   <div class="bg-white rounded shadow-lg p-4 w-1/3">
    <h2 class="text-lg font-semibold mb-2">Add New University</h2>
    <input type="text" x-model="newUniversityName" class="mt-1 px-4 py-2 border rounded w-full" required>
    <div class="mt-4 flex justify-end">
     <button type="button" @click="addUniversity()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"> Add University </button>
     <button type="button" @click="showUniversityPopup = false; newUniversityName = ''" class="px-4 py-2 ml-2 bg-gray-300 rounded hover:bg-gray-400"> Cancel </button>
    </div>
   </div>
  </div>
  <!-- Technologies Section -->
  <div class="mb-4">
   <label class="block text-sm font-medium text-gray-700">Technologies:</label>
   <select x-model="selectedTechnologies" multiple class="mt-1 px-4 py-2 border rounded w-full" required> @foreach($technologies as $technology) <option value="{{ $technology->id }}">{{ $technology->name }}</option> @endforeach </select>
   <button type="button" @click="showTechnologyPopup = true" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"> Add New Technology </button>
  </div>
  <!-- Technologies Popup -->
  <div x-show="showTechnologyPopup" class="fixed inset-0 flex items-center justify-center">
   <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
   <div class="bg-white rounded shadow-lg p-4 w-1/3">
    <h2 class="text-lg font-semibold mb-2">Add New Technology</h2>
    <input type="text" x-model="newTechnologyName" class="mt-1 px-4 py-2 border rounded w-full" required>
    <div class="mt-4 flex justify-end">
     <button type="button" @click="addTechnology()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"> Add Technology </button>
     <button type="button" @click="showTechnologyPopup = false; newTechnologyName = ''" class="px-4 py-2 ml-2 bg-gray-300 rounded hover:bg-gray-400"> Cancel </button>
    </div>
   </div>
  </div>
  <div class="mb-4 md:flex md:justify-between">
   <button type="button" @click="submitForm()" class="w-full md:w-auto px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"> Create CV </button>
  </div>
 </form>
</div>

<script>
function cvForm() {
    return {
        // ... Other data and methods ...

        openUniversityPopup() {
            this.showUniversityPopup = true;
        },
        closeUniversityPopup() {
            this.showUniversityPopup = false;
            this.newUniversityName = '';
        },
        addUniversity() {
            if (this.newUniversityName.trim() !== '') {
                axios.post('{{ route("university.store") }}', {
                        name: this.newUniversityName
                    })
                    .then(response => {
                        // Update UI and close popup
                        this.selectedUniversity = response.data.university.id;
                        this.closeUniversityPopup();
                    })
                    .catch(error => {
                        console.error('Error adding university:', error);
                    });
            }
        },
        openTechnologyPopup() {
            this.showTechnologyPopup = true;
        },
        addTechnology() {
            if (this.newTechnologyName.trim() !== '') {
                axios.post('{{ route("technology.store") }}', {
                        name: this.newTechnologyName
                    })
                    .then(response => {
                        // Update UI and close popup
                        // Handle the response if needed
                        this.newTechnologyName = '';
                        this.showTechnologyPopup = false;
                    })
                    .catch(error => {
                        console.error('Error adding technology:', error);
                    });
            }
        },
        submitForm() {
            // Prepare the form data
            const formData = {
                first_name: this.formData.first_name,
                last_name: this.formData.last_name,
                birth_date: this.formData.birth_date,
                university_id: this.selectedUniversity,
                technologies: this.selectedTechnologies, // Array of selected technology IDs
                // ... Other form fields ...
            };

            // Perform AJAX request to submit the form data
            axios.post('/cv/store', formData)
                .then(response => {
                    // Display success message or perform any other actions
                    alert('CV created successfully');
                    // Optionally, you can reset the form fields or redirect to another page
                    this.formData = {
                        first_name: '',
                        last_name: '',
                        birth_date: '',
                        university_id: '',
                        technologies: '',
                        // ... Other form fields ...
                    };
                    this.selectedUniversity = ''; // Reset selected university
                    this.selectedTechnologies = []; // Reset selected technologies
                })
                .catch(error => {
                    // Handle errors if needed
                    console.error('Error creating CV:', error);
                });
        }
        // ... Other methods ...
    };
}
</script>
@endsection
