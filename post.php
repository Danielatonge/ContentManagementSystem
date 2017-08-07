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
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];


                $stmt = $conn->prepare("UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$the_post_id}");
                $stmt->execute();


                $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id='{$the_post_id}'");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);


                foreach ($stmt->fetchAll() as $row) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

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


                <?php }

            } else {

                header("Location: index.php");

            } ?>

            <?php

            if (isset($_POST['create_comment'])) {

                $comment_email = $_POST['comment_email'];
//                    $comment_post_id = $_POST['comment_post_id'];
                $comment_author = $_POST['comment_author'];
                $comment_status = 'Approved';
                $comment_content = $_POST['comment_content'];


                if (empty($comment_email) || empty($comment_author) || empty($comment_content)) {
                    echo "<p class='alert alert-danger'>The following fields should not be empty Author, Email, Comment</p>";
                } else {

                    $stmt = $conn->prepare("INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_date,comment_status) VALUES('{$the_post_id}','{$comment_author}','{$comment_email}','{$comment_content}',Now(),'{$comment_status}') ");

                    $stmt->execute();

                }


            }


            ?>


            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="post.php?p_id=<?php echo $the_post_id; ?>" method="post" role="form">
                    <div class="form-group">
                        <label for="">Author</label>
                        <input type="text" class="form-control" name="comment_author"/>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="comment_email"/>
                    </div>

                    <div class="form-group">
                        <label for="">Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>


            <!-- Posted Comments -->

            <!-- Comment -->

            <?php
            $stmt = $conn->prepare("SELECT * FROM comments WHERE comment_post_id = '{$the_post_id}' AND comment_status = 'Approved' ORDER BY comment_id DESC ");
            $stmt->execute();
            foreach ($stmt->fetchAll() as $row) {
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];
                ?>
                <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading'> <?php echo $comment_author; ?>
                            <small> <?php echo $comment_date; ?> </small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

            <?php } ?>


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