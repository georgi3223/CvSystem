@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded shadow-md md:w-1/2 lg:w-1/3 m-auto">
     <h1 class="text-2xl font-semibold">Create CV</h1> @if(session('success')) 
     <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
          {{ session('success') }}
     </div> @endif 
     <form x-data="cvForm()" x-init="init()" class="mt-4" action="{{ route('cv.store') }}" method="POST"> 
        @csrf 
        <div class="mb-4">
               <label class="block text-sm font-medium text-gray-700">First Name:</label>
               <input type="text" x-model="formData.first_name" class="mt-1 px-4 py-2 border rounded w-full" required>
          </div>
          <div class="mb-4">
               <label class="block text-sm font-medium text-gray-700">Last Name:</label>
               <input type="text" x-model="formData.last_name" class="mt-1 px-4 py-2 border rounded w-full" required>
          </div>
          <div class="mb-4">
               <label class="block text-sm font-medium text-gray-700"> Date of Birthday:</label>
               <input type="date" x-model="formData.birth_date" class="mt-1 px-4 py-2 border rounded w-full" required>
          </div>
         


      <!-- University Section -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">University:</label>
    <select name="university_id" x-model="selectedUniversity" class="mt-1 px-4 py-2 border rounded w-full" required>
        <option value="" selected disabled>Select University</option>
        @foreach([
            'Sofia University',
            'Plovdiv University',
            'Varna Technical University',
            'Burgas Medical University',
            'Ruse University',
            // Add more universities here...
        ] as $university)
        <option value="{{ $loop->index + 1 }}">{{ $university }}</option>
        @endforeach
    </select>
    <button type="button" @click="openUniversityPopup" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
        Add New University
    </button>
</div>
        

<!-- Technologies Section -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Technologies:</label>
    <select x-model="selectedTechnologies" multiple class="mt-1 px-4 py-2 border rounded w-full" required>
        @foreach([
            'JavaScript',
            'Python',
            'Java',
            'C#',
            'Ruby',
            'PHP',
            'HTML/CSS',
            'React',
            'Angular',
            'Vue.js',
            'Node.js',
            'Laravel',
            'Django',
            'Spring Boot',
            // Add more technologies here...
        ] as $technology)
        <option value="{{ $loop->index + 1 }}">{{ $technology }}</option>
        @endforeach
    </select>
    <button type="button" @click="showTechnologyPopup = true" class="mt-1 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
        Add New Technology
    </button>
</div>

          
          <!-- University Popup -->
          <div x-show="showUniversityPopup" class=" pointer-events-none fixed inset-0 flex items-center justify-center">
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
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>
<script>

    
function cvForm() {
    return {
        formData: {
            first_name: '',
            last_name: '',
            birth_date: '',
            // ... Other form fields ...
        },
        universities: [
            'Sofia University',
            'Plovdiv University',
            'Varna Technical University',
            'Burgas Medical University',
            'Ruse University',
            // ... Add more universities here ...
        ],
        technologies: [
            'JavaScript',
            'Python',
            'Java',
            'C#',
            'Ruby',
            'PHP',
            'HTML/CSS',
            'React',
            'Angular',
            'Vue.js',
            'Node.js',
            'Laravel',
            'Django',
            'Spring Boot',
            // ... Add more technologies here ...
        ],
        selectedUniversity: '',
        selectedTechnologies: [],
        newUniversityName: '',
        newTechnologyName: '',
        showUniversityPopup: false,
        showTechnologyPopup: false,

        init() {
            //
        },

        openUniversityPopup() {
            this.showUniversityPopup = true;
        },

        closeUniversityPopup() {
            this.showUniversityPopup = false;
            this.newUniversityName = '';
        },

        addUniversity() {
            if (this.newUniversityName.trim() !== '') {
                // Perform AJAX request to add university
                // Update UI and close popup
                this.universities.push(this.newUniversityName);
                this.selectedUniversity = this.universities.length;
                this.closeUniversityPopup();
            }
        },

        openTechnologyPopup() {
            this.showTechnologyPopup = true;
        },

        closeTechnologyPopup() {
            this.showTechnologyPopup = false;
            this.newTechnologyName = '';
        },

        addTechnology() {
            if (this.newTechnologyName.trim() !== '') {
                // Perform AJAX request to add technology
                // Update UI and close popup
                this.technologies.push(this.newTechnologyName);
                this.selectedTechnologies.push(this.technologies.length);
                this.closeTechnologyPopup();
            }
        },

         // ... existing code ...

         submitForm() {
            // Prepare the form data
            const formData = {
                first_name: this.formData.first_name,
                last_name: this.formData.last_name,
                birth_date: this.formData.birth_date,
                university_id: this.selectedUniversity,
                technologies: this.selectedTechnologies,
                // ... Other form fields ...
            };

            // Reset errors before submitting
            this.errors = {};

            // Perform AJAX request to submit the form data
            axios.post('/cv/store', formData)
                .then(response => {
                    // Display success message or perform any other actions
                    alert('CV created successfully');
                    // Reset form data
                    this.formData = {
                        first_name: '',
                        last_name: '',
                        birth_date: '',
                        // ... Other form fields ...
                    };
                    this.selectedUniversity = '';
                    this.selectedTechnologies = [];
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        // Display validation errors
                        this.errors = error.response.data.errors;
                    } else {
                        // Handle other errors if needed
                        console.error('Error creating CV:', error);
                    }
                });
        }
    };
}

</script>

@endsection
