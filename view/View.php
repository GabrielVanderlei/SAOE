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
          include realpath(__DIR__ . '/..')."/template/basic/head.php";
      }
      
      private function rodape(){
          include realpath(__DIR__ . '/..')."/template/basic/footer.php";
      }
      
      
      private function corpo($data=''){
          
          $config = $this -> config;
          $data = $this -> data;
          
          if(file_exists(realpath(__DIR__ . '/..')."/template/".$this -> config['template'])){
            include realpath(__DIR__ . '/..')."/template/".$this -> config['template'];
          }
          else{
              $this -> controller -> Erro();
              exit();
          }
      }
   }