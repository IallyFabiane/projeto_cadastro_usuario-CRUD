<?php 
    require_once 'pessoa.php';
    $pessoa = new Pessoa("crudpdo", "localhost","root", "");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="bx-table.svg" type="image/x-icon">
</head>

<body>
    <?php 
    //pegando os dados do formulário
        if (isset($_POST['btn-cadastrar'])){ //testando se o botãocadastrar foi clkicado
            $nome = addslashes($_POST['nome']); //proteção contra códigos maliciosos com o addslashes
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if (!empty($nome) && !empty($telefone) && !empty($email)) {
                if(!$pessoa->cadastrarPessoa($nome, $telefone, $email)) {
                    echo "E-mail já cadastrado";
                }
            } else {
                echo "Preencha todos os campos";
            }
        }

        if (isset($_GET['id'])) {
            $id_pessoa = $_GET['id'];
            $id_pessoa = addslashes($id_pessoa);
            $pessoa->excluirPessoa($id_pessoa);
            header("location: index.php"); //atualizando a página
        }

       
       if(isset($_GET['id_update'])){
        $id_update = $_GET['id_update'];
        $id_update = addslashes($id_update);
        $cmd = $pessoa->buscarDadosPessoa($id_update);
       }
        
    ?>
    <main>
        <section id="esquerda">
            <form action="" method="post">
                <h2><?php echo isset($cmd) ? "Editar Pessoa" : "Atualizar Pessoa"; ?></h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if(isset($cmd)) { echo htmlspecialchars($cmd['NOME']); } ?>">
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefone" value="<?php if(isset($cmd)) { echo htmlspecialchars($cmd['TELEFONE']); } ?>">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php if(isset($cmd)) { echo htmlspecialchars($cmd['EMAIL']); } ?>">
                <button name="btn-cadastrar" type="submit"><?php if(isset($cmd)) { echo "Atualizar"; } else { echo "Cadastrar"; } ;?></button>
            </form>
        </section>
        <section id="direita">
            <table>
                <tr class="titulo">
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td colspan="2">E-mail</td>
                </tr>
                <?php 
                $dados = $pessoa->buscarDados(); //retornando os dados vindos do banco
                $tamanhoDados = count($dados);
                if( $tamanhoDados > 0) {
                    for ($i=0; $i < $tamanhoDados; $i++) { //entrando na tabela e percorrendo as linhas
                        echo "<tr>";
                        foreach ($dados[$i] as $coluna => $valor) { //percorrendo as colunas da tabela
                            if ($coluna !== "ID") {
                                echo "<td>" . $valor . "</td>";
                            }
                        }
            ?>
                <td>
                    <a href="index.php?id_update=<?= $dados[$i]['ID']?>">Editar</a>
                    <a href="index.php?id=<?= $dados[$i]['ID']?>">Excluir</a>
                </td>
                <?php
                        echo "</tr>";
                    }
                } else {
                    echo "Ainda não há pesssoas cadastradas";
                }
            ?>
            </table>
        </section>
    </main>
</body>

</html>