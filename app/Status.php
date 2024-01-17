<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;

    public function wagon() {
       	return $this->belongsTo("App\Wagon");
    }
}
