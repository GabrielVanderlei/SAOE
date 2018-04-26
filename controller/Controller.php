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

          $this -> script = [
              '0' => '/assets/js/libs/jquery/jquery.min.js',
              ];
              
          $this -> style = [
              '0' => '/assets/css/basic/header.css'
              ];
        
            
         $this -> setConfig([
                'script' => [
                    ['text/javascript', $this->script['0']],]]);
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
          $file = file_get_contents(realpath(__DIR__ . '/..')."/configuration/".$file.".json");
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
        /*
        0 -> Apenas usuários
        1 -> Páginas normais
        */
        
        switch($lchannel){
            case 0:
                if(!isset($_SESSION['usuario'])){
                    header("location: logout");}
                break;
            case 1:
                if(isset($_SESSION['usuario'])){
                    header("location: ".$this->Config("saoe")->{"public"}."/".$_SESSION['type']."/painel");
                }
                break;
        }
      }

      public function User($data){

          if(isset($_SESSION['usuario'])){
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
                      $_SESSION['log_err'] = "Token expirado";
                      session_destroy();}
              }

              $this->dados=1;
              if(empty($_SESSION['usuario'][$data])) return 0;
              return $_SESSION['usuario'][$data];
          }
     }

    // Prepare -> Função de proteção.
    public function Prepare($str, $type=''){
            
    switch($type){
        case 'email': 
            $alt = '|@|.';
            break;

        case 'secure':
            # $str[0] => Senha atual.
            # $str[1] => Valor novo.
            # $str[2] => Coluna no banco.

            # A senha é a mesma que a registrada no sistema?
            if($this->Senha($this->User('email'),$str[0]) == $this->User('senha')) return $str[1];
            else return $this -> User($str[2]);
            break;

        case 'number':
            if(!is_numeric($str)) return 0;
            else return $str;
            break;

        case 'all':
            return $str;
            break;

        default:
            // Retorna apenas letras e números
            $alt = '';
            break;
    }

    $secure = preg_replace('/[^[:alnum:]'.$alt.'_]/', '',$str);
    $secure = utf8_encode($secure);
    return $secure;
}

public function Upload($nomeInput, $tipo = '*', $tamanho = '*', $uploadLoc = ''){
    $arquivo = $_FILES[$nomeInput];
    $tipoDoArquivo = $arquivo['type'];
    $patch = ["application/pdf" => "pdf"];
    $tamanhoDoArquivo = $arquivo['size'];

    if(empty($uploadLoc))  $uploadLoc = realpath(__DIR__ . '/..').$this->Config('saoe')->{"upload_dir"}."/".$this->User("id")."-".($this->User("trabalhos") + 1).".".$patch[$tipoDoArquivo];
    #if(($tipoDoArquivo != $tipo) && ($tipo != '*')) return 'a';
    if(($tamanhoDoArquivo > $tamanho) && ($tamanho != '*'))  return 'b';
    if(!move_uploaded_file($arquivo["tmp_name"], $uploadLoc)) return 'c';
    return ($this->User("trabalhos") + 1);
}

public function Senha($email, $senha){
    $secure = md5(sha1($email).sha1($senha));
    return $secure;
}

public function Utils($str, $type){
    switch($type):
        case 'mes':
            $mes = [
                "01" => "janeiro",
                "02" => "fevereiro",
                "03" => "março",
                "04" => "abril",
                "05" => "maio",
                "06" => "junho",
                "07" => "julho",
                "08" => "agosto",
                "09" => "setembro",
                "10" => "outubro",
                "11" => "novembro",
                "12" => "dezembro",
            ];

            return $mes[$str];
            break;
    endswitch;
}
   }