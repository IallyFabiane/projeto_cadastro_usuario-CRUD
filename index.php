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
    <main>
        <section id="esquerda">
            <form action="">
                <h2>Cadastrar Pessoa</h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" >
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefone">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <button type="submit">Cadastrar</button>
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
                        <td><a href="#">Editar</a><a href="#">Excluir</a></td>
                        
                        <?php
                        echo "</tr>";
                    }
                }
            ?>
            </table>
        </section>
    </main>
</body>
</html>