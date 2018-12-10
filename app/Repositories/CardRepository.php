<?php

namespace App\Repositories;
use App\Card;
use Illuminate\Support\Facades\DB;
use App\User;

class CardRepository implements CardRepositoryInterface
{
    protected $card;
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function user_information(){

        $user_info = DB::table('users')->orderBy('id', 'DESC')->first();
        $user = User::find($user_info->id);
        return $user;
    }


}