<?php
if (isset($_GET['update'])) {
    
    try {
                                $comment_id = $_GET['update'];
        
        
                    //updates the comment in the comments table    
            
                    if(isset($_POST['update_comment'])) {
                    $comment_email = $_POST['email'];
                    $comment_author = $_POST['author'];
                    $comment_status = $_POST['status'];
                    $comment_content = $_POST['content'];
                    $comment_post_id = $_POST['comment_post_id'];


                    if (empty($comment_email) || empty($comment_author) || empty($comment_content)){
                    echo 'The following fields should not be empty Email, Author, Content';
                    } else {

                    $stmt = $conn->prepare("UPDATE comments SET comment_email = '{$comment_email}', comment_post_id = '{$comment_post_id}', comment_author = '{$comment_author}', comment_status = '{$comment_status}', comment_date = Now(), comment_content = '{$comment_content}' WHERE comment_id = '{$comment_id}' ");
                    $stmt->execute(); 

                    }
                        echo "<div class='alert alert-success'> Comment successfully Updated. View comment " . "<a href='comments.php'>Here</a></div>";

                    }
        
                                //Select the comment to be edited from the comments table
        
                                $stmt = $conn->prepare("SELECT * FROM comments WHERE comment_id={$comment_id}"); 
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                foreach($stmt->fetchAll() as $row) {
                                $comment_id = $row['comment_id'];
                                $comment_author = $row['comment_author'];
                                $comment_date = $row['comment_date'];
                                $comment_email = $row['comment_email'];
                                $comment_content = $row['comment_content'];
                                $comment_status = $row['comment_status'];
                                $comment_post_id = $row['comment_post_id'];
                                }
                                
        
       
 ?> 
 
  
  <form action="" method="post" enctype="multipart/form-data">

       
    <div class="form-group">
       <label for="title">Author</label>
       <input type="text" class="form-control" name="author" value="<?php echo $comment_author; ?>">
    </div>
    
    <div class="form-group">
       <label for="title">Comment post</label><br>
       <select name="comment_post_id" value="">
       <?php 
            $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id = {$comment_post_id}"); 
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach($stmt->fetchAll() as $row) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
                echo "<option value='{$post_id}'>{$post_title}</option>";
            }
        
        ?>
        </select>
    </div>
           
    <div class="form-group">
       <label for="title">Email</label>
       <input type="text" class="form-control" name="email" value="<?php echo $comment_email; ?>">
    </div>
    
    <div class="form-group">
       <label for="comment_status">Status</label>
       <input type="text" class="form-control" name="status" value="<?php echo $comment_status; ?>">
    </div>
    
        
    <div class="form-group">
       <label for="comment_content">Content</label>
        <textarea class="form-control" name="content" id='' cols="30" rows='10'><?php echo $comment_content; ?>    
        </textarea>
    </div>
    
    <div class="form-group">
       <input type="submit" class="btn btn-primary" name="update_comment" value="Save">
    </div>
</form>






<?php 
 } catch (PDOException $e) {
            echo 'Error:' .$e->getMessage();
        }    
    
}
 
?>

