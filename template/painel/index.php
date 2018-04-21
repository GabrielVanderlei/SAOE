<?php if($this->controller->User("ativo") == '0'){ ?>
<<<<<<< HEAD
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
=======
<div class="error">
    <div class="title">Oi, tudo bem?</div>
    <div class="sub">Você está cadastrado na categoria <?=$this->controller->User("tipo");?></div>
    <div class="desc">Nessa categoria, você só pode utilizar o sistema após a aprovação de algum organizador.</div>
    <div class="obs">Mas não se preocupe que quando sua inscrição for efetivada um e-mail será enviado para sua caixa de entrada.</div>
</div>
<?php exit();} ?>
<div class="header">
    <div class="logo">SOAE</div>
    <div class="user">
        <span class="nome"><?=$this->controller->User("nome");?></span>
        <span class="selector">-</span>
        <span class="tipo"><?=$this->controller->User("tipo");?></span>
    </div>
    <div class="options">
        <a class="opt" href="../logout">Deslogar</a>
    </div>
</div>
<div class="menu">
    <div class="opt">Sobre Mim</div>
    <?php if($this->controller->User("tipo") == 'palestrante'){ ?>
    <div class="opt">Meus Trabalhos</div>
    <?php } ?>
    <?php if($this->controller->User("tipo") == 'avaliador'){ ?>
    <div class="opt">Trabalhos</div>
    <?php } ?>
    <?php if($this->controller->User("tipo") == 'organizador'){ ?>
    <div class="opt">Trabalhos</div>
    <div class="opt">Evento</div>
    <?php } ?>
>>>>>>> c82b1ff3be6cb1ebe698464ffd7d5437fc227e6b
</div>