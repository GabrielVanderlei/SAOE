<?php
    include 'Controller.php';

    class UserController extends Controller
    {
        public $controller;
        private $type;
        
        // Utilidades
        private function Verificar($str, $type){
            if($type == 'email') return filter_var($str, FILTER_VALIDATE_EMAIL);
            
            if($type == 'senha'){
                if(strlen($str) < 6){ return 0; }
                else{ return 1; }
            }
        }

        private function Prepare($str, $type){
            // Retorna apenas letras e números
            if($type == 'email') $alt = '|@|.';
            else $alt = '';

            $secure = preg_replace('/[^[:alnum:]'.$alt.'_]/', '',$str);
            return $secure;
        }

        private function Senha($email, $senha){
            $secure = md5(sha1($email).sha1($senha));
            return $secure;
        }

        // Inicializando a função.
        public function __construct($type){
            $this -> controller = new Controller();
            $this -> controller -> verificarLogin(1);

            if(($type != 'palestrante') && ($type != 'avaliador') && ($type != 'organizador')){
                $this ->controller->Erro(); 
            }
            else{
                $_SESSION['type'] = $type;
                $this -> type = $type;
            }

        }
        
        // Funções focadas no View
        public function Registro($type)
        {         
            $this -> controller -> setConfig([
                'title' => 'Eventos',
                'link' => [ ['stylesheet','/assets/css/main/main.css'] ],
                'template' => 'registro/registro.php',
                'version' => time() #Para testes o 'time' pode ser usado.
            ]);
                
            $model = new Model;
            $view = new View;

            $view->render(
                $this -> controller -> getConfig(),
                $model -> verDados());    
      }   

      public function Login()
        {         
            $this -> controller -> setConfig([
                'title' => 'Eventos',
                'link' => [ ['stylesheet','/assets/css/main/main.css'] ],
                'template' => 'login/login.php',
                'version' => time() #Para testes o 'time' pode ser usado.
            ]);
                
            $model = new Model;
            $view = new View;

            $view->render(
                $this -> controller -> getConfig(),
                $model -> verDados());    
      } 
      
      // Funções de autenticação
      public function Logar()
      {

          if(!$this -> Verificar($_POST['email'], 'email')){ $_SESSION['error'] = 'Email ou senha incorreto.';header('location: login');};
          if(!$this -> Verificar($_POST['senha'], 'senha')){ $_SESSION['error'] = 'Email ou senha incorreto.';header('location: login');};
          
          $form = [
            "email" => $this -> Prepare($_POST['email'], 'email'),
            "senha" => $this -> Senha($_POST['email'], $_POST['senha'])];

          $model = new Model;

          $model -> setOrdem("senha");
          
          $model -> consultarBanco(
            "usuarios",
            " WHERE 
                email='".$form['email']."' AND 
                senha='".$form['senha']."' AND 
                tipo='".$_SESSION['type']."'");

          $dd = $model -> verDados();
          if(!empty($dd)){
              $_SESSION['usuario'] = $dd['usuarios']['senha'][$form['senha']];
              header("location: painel");
          }
          else{
              $_SESSION['error'] = "Email ou senha incorreto.";
              header("location: login");
          }
      }

      public function Registrar()
      {
          if(!$this -> Verificar($_POST['email'], 'email')){ $_SESSION['error'] = 'Seu e-mail não está corretamente formatado.';header('location: registro');exit();};
          if(!$this -> Verificar($_POST['senha'], 'senha')){ $_SESSION['error'] = 'Sua senha não cumpre as exigências requiridas.';header('location: registro');exit();};
          
          $form = [
            "email" => $this -> Prepare($_POST['email'], 'email'),
            "senha" => $this -> Senha($_POST['email'], $_POST['senha'])];

          $model = new Model;
          $model -> consultarBanco(
            "usuarios",
            " WHERE email='".$form['email']."' "
          );

          $dd = $model -> verDados();
          if(empty($dd)){
              $model -> alterarBanco(
                " INSERT INTO
                     usuarios (email, senha, tipo) 
                     VALUES(
                        '".$form['email']."',
                        '".$form['senha']."',
                        '".$_SESSION['tipo']."') ");
          }

          else{
              $_SESSION['erro'] = 'Email já cadastrado.';
              header("location: registro");
          }
      }

      public function Logout(){
          session_destroy();
          header("location: ./");
      }

    }
?>
