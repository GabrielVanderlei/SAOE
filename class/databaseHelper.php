<?php

/*
    @name Database Helper 
    @version 1.1
    @author Gabriel Vanderlei
*/

class DatabaseHelper {

    protected $db;

    function __construct($array=[]){
        
        if(!isset($array['type'])){$array['type'] = 'mysql';}
        if(!isset($array['host'])){$array['host'] = 'localhost';}
        if(!isset($array['dbname'])){$array['dbname'] = 'login';}
        if(!isset($array['user'])){$array['user'] = 'root';}
        if(!isset($array['pass'])){$array['pass'] = '1234';}
        
        try{
            $this -> db = new PDO(
                $array['type'].':'.
                    'host='.$array['host'].';'.
                    'dbname='.$array['dbname'].';',
                $array['user'],
                $array['pass'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );  

        }  catch (Exception $e){
            die($e -> getMessage());
        }

    }
    
    function GET($sql='', $fn=''){

        try{
            $sth = $this -> db -> prepare($sql);
            $sth -> execute();
             $res =  $sth -> fetchAll();

            if(!empty($fn)){
                    $i = 0;
                    foreach($res as $row){
                        $fn($row, $i, count($res));
                        $i++;
                    }
            }
            else{
                return $res;
            }
    
        }  catch (Exception $e){
            die($e -> getMessage());
        }

    }

    function MK($sql , $prep, $fn, $err){
        
        if((empty($fn)) AND (empty($err))){
            $this -> GET($sql, $prep);
        }
        
        else{
            try{
                if(!empty($prep)){
    
                    $sth = $this -> db -> prepare($sql);
                    foreach($prep as $item => $value){
                    
                        $sth -> bindValue(
                            $item,
                            $value,
                            PDO::PARAM_STR
                        );
                    }
                    
                    $sth -> execute();
                    $res =  $sth -> fetchAll();
                }
                else{
                    $res = $this -> db -> exec($sql);
                }
    
                if(!empty($fn)){
                    if(empty($res)){$err();}
                    $i = 0;
                    foreach($res as $row){
                        $fn($row, $i, count($res));
                        $i++;
                    }
                }
                else{
                    return $res;
                }
    
            }  catch (Exception $e){
                die($e -> getMessage());
            }
        }
    }
}

/*
# Exemplos de uso
## Connect, Select, Create, Insert, Update and Delete

$load = new database(array(
    "type" => "mysql",
    "host" => "localhost",
    "dbname" => "login",
    "user" => "root",
    "pass" => "1234"
));

$load -> get("SELECT * FROM userdata",function($res){
    print_r($res);
});

$load -> mk("CREATE TABLE IF NOT EXISTS gabrielvanderlei(
    ID INT(11) NOT NULL,
    TEXT VARCHAR(50) NOT NULL,
    IMAGE VARCHAR(50) NOT NULL,
    VIDEO VARCHAR(50) NOT NULL
    )");

$load -> mk("INSERT INTO userdata (username, password)
    VALUES ( :name , :pass )", array(
        ":name" => "Batata doce",
        ":pass" => "1234"
    ));

$load -> mk("UPDATE userdata
    SET username = 'Gralha'
    WHERE username = 'batatazul'");

$load -> mk("DELETE FROM userdata");

*/