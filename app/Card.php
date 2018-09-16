<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key','suit', 'value'
    ];

    /**
     * Get the card that owns the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
