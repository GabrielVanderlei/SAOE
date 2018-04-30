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
    </head>
    <body>
       <?php include 'header.php';?>