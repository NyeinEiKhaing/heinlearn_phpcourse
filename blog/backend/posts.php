<?php
    include "../dbconnect.php";
    include "../QueryBuilder.php";
    
    $table = "posts";
    $cols = "posts.*, categories.name as c_name, users.name as u_name ";
    $join = "inner join categories on posts.category_id=categories.id inner join users on posts.created_by=users.id";
    $where = null;
    $order = "id desc";
    $posts = selectJoins($table, $cols, $join, $where, $order, $conn);

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        delete('posts',$id,$conn);
        header("location: posts.php");
    }

    include "layouts/nav.php";
?>
                <main>
                    <div class="container-fluid px-4">
                        
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">Posts Lists</p>
                                <a href="post_create.php" class="btn btn-sm btn-primary float-end">Post Create</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($posts as $post){
                                                
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $post['title'] ?></td>
                                            <td><?php echo $post['c_name'] ?></td>
                                            <td><?php echo $post['u_name'] ?></td>
                                            <td>
                                                <a href="post_edit.php?id=<?php echo $post['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger delete_id" data-id="<?php echo $post['id']?>" data-bs-toggle="modal" data-bs-target="#categoryDelete">Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

                <!--Delete Modal start -->
    <div class="modal fade" id="categoryDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title">Delete Tast</h1>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h3 class="text-center py-4">Are you sure delete?</h3>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="posts.php" method="post">
                    <input type="hidden" value="" id="delete_id" name="id">
                    <button type="submit" class="btn btn btn-danger">Delete</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
<?php
    include "layouts/footer.php";

?>