<?php
    
    #Controle de Roteamento
    include $_SERVER['DOCUMENT_ROOT'].'/router.php';
    include $_SERVER['DOCUMENT_ROOT'].'/config.php';

    $router = new Router();
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
        $controller = new UserController('off');
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
        $controller = new PainelController();
        $controller -> Painel();
    });
