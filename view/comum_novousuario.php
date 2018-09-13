<form action="<?= BASE_URL ?>comum/novousuario" method="POST">

    <div class="form-group">
        <label for="cpf">Cpf</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Cpf" maxlength="11" required>
    </div>


    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>

    <div class="form-group">
        <label for="cidade">Estado</label>
        <select onchange="edit_estado('<?= BASE_URL; ?>')" id="estado" name="estado" class="form-control selectpicker" data-live-search="true" required>
          <option 
            value="" 
            >
            ---
          </option>

          <?php        
          foreach ($args['estados'] as $estado) {
            ?>
            <option 
                value="<?= $estado->getId() ?>" 
                data-tokens="<?= $estado->getNome()?>"
                >
                <?= $estado->getNome() ?>
            </option>
            <?php
          }
          ?>        
        </select>
    </div>

    <div class="form-group">
        <label for="cidade">Cidade</label>
        <select id="cidade" name="cidade" class="form-control" data-live-search="true" required>
            <option 
                value="" 
                data-tokens="">
                -----
            </option>
        </select>
    </div>    
    <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
