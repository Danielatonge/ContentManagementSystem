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
                        Welcome to dashboard
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            //counting the number of post in the posts table
                                            $stmt = $conn->prepare("SELECT * FROM posts");
                                            $stmt->execute();
                                            $post_count = $stmt->rowCount();
                                            ?>
                                            <div class='huge'><?php echo $post_count; ?></div>
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            //counting the number of comments in the comments table
                                            $stmt = $conn->prepare("SELECT * FROM comments");
                                            $stmt->execute();
                                            $comment_count = $stmt->rowCount();
                                            ?>
                                            <div class='huge'><?php echo $comment_count; ?></div>
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            //counting the number of users in the users table
                                            $stmt = $conn->prepare("SELECT * FROM users");
                                            $stmt->execute();
                                            $user_count = $stmt->rowCount();
                                            ?>
                                            <div class='huge'><?php echo $user_count; ?></div>
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php
                                            //counting the number of categories in the categories table
                                            $stmt = $conn->prepare("SELECT * FROM categories");
                                            $stmt->execute();
                                            $category_count = $stmt->rowCount();
                                            ?>
                                            <div class='huge'><?php echo $category_count; ?></div>
                                            <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <?php

                    //counting the number of published post in the posts table
                    $stmt = $conn->prepare("SELECT * FROM comments WHERE comment_status = 'Unapproved' ");
                    $stmt->execute();
                    $unapprove_count = $stmt->rowCount();

                    //counting the number of published post in the posts table
                    $stmt = $conn->prepare("SELECT * FROM posts WHERE post_status = 'published' ");
                    $stmt->execute();
                    $post_published_count = $stmt->rowCount();

                    //counting the number of draft post in the posts table
                    $stmt = $conn->prepare("SELECT * FROM posts WHERE post_status = 'draft' ");
                    $stmt->execute();
                    $post_draft_count = $stmt->rowCount();

                    //counting the number of draft post in the posts table
                    $stmt = $conn->prepare("SELECT * FROM users WHERE user_role = 'Subscriber' ");
                    $stmt->execute();
                    $subscriber_count = $stmt->rowCount();

                    ?>
                    <div class="row">

                        <script type="text/javascript">
                            google.charts.load('current', {'packages': ['bar']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Data', 'Count'],

                                    <?php

                                    $element_text = ['Total Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Unapprove Comments', 'Users', 'Subscribers', 'Categories'];
                                    $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapprove_count, $user_count, $subscriber_count, $category_count];

                                    for ($i = 0; $i < count($element_text); $i++) {
                                        echo "['$element_text[$i]', $element_count[$i]],";
                                    }


                                    ?>

                                ]);

                                var options = {
                                    chart: {
                                        title: '',
                                        subtitle: '',
                                    }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>


                    </div><!--/.row chart-->


                </div>
            </div>
            <!-- /.row -->
            <div id="columnchart_material" style="width: 'auto'; height: 600px;"></div>
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
