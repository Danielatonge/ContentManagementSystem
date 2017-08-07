<?php
if (isset($_POST['create_post'])) {

    try {
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_date = date('d-m-Y');
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_comment_count = 0;

        move_uploaded_file($post_image_temp, "../images/$post_image");


        if (empty($post_title) || empty($post_author) || empty($post_content)) {
            echo 'The following fields should not be empty Post Title, Post Author, Post Content';
        } else {

            $stmt = $conn->prepare("INSERT INTO posts(post_title,post_category_id,post_author,post_status,post_image,post_date,post_tags,post_content,post_comment_count) VALUES ('{$post_title}','{$post_category_id}','{$post_author}','{$post_status}','{$post_image}',Now(),'{$post_tags}','{$post_content}','{$post_comment_count}') ");
            $stmt->execute();

        }
    } catch (PDOException $e) {
        echo 'Error:' . $e->getMessage();
    }

    $last_id = $conn->lastInsertId();
    echo "<div class='alert alert-success'> Post successfully created. View post " . "<a href='../post.php?p_id={$last_id}'>Here</a></div>";
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label><br>
        <select name="post_category" value="">
            <?php
            $stmt = $conn->prepare("SELECT * FROM categories");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($stmt->fetchAll() as $row) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="">
            <option value='draft'>Select Status</option>
            <option value='published'>Published</option>
            <option value='draft'>Draft</option>
        </select>

    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id='' cols="30" rows='10'></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>