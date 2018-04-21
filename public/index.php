<?php

    #Controle de Roteamento
    include '../router.php';
    include '../config.php';
    
    $file = file_get_contents(realpath(__DIR__ . '/..')."/configuration/saoe.json");
    $json = json_decode($file, 1);

    $router = new Router();
    $router -> setPublic($json['public']);
    
    $router -> setPass("assets/");

    $router -> setVar("type", [
        'palestrante',
        'organizador',
        'avaliador'
    ]);

    $router -> GET('404', function(){
        $controller = new Controller();
        $controller -> Erro();
    });

    $router -> GET('/', function(){
        $controller = new IndexController();
        $controller -> Inicial();
    });
    
    $router -> GET('/logout', function(){
        $controller = new UserController();
        $controller -> Logout();
    });

    $router -> GET('/login', function($data){
        header("location: ./");
    });

    $router -> GET('/painel', function($data){
        $type = $_SESSION['type'];
        header("location: {$type}/painel");
    });

    $router -> GET('/&type/', function($data){
        $type = $_SESSION['type'];
        header("location: /painel");
    });

    $router -> GET('/&type/logout', function($data){
        header("location: ../logout");
    });

    $router -> GET('/&type/login', function($data){
        $controller = new UserController($data['type']);
        $controller -> Login();
    });

    $router -> GET('/&type/logar', function($data){
        $controller = new UserController($data['type']);
        $controller -> Logar();
    });

    $router -> GET('/&type/registro', function($data){
        $controller = new UserController($data['type']);
        $controller -> Registro();
    });

    $router -> GET('/&type/registrar', function($data){
        $controller = new UserController($data['type']);
        $controller -> Registrar();
    });

    $router -> GET('/&type/painel', function($data){
        header("location: painel/geral");
    });

    $router -> GET('/&type/painel/{area}', function($data){
        $_SESSION['area'] = $data['area'];
        $controller = new PainelController();
        $controller -> Painel();
    });

    $router -> GET('/&type/alterar', function($data){
        header("location: ../painel/geral");
    });

    $router -> GET('/&type/alterar/{area}', function($data){
        $controller = new AlterarController($data['area']);
        $controller -> Alterar();
    });
    
    $router -> GET('/&type/enviar/{area}', function($data){
        $_SESSION['enviar'] = $data['area'];
        $controller = new EnviarController($data['area']);
        $controller -> Enviar();
    });



