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
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php


            if (isset($_GET['page'])) {
                $page_active = $_GET['page'];
            } else {
                $page_active = "";
            }

            if ($page_active == '' || $page_active == 1) {
                $page = 0;
            } else {
                $page = ($page_active * 5) - 5;
            }

            $stmt = $conn->prepare("SELECT * FROM posts");
            $stmt->execute();
            $num_post = $stmt->rowCount();
            //                    echo $num_post;
            $num_post = ceil($num_post / 5);


            $stmt = $conn->prepare("SELECT * FROM posts WHERE post_status = 'published' LIMIT $page, 5");
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
                <p class="lead">
                    by <a href="post_author.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive"
                                                                     src="../images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>


            <?php } ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <ul class="pager pull-left">

        <?php

        for ($i = 1; $i <= $num_post; $i++) {
            if ($i == $page_active) {
                echo "<li><a style='background: #ccc;' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }

        }

        ?>

    </ul>

    <?php include "includes/footer.php"; ?>


</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>


</html>