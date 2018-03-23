<?php
    #Load all MVC classes
    
    spl_autoload_register(function ($class_name) 
    {
        $class_name = $class_name;
        
        #Directories
        $directorys = array(
            $_SERVER['DOCUMENT_ROOT'].'/controller/',
            $_SERVER['DOCUMENT_ROOT'].'/view/',
            $_SERVER['DOCUMENT_ROOT'].'/model/'
        );
        
        foreach($directorys as $directory)
        {
            if(file_exists($directory.$class_name.'.php'))
            {
                include $directory.$class_name.'.php';
                return;
            }            
        }
    });