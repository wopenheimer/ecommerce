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
        <label for="paciente">Paciente</label>
        <select id="paciente" name="paciente" class="form-control selectpicker" data-live-search="true" required>
          <?php        
          foreach ($args as $paciente) {
          	print '<option value="' . $paciente->getCpf() . '" data-tokens="' . $paciente->getNome() . '">' . $paciente->getNome() . '</option>';
          }
          ?>		
		</select>

    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
