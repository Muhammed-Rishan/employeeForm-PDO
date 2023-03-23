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

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   
        $id = $_GET['id'];

        $sql = $pdo->prepare("SELECT * FROM employees WHERE id = '$id'");
        $sql->bindParam('id', $id);
        $sql->execute();
        $row = $sql->fetch();

        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $department = $row['department'];

        include 'edit_Form.php';
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $department = $_POST['department'];


        $checkSql = $pdo->prepare("SELECT * FROM employees WHERE id !=  '$id' AND  (email = '$email' OR mobile = '$mobile')");
       
        $checkSql->bindParam(1, $id);
        $checkSql->bindParam(2, $email);
        $checkSql->bindParam(3, $mobile);
        $error_message = '';
        if ($checkSql->execute()) {
            $result = $checkSql->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    if ($row['email'] == $email) {
                        $error_message .= 'Email already exists!';
                    }
                    if ($row['mobile'] == $mobile) {
                        $error_message .= "Mobile number already exists! ";
                    }
                }
                echo $error_message;
                exit();
            }
        } else {
            echo "Error: " . $checkSql->errorInfo()[2];
            exit();
        }


        $sql = $pdo->prepare("UPDATE employees SET fname = '$fname', lname = '$lname', email = '$email', mobile = '$mobile', department = '$department' WHERE id = '$id'");
        $sql->bindParam('id', $id);
        $sql->bindParam('fname', $fname);
        $sql->bindParam('lname', $lname);
        $sql->bindParam('email', $email);
        $sql->bindParam('mobile', $mobile);
        $sql->bindParam('department', $department);
        $sql->execute();
        header("Location: view.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


//=====================================================

?>