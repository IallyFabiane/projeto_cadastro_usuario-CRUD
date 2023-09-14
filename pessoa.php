<?php 
    Class Pessoa {
        private $pdo;
        //CONEXAO COM O BANCO DE DADOS
        public function __construct($dbname, $host, $username, $password) {
           try {
                $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $username, $password);
           } catch (PDOException $e) {
                echo "Erro com o banco de dados: " . $e->getMessage();
                exit(); // interrom´pe o fluxo de código caso dê erro
           } catch (Exception $e) {
                echo "Erro genérico: " . $e->getMessage();
           }
          
        } //construtor da classe

        public function buscarDados() {
            $cmd = array(); // se o banco de daodsa estiver vazio, será retornado um array vazio
            $res = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
            $cmd= $res->fetchAll(PDO::FETCH_ASSOC);
            return $cmd;
        }

    }
?>