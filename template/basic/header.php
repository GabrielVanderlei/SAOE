<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mb-0 h1" href="<?=$this->controller->Config("saoe")->{"public"};?>">
        <?=$this->controller->Config("saoe")->{"name"};?></a>
    <?php if(isset($_SESSION['usuario'])){ ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link active" href="<?=$this->controller->Config("saoe")->{"public"}?>">
                    <span>
                        <?=$this->controller->User("nome");?>
                        <b>(<?=ucfirst($this->controller->User("tipo"));?>)</b>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=$this->controller->Config("saoe")->{"public"}?>/logout">Deslogar</a>
            </li>
        </ul>
    </div>
    <?php } ?>
</nav>