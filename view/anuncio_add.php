<form action="<?= BASE_URL ?>anuncio/add" method="POST">

    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição" required></textarea>
    </div>

    <div class="form-group">
        <label for="preco">Preço</label>
        <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="Preço" required>
    </div>

    <?php
    if (is_adm_user()) {
    ?>
        <div class="form-group">
            <label for="pessoa">Anunciante</label>
            <select id="anunciante" name="anunciante" class="form-control selectpicker" data-live-search="true" required>
              <?php        
              foreach ($args as $anunciante) {
                    print '<option value="' . $anunciante->getCpf() . '" data-tokens="' . $anunciante->getNome() . '">' . $anunciante->getNome() . '</option>';
              }
              ?>		
                    </select>

        </div>
    <?php
    }
    ?>    

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
