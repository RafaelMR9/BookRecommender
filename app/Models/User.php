<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password', 'preferences'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['preferences' => 'array'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
