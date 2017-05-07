<!DOCTYPE html>
<html lang="en">
    <!-- Header files -->
<?php include "includes/admin_header.php";    ?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h1 class="page-header">
                            Comments
                            <small>User</small>
                        </h1>            
                    <?php             
                       if(isset($_GET['source1'])) {
                       $source = $_GET['source1'];
                        } 
                        else {
                           $source = '';
                       }
                        
                         switch($source){
                             case 'add_comment':
                                 include "includes/add_comment.php";
                                 break;
                             case 'edit_comment':
                                include "includes/edit_comment.php";
                                 break;
                             case '10':
                                 echo 'why me and 10'; 
                                 break;
                             case '20':
                                 echo 'why me and 20'; 
                                 break;
                             default:
                                 include "includes/view_all_comments.php";
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
