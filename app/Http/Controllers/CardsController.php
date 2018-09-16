<?php

namespace App\Http\Controllers;

use App\Card as Card;
use App\User as User;
use DB;
use Illuminate\Http\Request;

class CardsController extends Controller
{  
    /**
     * Declaration of card array
     * 
     * @return array
     */
    public function cards_of_array(){
        $suits = [
            "Spades", "Hearts", "Clubs", "Diamonds"
        ];
        $values = [
            "2", "3", "4", "5", "6", "7", "8",
            "9", "10", "Jack", "Queen", "King", "Ace"
        ];

        $deck = [];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                //HJ - jack of hearts H2-H10 - cards 2-10 of hearts
                $deck[] = array ("suit"=>$suit[0],"value"=>$value[0]);
            }
          
        }
        return $deck;
    }
    
    /**
     * Create Random Cards
     * 
     * @return void
     */
    public function create_random_cards(){
        //use remaining data values since database values are being deleted see : draftCards()
        $get_cards = Card::all();
        $mix_card =[];
        foreach ( $get_cards as $key => $value ) {
            $mix_card[] = array ("key"=>$value["key"],"suit"=>$value["suit"],"value"=>$value["value"]);
        }
        if( !empty( $mix_card ) ) {
            shuffle( $mix_card );
            $first_out_item = $mix_card[0];
            return $first_out_item;
        }else {
            $first_out_item =0;
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_cards          = $this->cards_of_array(); 
        $chance             = 0;
        $user               = User::all();
        $card_name          = "";
        $selected_card_name = "";
        $random_card        = "";
       
        if ( count($user) > 0 ) {
           
            foreach( $user as $user_data ) {
                $chance = $user_data->chance_percentage;
                $user_card_index = $user_data->card_index;
            }
            $selected_card_name = $get_cards[$user_card_index]["suit"].$get_cards[$user_card_index]["value"];
        }  
        return view('welcome')->with('cards', $get_cards)->with('chance', $chance)->with('card_name', $selected_card_name)->with('random_card', $random_card);  
    }

    /**
     * Store values to user table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check selectbox
        if( $request->input('select_card') == "Select a card" ) {
            return redirect()->action('CardsController@index');           
        }
        $selected_card           = $request->get("select_card");  
        $user                    = new User();
        $user->card_index        = $selected_card;
        $user->chance_percentage = 0;
        $user->random_card_index = -1;
        $user->save();
        //populate cards table
        $this->save_cards_to_db();
        return redirect()->back();
    }

    /**
     * Calculate odds
     * 
     * @return \Illuminate\Http\Response
     */
    public function draftCards() {  
        $original_cards      = $this->cards_of_array();
        $random_card         = $this->create_random_cards();
        $selected_card_index = 0;
        $count_after_delete  = 0;
        $time                = 0;
        $count_original_card = count($original_cards);
        //get last item on users table
        $user_info = DB::table('users')->orderBy('id', 'DESC')->first();
        if( count( $user_info )>0 )
        {
            $selected_card_index = $user_info->card_index;
            $user = User::find($user_info->id);
 
            $random_card_name = $random_card["key"].'=>'.$original_cards[$random_card["key"]]["suit"]. $original_cards[$random_card["key"]]["value"];
            
            $user_selected_card_name = $user->card_index. '=>' .$original_cards[$user->card_index]["suit"].$original_cards[$user->card_index]["value"];
            $user->random_card_index = $random_card["key"];
            $user->save();
                     
            if(  $selected_card_index !== $random_card["key"] )
            { 
                //some how unset does not work..         
                // unset( $original_cards[ $random_card["key"] ] );
                $count_after_delete = count( Card::all() );
                DB::table('cards')->where('key', '=', $random_card["key"])->delete();
                
                return view('welcome')->with('cards',  $original_cards)->with('chance',  $time)->with('card_name', $user_selected_card_name)->with('random_card', $random_card_name);
            }
            if( $selected_card_index == $random_card["key"] )
            {
                $count_after_delete = count( Card::all() );
                $time =  $count_original_card -  $count_after_delete;
                
                // echo $count_original_card; echo '-';
                // echo $random_card["key"]; echo '-';
                // echo $count_after_delete.PHP_EOL; echo '-';
                // echo $time.PHP_EOL;
                if( $time > 0 ){
                    $time = 1/$time*100;
                }else{
                    $time = 100;
                }
               // echo $time;
                DB::table('cards')->truncate();
                DB::table('users')->truncate();
                return view('welcome')->with('cards',  $original_cards)->with('chance',  $time)->with('card_name', $user_selected_card_name)->with('random_card',$random_card_name);
            }          
           
            $user->chance_percentage = $time;
            $user->save();
            
        }
        return redirect()->action('CardsController@index');
    }
    
    public function save_cards_to_db(){
        $deck = $this->cards_of_array();
       
        //get latest user information from database, 
        //since all data values will be destroyed with truncate see: draftCards()
        $user_info = DB::table('users')->orderBy('id', 'DESC')->first();
        $user = User::find($user_info->id);
       
        //save all suit value pair to the database table
        foreach ($deck as $key => $value){
            $card = new Card();
            $card->suit  = $value["suit"];
            $card->value = $value["value"];
            $card->key   = $key;
          
            $get_cards = Card::all();
            $db_card_number = count($get_cards);
            //prevent dublicates when it is deleted
            //when selectbox ticked more than once, card table is being populated one more.
            //however all values will be deleted when keys are equal see : draftCards()
            if( $user->random_card_index !=  $card->key ){
               $card->save();
            }
        }
        
    }
    
}
