<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
    </head>
    <body>
        <h2>Cadastro de Alunos</h2>
        <form action="db.php" method="GET">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="idade">Idade:</label><br>
            <input type="text" id="idade" name="idade" required><br><br>

            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="curso">Curso:</label><br>
            <input type="text" id="curso" name="curso" required><br><br>

            <input type="submit" value="Enviar">
        </form>
    </body>
</html>

<!-- Coneção estabelecida de formulário criado com o banco de dados -->