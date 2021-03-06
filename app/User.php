<?php

namespace App;

use App\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class User extends Authenticatable implements HasMedia
{
    use Notifiable;
	use HasMediaTrait;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

	const ADMIN_ROLE = 'admin';
	const DEFAULT_ROLE = 'default';

	public function isAdmin()    {

		if ($this->role === self::ADMIN_ROLE) {
			return true;
		}
		return false;
	}

	public function products()
	{
		return $this->hasMany('App\Product');
	}
}
