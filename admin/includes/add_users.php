<?php
if (isset($_POST['create_user'])) {

    try {
        $username = $_POST['username'];
        $user_firstname = $_POST['firstname'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $user_lastname = $_POST['lastname'];
        $user_role = $_POST['user_role'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/$user_image");


        if (empty($username) || empty($user_password) || empty($user_email)) {
            echo 'The following fields should not be empty username, Password, Email';
        } else {

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

            $stmt = $conn->prepare("INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) 
            VALUES ('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}') ");
            $stmt->execute();

        }
    } catch (PDOException $e) {
        echo 'Error:' . $e->getMessage();
    }

    echo "<div class='alert alert-success'> User successfully created. View user " . "<a href='users.php'>Here</a></div>";

}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="lastname">
    </div>

    <div class="form-group">
        <label for="title">User Name</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="title">User Role</label><br>
        <select name="user_role" id="">
            <option value="subscriber">Select options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="email">
    </div>

    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add user">
    </div>

</form>