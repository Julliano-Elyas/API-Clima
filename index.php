<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Clima</title>

    <style type="text/css">
    #temp-atual{
      font-size:35px;
    }
    #local{
      font-size:40px;
    }
  </style>
</head>
<body>
    <div id="fundoDiv" class="card text-center">
        <div class="card-header text-success bg-dark fs-3">
          Dados Climáticos
        </div>
        <div class="card-body b-success">
          <h5 class="card-title text-white" id="local"></h5>
          <h4 class="card-title text-white" id="pais"></h4>
          <p class="card-text fw-bold text-danger mt-4" id="temp-atual">Temperatura</p>
          <img id="icone" src="">
          <p class="m-0 text-white" id="descricao"></p>
          <p class="m-0 text-white" id="sensacao"></p>
          <p class="m-0 text-white" id="precipitacao"></p>
          <small id="horario" class="d-block mb-5 text-white"></small>
          
          
        </div>
        <div class="card-footer d-flex justify-content-center bg-dark">
            <div class="input-group my-2 w-25">
                <input type="text" class="form-control border-success" placeholder="Localidade" id="regiao" name="regiao">
                <button id="pesquisar" class="btn btn-outline-success" type="submit">Pesquisar</button>
              </div>        
            </div>
      </div>

      <script>
      $(document).ready(function(){ //Será executado assim que a página for carregada
        $('#pesquisar').click(function(){
          var nomeCidade = $('#regiao').val();

          $dadosParaChamarEndpoint = {
          "regiao": nomeCidade
        }

          $.post("endpointAtual.php", $dadosParaChamarEndpoint, function(reponse){
            var objeto = JSON.parse(reponse)
            var local =  objeto.location.name
            var pais = objeto.location.country
            var tempAtual = objeto.current.temperature
            var icone =  objeto.current.weather_icons
            var desc = objeto.current.weather_descriptions
            var sensacao = objeto.current.feelslike
            var precipitacao = objeto.current.precip
            var diahora = objeto.location.localtime
            var separaDiaHora = diahora.split(" ") //separa a data da hora
            var separaDia = separaDiaHora[0].split("-").reverse().join("/") // faz a conversão de 2021-02-03 para 03/02/2021
            
            console.log(icone)


            $("#local").text(local)
            $('#pais').text(pais)
            $("#temp-atual").text(tempAtual + "°C")
            $("#icone").attr("src", icone)
            $("#icone").attr("width", "50")
            $("#icone").attr("height", "50")
            $("#descricao").text(desc)
            $("#sensacao").text("Sensação térmica: " + sensacao + "°C")
            $("#precipitacao").text("Nível de precipitação: " + precipitacao + " milímetros")
            $("#horario").text(separaDia + " - " + separaDiaHora[1])

            var hora = separaDiaHora[1].split(":")
            if((hora[0] > 6) && (hora[0] < 17)){
              $('#fundoDiv').css({background: "#2e8abf"}); // claro
            }

            if(hora[0] > 17){
              $('#fundoDiv').css({background: "#143547"}); // escuro
            }
            if(hora[0] < 6){
              $('#fundoDiv').css({background: "#143547"}); // escuro
            }
          });
        });
      });
      </script>
    </body>
</html>