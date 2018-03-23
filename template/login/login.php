<div class="hdeck">
    <div class="title">Olá, <?=ucfirst($_SESSION['tipo']);?>.</div>
    <div class="description">Insira seus dados de login.</div>
    <div class="option">
        Não possui um cadastro? <a href="./registro">Registrar-se</a>
    </div>
    <div class="erro">
        <?=$_SESSION['error'];$_SESSION['error'] = '';?>
    </div>
    <form action="logar" method="post">
        <input type="hidden" value="<?=$this -> controller -> CSR();?>" name="CSR" />
        <input type="text" placeholder="Email" class="emailInput" name="email"/>
        <input type="password" placeholder="Senha" class="passInput" name="senha"/>
        <input type="submit" value="Enviar" class="sendButton" />
    </form>
</div>