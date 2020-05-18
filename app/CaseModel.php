<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{

    protected $table = 'cases';

    protected $fillable = ['age', 'classification', 'brgy_id'];

    public function barangay(){
        return $this->belongsTo(Barangay::class, 'brgy_id');
    }
}
