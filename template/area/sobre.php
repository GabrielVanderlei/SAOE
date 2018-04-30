<div class="container p-4">
    <div class="display-4">Dados<br/>
    <small>Altere seu perfil</small></div><br />
    <?php if(!empty($_SESSION['err'])): ?>
        <div class="alert alert-danger">
            <?=($_SESSION['err']);?>
        </div>
    <?php $_SESSION['err'] = '';endif; ?>
    <form action="../alterar/sobre" method="post">
        <input type="hidden" name="emailo" value="<?=$this->controller->User('email');?>" />
        <h2 class="mt-3">Dados do usuário</h2>
        <div class="row">
            <div class="col">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?=$this->controller->User("nome");?>"/>
            </div>
                </div>
            <div class="col">
                <div class="form-group">
                    <label for="nascimento">Nascimento</label>
                    <input type="date" name="nascimento" id="nascimento" class="form-control"  value="<?=$this->controller->User("nascimento");?>"/>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <h2>Permissões<br />
                    <small>Você está cadastrado atualmente como <?=$this->controller->User('tipo');?></small></h2>
            </div>
        </div>
        <h2 class="mt-3">Contato</h2>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" class="form-control"  value="<?=$this->controller->User("telefone");?>" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="telefone">Lattes</label>
                    <input type="tel" name="lattes" id="lattes" class="form-control"  value="<?=$this->controller->User("lattes");?>" />
                </div>
            </div>
        </div>
        <h3 class="mt-3">Endereço</h3>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-control" value="<?=$this->controller->User("cep");?>" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control"  value="<?=$this->controller->User("estado");?>" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="estado">Município</label>
                    <input type="text" name="municipio" id="municipio" class="form-control"  value="<?=$this->controller->User("municipio");?>" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="form-control"  value="<?=$this->controller->User("bairro");?>"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control"  value="<?=$this->controller->User("rua");?>"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="rua">Numero</label>
                    <input type="text" name="numero" id="numero" class="form-control"  value="<?=$this->controller->User("numero");?>"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" id="complemento" class="form-control"  value="<?=$this->controller->User("complemento");?>"/>
                </div>
            </div>
        </div>
        <h3 class="mt-3">Documentos</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rg">RG</label>
                    <input type="text" name="rg" id="rg" class="form-control" value="<?=$this->controller->User("rg");?>" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">    
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control"  value="<?=$this->controller->User("cpf");?>" />
                 </div>
            </div>
        </div>
        <h3 class="mt-3">Senha & E-mail</h3>
        <div class="alert alert-danger">
            Qualquer dado alterado nessa área exige a confirmação da senha.
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">    
                    <label for="novasenha">Senha atual</label>
                    <input type="text" name="senhaa" id="senha" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">    
                    <label for="novoemail">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?=$this->controller->User('email')?>" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">    
                    <label for="novoemail">Repita o Email</label>
                    <input type="email" name="cemail" id="cemail" class="form-control" value="<?=$this->controller->User('email')?>" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">    
                    <label for="novasenha">Senha Nova</label>
                    <input type="text" name="senha" id="senha" class="form-control"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">   
                    <label for="novasenha">Repita a nova senha</label>
                    <input type="text" name="csenha" id="csenha" class="form-control"/>
                </div>
            </div>
        </div>
            </div>
                <input type="submit" class="btn btn-primary" value="Enviar documento" />
                <input type="reset" class="btn btn-secundary" value="Cancelar" />
        </form>
    </div>
</div>