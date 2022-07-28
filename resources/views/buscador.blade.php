<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscador</title>
    <link rel="stylesheet" href="{{ asset('../css/app.css')}}">
    <script src="{{ asset('../js/app.js')}}"></script>
    <script src="{{ asset('../js/jquery-3.4.1.min.js')}}"></script>
</head>
<body>
    
        <input type="text" id="ele">
        
    <button onclick="Busca()">Click Para Buscar</button>

    <br><br>

    <div id="contenedor"></div>
    
    <script>
        ele = document.getElementById('ele');

       function Busca() {
        cont = document.getElementById('contenedor');

        $.ajax({
        url: "http://blog.test/Busca/"+ele.value,
       
        })
        .done(function( data ) {
            if ( console && console.log ) {
                console.log(data);
                cont.innerHTML = data;
            }
        });
        
       }//fin de Busca

       
    </script>
</body>
</html>