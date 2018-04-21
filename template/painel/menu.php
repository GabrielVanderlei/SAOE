<?php
    function act($type){
        if($_SESSION['area'] == $type) return 'active';
    }
?>

<div class="list-group list-group-flush">
    <a class="list-group-item list-group-item-action <?=act('geral');?>" href="geral" class="opt">Visão Geral</a></li>
    <a class="list-group-item list-group-item-action <?=act('sobre');?>" href="sobre" class="opt">Sobre Mim</a></li>
    <?php if($this->controller->User("tipo") == 'palestrante'){ ?>
    <a class="list-group-item list-group-item-action <?=act('obra');?>" href="obra" class="opt">Meus Trabalhos</a></li>
    <?php } ?>
    <?php if($this->controller->User("tipo") == 'avaliador'){ ?>
    <a class="list-group-item list-group-item-action <?=act('pendentes');?>" href="pendentes" class="opt">Trabalhos pendentes</a></li>
    <a class="list-group-item list-group-item-action <?=act('analise');?>" href="analise" class="opt">Trabalhos em análise</a></li>
    <?php } ?>
    <?php if($this->controller->User("tipo") == 'organizador'){ ?>
    <a class="list-group-item list-group-item-action <?=act('obra');?>" href="obra" class="opt">Meus Trabalhos</a></li>
    <a class="list-group-item list-group-item-action <?=act('pendentes');?>" href="pendentes" class="opt">Trabalhos pendentes</a></li>
    <a class="list-group-item list-group-item-action <?=act('analise');?>" href="analise" class="opt">Trabalhos em análise</a></li>
    <a class="list-group-item list-group-item-action <?=act('eventos');?>" href="eventos" class="opt">Eventos</a></li>
    <a class="list-group-item list-group-item-action <?=act('cadastros');?>" href="cadastros" class="opt">Cadastros</a></li>
    <?php } ?>
</div>