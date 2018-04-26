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

            $form = [
                'perfil' => $this->controller->Prepare($_POST['perfil'], 'imagem'),
                'nome' => $this->controller->Prepare($_POST['nome']),
                'sobrenome' => $this->controller->Prepare($_POST['sobrenome']),
                'telefone' => $this->controller->Prepare($_POST['telefone']),
                'nascimento' => $this->controller->Prepare($_POST['nascimento']),
                'cep' => $this->controller->Prepare($_POST['cep']),
                'estado' => $this->controller->Prepare($_POST['estado']),
                'bairro' => $this->controller->Prepare($_POST['bairro']),
                'rua' => $this->controller->Prepare($_POST['rua']),
                'complemento' => $this->controller->Prepare($_POST['complemento']),
                'rg' => $this->controller->Prepare($_POST['rg']),
                'cpf' => $this->controller->Prepare($_POST['cpf']),
                'senha' => $this->controller->Prepare([$_POST['senha'], $_POST['novasenha'], 'senha'], 'secure'),
                'email' => $this->controller->Prepare([$_POST['senha'], $_POST['novoemail'], 'email'], 'secure'),
            ];

            $model = new Model;
            $model -> alterarBanco(
                "UPDATE 
                 usuarios 
                 SET 
                 nome='".$form['nome']."', 
                 sobrenome='".$form['sobrenome']."', 
                 email='".$form['email']."', 
                 telefone='".$form['telefone']."', 
                 nascimento='".$form['nascimento']."', 
                 img='".$form['perfil']."', 
                 cep='".$form['cep']."', 
                 rua='".$form['rua']."', 
                 estado='".$form['estado']."', 
                 bairro='".$form['bairro']."', 
                 complemento='".$form['complemento']."', 
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
                 trabalhos ( autor, autorid, enviadoem, titulo, descricao, arquivo, area ) 
                 VALUES ( '".$form["autor"]."','".$form["autorid"]."','".$form["enviadoem"]."','".$form["titulo"]."','".$form["descricao"]."','".$form["arquivo"]."','".$form["area"]."' ) "
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
                'avaliador' => $this->controller->User("nome")." ".$this->controller->User("sobreome"),
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
