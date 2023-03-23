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

    $sql = $pdo->query("SELECT * FROM employees");

    echo "<table>";
    echo "<tr>
          <th>id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Department</th>
          <th class='action'>Action</th>
          </tr>";
    while ($row = $sql->fetch()) {
        echo "<tr>
                 <td>" . $row['id'] . "</td>
                 <td>" . $row['fname'] . "</td>
                 <td>" . $row['lname'] . "</td>
                 <td>" . $row['email'] . "</td>
                 <td>" . $row['mobile'] . "</td>
                 <td>" . $row['department'] . "</td>
                 <td><a href='edit.php?id=" . $row['id'] . "' class='edit'>Edit</a>
                 <a href='delete.php?id=" . $row['id'] . "' class='delete'>Delete</a></td>
                 
             </tr>";
    }
    echo "</table>";

    $sql->closeCursor();
    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<style>
    body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-image: url('https://images.unsplash.com/photo-1470790376778-a9fbc86d70e2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=704&q=80'); 
			background-size: cover;
			background-position: center;
    }

table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
th {
    background-color: #3F497F;
    color: white;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
th.action {
    width: 180px;
}
a.edit {
    background-color: #4CAF50;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
}
a.edit:hover {
    background-color: #3e8e41;
}
a.delete {
    background-color: #f44336;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
}
a.delete:hover {
    background-color: #cc0000;
}
</style>