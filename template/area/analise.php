<?php 
    $model = new Model;
    if($this->controller->User("tipo") != "organizador"):
        $model -> consultarBanco("trabalhos", " WHERE area='".$this->controller->User("area")."' AND avaliado = '1' AND autorid ^= '".$this->controller->User("id")."' ");
    else:
        $model -> consultarBanco("trabalhos", " WHERE avaliado = 1 ");
    endif;
    $dados = $model -> verDados();
    $c = 0;
?>
<div class="display-4">Confirmados<br />
<small>Trabalhos aprovados para o evento.</small></div>
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
                <div class="card-header">Enviado por <?=$key['autor'];?></div>
                <div class="card-body">
                <h5 class="card-title"><?=$key['titulo']?></h5>
                <p class="card-text"><?=$key['descricao']?></p>
                </div>       
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Avaliado por <?=$key['avaliador']?></li>
                    <li class="list-group-item">Data da avaliação: <?=date('d/m/Y h:i:s',$key['enviadoem'])?></li>
                    <li class="list-group-item">Nota: <?=$key['nota']?></li>
                      <li class="list-group-item">Comentário: <?=$key['comentarios']?></li>
                  </ul>
                <div class="card-body">
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