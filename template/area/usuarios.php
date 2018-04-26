<?php 
    $model = new Model;
    $model -> consultarBanco("usuarios");
    $dados = $model -> verDados();
    $c = 0;
?>
<div class="display-4">Usuários<br />
<small>Gerencie os usuários da plataforma.</small></div>
<br />

<h2>Inativos<br />
<small>Usuários aguardando ativação.</small></h2>
<?php foreach($dados['usuarios'] as $users): ?>
<?php if($users['ativo'] != 1): ?>
        <?php if($c % 3 == 0):?>
            <div class="row">
        <?php endif; ?>
        <div class="col">
            <div class="ativo p-3">
                <div class="card" >
                  <div class="card-header">
                    <h5 class="card-title"><?=$users['nome'];?> <?=$users['sobrenome'];?></h5>
                    <p class="card-text"><?=$users['tipo'];?></p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?=$users['email'];?></li>
                  </ul>
                  <div class="card-body">
                      <a href="ativar/<?=$users['id'];?>" class="btn-primary btn">Ativar</a>
                  </div>
                </div>
            </div>
            </div>
        <?php if($c % 3 == 2):?>
            </div>
        <?php endif; ?>
    <?php $c++; endif;?>
<?php endforeach; ?>
<?php if($c % 3 != 0):?>
    </div>
<?php endif;?>
<?php if($c == 0):?>
<h4>Nenhum usuário inativo no momento.</h4>
<?php endif;$c=0;?>
<br />

<h2>Ativos<br />
<small>Usuários ativos</small></h2>
<?php foreach($dados['usuarios'] as $users): ?>
<?php if($users['ativo'] == 1): ?>
        <?php if($c % 3 == 0):?>
            <div class="row">
        <?php endif; ?>
        <div class="col">
            <div class="ativo p-3">
                <div class="card" >
                  <div class="card-header">
                    <h5 class="card-title"><?=$users['nome'];?> <?=$users['sobrenome'];?></h5>
                    <p class="card-text"><?=$users['tipo'];?></p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?=$users['email'];?></li>
                  </ul>
                  <?php if($this->controller->Config("evento")->{"principal"} != $users['email']):?>
                  <div class="card-body">
                    <a href="desativar/<?=$users['id'];?>" class="btn-primary btn">Desativar</a>
                  </div>
                  <?php else: ?>
                  <div class="card-body">
                    <b>Organizador Principal</b>
                  </div>
                  <?php endif; ?>
                </div>
            </div>
            </div>
        <?php if($c % 3 == 2):?>
            </div>
        <?php endif; ?>
    <?php $c++; endif;?>
<?php endforeach; ?>
<?php if($c % 3 != 0):?>
    </div>
<?php endif;?>
<?php if($c == 0):?>
<h4>Nenhum usuário ativo no momento.</h4>
<?php endif;$c=0;?><br />