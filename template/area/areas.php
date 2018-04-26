<?php 
    $model = new Model;
    $model -> consultarBanco("tipos");
    $dados = $model -> verDados();
    $c = 0;
?>
<div class="display-4">
    Áreas<br />
    <small>Categorias em que os artigos podem ser avaliados.</small>
</div>

    <div class="p-4">
        <p class="h3">Categorias existentes</p>
        <?php foreach($dados['tipos'] as $tipos):?>
            <div class="card d-inline-block m-3 w-25">
                <div class="card-header">#<?=$tipos['id']?></div>
                <form method="post" class="p-3" action="tipo/alterar">
                    <input name="nvalor" type="text" class="form-control" value="<?=$tipos['valor']?>" />
                    <input name="id" type="hidden" value="<?=$tipos['id'];?>" />
                    <input name="valor" type="hidden" value="<?=$tipos['valor'];?>" />
                    <select name="act" class="form-control mt-3">
                        <option value="0">Alterar</option>
                        <option value="1">Excluir</option>
                    </select>
                    <input type="submit" class="btn btn-primary mt-3 w-100" value="Enviar"/>
                </form>
            </div>
          <?php endforeach;?>
        <h3>Criar categoria</h3>
        <div class="card p-3 m-3">
                <form method="post" action="tipo/alterar">
                    <input name="nvalor" type="text" class="form-control" placeholder="Valor" />
                    <input type="hidden" value="2" name="act" />
                    <input type="submit" class="btn btn-primary mt-3 w-100" value="Criar"/>
                    <input name="id" type="hidden" value="0" />
                    <input name="valor" type="hidden" value="0" />
                </form>
            </div>
</div>
