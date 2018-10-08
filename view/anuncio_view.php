<?php

$anuncio = $args['anuncio'];
?>

<div class="clearfix content-heading">
    <h3><?=$anuncio->getTitulo();?></h3>

    <?php
    $img = $anuncio->getMainfile();
    if ($img == "") {
            $img = NO_IMAGE_FILE;
    }
    ?>
    <img class="img-responsive img-rounded pull-left" width="250px" src="<?= BASE_URL . 'utils/image.php?img=' . $img; ?> " style="margin-right: 10px" />
    
    <div>
        <h3>R$ <?=$anuncio->getPreco();?></h3>
        <p><?=$anuncio->getAnunciante()->getNome();?></p>
        <p>
            <a 
                    href="<?= BASE_URL ?>anuncio/feed/?cidade=<?= $anuncio->getAnunciante()->getCidade()->getId(); ?>">
                    <?= $anuncio->getAnunciante()->getCidade()->getNome();?>-<?=$anuncio->getAnunciante()->getCidade()->getEstado()->getSigla();?>

            </a>
        </p>
        <p><?=$anuncio->getUltimaAlteracao();?></p>
    </div>
    
    
</div>
<div class="clearfix content-heading">
    <p>Informações Adicionais:</p>
    <p>
        <?=$anuncio->getDescricao();?>
    </p>
</div>    
<?php
?>