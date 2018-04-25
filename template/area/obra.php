<?php
    #p/ envio de artigos
    $model = new Model;
    $model -> consultarBanco("trabalhos", " WHERE autorid='".$this->controller->User("id")."' ");
    $dados = $model->verDados();
    $c = 0;

    if(empty($dados['trabalhos'])) $dados['trabalhos'] = [];
?>
<div class="jumbotron bg-light">
    <h1>Você possui <?=count($dados['trabalhos'])?> trabalho(s)<br />
        <small>Seus trabalhos serão analisados por um avaliador, fique atento!</small><br/></h1>
    <a href="../enviar/trabalho" class="btn btn-primary">Quero enviar um trabalho.</a>
</div>
<h2>Meus trabalhos pendentes.<br />
    <small>Acompanhe seus trabalhos pendentes.</small></h2><br />

<?php foreach($dados['trabalhos'] as $key):?>
    <?php if($key['nota'] < $this->controller->Config("saoe")->{"min_nota"}):?>
        <?php if($c % 3 == 0):?>
            <div class="row">
        <?php endif; ?>
        <div class="col">
            <div class="card bg-light mb-3">
                <div class="card-header"><?=(($key['nota'] == NULL)?"Seu artigo ainda não foi avaliado":"Nota insuficiente.");?></div>
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
<?php if($c == 0):?>
    <div class="jumbotron bg-light">
    <h1>Nenhum trabalho pendente no momento.<br />
        <small>Envie mais artigos para ve-los aqui.</small><br/></h1>
    </div>
<?php endif; ?>
<?php if($c % 3 != 0):?>
    </div>
<?php endif; $c = 0;?><br />
<h2>Meus trabalhos confirmados.<br />
    <small>Acompanhe seus trabalhos enviados.</small></h2>
<?php foreach($dados['trabalhos'] as $key):?>
    <?php if($key['nota'] >= $this->controller->Config("saoe")->{"min_nota"}):?>
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
<?php if($c == 0):?>
    <div class="jumbotron bg-light">
    <h1>Nenhum trabalho pendente no momento.<br />
        <small>Envie mais artigos para ve-los aqui.</small><br/></h1>
    </div>
<?php endif; ?>
<?php if($c % 3 != 0):?>
    </div>
<?php endif; $c = 0;?><br />
<br/><br/>