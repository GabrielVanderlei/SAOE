<div class="container p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="display-4">Olá, <?=ucfirst($_SESSION['tipo']);?>.<br />
            <small>Insira seus dados de login.</small></div>
        </div>
    </div><br />
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-primary">
                Não possui um cadastro? <a href="./registro">Registrar-se</a>
            </div>
            <?php if(!empty($_SESSION['err'])): ?>
                <div class="alert alert-danger">
                    <?=$_SESSION['err'];?>
                </div>
            <?php $_SESSION['err'] = '';endif; ?>
            <form action="logar" method="post">
                <input type="hidden" value="<?=$this -> controller -> CSR();?>" name="CSR" />
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" id="email" type="email" placeholder="Seu e-mail." name="email"/>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input class="form-control" id="senha" type="password" placeholder="Sua senha" name="senha"/>
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar" />
            </form>
        </div>
</div>