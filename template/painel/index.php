<?php if($this->controller->User("ativo") == '0'){ ?>
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
</div>