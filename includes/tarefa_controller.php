<?php 
    require_once '../includes/tarefa.model.php';
    require_once '../includes/tarefa.service.php';
    require_once '../includes/conexao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if ( $acao && $_GET['acao'] == 'inserir' ) {
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('location: nova_tarefa.php?inclusao=1');

    } else if ( $acao == 'recuperar') {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar($filtro);

    } else if ( $acao == 'atualizar' ) {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $tarefaService = new TarefaService($conexao, $tarefa);

        if ( $tarefaService->atualizar() ) {
            if ( isset($_GET['pag']) && $_GET['pag'] === 'index') {
                header('location: index.php');

            } else {
                header('location: todas_tarefas.php');
            }
        }

    } else if ( $acao == 'remover' ) {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefa->__set('id', $_GET['id']);

        $tarefaService = new TarefaService($conexao, $tarefa);

        if ( $tarefaService->remover() ) {
            if ( isset($_GET['pag']) && $_GET['pag'] === 'index') {
                header('location: index.php');

            } else {
                header('location: todas_tarefas.php');
            }
        }

    } else if ( $acao == 'marcarOK' ) {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);

        $tarefaService = new TarefaService($conexao, $tarefa);

        if ( $tarefaService->marcarOK() ) {
            if ( isset($_GET['pag']) && $_GET['pag'] === 'index') {
                header('location: index.php');

            } else {
                header('location: todas_tarefas.php');
            }
        }
    }
?>