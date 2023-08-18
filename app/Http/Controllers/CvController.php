<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cv;
use App\Candidate;
use App\University;
use App\Technology;

class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::with('candidate', 'university')->get();
        $candidates = Candidate::all();
        $universities = University::all();
        $technologies = Technology::all();

        return view('cv.index', compact('cvs', 'candidates', 'universities', 'technologies'));
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
            'technologies' => 'array', // Assuming technologies is an array
        ]);
    
        // Check if the candidate already exists or create a new one
        $candidate = Candidate::firstOrCreate([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
        ], [
            'birth_date' => $validatedData['birth_date'],
        ]);
    
        // Attach selected technologies to the candidate
        if (isset($validatedData['technologies'])) {
            $candidate->technologies()->sync($validatedData['technologies']);
        }
    
        // Create a new CV record
        $cv = new Cv();
        $cv->candidate_id = $candidate->id;
        $cv->university_id = $validatedData['university_id'];
        // Add other fields as needed
        $cv->save();
    
        return redirect()->route('cv.create')->with('success', 'CV created successfully.');
    }

    public function show($id)
    {
        $cv = Cv::with('candidate', 'university')->findOrFail($id);
        return view('cv.show', compact('cv'));
    }

    public function edit($id)
    {
        $cv = Cv::with('candidate', 'university')->findOrFail($id);
        $universities = University::all();
        $technologies = Technology::all();
        return view('cv.edit', compact('cv', 'universities', 'technologies'));
    }

    public function update(Request $request, $id)
    {
        // Your update logic here
    }

    public function destroy($id)
    {
        // Your delete logic here
    }
}
