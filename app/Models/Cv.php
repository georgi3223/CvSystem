<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = ['candidate_id', 'university_id'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}