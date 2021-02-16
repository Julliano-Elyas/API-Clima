<?php
    $curl = curl_init(); //Permite fazer solicitações HTTP, iniciando uma sessão]

    $chaveDeAcessoApi = "b7d5e8870ef22570e702797c93723c85";
    
    $url = 'http://api.weatherstack.com/current?access_key=' . $chaveDeAcessoApi . '&query=' . $_POST['regiao'];
    
    curl_setopt_array($curl, array( //opções para a sessão
    CURLOPT_URL => $url, //URL que vai ser buscado
    CURLOPT_RETURNTRANSFER => true, //retornar a transferencia como uma string
    CURLOPT_TIMEOUT => 0, //número máximo de segundos para execução da função
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;