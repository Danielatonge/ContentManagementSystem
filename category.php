<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>


<body>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <h1 class="page-header">
                Categories
                <small>Secondary Text</small>
            </h1>

            <?php

            if (isset($_GET['category'])) {
                $post_category_id = $_GET['category'];


                $stmt = $conn->prepare("SELECT * FROM posts WHERE post_category_id = {$post_category_id}");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);


                foreach ($stmt->fetchAll() as $row) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 250);

                    ?>


                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="../images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>


                <?php }
            } ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

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