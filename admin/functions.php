<?php

function users_online()
{


    if (isset($_GET['onlineusers'])) {

        global $conn;//This connection should not normally work

        if (!$conn) {
            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_second = 5;
            $time_out = $time - $time_out_in_second;


            $stmt = $conn->prepare("SELECT * FROM users_online WHERE session = '$session' ");
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count == null) {
                $stmt = $conn->prepare("INSERT INTO users_online(session,time) VALUES('{$session}','{$time}') ");
                $stmt->execute();

            } else {
                $stmt = $conn->prepare("UPDATE users_online SET time = '$time' WHERE session = '{$session}' ");
                $stmt->execute();
            }

            $stmt = $conn->prepare("SELECT * FROM users_online WHERE time > '$time_out' ");
            $stmt->execute();
            echo $stmt->rowCount();

        }

    }
}

users_online();


function insert_categories()
{
    global $conn;
    if (isset($_POST['submit'])) {
        try {
            $cat_title = $_POST['cat_title'];
            if ($cat_title === '' || empty($cat_title)) {
                echo 'This field should not be empty';
            } else {

                $stmt = $conn->prepare('INSERT into categories(cat_title) values (:cat_title)');
                $stmt->bindParam(':cat_title', $cat_title);
                $stmt->execute();

            }
        } catch (PDOException $e) {
            echo 'Error:' . $e->getMessages();
        }
    }
}

function deleteCategories()
{
    global $conn;

    if (isset($_GET['delete'])) {

        $the_cat_id = $_GET['delete'];

        $delstmt = $conn->prepare("DELETE FROM categories WHERE cat_id={$the_cat_id} ");
        $delstmt->execute();
        header("Location: categories.php");
    }
}

function findAllCategories()
{
    global $conn;
    //display all categories
    $stmt = $conn->prepare('SELECT * FROM categories');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach ($stmt->fetchAll() as $row) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<tr><td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?update={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }
}