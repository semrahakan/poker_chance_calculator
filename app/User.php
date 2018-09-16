<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_index','chance_percentage','random_card_index','card_id'
    ];

    /**
     * Get the cards for the users. One to many releation.
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
}
