 <form action="<?= BASE_URL ?>paciente/edit" method="POST">
    <div class="form-group">
        <label for="cpf">Cpf</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Cpf" value="<?=$args->getCpf()?>" required>
    </div>
    <input type="hidden" id="old_cpf" name="old_cpf" value="<?=$args->getCpf()?>">

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?=$args->getNome()?>"  required>
    </div>

    <div class="form-group">
        <label for="datanasc">Data de Nascimento</label>
        <div class="input-group date" id="datetimepicker1">
            <input type="text" class="form-control" id="datanasc" name="datanasc" placeholder="Data de Nascimento" value="<?=$args->getDatanasc()?>" required>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>


    </div>

    <div class="form-group">
        <label for="altura">Peso</label>
        <input type="number" step="0.01" class="form-control" id="peso" name="peso" placeholder="Peso" value="<?=$args->getPeso()?>" required>
    </div>

    <div class="form-group">
        <label for="altura">Altura</label>
        <input type="number" step="0.01" class="form-control" id="altura" name="altura" placeholder="Altura" value="<?=$args->getAltura()?>" required>
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