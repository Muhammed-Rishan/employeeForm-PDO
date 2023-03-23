<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'];

    $sql = $pdo->prepare("DELETE FROM employees WHERE id = '$id'");
    $sql->bindParam('id', $id);

   if ($sql->execute()){
    echo "<script>alert('Record Deleted')</script>";
   } 

    header("Location: view.php");
    exit();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

