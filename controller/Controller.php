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
      public $prepareEmpty;
      
      public function __construct(){

          $this -> config = [];
            
          $this -> script = [
              '0' => '/assets/js/build.js',
              '1' => '/assets/js/main.js',
              ];

          
          $this -> style = [
              '0' => '/assets/css/build.css'
              ];
        
            
         $this -> setConfig([
                'script' => [
                    ['text/javascript', $this->script['0']],
                    ['text/javascript', $this->script['1']],
                    ],
                'link' => [
                    ['stylesheet', $this->style['0']],
                    ]
                 ]);
        $this -> prepareEmpty = TRUE;
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
                    header("location: ".$this->Config("saoe")->{"public"}."/".$_SESSION['tipo']."/painel");
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



        public function PrepareUser($str, $type='', $opt='', $opt2 = '', $opt3 = ''){
            // Retorna apenas letras e números
            $alt = '';
            $err = 0;
            $secure = $str;

            if($this -> prepareEmpty == TRUE):
                if(empty($str) && ($str != '0')):
                    $_SESSION['err'] = "Algum campo não foi preenchido. (".ucfirst($type).")";    
                    $err = 1;
                    header("location: ".$_SESSION['last_location']);
                    exit();
                endif;
            endif;

            switch($type):
                case 'email':
                    if(empty($str)) return $this->User("email");

                    if(!filter_var($str, FILTER_VALIDATE_EMAIL)):
                        $_SESSION['err'] = "E-mail inválido.";    
                        $err = 1;
                    endif;

                    if((!empty($opt))&&($opt != $str)):
                        $_SESSION['err'] = "E-mail e confirmação não são iguais.";    
                        $err = 1;
                    endif;
                    
                    if((!empty($opt2))&&($this -> Senha($opt2, $opt3) != $this->User("senha"))):
                        $_SESSION['err'] = "Senha atual incorreta.";    
                        $err = 1;
                        break;
                    endif;

                    break;

                case 'senha':
                    if(empty($str)) return $this->User("senha");
                    
                    if(strlen($str) < 6):
                        $_SESSION['err'] = "Senha inválida.";    
                        $err = 1;
                        break;
                    endif;
                    
                    if((!empty($opt))&&($opt != $str)):
                        $_SESSION['err'] = "Senha e confirmação não são iguais.";    
                        $err = 1;
                        break;
                    endif;

                    if((!empty($opt3))&&($this -> Senha($opt3, $opt2) != $this->User("senha"))):
                        $_SESSION['err'] = "Senha atual incorreta.";    
                        $err = 1;
                        break;
                    endif;

                    return $this -> Senha($str, $opt2);
                    break;
                
                case 'tipo':
                    if(!(
                        ($str == "palestrante")||
                        ($str == "organizador")||
                        ($str == "avaliador")
                    )): 
                        $_SESSION['err'] = "Tipo inválido.";
                        $err = 1;
                    endif;
                    break;

                case 'data':
                    if(empty(date("d/m/Y", strtotime($str)))):
                        $_SESSION['err'] = "Data inválida.";
                        $err = 1;
                    endif;
                    break;

                case 'texto':
                    $secure = preg_replace('/[^[:alnum:]'.$alt.'_]/', '',$str);
                    break;

                case 'url':
                    if(!filter_var($str, FILTER_VALIDATE_URL)):
                        $opt = "(".$opt.")";
                        $_SESSION['err'] = "Link ".$opt." inválido.";    
                        $err = 1;
                    endif;
                    break;

                case 'cpf':
                    if(strlen($str) != 11): 
                        $_SESSION['err'] = "CPF inválido";
                        $err = 1;
                        break;
                    endif;
                    
                    // Retira o dígito verificador
                    $cpf = [
                            '1' => array_slice(str_split($str), 0, 9),
                            '0' => array_slice(str_split($str), 9, 11)
                        ];

                    // 1º Dígito
                    $verificador = $cpf['0'];
                    $digitos = $cpf['1'];
                    $res = 0;

                    for($i = 10; $i >= 2; $i--):
                        $res += $digitos[(10 - $i)]*$i;
                    endfor;
                    
                    if(($res%11) < 2):
                        if(!($verificador[0] == 0)): 
                            $_SESSION['err'] = "CPF inválido";
                            $err = 1;
                            break;
                        endif;
                    else:
                        if((11-$res%11) != $verificador[0]):
                            $_SESSION['err'] = "CPF inválido";
                            $err = 1;
                            break;
                        endif;
                    endif;
                    # 1º Dígito OK

                    // 2º Dígito
                    $res = 0;
                    for($i = 10; $i >= 2; $i--):
                        $res += $digitos[(10 - $i)]*($i+1);
                    endfor;
                    $res += $verificador[0] * 2;

                    if(($res%11) < 2):
                        if(!($verificador[1] == 0)): 
                            $_SESSION['err'] = "CPF inválido";
                            $err = 1;
                            break;
                        endif;
                    else:
                        if((11-$res%11) != $verificador[1]):
                            $_SESSION['err'] = "CPF inválido";
                            $err = 1;
                            break;
                        endif;
                    endif;

                    # 2º Dígito OK
                    # CPF válido.
                    break;

                case 'rg':
                    // Retira o dígito verificador
                    $rg = explode("-", $str);

                    // 1º Dígito
                    $verificador = $rg[0];
                    $digitos = $rg[1];
                    $res = 0;

                    for($i = strlen($digitos); $i <= 2; $i--):
                        $res += $digitos[(strlen($digitos) - $i)]*$i;
                    endfor;

                    if((11-$res%11) >= 10):
                        if(!(($verificador[0] == 'X') || ($verificador[0] == 0))):
                            $_SESSION['err'] = "CPF inválido";
                            $err = 1;
                            break;
                        endif;
                    else:
                        if((11-$res%11) != $verificador[0]):
                            $_SESSION['err'] = "CPF inválido";
                            $err = 1;
                            break;
                        endif;
                    endif;
                    # RG OK
                    break;

                case 'telefone':
                    if(!preg_match('/(\(?\d{2}\)?) ?9?\d{4}-?\d{4}/', $str)):
                        $_SESSION['err'] = "Telefone inválido.";
                        $err=1;
                        break;
                    endif; 
                    break;

                case 'numero':
                    if(!is_numeric($str)):
                        $_SESSION['err'] = "Área de atuação inválido.";
                        $err=1;
                        break;
                    endif; 
                    break;
                default: 
                    $_SESSION['err'] = "Alguma das entradas é inválida.";
                    $err = 1;
                    break;
            endswitch;

            if($err == 0):
                return $str;
            else:
                header("location: ".$_SESSION['last_location']);
                exit();
            endif;
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