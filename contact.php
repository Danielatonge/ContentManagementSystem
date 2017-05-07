<?php  include "includes/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

   <?php  include "includes/header.php"; ?>


<body>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <?php
    
    if(isset($_POST['submit'])) {
        
        $to = "driivehard@gmail.com";
        $email = trim($_POST['email']);
        $subject = trim($_POST['subject']);
        $content = trim($_POST['content']);
        
        $subject = htmlspecialchars($subject);
        $email = htmlspecialchars($email);
        $content = htmlspecialchars($content);
            
        
        if (empty($content) || empty($email)) {
            $message = "<p class='alert alert-danger'>The Content and Email fields are obligatory</p>";
        } else {  
           $email = "From: " . $email;
            mail($to,$subject,$content,$email);
       
            header("Location: index.php");
            $message = "<p class='alert alert-success text-center'>Your Preoccupation was received</p>";
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
                       <?php echo $message;?>
                        <div class="form-wrap">
                        <h1>Contact</h1>
                            <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                                
                                 <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                                </div>
                                
                                <div class="form-group">
                                    <label for="subject" class="sr-only">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                                </div>
                                 <div class="form-group">
                                    <label for="content" class="sr-only">Content</label>
                                    <textarea name="content" class="form-control" id="content" cols="40" rows="10"></textarea>
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>


        <hr>



<?php include "includes/footer.php";?>


</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>


</html>