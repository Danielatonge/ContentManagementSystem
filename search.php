
<!DOCTYPE html>
<html lang="en">

   <?php  include "includes/header.php"; ?>


<body>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
                <div class="col-md-8">
        
                      
                        
                <h1 class="page-header">
                    Results
                    <small></small>
                </h1>
              
               <?php
                    
                    if (isset($_POST['submit'])) {
                try {
                $search = $_POST['search'];
                
                $stmt = $conn->prepare("SELECT * FROM posts WHERE post_tags LIKE '%$search%'"); 
                
                $stmt->execute();
                    
                    
                    foreach ($stmt as $s) {
             
                            $post_title = $s['post_title'];
                            $post_author = $s['post_author'];
                            $post_date = $s['post_date'];
                            $post_image = $s['post_image'];
                            $post_content = $s['post_content'];
                            $post_tags = $s['post_tags'];
                                                                               
                ?>
                

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="../images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

   
                        
                        
                <?php  
                        
                        } 
                                        
                                
                } catch (PDOException $e) {
                    echo 'Error: '. $e->getMessage();
                }
            }
                    ?> 
                    
                
                
                

            </div> 

            <!-- Blog Sidebar Widgets Column -->
           
               <?php  include "includes/sidebar.php";  ?> 

        </div>
        <!-- /.row -->

        <hr>

        

        <?php  include "includes/footer.php";  ?> 


    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>


</html>