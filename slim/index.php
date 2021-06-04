<?php

require 'vendor/autoload.php';
//objeto onde pode ser definido a rota para api
$app = new \Slim\App;
//definindo a rota
$app->get('/postagens2', function(){
    
    echo "Listagem de postagens";
} );
//[/exp]torna exp opcional
$app->get('/usuarios[/{id}]', function($request, $response){
    
    $id = $request->getAttribute('id');

    //Verificar se ID é valido e existe no BD
    echo "Listagem de usuarios e seu ID:" . $id;
} );

$app->get('/postagens[/{ano}/{mes}]', function($request, $response){
    
    $ano = $request->getAttribute('ano');
    $mes = $request->getAttribute('mes');
    //Verificar se ID é valido e existe no BD
    echo "Listagem de postagens no Ano: " . $ano . " Mes: " . $mes;
} );

$app->get('/lista/{itens:.*}', function($request, $response){
    
    $itens = $request->getAttribute('itens');

    //Verificar se ID é valido e existe no BD
    //echo $itens;
    var_dump(explode("/", $itens));
} );

//Nomear rotas

$app->get('/blog/postagens/{id}', function($request, $response){
    echo "Listar postagem para um ID";
} )->setName("blog");//agora a rota completa tem apenas um nome
//recupear rota
$app->get('/meusite', function($request, $response){
    
    //definindo o caminho para recuperar
    $retorno = $this->get("router")->pathFor("blog", ["id" => "10"]);

    echo $retorno;
} );

//agrupar rotas

$app->group('/v1', function(){
   
    $this->get('/usuarios', function(){
    
        echo "Listagem de usuarios";
    } );
    
    $this->get('/postagens', function(){
        
        echo "Listagem de postagens";
    } );

} );

//executa a rota
$app->run();