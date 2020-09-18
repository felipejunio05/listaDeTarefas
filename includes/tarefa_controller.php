<?php 
    require_once '../includes/tarefa.model.php';
    require_once '../includes/tarefa.service.php';
    require_once '../includes/conexao.php';

    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    header('Location: nova_tarefa.php?inclusao=1');
?>