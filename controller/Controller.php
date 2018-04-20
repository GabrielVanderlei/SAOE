<?php
    
/*
    @name Controller.php
    @author Gabriel Vanderlei
    @description Essa é a classe que controla todas as requisições.
*/

   class Controller
   {
      public $script;
      public $config;
      public $style;
      public $user;
      public $dados;
      
      public function __construct(){

          $this -> config = [];
          
          $this -> script = array(
              '0' => '/assets/js/libs/jquery/jquery.min.js',
              );
              
          $this -> style = array(
              );
        
         $this -> setConfig([
                'script' => array(
                    ['text/javascript', $this->script['0']],
                )

           ]);
      }
      
      public function setConfig($arr){
        foreach($arr as $key => $val){
            if(isset($this -> config[$key])){
          $this -> config[$key] = array_merge($this -> config[$key], 
            $arr[$key]);
            }
            else{
                $this -> config[$key] =
            $arr[$key];
            }
        }
      }

      public function getConfig(){
          return $this -> config;
      }
      
      public function index()
      {
         $model = new Model;
         $view = new View;
         $view->render($model->getText());
      }
      
      public function Erro(){
          #Página de erro
          http_response_code("404");

            $this -> setConfig([
                'title' => 'Página não encontrada',
                'link' => array(
                    ['stylesheet', '/assets/css/404/404.css']
                    ),
                'template' => 'errorHandler/404.php',
                'version' => time() #Para testes o 'time' pode ser usado.
            ]);
          
            $model = new Model;
            $view = new View;
            $view->render(
                $this -> getConfig(),
                $model -> verDados());
      }

      public function Config($file, $opt=false){
          $file = file_get_contents($_SERVER['DOCUMENT_ROOT']."/configuration/".$file.".json");
          $json = json_decode($file, $opt);
          return $json;
      }

      public function CSR($create = 1){
           if($create == 1){
              if(!isset($_SESSION['CSR'])){
                $_SESSION['CSR'] = md5(rand());
              }

              return md5($_SESSION['CSR']);
          }
          else{
              // Verifica o CSR
              if($_POST['CSR'] != md5($_SESSION['CSR'])){
                  $_SESSION['error'] = "Aconteceu um erro, por favor tente novamente.";
                  $last = $_SERVER['HTTP_REFERER'];
                  header("location: {$last}");
              }
          }
      }

      public function verificarLogin($lchannel = 0){
          if(!isset($_SESSION['usuario'])){ if($lchannel == 0){ $_SESSION['error'] = 'Você não está logado.'; header("location: login"); }}
          else{if($lchannel){ header("location: painel"); }}
      }

      public function User($data){
          if(empty($this -> dados)){
              $model = new Model;
              $model -> setOrdem("senha");
              $model -> consultarBanco(
                "usuarios", 
                " WHERE email='".$_SESSION['usuario']['email']."' AND senha='".$_SESSION['usuario']['senha']."' ");
              
              $dd = $model -> verDados();
              if(!empty($dd)){
                $_SESSION['usuario'] = $dd['usuarios']['senha'][$_SESSION['usuario']['senha']];
              }

              else{
                  exit("b");
                  $_SESSION['log_err'] = "Token expirado";
                  header("location: ../logout");}
          }

          return $_SESSION['usuario'][$data];
      }
   }