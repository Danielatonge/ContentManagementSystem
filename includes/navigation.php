<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">


        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS FRONT</a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                $stmt = $conn->prepare('SELECT * FROM categories LIMIT 3');
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                //                    var_dump($stmt->fetchAll());

                foreach ($stmt->fetchAll() as $row) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    $category_class = '';
                    $registration_class = '';
                    $registration = 'registration.php';

                    $page_name = basename($_SERVER['PHP_SELF']);
                    if (isset($_GET['category']) && $_GET['category'] == $cat_id) {

                        $category_class = 'active';

                    } else if ($page_name == $registration) {

                        $registration_class = 'active';
                    }

                    echo "<li class='$category_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";


                }

                ?>


                <li>
                    <a href="../admin/index.php">Admin</a>
                </li>

                <?php
                session_start();
                if (isset($_SESSION['user_role'])) {

                    if (isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_post&update=$post_id'>Edit Post</a></li>";
                    }
                }


                ?>

                <li class="<?php echo $registration_class; ?>">
                    <a href="registration.php">Registration</a>
                </li>


            </ul>
        </div>
        <!-- /.navbar-collapse -->


    </div>
    <!-- /.container -->
</nav>