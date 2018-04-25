<?php 
    $model = new Model;
    $model -> consultarBanco("trabalhos", " WHERE area='".$this->controller->User("area")."' AND avaliado = '1' AND avaliadorid='".$this->controller->User("id")."'");
    $dados = $model -> verDados();
    $c = 0;
?>
<div class="display-4">Confirmados<br />
<small>Trabalhos que você confirmou.</small></div>
<br />
<?php if(empty($dados['trabalhos'])):?>
    <div class="jumbotron bg-light">
    <h1>Nenhum trabalho confirmado no momento.<br />
        <small>Envie mais artigos para ve-los aqui.</small><br/></h1>
    </div>
<?php else: foreach($dados['trabalhos'] as $key):?>
    <?php if($key['avaliado'] == 1):?>
        <?php if($c % 3 == 0):?>
            <div class="row">
        <?php endif; ?>
        <div class="col">
            <div class="card bg-light mb-3">
                <div class="card-header">Nota <?=$key['nota'];?></div>
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