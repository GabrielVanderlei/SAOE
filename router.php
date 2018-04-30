<?php
    #Script de Roteamento

    class Router {
        public $url;
        public $urlData;
        public $urlError;
        public $found;
        public $pubData;
        public $pass;
        public $httpDeck;
        public $vars;
        public $returnData;
        
        public function __construct(){
            session_start();
            $this -> vars = [];
            $this -> returnData = [];
            $this -> found = 0;
            $this -> pass = [];
            $this -> pubData = '';
            $this -> httpDeck = $this -> atualHTTP($_SERVER['REQUEST_URI']);
            $this -> url = $this -> URLPrep($_SERVER['REQUEST_URI']);

            # Sistema de histórico de URL integrado.
            
            if(!isset(explode('.', $_SERVER['REQUEST_URI'])[1])):
                if(!isset($_SESSION['location_counter'])): 
                    $_SESSION['location_counter'] = 0;
                    $_SESSION['last_location'] = "404";
                else: 
                    $_SESSION['location_counter']++;
                    $_SESSION['last_location'] = $_SESSION['location_history'][($_SESSION['location_counter'] - 1)];
                endif;
            
                $_SESSION['location_history'][$_SESSION['location_counter']] = $_SERVER['REQUEST_URI'];
            endif;
        }

        function atualHTTP($url){
            $url = explode("?", $url);
            return substr($url[0], 1);
        }

        function setPublic($pubData){
            $this -> pubData = $pubData;
        }

        function setPass($passDir){
            $this -> pass[substr($this->pubData, 1).'/'.$passDir] = 1;
        }

        function setVar($var, $content){
            $this -> vars[$var] = $content;
        }

        function URLPrep($uri = ''){
            $routes = explode('/', $uri);
            unset($routes[0]);
            $routes = array_values($routes);
            if(count($routes) > 0){
                if($routes[(count($routes) - 1)] == ''){
                    unset($routes[(count($routes) - 1)]);
                }
            }

            $routes = array_values($routes);
            return $routes;
        }

        function DT($str, $fn){

            if($str == '404'){
                $this -> urlError['404']['fn'] = $fn;
            }

            $this -> urlData[count($this -> urlData)] = array(
                'str' => $str,
                'fn' => $fn
            ); 
        }

        function Process($str, $fn){
            $atualUrl = $this -> URLPrep($this -> pubData.$str);

            $u = array(
                0 => '',
                1 => ''
            );

            $pData = [];

            if(($str == '/') && ($this -> httpDeck == '')){
                $fn();
                exit();
            }

            for($i = 0; $i <= (count($atualUrl) - 1); $i++){

                if(isset($atualUrl[$i]) && isset($this -> url[$i])){
                        
                        $params = preg_match("/{(.*)}/", $atualUrl[$i], $matches);
                        
                        if(!empty($matches)){
                            $atualUrl[$i] = $this -> url[$i];
                            $pData[$matches[1]] = $this -> url[$i];
                        }
                        
                        if(isset($this -> returnData['/'.$u[0]])){
                            foreach($this -> returnData['/'.$u[0]] as $key => $val){
                                $pData[$key] = $val;
                            }
                        }

                        $u[0] .= $atualUrl[$i].'/';
                        $u[1] .= $this -> url[$i].'/';
                        
                        if(isset($this -> pass[$u[1]])){
                            $atURL = str_replace(substr($this->pubData, 1), '', $this->httpDeck);
                            $url = realpath(__DIR__ . '/.').'/public'.$atURL;

                            if(file_exists($url)):
                                $this -> found++;
                                header("Content-Type: ".$this->getType($url)."; ");
                                include(realpath(__DIR__ . '/.').'/public'.$atURL);
                                exit();
                            endif;
                        }

                        if(
                        ($u[0] == $u[1]) &&
                        (count($atualUrl) == ($i + 1)) && 
                        (count($atualUrl) == count($this -> url))
                        ){
                            $this -> found++;
                            $fn($pData, $this);
                        }
                         

                }
            }
        }

        function getType($url){
            $ends = explode(".", $url);
            $type = end($ends);
            switch($type):
                case 'css':
                    return 'text/css';
                    break;
                case 'js':
                    return 'text/js';
                    break;
            endswitch;
        }

        function GET($str, $fn){
            preg_match('@^(?:\/)[\&?]([^/]+)@i',$str, $matches);
            if(!empty($matches[1])){
                if(isset($this -> vars[$matches[1]])){
                    foreach($this -> vars[$matches[1]] as $key){
                        $vals = str_replace('&'.$matches[1], $key, $str);
                        $this -> returnData[$this->pubData.$vals][$matches[1]] = $key;
                        $this -> DT($vals, $fn);
                    }
                }
            }
            else{
                $this -> DT($str, $fn);
            }
        }

        function LoadAllData(){
            foreach($this -> urlData as $key){
                $this
                -> Process($key['str'], $key['fn']);
            }
        }

        function ErrorHandler($err = 0){
            if(($this -> found == 0)||($err == 404)){
                $this -> urlError['404']['fn']($this);
            }
        }

        function __destruct(){
            $this -> LoadAllData();
            $this -> ErrorHandler();
        }
    }
