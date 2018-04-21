<!DOCTYPE html>
<html>
    <head>
        <!--Configuração básica-->
        <meta charset='utf-8' />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?php if(!empty($data['title'])){ ?>
        <title><?=$data['title'];?></title>
        <?php } ?>
        
        <?php if(!empty($data['link'])){ ?>
        <!--Estilos-->
        <?php foreach($data['link'] as $key){ ?>
        <link rel='<?=$key[0];?>' 
              href='<?=$this->controller->Config("saoe")->{"public"};?><?=$key[1];?>?v=<?=$data['version']?>'/>
        <?php } ?>
        <?php } ?>
        
        <?php if(!empty($data['script'])){ ?>
        <!--Scripts-->
        <?php foreach($data['script'] as $key){ ?>
        <script type='<?=$key[0];?>' 
                src='<?=$this->controller->Config("saoe")->{"public"};?><?=$key[1];?>?v=<?=$data['version'];?>'></script>
        <?php } ?>
        <?php } ?>
        
        <?php if(!empty($data['meta'])){ ?>
        <!--Metas-->
        <?php foreach($data['meta'] as $key){ ?>
        <meta name='<?=$key[0];?>' 
              content='<?=$key[1];?>?v=<?=$data['version'];?>'/>
        <?php } ?>
        <?php } ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
       <?php include 'header.php';?>