<?php
    include 'Controller.php';

    class AlterarController extends Controller
    {
        public $controller;
        public $area;

        public function __construct($area){
            $this -> controller = new Controller();
            $this -> controller -> verificarLogin(0);
            $this -> area = $area;
        }
        
        public function Alterar()
        {
            switch($this -> area){
                case 'sobre':
                    $this -> Sobre();
                    break;

                case 'trabalhos':
                    $this -> Trabalhos();
                    break;

                case 'avaliar':
                    $this -> Avaliar();
                    break;
            }
        } 

        public function Sobre(){
            // Verifica os dados e atualiza as informações do 'Sobre'
            $this->controller->prepareEmpty = FALSE;

            $form = [   
                "nome" => $this->controller->PrepareUser($_POST['nome'], 'texto'),  
                "nascimento" => $this->controller->PrepareUser($_POST['nascimento'], 'data'), 
                "rg" => $this->controller->PrepareUser($_POST['rg'], 'texto'),
                "cpf" => $this->controller->PrepareUser($_POST['cpf'], 'cpf'),
                "lattes" => $this->controller->PrepareUser($_POST['lattes'], 'url', 'Lattes'),
                "email" => $this->controller->PrepareUser($_POST['email'], 'email', $_POST['cemail'], $_POST['senhaa'], $_POST['emailo']),
                "telefone" => $this->controller->PrepareUser($_POST['telefone'], 'telefone'), 
                "senha" => $this->controller->PrepareUser($_POST['senha'], 'senha', $_POST['csenha'], $_POST['emailo'], $_POST['senhaa']),
                "cep" => $this->controller->PrepareUser($_POST['cep'], 'numero'),
                "estado" => $this->controller->PrepareUser($_POST['estado'], 'texto'),
                "municipio" => $this->controller->PrepareUser($_POST['municipio'], 'texto'),
                "bairro" => $this->controller->PrepareUser($_POST['bairro'], 'texto'),
                "rua" => $this->controller->PrepareUser($_POST['rua'], 'texto'),
                "numero" => $this->controller->PrepareUser($_POST['numero'], 'texto'),
                "complemento" => $this->controller->PrepareUser($_POST['complemento'], 'texto')
              ];
            

            $model = new Model;
            $model -> alterarBanco(
                "UPDATE 
                 usuarios 
                 SET 
                 nome='".$form['nome']."', 
                 email='".$form['email']."', 
                 telefone='".$form['telefone']."', 
                 nascimento='".$form['nascimento']."', 
                 cep='".$form['cep']."', 
                 rua='".$form['rua']."', 
                 estado='".$form['estado']."', 
                 bairro='".$form['bairro']."', 
                 complemento='".$form['complemento']."', 
                 municipio='".$form['municipio']."', 
                 numero='".$form['numero']."', 
                 rg='".$form['rg']."', 
                 cpf='".$form['cpf']."', 
                 senha='".$form['senha']."' 
                 WHERE 
                 email='".$this->controller->User("email")."' AND
                 senha='".$this->controller->User("senha")."' "
            );

            header('location: ../painel/sobre');
        }
        
        public function Trabalhos(){
            // Adiciona um trabalho ao sistema
            $form = [
                'autor' => $this->controller->User("nome")." ".$this->controller->User("sobrenome"),
                'autorid' => $this->controller->User("id"),
                'enviadoem' => $this->controller->Prepare(time()),
                'titulo' => $this->controller->Prepare($_POST['titulo'], 'all'),
                'descricao' => $this->controller->Prepare($_POST['descricao'], 'all'),
                'arquivo' => $this->controller->Upload('arquivo', 'pdf', 31457280),
                'area' => $this->controller->Prepare($_POST['area'], 'number'),
                ];

            $model = new Model;
            $model -> alterarBanco(
                " INSERT INTO  
                 trabalhos ( autor, autorid, enviadoem, titulo, descricao, arquivo, area , avaliado) 
                 VALUES ( '".$form["autor"]."','".$form["autorid"]."','".$form["enviadoem"]."','".$form["titulo"]."','".$form["descricao"]."','".$form["arquivo"]."','".$form["area"]."', '0' ) "
            );

            $model -> alterarBanco(
                " UPDATE usuarios
                    SET trabalhos = '".($this->controller->User("trabalhos") + 1)."'  
                    WHERE id = '".($this->controller->User("id"))."' "
            );

            $model -> consultarBanco("trabalhos", " WHERE autorid='".$this->controller->User("id")."' AND enviadoem='".$form['enviadoem']."' ");
            $dados = $model->verDados();

            header('location: ../sobre/'.$dados['trabalhos']['0']['id']);
        }

        public function Avaliar(){
            if(($this->controller->User("tipo") != 'avaliador')&&($this->controller->User("tipo") != 'organizador'))
                $this->controller->Erro();

            $form = [
                'nota' => $this->controller->Prepare($_POST['nota'], 'all'),
                'comentarios' => $this->controller->Prepare($_POST['descricao'], 'all'),
                'avaliador' => $this->controller->User("nome"),
                'avaliadorid' => $this->controller->User("id"),
                'avaliadoem' => time()
            ];

            $model = new Model;
            $model -> alterarBanco(
                " UPDATE trabalhos 
                    SET nota='".$form['nota']."', 
                        comentarios='".$form['comentarios']."', 
                        avaliador='".$form['avaliador']."', 
                        avaliadorid='".$form['avaliadorid']."', 
                        avaliadoem='".$form['avaliadoem']."',
                        avaliado='1' 
                    WHERE id='".$_POST['id']."'
                "
            );

            header('location: ../sobre/'.$_POST['id']);
        }
    }
?>
