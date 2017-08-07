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
                        Users
                        <small></small>
                    </h1>
                    <?php
                    if (isset($_GET['user'])) {
                        $source = $_GET['user'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {
                        case 'add_user':
                            include "includes/add_users.php";
                            break;
                        case 'edit_user':
                            include "includes/edit_user.php";
                            break;
                        default:
                            include "includes/view_all_users.php";
                            break;
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
