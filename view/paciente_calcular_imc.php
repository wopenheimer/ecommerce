<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cálculo de IMC</h4>
            </div>
            <div class="modal-body">
			    <form action="<?= BASE_URL ?>paciente/processar_imc" method="POST">
			        <div class="form-group">
			            <label for="peso">Peso</label>
			            <input type="text" class="form-control" id="peso" name="peso" placeholder="Peso">
			        </div>
			        <div class="form-group">
			            <label for="altura">Altura</label>
			            <input type="text" class="form-control" id="altura" name="altura" placeholder="Altura">
			        </div>
			        <button type="submit" class="btn btn-primary">Calcular</button>
			    </form>
            </div>
        </div>
    </div>
</div>
