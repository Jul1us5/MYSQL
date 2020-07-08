<?php
$host = '127.0.0.1';
$db   = 'zeba';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

try {
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    // use exec() because no results are returned
    $pdo->exec($sql);
    echo "Table MyGuests created successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julius', 'Akimbo', 'julius@akimbo.com')";


$stmt = $pdo->query($sql);

$sql = "SELECT * FROM MyGuests";

$stmt = $pdo->query($sql);
while ($row = $stmt->fetch())
{
    echo $row['name'] . "<br/>";
}