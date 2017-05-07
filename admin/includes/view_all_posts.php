<?php

    include "delete_modal.php";

    if(isset($_POST['checkBoxArray'])) {
        
     foreach($_POST['checkBoxArray'] as $checkBoxValue){
         $bulk_options = $_POST['bulk_options'];
         
         switch ($bulk_options) {
             case 'published':
                 
                $stmt = $conn->prepare("UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}"); 
                $stmt->execute();
                 header("Location: posts.php");
                   
                 break;
                 
            case 'draft':

                $stmt = $conn->prepare("UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}"); 
                $stmt->execute();
                 header("Location: posts.php");

                 break;
                 
             case 'delete':

                $delstmt = $conn->prepare("DELETE FROM posts WHERE post_id={$checkBoxValue} "); 
                $delstmt->execute();
                header("Location: posts.php");

                 break;
            case 'clone':
                 
                $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id={$checkBoxValue}"); 
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                foreach($stmt->fetchAll() as $row) {
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                
                }
                 
                $clonestmt = $conn->prepare("INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ('{$post_category_id}','{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}') "); 
                $clonestmt->execute();
                header("Location: posts.php");

                 break;
                 
             default:
                 header("Location: posts.php");
                 break;
                 
         }
         
     }
        
        
    }

?>                 
                          
             <form action="" method="post">                         
                          
                    <div id="bulkOptionContainer" class="col-xs-4" style="padding:0px;">
                        <select name="bulk_options" id="" class="form-control">
                            <option value="">Select Option</option>
                            <option value="published">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="delete">Delete</option>
                            <option value="clone">Clone</option>
                        </select>

                    </div>            
                    <div class="col-xs-4">
                        <input name="submit" class="btn btn-success" type="submit" value="Apply">
                        <a href="posts.php?source=add_posts" class="btn btn-primary" name="">Add New</a>
                    </div>                      

                    <br><br>
                        
                        <table class="table table-bordered table-hover">
                          
                           
                            
                           <thead>
                               <tr>
                                  <th><input id="selectAllBoxes" type="checkbox"></th>
                                   <th>Id</th>
                                   
                                   <th>Author</th>
                                   <th>Title</th>
<!--                                   <th>User</th>-->
                                   <th>Content</th>
                                   <th>Status</th>
                                   <th>Image</th>
                                   <th>Tags</th>
                                   <th>Comment</th>
                                   <th>Date</th>
                                   <th>Post Views Count</th>
                                   <th>Category</th>                             
                                   <th>View Post</th>
                                   <th>Delete</th>
                                   <th>Edit</th>
                                   
                               </tr>
                           </thead>
                           <tbody>
                              <?php 
                                $stmt = $conn->prepare('SELECT * FROM posts'); 
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                foreach($stmt->fetchAll() as $row) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_user = $row['post_user'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = substr($row['post_content'], 0 , 100);
                                $post_tags = $row['post_tags'];
                                $post_status = $row['post_status'];
                                $post_category_id = $row['post_category_id'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_views_count = $row['post_views_count'];

                                    
                            echo "<tr>";
                                ?>
                                
                              <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id;?>'></td>   
                                
                                <?php
                           
                            echo "<td>$post_id</td>";
                            echo "<td>{$post_author}</td>";
                            echo "<td>{$post_title}</td>";
//                            echo "<td>{$post_user}</td>";
                            echo "<td>{$post_content}</td>";
                            echo "<td>{$post_status}</td>";
                            echo "<td><img width='100' src='../images/{$post_image}'></td>";
                            echo "<td>{$post_tags}</td>";   
                            echo "<td>{$post_comment_count}</td>";
                            echo "<td>{$post_date}</td>";
                            echo "<td>{$post_views_count}</td>";
                                    
                            $stmt = $conn->prepare("SELECT * FROM categories WHERE cat_id = {$post_category_id}"); 
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            echo "<td>";
                            foreach($stmt->fetchAll() as $row) {
//                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            
                                    
                            echo $cat_title;
                            
                            }
                            echo "</td>";        //posts.php?delete={$post_id}
                            
                            echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
                            echo "<td><a rel='{$post_id}' href='' class='delete_link' data-toggle='modal' data-target='#myModal'>Delete</a></td>";
                            echo "<td><a href='posts.php?source=edit_post&update={$post_id}'>Edit</a></td>";
                            echo "</tr>";

                            }
                        
                        ?>
                               
                           </tbody>
                       </table>
                       
                       
         </form>               
                       <?php 

                            if(isset($_GET['delete'])) {
                                $post_id = $_GET['delete'];

                                $delstmt = $conn->prepare("DELETE FROM posts WHERE post_id={$post_id} "); 
                                $delstmt->execute();
                                header("Location: posts.php");
                            }       
                        
                        ?>
        <script src="js/jquery.js"></script>            
        <script>
            $(document).ready(function(){
                
                $('.delete_link').on('click', function(){
                    var id = $(this).attr('rel');
                    var delete_url = 'posts.php?delete='+ id +'';
                        
                    $('.modal_delete_link').attr('href', delete_url);
                    
                });
                
            });



        </script>