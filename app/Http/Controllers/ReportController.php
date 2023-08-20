<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cv;
use App\Models\Candidate;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function generate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $cvs = Cv::whereHas('candidate', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('birth_date', [$startDate, $endDate]);
        })->with('candidate')->get();

        return view('report.generate', compact('cvs', 'startDate', 'endDate'));
    }

    // Optionally implement aggregation report methods here
}
