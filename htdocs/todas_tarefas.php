<?php
	$acao = 'recuperar';

	require_once 'tarefa_controller.php';
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function editar(nId) {
				let oForm = document.createElement("form")
				let oInput = document.createElement("input")
				let oInputID = document.createElement("input")
				let oButton = document.createElement("button")

				let oTarefa = document.getElementById(`tarefa_${nId}`)
				let cTarefa = fixConteudo(oTarefa.innerHTML)

				oForm.action = "tarefa_controller.php?acao=atualizar"
				oForm.method = "post"
				oForm.className = "mt-4 row"

				oInput.type = "text"
				oInput.name = "tarefa"
				oInput.className = "col-9 form-control"
				oInput.value = cTarefa
				
				oInputID.type  = "hidden"
				oInputID.name = "id"
				oInputID.value = nId

				oButton.type = "submit"
				oButton.className = "col-3 btn btn-info"
				oButton.innerHTML = "Atualizar"

				oForm.appendChild(oInput)
				oForm.appendChild(oInputID)
				oForm.appendChild(oButton)

				oTarefa.innerHTML = ""
				oTarefa.insertBefore(oForm, oTarefa[0])
			}

			function remover(nId) {
				location.href = `todas_tarefas.php?acao=remover&id=${nId}`
			}
			
			function marcarOK(nId) {
				location.href = `todas_tarefas.php?acao=marcarOK&id=${nId}`
			}

			function fixConteudo(cTexto) {
				cTexto = cTexto.trim()

				for (let i = cTexto.length; i > 0; i--) {
					if ( cTexto.substr(i, 1) == '(') {

						return cTexto.substr(0, i).trim()
					}
				}
			}
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />
								<? foreach($tarefas as $tarefa ) { ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
										<div id="tarefa_<?= $tarefa->id ?>"class="col-sm-9">
											<?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i onclick="remover(<?= $tarefa->id ?>)" class="fas fa-trash-alt fa-lg text-danger"></i>

											<? if ( $tarefa->status === 'pendente' ) { ?>
												<i onclick="editar(<?= $tarefa->id ?>)" class="fas fa-edit fa-lg text-info"></i>
												<i onclick="marcarOK(<?= $tarefa->id ?>)" class="fas fa-check-square fa-lg text-success"></i>
											<? } ?>
										</div>
									</div>
								<? } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>