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

        public function Senha($email, $senha){
            $secure = md5(sha1($email).sha1($senha));
            return $secure;
        }

        // Inicializando a função.
        public function __construct($type='off'){
            $this -> controller = new Controller();

            if($type != 'off'){
                $this -> controller -> verificarLogin(1);
                if(($type != 'palestrante') && ($type != 'avaliador') && ($type != 'organizador')){
                    $this ->controller->Erro(); 
                }
                else{
                    $_SESSION['tipo'] = $type;
                    $this -> type = $type;
                }
            }

        }
        
        // Funções focadas no View
        public function Registro()
        {         
            $this -> controller -> setConfig([
                'title' => 'Eventos',
                'template' => 'registro/registro.php',
                'version' => time() #Para testes o 'time' pode ser usado.
            ]);
                
            $model = new Model;
            $view = new View;
            $_SESSION['tipo'] = $this -> type;

            $view->render(
                $this -> controller -> getConfig(),
                $model -> verDados());    
      }   

      public function Login()
        {         
            $this -> controller -> setConfig([
                'title' => 'Eventos',
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

          $form = [
            "email" => $this->controller->PrepareUser($_POST['email'], 'email'),
            "senha" => $this->controller->PrepareUser($_POST['senha'], 'senha', '', $_POST['email'])];

          $model = new Model;
          $model -> setOrdem("senha");
          $model -> consultarBanco(
            "usuarios",
            " WHERE 
                email='".$form['email']."' AND 
                senha='".$form['senha']."' AND 
                tipo='".$_SESSION['tipo']."'");

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
          # Se for um avaliador
          if($_POST['tipo'] == 'avaliador'):
            $form['area'] = $this->controller->PrepareUser($_POST['area'], 'numero');
          endif;

          if($_POST['tipo'] != 'palestrante'):
            $form["lattes"] = $this->controller->PrepareUser($_POST['lattes'], 'url', 'Lattes');
          endif;

          $form = [
            "tipo" => $this->controller->PrepareUser($_POST['tipo'], 'tipo'),     
            "nome" => $this->controller->PrepareUser($_POST['nome'], 'texto'),  
            "nascimento" => $this->controller->PrepareUser($_POST['nascimento'], 'data'), 
            "rg" => $this->controller->PrepareUser($_POST['rg'], 'texto'),
            "cpf" => $this->controller->PrepareUser($_POST['cpf'], 'cpf'),
            "email" => $this->controller->PrepareUser($_POST['email'], 'email', $_POST['cemail']),
            "telefone" => $this->controller->PrepareUser($_POST['telefone'], 'telefone'), 
            "senha" => $this->controller->PrepareUser($_POST['senha'], 'senha', $_POST['csenha'], $_POST['email']),
            "cep" => $this->controller->PrepareUser($_POST['cep'], 'numero'),
            "estado" => $this->controller->PrepareUser($_POST['estado'], 'texto'),
            "municipio" => $this->controller->PrepareUser($_POST['municipio'], 'texto'),
            "bairro" => $this->controller->PrepareUser($_POST['bairro'], 'texto'),
            "rua" => $this->controller->PrepareUser($_POST['rua'], 'texto'),
            "numero" => $this->controller->PrepareUser($_POST['numero'], 'texto'),
            "complemento" => $this->controller->PrepareUser($_POST['complemento'], 'texto'),
            "img" => 0,
            "ativo" => (($_SESSION['tipo'] == 'palestrante')?1:0)
          ];

          $model = new Model;
          $model -> consultarBanco(
            "usuarios",
            " WHERE email='".$form['email']."' "
          );

          $dd = $model -> verDados();
          if(empty($dd)){
              
              $model -> alterarBanco(
                " INSERT INTO 
                     usuarios 
                     ( email, senha, tipo, nascimento, 
                      nome, telefone,
                      rg, cpf, 
                      cep, complemento, numero, rua, bairro, municipio, estado,
                      img, lattes,
                      ativo ) 
                     
                     VALUES (
                         '".$form['email']."',
                         '".$form['senha']."',
                         '".$form['tipo']."',
                         '".$form['nascimento']."',
                         '".$form['nome']."',
                         '".$form['telefone']."',
                         '".$form['rg']."',
                         '".$form['cpf']."',
                         '".$form['cep']."',
                         '".$form['complemento']."',
                         '".$form['numero']."',
                         '".$form['rua']."',
                         '".$form['bairro']."',
                         '".$form['municipio']."',
                         '".$form['estado']."',
                         '".$form['img']."',
                         '".$form['lattes']."',
                         '".$form['ativo']."' ) ");
                         
                        $_SESSION['usuario'] = $form;
                        header("location: painel");
          }

          else{
              $_SESSION['err'] = 'Email já cadastrado.';
              header("location: registro");
          }
      }

      public function Logout(){
          session_destroy();
          header("location: ./");
      }

    }
?>
