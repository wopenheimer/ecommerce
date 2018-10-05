<form action="<?= BASE_URL ?>comum/trocarsenha" method="POST">
    <input type="hidden" id="token" name="token" value="<?php print $args['token'];?>" />
    <div class="form-group">
        <label for="senha">Nova Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
    </div>
    
    <div class="form-group">
        <label for="senha">Repita Nova Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
    </div>    

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
