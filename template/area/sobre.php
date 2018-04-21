<div class="container p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="display-4">Altere seu Perfil</div>
        </div>
    </div>

    <form action="../alterar/sobre" method="post" class="col-md-11">
        <h2 class="mt-5">Imagem de Perfil</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="perfil">Alterar Imagem</label>
                    <input type="file" name="perfil" id="perfil" class="form-control"  />
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?=$this->controller->User("img");?>" width="250" height="250" class="bg-light" alt="perfil" />
            </div>
        </div>
        <h2 class="mt-3">Dados do usuário</h2>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?=$this->controller->User("nome");?>"/>
            </div>
                </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="<?=$this->controller->User("sobrenome");?>" />
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" class="form-control"  value="<?=$this->controller->User("telefone");?>" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nascimento">Nascimento</label>
                    <input type="date" name="nascimento" id="nascimento" class="form-control"  value="<?=$this->controller->User("nascimento");?>"/>
                </div>
            </div>
        </div>
        <h3 class="mt-3">Endereço</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-control" value="<?=$this->controller->User("cep");?>" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control"  value="<?=$this->controller->User("estado");?>" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="form-control"  value="<?=$this->controller->User("bairro");?>"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control"  value="<?=$this->controller->User("rua");?>"/>
                </div>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="senha">Senha atual</label>
                    <input type="text" name="senha" id="senha" class="form-control" />
                </div>
                </div>
            <div class="col-md-4">
                <div class="form-group">    
                    <label for="novoemail">Novo Email</label>
                    <input type="email" name="novoemail" id="novoemail" class="form-control" value="" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">    
                    <label for="novasenha">Nova senha</label>
                    <input type="text" name="novasenha" id="novasenha" class="form-control"  />
                </div>
            </div>
            </div>
                <input type="submit" class="btn btn-primary" value="Enviar documento" />
                <input type="reset" class="btn btn-secundary" value="Cancelar" />
        </form>
    </div>
</div>