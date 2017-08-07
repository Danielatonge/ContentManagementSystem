<?php
require __DIR__ . '/db.php';
session_start();
?>

<?php

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = '{$username}' ");
    $stmt->execute();

    foreach ($stmt->fetchAll() as $row) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_lastname = $row['user_lastname'];
        $db_firstname = $row['user_firstname'];
        $db_role = $row['user_role'];
        $db_password = $row['user_password'];
    }


    if (password_verify($password, $db_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_role;
        $_SESSION['user_id'] = $db_user_id;

        header("Location: ../admin/index.php");
    } else {
        header("Location: ../index.php");
    }

}


?>