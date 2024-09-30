<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="image">
                <img src="../css/img/301187972_489820663151401_1452107599857658394_n.png" alt="" />
            </div>
            <div class="form-container">
                <h2>Cadastro de Alunos</h2>
                <form action="db.php" method="GET">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="idade">Idade:</label>
                    <input type="text" id="idade" name="idade" required>

                    <label for="curso">Curso:</label>
                    <input type="text" id="curso" name="curso" required>

                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </body>
</html>

<!-- Coneção estabelecida de formulário criado com o banco de dados - Fim: 09:40 -->