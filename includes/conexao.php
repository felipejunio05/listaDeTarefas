<?php 
    class Conexao {
        private $host = 'localhost';
        private $dbname = 'app_listaTarefas';
        private $user = 'listaTarefas';
        private $pass = 't@X3l.#$';

        public function conectar() {
            try {
                return new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->user", "$this->pass");

            } catch(PDOException $error) {
                echo '<p>'. $error->getMessage(). '</p>';
            }
        }
    }
?>