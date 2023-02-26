<?php
    include "layouts/nav.php";
    require "QueryBuilder.php";
    require "dbconnect.php";

    $post_id = $_GET['id'];
    // echo $post_id;

    $table = 'posts';
    $cols = 'posts.*,categories.name as c_name,users.name as u_name';
    $join = "inner join categories on posts.category_id=categories.id inner join users on posts.created_by=users.id";
    $id = $post_id;
    

    $post = show($table,$cols,$join,$id,$conn);
    // var_dump ($post);
    $categories = selectJoins('categories','*',null,null,null,$conn);

?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php echo $post['title'] ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">
                                Posted on
                                <?php
                                    $post_date_str = strtotime($post['post_date']);
                                    echo date('F d, Y',$post_date_str);
                                ?>
                                by <?php echo $post['u_name'] ?>
                            </div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="category_posts.php?id=<?php echo $post['category_id'] ?>">#<?php 
                           echo $post['c_name'] ?></a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="backend/<?php echo $post['photo'] ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <?php echo $post ['description'] ?>
                        </section>
                    </article>
                </div>

                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            <?php
                                                foreach($categories as $category){
                                            ?>
                                                <li><a href="category_posts.php?id=<?php echo $category['id']?>">#<?php echo $category['name'] ?></a></li>
                                            <?php
                                                }
                                            ?>
                
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 <?php
    include "layouts/footer.php";
 ?>   