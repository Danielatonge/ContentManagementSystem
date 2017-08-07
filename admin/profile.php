<!DOCTYPE html>
<html lang="en">
<!-- Header files -->
<?php include "includes/admin_header.php"; ?>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Profile
                        <small></small>
                    </h1>
                    <?php
                    if (isset($_SESSION['user_id'])) {

                        $user_id = $_SESSION['user_id'];

                        try {

                            $stmt = $conn->prepare("SELECT * FROM users WHERE user_id={$user_id}");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);

                            foreach ($stmt->fetchAll() as $row) {
                                $username = $row['username'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_role = $row['user_role'];
                                $user_password = $row['user_password'];
                                $user_image = $row['user_image'];
                            }


                            ?>


                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="title">First Name</label>
                                    <input type="text" class="form-control" name="firstname"
                                           value="<?php echo $user_firstname; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="title">Last Name</label>
                                    <input type="text" class="form-control" name="lastname"
                                           value="<?php echo $user_lastname; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="title">User Name</label>
                                    <input type="text" class="form-control" name="username"
                                           value="<?php echo $username; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="title">User Role</label><br>
                                    <select name="user_role" id="">
                                        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                                        <?php
                                        if ($user_role == 'subscriber') {
                                            echo "<option value='admin'>Admin</option>";
                                        } else {
                                            echo "<option value='subscriber'>Subscriber</option>";
                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="user_image">User Image</label><br>
                                    <img width='50' height="50" src="../images/<?php echo $user_image; ?>"><br>
                                    <input type="file" name="image">
                                </div>

                                <div class="form-group">
                                    <label for="title">Email</label>
                                    <input type="email" class="form-control" name="email"
                                           value="<?php echo $user_email; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="title">Password</label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Enter new password to modify or leave field empty to maintain old password">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="update_user"
                                           value="Update Profile">
                                </div>

                            </form>


                            <?php
                        } catch (PDOException $e) {
                            echo 'Error:' . $e->getMessage();
                        }
                    }


                    ?>

                    <?php
                    if (isset($_POST['update_user'])) {
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

                            if (empty($user_image)) {
                                $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = '{$user_id}'");
                                $stmt->execute();

                                foreach ($stmt->fetchAll() as $row) {
                                    $user_image = $row['user_image'];
                                }
                            }

                            if (empty($username) || empty($user_email)) {
                                echo 'The following fields should not be empty username, Email';
                            } else {

                                if (empty($user_password) || $user_password == '') {
                                    $stmt = $conn->prepare("UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_image = '{$user_image}', user_role ='{$user_role}' WHERE user_id = '{$user_id}' ");
                                    $stmt->execute();

                                } else {
                                    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                                    $stmt = $conn->prepare("UPDATE users SET username = '{$username}', user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_image = '{$user_image}', user_role ='{$user_role}' WHERE user_id = '{$user_id}' ");
                                    $stmt->execute();

                                }

                                $stmt = $conn->prepare("UPDATE users SET username = '{$username}', user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_image = '{$user_image}', user_role ='{$user_role}' WHERE user_id = '{$user_id}' ");
                                $stmt->execute();

                            }
                        } catch (PDOException $e) {
                            echo 'Error:' . $e->getMessage();
                        }

                    }

                    ?>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include "includes/footer.php";

?>

</body>

</html>
