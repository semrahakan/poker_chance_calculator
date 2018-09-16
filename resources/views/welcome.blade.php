<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <title>Poker Chance Calculator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <style>
            .text-card{
                margin-top:50px;
            }
            .button-draft{
                margin-top:-7.5%;
                margin-right: -10%;
            }
            .button-select{
                margin-left: 5px; 
            }
        </style>
    </head>
    <body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/phrase_analyser"> Phrase analyser</a>
        </li>
    </ul>
    <div  class="container text-card">
        <label>To use this simple program: </label>
        <p>Please select a card and press DRAFT</p>
        <p>To start over after modal appear just click on close button and click buttons either Select a card or Draft.. </p>
        <p>Or you can refresh the page!</p>
        <form class="form-inline" action="/" method="POST">
        @csrf
            <div class="form-group mb-2">
                <select class="custom-select" name="select_card">
                    <option selected>Select a card</option>
                    @foreach($cards as $key => $card)
                   
                        <option value="{{ $key }}">{{$card["suit"].$card["value"]}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2 button-select">Select a card</button>
        </form>
    </div>
    <div class="container" style="margin-right: 9.5%">
    <div class="row">
        <label>Selected Card: {{ $card_name }}</label><br>
    </div>
    <div class="row">
        <label>Random Card:   {{ $random_card }}</label>
    </div>
    </div>
    <div  class="container button-draft">
        <div>
            <form action="/draftcards" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
               Draft!
            </button>
            </form>
        </div>
    </div>
    @if( $chance > 0 ) 
        <!-- modal starts -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your chance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            Got it, the chance was (current chance of getting the card) % {{$chance}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        <!-- modal ends -->
    @endif
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
    @if( $chance > 0 ) 
        <script>
             $("#exampleModal").modal()
        </script>
    @endif
    </body>
</html>
