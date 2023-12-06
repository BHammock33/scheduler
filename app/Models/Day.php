<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    private $Availability;

    private function __construct($Availability)
    {
        $this->Availability = $Availability;
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function availability(){
        return $this->hasOne(Availability::class);
    }
}
