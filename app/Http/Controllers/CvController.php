<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cv;
use App\Models\Candidate;
use App\Models\University;
use App\Models\Technology;


class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::with(['candidate', 'university', 'skills'])->get();
        return view('cv.index', compact('cvs'));
    }

    public function create()
    {
        $universities = University::all();
        $technologies = Technology::all();

        return view('cv.create', compact('universities', 'technologies'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date',
            'university_id' => 'required',
            'technologies' => 'required|array', // Adjust the field name if needed
            // ... Other form fields ...
        ]);
    
        // Check if the candidate already exists or create a new one
        $candidate = Candidate::firstOrCreate([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
        ], [
            'birth_date' => $validatedData['birth_date'],
            // ... Other candidate fields ...
        ]);
    
        // Attach selected technologies to the candidate
        if (isset($validatedData['technologies'])) {
            $candidate->technologies()->sync($validatedData['technologies']);
        }
    
        // Create a new CV record
        $cv = new Cv();
        $cv->candidate_id = $candidate->id;
        $cv->university_id = $validatedData['university_id'];
        // ... Add other CV fields as needed ...
        $cv->save();
    
        return redirect()->route('cv.index')->with('success', 'CV created successfully.');
    }
    

    // Other methods remain the same as before
}
