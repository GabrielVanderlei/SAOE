<?php
    function act($type){
        if($_SESSION['area'] == $type) return 'active';
    }
?>

<div class="list-group list-group-flush">
    <a class="list-group-item list-group-item-action <?=act('geral');?>" href="geral" class="opt">Visão Geral</a></li>
    <a class="list-group-item list-group-item-action <?=act('sobre');?>" href="sobre" class="opt">Sobre Mim</a></li>
    <a class="list-group-item list-group-item-action <?=act('obra');?>" href="obra" class="opt">Meus Trabalhos</a></li>
    <?php if(($this->controller->User("tipo") == 'avaliador') || ($this->controller->User("tipo") == 'organizador')){ ?>
    <a class="list-group-item list-group-item-action <?=act('pendentes');?>" href="pendentes" class="opt">Trabalhos pendentes</a></li>
    <a class="list-group-item list-group-item-action <?=act('analise');?>" href="analise" class="opt">Trabalhos avaliados</a></li>
    <?php } ?>
    <?php if($this->controller->User("tipo") == 'organizador'){ ?>
    <a class="list-group-item list-group-item-action <?=act('eventos');?>" href="eventos" class="opt">Sobre o evento</a></li>
    <a class="list-group-item list-group-item-action <?=act('usuarios');?>" href="usuarios" class="opt">Usuários cadastrados</a></li>
    <a class="list-group-item list-group-item-action <?=act('areas');?>" href="areas" class="opt">Áreas avaliadas</a></li>
    <?php } ?>
</div>