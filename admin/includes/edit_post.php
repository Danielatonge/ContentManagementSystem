
<?php
if (isset($_GET['update'])) {
    
    try {
                    $p_id = $_GET['update'];
        
        
                     //updates post in the posts table 
                    if(isset($_POST['update_post'])) {
                    $post_title = $_POST['title'];
                    $post_category_id = $_POST['post_category'];
                    $post_author = $_POST['author'];
                    $post_status = $_POST['post_status'];

                    $post_image = $_FILES['image']['name'];
                    $post_image_temp = $_FILES['image']['tmp_name'];

                    $post_date = date('d-m-Y');
                    $post_tags = $_POST['post_tags'];
                    $post_content = $_POST['post_content'];

                    move_uploaded_file($post_image_temp, "../images/$post_image");

                        if(empty($post_image)) {
                            $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id = '{$p_id}'"); 
                            $stmt->execute();

                            foreach($stmt->fetchAll() as $row){
                                $post_image = $row['post_image'];
                            }
                        }


                        if (empty($post_title) || empty($post_author) || empty($post_content)){
                        echo 'The following fields should not be empty Post Title, Post Author, Post Content';
                        } else {

                            $stmt = $conn->prepare("UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_author = '{$post_author}', post_status = '{$post_status}', post_image = '{$post_image}', post_date = Now(), post_tags = '{$post_tags}', post_content = '{$post_content}' WHERE post_id = '{$p_id}' ");
                            $stmt->execute(); 

                        }

                        echo "<div class='alert alert-success'> Post successfully Updated. View post " . "<a href='../post.php?p_id={$p_id}'>Here</a> OR  Edit more posts <a href='posts.php'>Here</a></div>";

                    }
                                
                                //Selects the post to be updated from the posts table    
                                $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id={$p_id}"); 
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                foreach($stmt->fetchAll() as $row) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_user = $row['post_user'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                                $post_tags = $row['post_tags'];
                                $post_status = $row['post_status'];
                                $post_category_id = $row['post_category_id'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_views_count = $row['post_views_count'];
                                }
                                
        
       
 ?> 
 
  
  <form action="" method="post" enctype="multipart/form-data">
   
   <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>
    
   <div class="form-group">
       <label for="post_category">Category</label>
       <br>
       <select name="post_category" value="">
           <?php
            $stmt = $conn->prepare("SELECT * FROM categories"); 
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach($stmt->fetchAll() as $row) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>           
           
       </select>
       
    </div>
    
    <div class="form-group">
       <label for="title">Post Author</label>
       <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
    </div>
    
    <div class="form-group">
       <label for="post_status">Post Status</label><br>
       <select name="post_status" id="">
            
          <?php
            echo "<option value='$post_status'>$post_status</option>";
            if($post_status == 'draft' || $post_status == 'Draft'){
                echo "<option value='published'>Published</option>";
            } else {
                echo "<option value='draft'>Draft</option>";
            }
        
           ?>
       </select>
       
    </div>
    
    <div class="form-group">
       <label for="post_image">Post Image</label><br>
       <img width='100' src="../images/<?php echo $post_image?>"><br><br>
       <input type="file" name="image">
    </div>
    
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    
    <div class="form-group">
       <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id='' cols="30" rows='10'><?php echo $post_content; ?>    
        </textarea>
    </div>
    
    <div class="form-group">
       <input type="submit" class="btn btn-primary" name="update_post" value="Save">
    </div>
</form>






<?php 
 } catch (PDOException $e) {
            echo 'Error:' .$e->getMessage();
        }    
    
}
 
?>

