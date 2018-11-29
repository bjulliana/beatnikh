<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

	protected $fillable = [
		'cat_title', 'image'
	];


	public function products()
    {
        return $this->belongsToMany('App\Product');
    }

}