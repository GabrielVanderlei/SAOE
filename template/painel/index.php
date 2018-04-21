<?php if($this->controller->User("ativo") == '0'){ ?>
<div class="jumbotron bg-light">
    <h1>Oi, tudo bem?<br />
    <small>Você está cadastrado na categoria <?=$this->controller->User("tipo");?></small></h1>
    <h2>Nessa categoria, você só pode utilizar o sistema após a aprovação de algum organizador.<br />
    <small>Mas não se preocupe que quando sua inscrição for efetivada um e-mail será enviado para sua caixa de entrada.</small></h2>
</div>
<?php exit();} ?>
<div class="container-fluid">
    <div class="row">
        <div class="col p-3">
            <?php 
             // Menu
             include "menu.php";
            ?>
        </div>

        <div class="col-9 p-3">
            <?php 
             // Área requisitada
             if(file_exists(realpath(__DIR__ . '/..')."/area/".($_SESSION['area']).".php")){
                 include(realpath(__DIR__ . '/..')."/area/".($_SESSION['area']).".php");
             }
             else{
            ?>
            <h1 class="display-4">404</h1>
            <p class="lead">Aparentemente essa página não existe...</p>

            <?php
             }
            ?>
        </div>
    </div>
</div>