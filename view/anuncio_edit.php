  <form action="<?= BASE_URL ?>anuncio/edit" method="POST">
    <div class="form-group">
        <label for="id">Id</label>
        <input type="text" class="form-control" id="id" name="id" placeholder="Id" value="<?=$args['anuncio']->getId()?>" required>
    </div>

    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="<?=$args['anuncio']->getTitulo()?>" required>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição" 
             required><?= htmlentities($args['anuncio']->getDescricao());?></textarea>
    </div>

    <div class="form-group">
        <label for="preco">Preço</label>
        <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="Preço" 
            value="<?=$args['anuncio']->getPreco()?>" required>
    </div>

    <?php
    if (is_adm_user()) {
    ?>
      
        <div class="form-group">
            <label for="pessoa">Anunciante</label>
            <select id="anunciante" name="anunciante" class="form-control selectpicker" data-live-search="true" required>
              <?php        
              foreach ($args['pessoas'] as $pessoa) {
                ?>
                <option 
                    value="<?= $pessoa->getCpf() ?>" 
                    data-tokens="<?= $pessoa->getNome()?>"
                    <?php 
                       if ($args['anuncio']->getAnunciante()->getCpf() == $pessoa->getCpf()) { 
                            print ' selected ';
                        }    
                         ?>
                    >
                        <?= $pessoa->getNome() ?>                        
                </option>
                <?php
              }
              ?>        

            </select>

        </div>
    <?php
    }
    ?>    
    <button type="submit" class="btn btn-primary">Enviar</button>

</form> 