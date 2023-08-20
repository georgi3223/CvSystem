<?php

namespace App\Http\Controllers;
use App\Models\Technology;

use Illuminate\Http\Request;

class TechnologyController extends Controller
{
 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:technologies,name',
        ]);
    
        $technology = Technology::create([
            'name' => $validatedData['name'],
        ]);
    
        return response()->json(['message' => 'Technology added successfully', 'technology' => $technology]);
    }
}
