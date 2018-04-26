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
      
      
        public function Ativar($id){
            // Verifica a autoridade
            if(($this->controller->User("tipo") != "organizador")||(!is_numeric($id))||($this->controller->User("id") == $id)):
                $this->controller->Erro();
            endif;

            $model = new Model;
            $model -> alterarBanco(
                " UPDATE usuarios 
                 SET ativo='1' 
                 WHERE id='".$id."' "
            );
            
            header("location: ../usuarios");
        }

        public function Desativar($id){
            // Verifica a autoridade
            if(($this->controller->User("tipo") != "organizador")||(!is_numeric($id))||($this->controller->User("id") == $id)):
                $this->controller->Erro();
            endif;

            $model = new Model;
            $model -> alterarBanco(
                " UPDATE usuarios 
                 SET ativo='0' 
                 WHERE id='".$id."' "
            );

            header("location: ../usuarios");
        }  
        
        public function Categoria(){
            if(($this->controller->User("tipo") != "organizador")):
                $this->controller->Erro();
            endif;
            
            $dados = [
                'valor' => $_POST['valor'],
                'nvalor' => $_POST['nvalor'],
                'id' => $_POST['id'],
                'nid' => $_POST['id'],
                'acao' => $_POST['act']
            ];

            switch($dados['acao']):
                // Alterar valor
                case 0:
                    $model = new Model;
                    $model -> alterarBanco(
                        " UPDATE tipos 
                          SET 
                          valor = '".$dados['nvalor']."' , 
                          id = '".$dados['nid']."' 
                          WHERE 
                          id = '".$dados['id']."'
                        "
                    );

                    break;

                // Excluir
                case 1: 
                    $model = new Model;
                    $model -> alterarBanco(
                        " DELETE FROM tipos  
                          WHERE 
                          id = '".$dados['id']."' AND 
                          valor = '".$dados['valor']."' 
                        "
                    );
                    break;

                // Criar
                case 2:
                    $model = new Model;
                    $model -> alterarBanco(
                        " INSERT INTO tipos (valor) VALUES ('".$dados['nvalor']."') "
                    );
                    break;

                    
            endswitch;

            header("location: ../areas");
        } 
    }
?>
