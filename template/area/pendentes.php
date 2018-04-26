<?php 
    $model = new Model;
    if($this->controller->User("tipo") != "organizador"):
        $model -> consultarBanco("trabalhos", " WHERE area='".$this->controller->User("area")."' AND avaliado ^= '1' AND autorid ^= '".$this->controller->User("id")."' ");
        $model -> consultarBanco("tipos", " WHERE id='".$this->controller->User("area")."' ");
    else:
        $model -> consultarBanco("trabalhos", " WHERE avaliado ^= 1 ");
    endif;
    $dados = $model -> verDados();
    $c = 0;
?>
<div class="display-4">Pendentes<br />
<small>Trabalhos que estão aguardando aprovação.</small>
<?php if($this->controller->User("tipo") == "avaliador"): ?>
<h3 class="p-2">(Na área de <?=$dados['tipos'][0]['valor']?>)</h3>
<?php endif; ?>
</div>
<br />
<?php if(empty($dados['trabalhos'])):?>
    <div class="jumbotron bg-light">
    <h1>Nenhum trabalho pendente no momento.<br />
        <small>Envie mais artigos para ve-los aqui.</small><br/></h1>
    </div>
<?php else: foreach($dados['trabalhos'] as $key):?>
    <?php if($key['avaliado'] == 0):?>
        <?php if($c % 3 == 0):?>
            <div class="row">
        <?php endif; ?>
        <div class="col">
            <div class="card bg-light mb-3">
                <div class="card-header"><?=(($key['nota'] == NULL)?"Avalie este artigo":"Nota insuficiente.");?></div>
                <div class="card-body">
                <h5 class="card-title"><?=$key['titulo']?></h5>
                <p class="card-text"><?=$key['descricao']?></p>
                <a href="../sobre/<?=$key['id'];?>" class="btn btn-primary">Ver detalhes</a>
                </div>
            </div>
        </div>
        <?php if($c % 3 == 2):?>
            </div>
        <?php endif; ?>
    <?php $c++; endif;?>
<?php endforeach;?>
<?php if($c % 3 != 0):?>
    </div>
<?php endif; $c = 0;?><br />
<?php endif; ?>