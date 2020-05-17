<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id','state_id', 'name', 'status'
    ];
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
