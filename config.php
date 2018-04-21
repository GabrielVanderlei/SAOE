<?php
    #Load all MVC classes
    
    spl_autoload_register(function ($class_name) 
    {
        $class_name = $class_name;
        
        #Directories
        $directorys = array(
            (__DIR__).'/controller/',
            (__DIR__).'/view/',
            (__DIR__).'/model/'
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