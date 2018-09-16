<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhraseAnalyserController extends Controller
{ 
  /**
   * Store values to user table
   *
   * @param  \Illuminate\Http\Request  $request
   * 
   * @return \Illuminate\Http\Response
   */
  public function analyser(Request $request)
  {
    $word           = $request->get("text_analyse");
    //check if textbox is null
    if( is_null($word) ) {
      $word = "football";
    }
    
    $char_array     = str_split($word);
    $same_chars     = array_count_values( $char_array );
    $queue          = [];
    $remove_duplicate = array_unique($char_array);
    
    foreach( $same_chars as $key => $char_val ){
      foreach( $remove_duplicate as $r_key => $r_value ){
        if( $r_value ==  $key ){
          $queue[] = array ('index'=>$r_key, 'char'=>$key, 'occurance' =>$char_val);
        }
      }
      
    }
    foreach ($queue as $key => $value) {
      $result[] =  $value["index"].$value["char"].$value["occurance"];
    }
  
    return view('phraseAnalyser')->with('queue',$queue)->with("result",$result);
  }
}