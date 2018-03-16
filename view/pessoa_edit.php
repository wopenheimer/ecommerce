 <form action="<?= BASE_URL ?>pessoa/edit" method="POST">
    <div class="form-group">
        <label for="cpf">Cpf</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Cpf" value="<?=$args['pessoa']->getCpf()?>" required>
    </div>
    <input type="hidden" id="old_cpf" name="old_cpf" value="<?=$args['pessoa']->getCpf()?>">

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?=$args['pessoa']->getNome()?>"  required>
    </div>

    <div class="form-group">
        <label for="datanasc">Data de Nascimento</label>
        <div class="input-group date" id="datetimepicker1">
            <input type="text" class="form-control" id="datanasc" name="datanasc" placeholder="Data de Nascimento" value="<?=$args['pessoa']->getDatanasc()?>" required>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>


    </div>

    <div class="form-group">
        <label for="celular">Celular</label>
        <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="<?=$args['pessoa']->getCelular()?>" >
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
        <label for="cep">Cep</label>
        <input type="text" class="form-control" id="cep" name="cep" placeholder="Cep" value="<?=$args['pessoa']->getCep()?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>

</form> 

<script type="text/javascript">
  $(function () {        
        $('#datetimepicker1').datetimepicker({ 
            minView: 2, 
            pickTime: false, 
            format: 'dd/mm/yyyy',
            locale: 'pt-BR'
        });
    });
</script>