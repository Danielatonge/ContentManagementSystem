                     <form action="" method="post">
                               <div class="form-group">
                                 <label for="cat_title">Edit Category:</label>
                                 <?php 
                                   //To edit categories
                                   if (isset($_GET['update'])) {
                                       $cat_id = $_GET['update'];
                                     
                                       
                                    $editstmt = $conn->prepare("SELECT * FROM categories WHERE cat_id={$cat_id} "); 
                                    $editstmt->execute();
                                    //$editstmt->setFetchMode(PDO::FETCH_ASSOC);

                                foreach($editstmt->fetchAll() as $row) {
                                    //$cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                       
                                    ?>
                                    
                                    
                                
                                <input value="<?php if(isset($cat_title)) { echo $cat_title;}?>" class="form-control" type="text" name="cat_title_update">    
                                                            
                                
                                
                                <?php       } 
                                       }  ?>
                                       
                                       <?php
                                   //Update category                                   
                                   if (isset($_POST['update_category'])) {
                                       $cat_id = $_GET['update'];
                                       $up_cat_title = $_POST['cat_title_update'];
                                      try{ 
                                       if ($up_cat_title === '' || empty($up_cat_title)){
                                        echo 'This field should be modified';
                                        } else {
                                       
                                        $upstmt = $conn->prepare("UPDATE categories SET cat_title='{$up_cat_title}' WHERE cat_id={$cat_id}" ); 
                                        $upstmt->execute();
                                        
                                        }
                                      } catch (PDOException $e) {
                                            echo 'Error:' .$e->getMessage();
                                      }
                                       
                                   }
                                   
                                   
                                   ?>
                              
                               </div>
                               <div class="form-group">
                                   <input class="btn btn-primary" type="submit" name="update_category" value="Save">
                               </div>
                           </form>