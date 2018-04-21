<?php
    #DatabaseHelper
    require(realpath(__DIR__ . '/..').'/class/databaseHelper.php');

   class Model
   {
      public $controller;

      #SQL
      private $sqlInteraction;
      
      #Ordenamento
      private $ordemArray;
      private $identifier;
      
      #Modelagem
      public $dados;
      private $tabelaAtual;
      private $atualId;
      
      #Banco de Dados
      private $dadosDoBanco;
      private $banco;
      
      function __construct(){
          
          $this -> controller = new Controller();

          #Configuração do banco de dados
          $conn = $this->controller->Config("conexao", true);
          
          $this -> dadosDoBanco = array(
              "type" => $conn["type"],
              "host" => $conn["host"],
              "dbname" => $conn["dbname"],
              "user" => $conn["user"],
              "pass" => $conn["pass"]
              );
              
          $this -> banco = new DatabaseHelper($this -> dadosDoBanco);
          
      } 
      
      public function getText($str='oi'){
          echo $str;
      }

      public function verDados()
      {
          return $this -> dados;
      }
      
      private function unirArray($antigoArray, $novoArray=''){
          if(!empty($antigoArray)) return array_merge($antigoArray, $novoArray);
          else{ return $novoArray; }
      }
      
      public function setOrdem($index){
        $this -> ordemArray[count($this -> ordemArray)] = $index;
      }
      
      public function setSQLIntegration($sqlFixo, $sqlBind, $param , $sqlOpt){
          $this -> sqlInteraction = '';
          $this -> sqlInteraction = $sqlFixo;
          $dados = $this -> dados[$this -> atualTabela];
          
          $contador = 0;
          foreach($dados as $key){
            $contador++;
            if((!empty($key[$param])) || ($key[$param] === '0')){
                $this -> sqlInteraction .= $sqlBind;
                $this -> sqlInteraction .= " '".$key[$param]."' ";
                
                if(
                    (!empty($sqlOpt)) &&
                    ($contador != count($dados))
                    ){
                    $this -> sqlInteraction .= $sqlOpt;
                }
            }
          }
          
      }
      
      public function consultarBanco($tabela = 'business', $sql='', $i = '', $identifier='')
      {
        $this -> atualTabela = $tabela;
              
        if(!empty($identifier)){
        $this -> identifier = $identifier;
        }
              
        else{
            $this -> identifier = $this -> atualTabela;
        }
          
        if(!empty($tabela)){
            if(!empty($this -> sqlInteraction)){
                $sql .= $this -> sqlInteraction;
            }
                  
            $this 
            -> banco 
            -> GET(
                "SELECT *
                FROM ".$tabela . $sql ,
                        
                function ($resposta, $i, $end){
                    $this 
                    -> dados[$this -> identifier][$i] = $resposta;
                            
                    if(is_array($this -> ordemArray)){
                        foreach($this -> ordemArray as $key => $val){
                            $this 
                            -> dados
                            [$this -> identifier]
                            [$val]
                            [$resposta[$val]] = $resposta;
                        }
                    }
                    
                    if(($i + 1) == $end){
                        $this -> ordemArray = '';
                        $this -> identifier = '';
                    }
                    }
            );
                    
        }
              
        else{
            $this 
            -> banco 
            -> GET(
                $sql ,
                        
                function ($resposta, $i){
                    $this 
                    -> dados = $this -> unirArray($this-> dados, $resposta);
                }
            );
        }
      }
      
      public function alterarBanco($sql){
          $this -> banco -> GET($sql, '');
      }
      
      private function verificaSeExiste($pattern, $input, $flags=0) {
            return array_intersect_key(
                $input, array_flip(
                    preg_grep(
                        $pattern, 
                        array_keys($input), 
                        $flags)));
        }
   }