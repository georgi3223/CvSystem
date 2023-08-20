<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{
  
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|unique:universities,name',
    ]);

    $university = University::create([
        'name' => $validatedData['name'],
    ]);

    return response()->json(['message' => 'University added successfully', 'university' => $university]);
}
}
