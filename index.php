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
                <tr>
                    <td>MARIA</td>
                    <td>4146564565</td>
                    <td>maria@mail.com</td>
                    <td><a href="#">Editar</a><a href="#">Excluir</a></td>
                </tr>
            </table>
        </section>
    </main>
</body>
</html>