<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wagon extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'date_borrowed', 'date_returned', 'quantity', 'user_id', 'item_id', 'category_id', 'status_id', 'action_id'
    ];

    public function action() {
       	return $this->belongsTo("App\Action");
    }

    public function user() {
       	return $this->belongsTo("App\User");
    }

  	public function item() {
     	return $this->belongsTo("App\Item");
    }

    public function category() {
       	return $this->belongsTo("App\Category");
    }

    public function status() {
       	return $this->belongsTo("App\Status");
    }
}
