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

            echo "Conexão com o banco de dados MySQL realizada com sucesso!<br>";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concluido</title>
    <?php 
        $host = 'localhost';
        $db = 'escola_sql';
        $user = 'Douglas';
        $pass = '123456';
        $port = 3307;
        // inclui o arquivo da classe Database que criamos para conectar dentro da pasta php
        require_once 'db.php';
        // instância da classe Database
        $database = new Database($host, $db, $user, $pass, $port);
        // método connect para estabelecer a conexão
        $database->connect();
        // instância PDO para realizar as consultas
        $pdo = $database->getConnection();
    ?>
</head>

<!-- Início: 08:40 - Fim: 09:20, muitas alterações e criação do banco de dados foram realizadas, demorou um pouco devido a falta de atençaõ -->

<body>
<?php
// Verifica se os dados foram enviados via GET
if (isset($_GET['nome']) && isset($_GET['email']) && isset($_GET['idade']) && isset($_GET['curso'])){
    // Captura os dados enviados pelo formulário
    $nome = htmlspecialchars($_GET['nome']);
    $idade = htmlspecialchars($_GET['email']);
    $email = htmlspecialchars($_GET['idade']);
    $curso = htmlspecialchars($_GET['curso']);

    // Exibe os dados capturados
    echo "<h2>Informações recebidas:</h2>";
    echo "<p><strong>Nome:</strong> " . $nome . "<p>";
    echo "<p><strong>E-mail:</strong> " . $idade . "<p>";
    echo "<p><strong>Idade:</strong> " . $email . "<p>";
    echo "<p><strong>Curso:</strong> " . $curso . "<p>";
    // Verifica se a variável $pdo, que deve ser uma instância de PDO, está definida e é válida
    // Prepara uma consulta SQL para selecionar as colunas 'nome', 'idade', 'email'e 'curso' da tabela 'alunos'
    $stmt = $pdo->prepare("INSERT into alunos(nome, idade, email, curso) values ('$nome', '$email','$idade','$curso')");

    // Executa a consulta preparada
    $stmt->execute();
} else{
    echo "Nenhum dado foi enviado.";
}
?>

<!--Início da inserção de dados na tabela, é preciso finaçizar a conexão -->
