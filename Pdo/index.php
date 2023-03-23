<?php 
require_once __DIR__ . '/vendor/autoload.php'; 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully to the database!";
    $sql = $pdo->prepare("INSERT INTO employees (fname, lname, email, mobile, department) VALUES (?, ?, ?, ?, ?)");

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $department = $_POST["department"];

    $sql->bindParam(1, $fname);
    $sql->bindParam(2, $lname);
    $sql->bindParam(3, $email);
    $sql->bindParam(4, $mobile);
    $sql->bindParam(5, $department);

    if ($sql->execute()) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql->errorInfo()[2];
    }
    $sql->closeCursor();
    $pdo = null;

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>