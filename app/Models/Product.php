<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $fillable = ['name','cost','type','status','description','price','category','image_path','uploader'];
    
    // public function Subject()
    // {
    //     return $this->belongsToMany('App\Subject','product_subject','subject_id','product_id')
    //     ->as ('orders')
    //      ->withTimestamps();
    // }
}
