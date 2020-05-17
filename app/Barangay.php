<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    //
    protected $fillable = ['name', 'lat_long'];

    public function cases() {
        return $this->hasMany(CaseModel::class);
    }
}
