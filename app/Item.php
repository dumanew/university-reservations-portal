<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function wagon() {
       	return $this->belongsTo("App\Wagon");
    }

    public function category() {
       	return $this->belongsTo("App\Category");
    }

    public function status() {
       	return $this->belongsTo("App\Status");
    }

    public function action() {
       	return $this->belongsTo("App\Action");
    }
}
