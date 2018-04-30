<?php
    $model = new Model;
    $model -> consultarBanco("tipos");
    $model -> consultarBanco("temas");
    $dados = $model -> verDados();
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Envie seu trabalho<br />
            <small>É simples e rápido.</small></h1>
        </div>
    </div>
    
    <div class="row p-2">
        <div class="col-md-6">
            <form enctype="multipart/form-data" action="../alterar/trabalhos" method="post">
                <h2>Sobre
                <small>Informações referentes ao trabalho</small></h2>
                <input type="hidden" name="MAX_FILE_SIZE" value="31457280" />
                <div class="form-group">
                    <input class="form-control form-control-lg" id="titulo" type="text" placeholder="Título" name="titulo"/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="descricao" type="text" placeholder="Breve descrição do artigo." name="descricao"/>
                </div>
                <div class="form-group">
                    <label for="descricao">Área de concentração</label>
                    <select class="form-control" id="area" name="area">
                        <?php foreach($dados['tipos'] as $key):?>
                        <option value="<?=$key['id'];?>"><?=$key['valor']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descricao">Eixo temático</label>
                    <select class="form-control" id="tema" name="area">
                        <?php foreach($dados['temas'] as $key):?>
                        <option class="<?=$key['area'];?>" value="<?=$key['id'];?>"><?=$key['valor']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <h2>Documentos do trabalho
                <small>Os arquivos referentes ao artigo</small></h2>
                <div class="form-group">
                    <label for="arquivo">PDF sem sua identificação</label>
                    <input class="form-control" id="arquivoPDF" type="file" name="arquivoPDF"/>
                </div>
                
                <div class="form-group">
                    <label for="arquivo">Word contendo sua identificação</label>
                    <input class="form-control" id="arquivoWORD" type="file" name="arquivoWORD"/>
                </div>

                <h2>Autores
                <small>Sobre os autores envolvidos</small></h2>
                <input type="submit" class="btn btn-primary" value="Enviar documento" />
            </form>
        </div>
    </div>
</div>