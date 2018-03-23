<div class="hdeck">
    <div class="title">Olá, <?=ucfirst($_SESSION['tipo']);?>.</div>
    <div class="description">Cadastre-se em nosso sistema.</div>
    <div class="option">
        Já possui um cadastro? <a href="./login">Logar-se</a>
    </div>
    <form action="registrar" method="post">
        <input type="hidden" value="<?=$_SESSION['type'];?>" />
        <label>
            <input type="file" class="imageInput" name="imagem"/>
            Imagem de perfil
        </label>
        <input type="text" placeholder="Email" class="emailInput" name="email"/>
        <input type="date" placeholder="Data de nascimento" class="dateInput" name="nascimento"/>
        <input type="number" placeholder="RG" class="rgInput" name="numrg"/>
        <input type="text" placeholder="CPF" class="cpfInput" name="numcpf">
        <input type="number" placeholder="CEP" class="cepInput" name="cep"/>
        <input type="text" placeholder="Logradouro" class="logradouroInput" name="logradouro" />
        <input type="text" placeholder="Complemento" class="bairroInput" name="complemento" />
        <input type="text" placeholder="Bairro" class="bairroInput" name="bairro" />
        <input type="text" placeholder="Estado" class="estadoInput" name="estado" />
        <input type="password" placeholder="Senha" class="passInput" name="senha"/>
        <label> 
            <input type="checkbox" class="checkInput" />
            Li e aceito os termos de uso.
        </label>
        <input type="submit" value="Enviar" class="sendButton" />
    </form>
</div>