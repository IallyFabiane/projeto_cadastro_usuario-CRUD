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

        public function cadastrarPessoa($nome, $telefone, $email) {
                $res = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
                $res->bindValue(":e", $email);
                $res->execute();
                if ($res->rowCount() > 0) { //se for maior que 0 é porque o e-mail já existe no banco de dados
                    return false;
                } else { //email não foi encontrado
                    $res = $this->pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:n, :t, :e)");
                    $res->bindValue(":n", $nome);
                    $res->bindValue(":t", $telefone);
                    $res->bindValue(":e", $email);
                    $res->execute();
                    return true;
                }
        }

        public function excluirPessoa($id) {
            $res =  $this->pdo->prepare("DELETE FROM pessoa WHERE ID = :id");
            $res->bindValue(":id", $id);
            $res->execute();
        }

        //Buscar Dados de uma Pessoa Específica

        public function buscarDadosPessoa($id) {
            try {
                $res = $this->pdo->prepare("SELECT * FROM pessoa WHERE ID = :id");
                $res->bindValue(":id", $id);
                $res->execute();
                return $res->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Exibir mensagens de erro ou registrar em log, se necessário
                echo "Erro na consulta: " . $e->getMessage();
                return array(); // Retornar um array vazio em caso de erro
            }
        }
        

        //Atualizar Dados no Banco de Dados

        public function atualizarDados($id, $nome, $telefone, $email) {
            $res = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
            $res->bindValue(":e", $email);
            $res->execute();
            if ($res->rowCount() > 0) { //se for maior que 0 é porque o e-mail já existe no banco de dados
                return false;
            } else {
                $res = $this->pdo->prepare("UPDATE pessoa SET NOME = :n, TELEFONE = :t, EMAIL = :e WHERE ID = :id");
                $res->bindValue(":id", $id);
                $res->bindValue(":n", $nome);
                $res->bindValue(":t", $telefone);
                $res->bindValue(":e", $email);
                $res->execute();
                header("location: index.php");
                return true;
            }
        }
    }
?>