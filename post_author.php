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
            <?php
            if (isset($_GET['author'])) {
                $post_author = $_GET['author'];
                ?>

                <h1 class="page-header">
                    All Posts By
                    <small><?php echo $post_author; ?></small>
                </h1>

                <?php
                $stmt = $conn->prepare("SELECT * FROM posts WHERE post_author = '{$post_author}' AND post_status = 'published' ");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);


                foreach ($stmt->fetchAll() as $row) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 300);

                    ?>


                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive"
                                                                         src="../images/<?php echo $post_image; ?>"
                                                                         alt=""></a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
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