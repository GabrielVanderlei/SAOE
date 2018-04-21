<?php 
    include 'Controller.php';

    class EnviarController extends Controller
    {
        public $controller;
        public $area;
        
        public function __construct(){
            $this -> controller = new Controller();
            $this -> controller -> verificarLogin(0);
        }
        
        public function Enviar()
        {
            $this -> controller -> setConfig([
                'title' => 'Eventos',
                'link' => [ ['stylesheet','/assets/css/painel/menu.css'] ],
                'template' => 'enviar/index.php',
                'version' => time() #Para testes o 'time' pode ser usado.
            ]);
          
            $model = new Model;
            $view = new View;

            $view->render(
                $this -> controller -> getConfig(),
                $model -> verDados());
             
      }   
    }
?>
