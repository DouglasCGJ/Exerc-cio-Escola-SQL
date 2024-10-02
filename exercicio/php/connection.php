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