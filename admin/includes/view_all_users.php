<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>

        <th>Role</th>
        <th>User Image</th>


    </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $conn->prepare('SELECT * FROM users');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach ($stmt->fetchAll() as $row) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_email = $row['user_email'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];


        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";

        echo "<td>{$user_role}</td>";
        echo "<td><img width='50' height='50' src='../images/{$user_image}'></td>";

//                            $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id = {$user_post_id}"); 
//                            $stmt->execute();
//                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
//                            echo "<td>";
//                            foreach($stmt->fetchAll() as $row) 
//                            $post_id = $row['post_id'];
//                            $user = $row['post_title'];

        echo "<td><a href='users.php?make_admin={$user_id}'>Admin</a></td>";
        echo "<td><a href='users.php?make_subscriber={$user_id}'>Subscriber</a></td>";
        echo "<td><a href='users.php?user={$user_id}'>Delete</a></td>";
        echo "<td><a href='users.php?user=edit_user&update={$user_id}'>Edit</a></td>";
        echo "</tr>";

    }

    ?>

    </tbody>
</table>


<?php

if (isset($_GET['make_admin'])) {
    $user_id = $_GET['make_admin'];
    $user_role = 'Admin';

    $stmt = $conn->prepare("UPDATE users SET user_role = '{$user_role}' WHERE user_id = {$user_id}");
    $stmt->execute();
    header("Location: users.php");
}

if (isset($_GET['make_subscriber'])) {
    $user_id = $_GET['make_subscriber'];
    $user_role = 'Subscriber';

    $stmt = $conn->prepare("UPDATE users SET user_role = '{$user_role}' WHERE user_id = {$user_id} ");
    $stmt->execute();
    header("Location: users.php");
}


if (isset($_GET['user'])) {

    if ($_SESSION['user_role'] == 'admin') {
        $user_id = $_GET['user'];
        $delstmt = $conn->prepare("DELETE FROM users WHERE user_id={$user_id} ");
        $delstmt->execute();
        header("Location: users.php");
    }
}

?>
                       