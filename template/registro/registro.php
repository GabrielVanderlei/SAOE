<?php
    $model = new Model;
    $model -> consultarBanco("tipos");
    $dados = $model -> verDados();
?>
<div class="container p-5">
    <div class="display-4">
        Olá, <?=ucfirst($_SESSION['tipo']);?><br/>
        <small>Cadastre-se em nosso sistema.</small>
    </div><br />
    <?php if(($_SESSION['tipo'] == 'organizador')||($_SESSION['tipo'] == 'avaliador')):?>
    <div class="alert alert-primary">
        Fique atento que para se registrar nessa área você vai precisar da aprovação de algum organizador.
    </div>
    <?php endif; ?>
    <div class="alert alert-primary">
        Já possui um cadastro? <a href="./login">Logar-se</a>
    </div>
    <?php if(!empty($_SESSION['err'])): ?>
        <div class="alert alert-danger">
            <?=($_SESSION['err']);?>
        </div>
    <?php $_SESSION['err'] = '';endif; ?>
    <form action="registrar" method="post">
        <input type="hidden" name="tipo" value="<?=($_SESSION['tipo']);?>" />
        <br />
        <h1>Documentos de identificação<br />
        <small>Dados pessoais</small></h1>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" placeholder="Nome Completo" class="form-control" name="nome"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="telefone">Data de Nascimento</label>
                    <input type="date" id="nascimento" placeholder="Data de nascimento" class="form-control" name="nascimento"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="RG">RG</label>
                    <input type="number" id="RG" placeholder="RG" class="form-control" name="rg"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="CPF">CPF</label>
                    <input type="number" id="CPF" placeholder="CPF" class="form-control" name="cpf"/>
                </div>
            </div>
            <?php if($this->controller->User("tipo") == "avaliador"): ?>
            <div class="col">
                <div class="form-group">
                    <label for="lattes">Link do Lattes</label>
                    <input type="url" id="lattes" placeholder="Lattes" class="form-control" name="lattes"/>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if($_SESSION['tipo'] == 'avaliador'): ?>
        <br />
        <h1>Específico<br />
        <small>Coisas que apenas avaliadores devem responder...</small></h1>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="email">Área do conhecimento em que irei avaliar trabalhos</label>
                    <select class="form-control" id="area" name="area">
                        <?php foreach($dados['tipos'] as $key):?>
                        <option value="<?=$key['id'];?>"><?=$key['valor']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <br />
        <h1>Contato<br />
        <small>Formas de contato e acesso ao sistema.</small></h1>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" placeholder="E-mail" class="form-control" name="email"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="cemail">Confirmação do E-mail</label>
                    <input type="email" id="cemail" placeholder="Confirmação de E-mail" class="form-control" name="cemail"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" placeholder="Telefone" class="form-control" name="telefone"/>
                </div>
            </div>
        </div>
        <br />
        <h1>Senha<br/>
        <small>Sua senha para o sistema.</small></h1>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" placeholder="Senha" class="form-control" name="senha"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="csenha">Repita a senha</label>
                    <input type="password" id="csenha" placeholder="Repita a senha" class="form-control" name="csenha"/>
                </div>
            </div>
        </div>
        <br />
        <h1>Endereço<br />
        <small>Onde você reside</small></h1>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="number" data-form="cep" id="cep" placeholder="CEP" class="form-control" name="cep"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" placeholder="Estado" class="form-control" name="estado"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="bairro">Município</label>
                    <input type="text" id="municipio" placeholder="Município" class="form-control" name="municipio"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" placeholder="Bairro" class="form-control" name="bairro"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" placeholder="Rua" class="form-control" name="rua"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="rua">Número</label>
                    <input type="number" id="numero" placeholder="Nº" class="form-control" name="numero"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" id="complemento" placeholder="Complemento" class="form-control" name="complemento"/>
                </div>
            </div>
        </div>
        <br />
        <h1>Tudo certo?<br />
        <small>Então conclua seu registro</small></h1>
        <div class="alert alert-primary">
            Ao clicar em 'Se registrar' você concorda com nossos <a href="termos">Termos de uso</a>
        </div>
        <input type="submit" value="Se registrar" class="btn btn-lg btn-primary" />
    </form>
</div>