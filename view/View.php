<?php
   class View
   {
      #Header & Estructure
      private $config;
      private $data;
      public $controller;
        
      public function __construct(){
          $this -> controller = new Controller();
      }

      public function render($config='', $str='')
      {
         if(isset($config)){
             foreach($config as $key){
                if(is_array($key)){
                    $contador = 0;
                    foreach($key as $conf){
                        $conf[$contador] = $conf;
                        $contador++;
                    }
                }    
             }
         }
         
         $this -> data = $str;
         $this -> config = $config;
         
         $this -> base($config);
         $this -> corpo($str);
         $this -> rodape();
      }
      
      private function base($data=''){
          include $_SERVER['DOCUMENT_ROOT']."/template/basic/head.php";
      }
      
      private function rodape(){
          include $_SERVER['DOCUMENT_ROOT']."/template/basic/footer.php";
      }
      
      
      private function corpo($data=''){
          
          $config = $this -> config;
          $data = $this -> data;

          if(file_exists($_SERVER['DOCUMENT_ROOT']."/template/".$this -> config['template'])){
            include $_SERVER['DOCUMENT_ROOT']."/template/".$this -> config['template'];
          }
          else{
              $this -> controller -> Erro();
              exit();
          }
      }
   }