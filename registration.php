<?php include "includes/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>


<body>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php

if (isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $username = htmlspecialchars($username);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $user_role = 'subscriber';


    if (empty($username) || empty($email) || empty($password)) {
        $message = "<p class='alert alert-danger'>The username shouldnt be less than 3 digits. All fields are obligatory</p>";
    } else {

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $stmt = $conn->prepare("INSERT INTO users(username, user_email, user_password, user_role ) VALUES('{$username}', '{$email}', '{$password}', '{$user_role}')");
        $stmt->execute();

        //$_SESSION['username'] = $username;
        //$_SESSION['user_role'] = $user_role;

        //header("Location: ../admin/index.php");
        $message = "<p class='alert alert-success text-center'>Your Registration was successful</p>";
    }

} else {
    $message = '';
}

?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <?php echo $message; ?>
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php include "includes/footer.php"; ?>


</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>


</html>