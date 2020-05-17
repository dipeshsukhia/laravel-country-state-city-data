<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id', 'name', 'status'
    ];
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
