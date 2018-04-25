<?php
    $model = new Model;
    $model -> consultarBanco("trabalhos", " WHERE id='".$_SESSION['envio_id']."'");
    $dados = $model -> verDados();
    
    if(empty($dados['trabalhos'])):
         include(realpath(__DIR__ . '/..')."/errorHandler/404.php");
    else:
        $key = $dados['trabalhos'][0];
        $model -> consultarBanco("usuarios", " WHERE id='".$key['autorid']."' ");
        $model -> consultarBanco("tipos", " WHERE id='".$key['area']."' ");
        $dados = $model->verDados();

        $autor = $dados['usuarios'][0];
        $categorias = $dados['tipos'][0]['valor'];
    ?>
<?php if(($key['autorid'] == $this->controller->User('id')) && ($key['avaliado'] == 1)):?>
<?php if($key['nota'] < $this->controller->Config("saoe")->{"min_nota"}):?>
<div class="jumbotron bg-light">
    <h3>Aaah, seu artigo não foi aprovado pelos avaliadores.<br />
    <small>Infelizmente você deverá enviar novamente o artigo com as melhorias sugeridas.</small></h3>
</div>
<?php else:?>
<div class="jumbotron bg-light">
    <h3>Parabéns!<br />
    <small>Seu artigo foi selecionado para o evento. Em breve enviaremos um e-mail para informa-lo sobre o dia e horário de sua apresentação.</small></h3>
</div>
<?php endif;?>
<?php endif;?>
<?php if(($key['avaliadorid'] == $this->controller->User("id"))):?>
<div class="jumbotron bg-light">
    <h3>Você avaliou esse artigo.<br />
    <small>A nota que você atribuiu a esse trabalho foi <b><?=$key['nota'];?></b>.<br/><i>- "<?=$key['comentarios']?>"</i></small></h3>
</div>
<?php endif;?>

        <br />
        <div class="container">
            <div class="display-4">Sobre o artigo<br />
            <small>Confira todos os dados do trabalho em questão.</small></div>
            <br />

            <div class="row">
                <div class="h1"><small>Título</small><br />
                <?=$key['titulo']?></div>
            </div>
            <br />

            <div class="row">
                <div class="h3"><small>Descrição</small><br />
                <?=$key['descricao']?></div>
            </div>
            <br />

            <div class="row">
                <a target="_blank" href="<?=$this->controller->Config("saoe")->{"public"}?><?=$this->controller->Config("saoe")->{"upload_dir"}?>/<?=$key['autorid']?>-<?=$key['arquivo']?>.pdf" class="btn btn-primary">Acessar artigo</a>
            </div>
            <br />

            <div class="row bg-light p-3">
                <div class="col">
                    <div class="h3"><small>Autor</small><br />
                    <?=$autor['nome']." ".$autor['sobrenome'];?></div>
                </div>
                <div class="col">
                    <div class="h3"><small>Enviado em</small><br />
                    <?=date('d/m/Y h:i:s',$key['enviadoem']);?></div>
                </div>
                <div class="col">
                    <div class="h3"><small>Área</small><br />
                    <?=$categorias;?></div>
                </div>
            </div>
            <br />

            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="mensagens-tab" data-toggle="tab" href="#mensagens" role="tab" aria-controls="mensagens" aria-selected="true">Mensagens</a>
                  </li>
                    <?php if(($this->controller->User("tipo") == 'avaliador')||($this->controller->User("tipo") == 'organizador')): ?>
                  <li class="nav-item">
                    <a class="nav-link" id="avaliar-tab" data-toggle="tab" href="#avaliar" role="tab" aria-controls="avaliar" aria-selected="true">Avaliar Artigo</a>
                  </li>
                    <?php endif;?>
                </ul>
              </div>
              <div class="tab-content p-3" id="content">
                  <div class="tab-pane fade show active" id="mensagens" role="tabpanel" aria-labelledby="mensagens-tab">
                      Função indisponível no momento.
                  </div>
                  <?php if(($this->controller->User("tipo") == 'avaliador')||($this->controller->User("tipo") == 'organizador')): ?>
                  <div class="tab-pane fade show" id="avaliar" role="tabpanel" aria-labelledby="avaliar-tab">
                    <form enctype="multipart/form-data" action="../alterar/avaliar" method="post">
                <input type="hidden" name="id" value="<?=$_SESSION['envio_id']?>"/>
                        <div class="form-group">
                    <label for="descricao">Nota do artigo</label>
                    <input class="form-control form-control-lg" id="nota" type="number" placeholder="Nota" name="nota"/>
                </div>
                <div class="form-group">
                    <label for="descricao">Por que essa nota?</label>
                    <input class="form-control" id="descricao" type="text" placeholder="Breve descrição do artigo." name="descricao"/>
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar avaliação" />
            </form>       
                  </div>
                  <?php endif;?>
             </div>
            </div>
            <br />
        </div>
    <?php
    endif;
    ?>