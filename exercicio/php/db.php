<?php
class Database {
    private $pdo;
    private $host;
    private $db;
    private $user;
    private $pass;

    // define as configurações do banco de dados
    public function __construct($host, $db, $user, $pass, $port = 3307) {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
    }

    // conexão com o banco de dados
    public function connect() {
        try {
            // cria uma instância de PDO para MySQL
            $this->pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            // define o modo de erro do PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // mensagem de erro em caso de falha
            echo "Erro na conexão com o banco de dados MySQL: " . $e->getMessage() . "<br>";
        }
    }

    // retornar para a instância PDO
    public function getConnection() {
        return $this->pdo;
    }
} 
?>

<!DOCTYPE html> <!-- A alegria do programador, html e css -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concluído</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 18px;
            line-height: 1.5;
            color: #555;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Conexão com o banco de dados
    $host = 'localhost';
    $db = 'escola_sql';
    $user = 'Douglas';
    $pass = '123456';
    $port = 3307;

    require_once 'db.php'; // Mantenha a conexão com a classe

    $database = new Database($host, $db, $user, $pass, $port);
    $database->connect();
    $pdo = $database->getConnection();

    // Verifica se os dados foram enviados via GET
    if (isset($_GET['nome']) && isset($_GET['email']) && isset($_GET['idade']) && isset($_GET['curso'])) {
        // Captura os dados enviados pelo formulário
        $nome = htmlspecialchars($_GET['nome']);
        $idade = htmlspecialchars($_GET['idade']);
        $email = htmlspecialchars($_GET['email']);
        $curso = htmlspecialchars($_GET['curso']);

        // Exibe os dados capturados
        echo "<h2>Informações recebidas:</h2>";
        echo "<p><strong>Nome:</strong> " . $nome . "</p>";
        echo "<p><strong>E-mail:</strong> " . $email . "</p>";
        echo "<p><strong>Idade:</strong> " . $idade . "</p>";
        echo "<p><strong>Curso:</strong> " . $curso . "</p>";

        // Prepara uma consulta SQL para inserir os dados na tabela 'alunos'
        $stmt = $pdo->prepare("INSERT INTO alunos(nome, idade, email, curso) VALUES (:nome, :idade, :email, :curso)");

        // Bind dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':curso', $curso);

        // Executa a consulta preparada
        if ($stmt->execute()) {
            echo "<p>Dados inseridos com sucesso!</p>";
        } else {
            echo "<p>Erro ao inserir dados.</p>";
        }
    } else {
        echo "<p>Nenhum dado foi enviado.</p>";
    }
    ?>

    <a class="button" href="index.php">Voltar</a>
</div>

</body>
</html>


<!--Início da inserção de dados na tabela, é preciso finaçizar a conexão -->


