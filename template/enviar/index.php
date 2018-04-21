<?php if($this->controller->User("ativo") == '0'){ ?>
<div class="error">
    <div class="title">Oi, tudo bem?</div>
    <div class="sub">Você está cadastrado na categoria <?=$this->controller->User("tipo");?></div>
    <div class="desc">Nessa categoria, você só pode utilizar o sistema após a aprovação de algum organizador.</div>
    <div class="obs">Mas não se preocupe que quando sua inscrição for efetivada um e-mail será enviado para sua caixa de entrada.</div>
</div>
<?php exit();} ?>
<div class="enviar">
    <?php 
     // Área requisitada
     if(file_exists(realpath(__DIR__ . '/..')."/envios/".($_SESSION['enviar']).".php")){
         include(realpath(__DIR__ . '/..')."/envios/".($_SESSION['enviar']).".php");
     }
     else{
    ?>
    <div class="error">
        <div class="title">404</div>
        <div class="sub">Essa área não existe...</div>
    </div>
    <?php
     }
    ?>
</div>