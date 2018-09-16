<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OddsTest extends TestCase
{
    /**
     * Testing selecting card value, drafing cards and getting chance percantage
     *
     * @return void
     */
    public function testExample()
    {
        //selecting a card and saving it to database
        $select_card = ['select_card' => 1];
        $response = $this->call( 'POST', '/',$select_card );

        //drafting cards it will also assign random_card_index value on users table
        //in this way we also testing random data generator
        //to see it is right, retriving the first item on users table and check the random card value
        $response = $this->call( 'POST', '/draftcards' );
        
        $user = User::find(1);
        //retrieve random card id from database 
        $random_card_id = $user->random_card_index;

        if( $user->chance_percentage > 0 ){
            echo 'the chance is' .  $user->chance_percentage;
        }

        //if the random card index is not match with selected card index which is 1 in this case,
        //code should delete this random card index therefore
        //checking random_card_id value on cards table
        $this->assertDatabaseMissing('cards', ['key' => $random_card_id]);

        //this assertation is to test saving selected card id on users table
        $this->assertDatabaseHas('users', [
            'card_index' => 1
        ]);
        //after testing expecting values from tables users and cards
        //we can delete values on them
        DB::table('users')->truncate();
        DB::table('cards')->truncate();
    }
}
