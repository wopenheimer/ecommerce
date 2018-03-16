<div id="myModal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Pessoa</h4>
            </div>
            <div class="modal-body">
			    <form action="<?= BASE_URL ?>pessoa/add" method="POST">
			        <div class="form-group">
			            <label for="cpf">Cpf</label>
			            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Cpf" required>
			        </div>


			        <div class="form-group">
			            <label for="nome">Nome</label>
			            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
			        </div>

			        <div class="form-group">
			            <label for="datanasc">Data de Nascimento</label>
                                    <div class="input-group date" id="datetimepicker1">
                                        <input type="text" class="form-control" id="datanasc" name="datanasc" placeholder="Data de Nascimento" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
			        </div>

			        <div class="form-group">
			            <label for="celular">Celular</label>
			            <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" required>
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
                        <select id="cidade" name="cidade" class="form-control selectpicker" data-live-search="true" required>
                            <option 
                                value="" 
                                data-tokens="">
                                -----
                            </option>
                        </select>
                    </div>    


			        <div class="form-group">
			            <label for="cep">Cep</label>
			            <input type="text" class="form-control" id="cep" name="cep" placeholder="Cep" required>
			        </div>

			        <button type="submit" class="btn btn-primary">Enviar</button>
			    </form>
            </div>
        </div>
    </div>
</div>

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
