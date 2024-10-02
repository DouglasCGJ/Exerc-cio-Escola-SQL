<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/style.css">

    <?php 
    // Conexão com o banco de dados
    $host = 'localhost';
    $db = 'escola_sql';
    $user = 'Douglas';
    $pass = '123456';
    $port = 3307;

    require_once 'connection.php';
    $database = new Database($host, $db, $user, $pass, $port);
    $database->connect();
    $pdo = $database->getConnection();
    ?>
</head>
<body>
    <header>
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

        <!-- Tabela de Alunos Cadastrados -->
        <div class="table-container">
            <h2>Alunos Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Idade</th>
                        <th>Curso</th>
                        <th>Ações</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->prepare("SELECT id, nome, email, idade, curso FROM alunos");
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['nome']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['idade']) . "</td>
                                    <td>" . htmlspecialchars($row['curso']) . "</td>
                                    <td>
                                        <a href='?id=" . $row['id'] . "' onclick=\"return confirm('Tem certeza que deseja remover este aluno?')\">Excluir</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum aluno cadastrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Opção de pesquisa para exclusão -->
        <div class="search-container">
            <h2>Pesquisar e Excluir Alunos</h2>
            <form action="index.php" method="GET">
                <label for="pesquisa">Pesquisar por ID ou Nome:</label>
                <input type="text" id="pesquisa" name="pesquisa" placeholder="Digite o ID ou Nome">
                <input type="submit" value="Excluir">
            </form>
        </div>

        <!-- Tabela de Alunos Removidos -->
        <div class="table-container">
            <h2>Alunos Removidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Idade</th>
                        <th>Curso</th>
                        <th>Data de Remoção</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->prepare("SELECT nome, email, idade, curso, data_remocao FROM removidos");
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['nome']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['idade']) . "</td>
                                    <td>" . htmlspecialchars($row['curso']) . "</td>
                                    <td>" . htmlspecialchars($row['data_remocao']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum aluno removido</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        if (isset($_GET['pesquisa'])) {
            $pesquisa = $_GET['pesquisa'];

            // Procura aluno pelo ID ou Nome
            $stmt = $pdo->prepare("SELECT id FROM alunos WHERE id = :pesquisa OR nome LIKE :pesquisa_nome");
            $stmt->bindParam(':pesquisa', $pesquisa);
            $stmt->bindParam(':pesquisa_nome', $nome_param);
            $nome_param = '%' . $pesquisa . '%';
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $row['id'];

                // Move o aluno para a tabela "removidos"
                $stmt = $pdo->prepare("INSERT INTO removidos (nome, email, idade, curso, data_remocao)
                                        SELECT nome, email, idade, curso, NOW() 
                                        FROM alunos WHERE id = :id");
                $stmt->bindParam(':id', $id);
                if ($stmt->execute()) {
                    // Exclui o aluno da tabela "alunos"
                    $stmtDelete = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
                    $stmtDelete->bindParam(':id', $id);
                    $stmtDelete->execute();

                    header("Location: index.php?msg=Aluno removido com sucesso.");
                    exit;
                } else {
                    echo "Erro ao remover aluno.";
                }
            } else {
                echo "Nenhum aluno encontrado.";
            }
        }
        ?>

    </header>

    <!-- Footer -->
    <footer>
        <p>© 2024 Sesi Senai</p>
    </footer>
</body>
</html>


<!-- Coneção estabelecida de formulário criado com o banco de dados - 30/09 Fim: 09:40 -->
 <!-- Projet terinado, tudo foi aplicado - 02/10 Fim: 11:33 -->