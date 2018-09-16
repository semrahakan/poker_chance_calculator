<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <title>Phrase Analyser</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <style>
           
        </style>
    </head>
    <body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/phrase_analyser"> Phrase Analyser</a>
        </li>
    </ul>
    <div class="container">
        <form action="/phrase_analyser" method="POST">
        @csrf
            <div class="row">
                <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter a phrase" aria-label="Recipient's username" aria-describedby="basic-addon2" name="text_analyse">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Analyse</button>
                        </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
     <div class ="row">
      <label>'football' is used as an example</label>
     </div>
    </div>
    <div class="container">
        <div class="row">
        @foreach( $queue as $key => $value )
            @if($value["index"] == 0)
                
                {{ $value["char"] . ' :' . $value["occurance"] . ' :' . ' before: '. ''  . 'after: none'}} <br>
            
            @elseif( $value["index"]+1 > count($queue)  )
                
                {{ $value["char"] . ' :' . $value["occurance"] . ' :' . ' before: none' . ' after: ' }}<br>
            @else
                {{ $value["char"] .' :' . $value["occurance"] . ' :' . ' before: '. $queue[$key+1]["char"]. ' after: ' .$queue[$key-1]["char"]}} <br>
            @endif
        @endforeach
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
    </body>
</html>
