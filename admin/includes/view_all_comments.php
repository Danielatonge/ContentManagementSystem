                <table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>Id</th>
                                   <th>Author</th>
                                   <th>Email</th>
                                   <th>Content</th>
                                   <th>Status</th>
                                   <th>Date</th>
                                   <th>In Response to</th>
                                   <th>Approve</th>
                                   <th>Unapprove</th>                             
                                   
                                   
                               </tr>
                           </thead>
                           <tbody>
                              <?php 
                               $stmt = $conn->prepare('SELECT * FROM comments'); 
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

                                    
                            echo "<tr>";
                            echo "<td>{$comment_id}</td>";
                            echo "<td>{$comment_author}</td>";
                            echo "<td>{$comment_email}</td>";
                            echo "<td>{$comment_content}</td>";
                            echo "<td>{$comment_status}</td>";
                            echo "<td>{$comment_date}</td>";
                                    
                            $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id = {$comment_post_id}"); 
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            echo "<td>";
                            foreach($stmt->fetchAll() as $row) {
                            $post_id = $row['post_id'];
                            $comment = $row['post_title'];
                            
                                    
                            echo "<a href='../post.php?p_id={$post_id}'>$comment</a>";
                            
                            }
                            echo "</td>";                                
                            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";                                 
                            echo "<td><a href='comments.php?source1={$comment_id}'>Delete</a></td>";
                            echo "<td><a href='comments.php?source1=edit_comment&update={$comment_id}'>Edit</a></td>";
                            echo "</tr>";

                            }
                        
                        ?>
                               
                           </tbody>
                       </table>
                    
                      
                       <?php 

                         if(isset($_GET['approve'])) {
                            $comment_id = $_GET['approve'];
                            $comment_status = 'Approved';
                            
                            $stmt = $conn->prepare("UPDATE comments SET comment_status = '{$comment_status}' WHERE comment_id = {$comment_id}"); 
                            $stmt->execute();
                             header("Location: comments.php");
                        } 

                        if(isset($_GET['unapprove'])) {
                            $comment_id = $_GET['unapprove'];
                            $comment_status = 'Unapproved';
                            
                            $stmt = $conn->prepare("UPDATE comments SET comment_status = '{$comment_status}' WHERE comment_id = {$comment_id} "); 
                            $stmt->execute();
                            header("Location: comments.php");
                        }       


                        if(isset($_GET['source1'])) {
                            $comment_id = $_GET['source1'];
                            
                            $delstmt = $conn->prepare("DELETE FROM comments WHERE comment_id={$comment_id} "); 
                            $delstmt->execute();
                            header("Location: comments.php");
                        }

                        





                        ?>
                       