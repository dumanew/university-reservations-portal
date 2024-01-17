<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $timestamps = false;

    public function wagon() {
       	return $this->belongsTo("App\Wagon");
    }
}
