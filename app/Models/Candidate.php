<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['first_name', 'last_name', 'birth_date'];

    public function cvs()
    {
        return $this->hasMany(Cv::class);
    }
}
