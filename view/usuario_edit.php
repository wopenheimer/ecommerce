 <form action="<?= BASE_URL ?>usuario/edit" method="POST">
    <div class="form-group">
        <label for="id">Id</label>
        <input type="text" class="form-control" id="id" name="id" placeholder="Id" value="<?=$args['usuario']->getId()?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" value="<?=$args['usuario']->getEmail()?>" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>

    <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
    </div>

    <div class="form-group">
        <label for="pessoa">Pessoa</label>
        <select id="pessoa" name="pessoa" class="form-control selectpicker" data-live-search="true" required>
          <?php        
          foreach ($args['pessoas'] as $pessoa) {
            ?>
            <option 
                value="<?= $pessoa->getCpf() ?>" 
                data-tokens="<?= $pessoa->getNome()?>"
                <?php 
                   if ($args['usuario']->getPessoa()->getCpf() == $pessoa->getCpf()) { 
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

    <button type="submit" class="btn btn-primary">Enviar</button>

</form> 