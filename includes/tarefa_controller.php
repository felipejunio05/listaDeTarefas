<?php 
    require_once '../includes/tarefa.model.php';
    require_once '../includes/tarefa.service.php';
    require_once '../includes/conexao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if ( acao && $_GET['acao'] == 'inserir' ) {
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('Location: nova_tarefa.php?inclusao=1');

    } else if ( $acao == 'recuperar') {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
    }
?>