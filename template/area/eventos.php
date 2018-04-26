<div class="row">
<div class="col-md-8">
<div class="display-4"><?=$this->controller->Config("evento")->{"sigla"};?><br />
<small><?=$this->controller->Config("evento")->{"nome"};?></small></div><br />
<div class="lead"><?=$this->controller->Config("evento")->{"descricao"};?></div>
</div>
<div class="col-md-4 p-3">
    <h3>Dados adicionais</h3>
    <h5>Início</h5>
    <?php $diaHora = strtotime($this->controller->Config("evento")->{"inicio"}); ?>
    <p>Dia <?=date("d", $diaHora);?> de <?=$this->controller->Utils(date("m", $diaHora), 'mes');?> de <?=date('Y', $diaHora)?></p>
    <p>Às <?=date("h", $diaHora);?> horas e <?=date('m', $diaHora)?> minutos</p>
</div>
</div>