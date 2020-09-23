<?php 
    class TarefaService {
        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao, Tarefa $tarefa) {
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        public function inserir() {
            $query = 'INSERT INTO tb_tarefas (tarefa) VALUES (:tarefa)';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        }

        public function recuperar() {
            $query = '
                        SELECT
                            t.id, t.tarefa, s.status
                        FROM
                            tb_tarefas as t 
                        LEFT JOIN 
                            tb_status as s ON s.id = t.id_status
                        ';

            $stmt = $this->conexao->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function atualizar() {
            $query = '
                        UPDATE 
                            tb_tarefas
                        SET
                            tarefa = :tarefa
                        WHERE
                            id = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            
            return $stmt->execute();
        }

        public function remover() {
            $query = '
                        DELETE 

                        FROM 
                            tb_tarefas 
                        WHERE
                            id = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));

            return $stmt->execute();
        }
    }
?>