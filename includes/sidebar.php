              
              <div class="col-md-4">

           
               
               
            <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>
                
                
                <!-- Login Form -->
                <div class="well">
                   
                   <?php
                    if(empty($_SESSION['username'])){
                    
                    ?>
                    <h4>Login</h4>
                    <form action="/includes/login.php" method="post">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        
                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter Password">
                            <span class="input-group-btn">
                                <button name="login" class="btn btn-primary" type="submit"> Submit
                                </button>
                            </span>
                        </div>
                        
                        
                    </form><!--search form-->
                    <?php
                     } else {
                     
                    ?>
                    <h4>You are logged in as <?php echo $_SESSION['username'];?></h4>
                    
                    <a href='includes/logout.php' class="btn btn-primary"> Log out
                    </a>
                    <!-- /.input-group -->
                    <?php
                    }
                    ?>
                </div>
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                   
                   <?php 
                    
                    $stmt = $conn->prepare('SELECT * FROM categories'); 
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);

                  
                      

                    ?>      
                   
                   
                   
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                               
                               
                               <?php 
                                foreach($stmt->fetchAll() as $row) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];

                                    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";

                                }
                                
                                ?>
                                
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                    </div>
                    <!-- /.row -->
                </div>

               
               
                <!-- Side Widget Well -->
                <?php include "widgets.php"; ?>

            </div>