<?php
    $model = new Model;
    $model -> consultarBanco("tipos");
    $dados = $model -> verDados();
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Envie sua obra<br />
            <small>É simples e rápido.</small></h1>
        </div>
    </div>
    
    <div class="row p-2">
        <div class="col-md-6">
            <form enctype="multipart/form-data" action="../alterar/trabalhos" method="post">
                <div class="form-group">
                    <input class="form-control form-control-lg" id="titulo" type="text" placeholder="Título" name="titulo"/>
                </div>
                <div class="form-group">
                    <label for="descricao">Sobre seu artigo</label>
                    <input class="form-control" id="descricao" type="text" placeholder="Breve descrição do artigo." name="descricao"/>
                </div>
                <div class="form-group">
                    <label for="descricao">Área de atuação</label>
                    <select class="form-control" id="area" name="area">
                        <?php foreach($dados['tipos'] as $key):?>
                        <option value="<?=$key['id'];?>"><?=$key['valor']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="arquivo">O Arquivo</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="31457280" />
                    <input class="form-control" id="arquivo" type="file" name="arquivo"/>
                </div>

                <input type="submit" class="btn btn-primary" value="Enviar documento" />
            </form>
        </div>
    </div>
</div>