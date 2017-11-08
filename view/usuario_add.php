<form action="<?= BASE_URL ?>usuario/add" method="POST">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>

    <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
    </div>

    <div class="form-group">
        <label for="pessoa">Pessoa</label>
        <select id="pessoa" name="pessoa" class="form-control selectpicker" data-live-search="true" required>
          <?php        
          foreach ($args as $pessoa) {
          	print '<option value="' . $pessoa->getCpf() . '" data-tokens="' . $pessoa->getNome() . '">' . $pessoa->getNome() . '</option>';
          }
          ?>		
		</select>

    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
