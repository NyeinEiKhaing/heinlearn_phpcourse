<?php
    require "../dbconnect.php";
    require "../QueryBuilder.php";
    
    // $conn = connect();
    $users = select('users','*',$conn);

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        delete('users',$id,$conn);
        header("location: users.php");
    }

    include "layouts/nav.php";
    
?>
            
                <main>
                    <div class="container-fluid px-4">
                        
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">Users Lists</p>
                                <a href="user_create.php" class="btn btn-sm btn-primary float-end">Users Create</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($users as $user){
                                                
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $user['name'] ?></td>
                                            <td><?php echo $user['email'] ?></td>
                                            <td><?php echo $user['password'] ?></td>
                                            <td>
                                                <a href="user_edit.php?id=<?php echo $user['id']?>" class="btn btn-sm btn-success">Edit</a>

                                                <button type="submit" class="btn btn-sm btn-danger delete_id" data-id="<?php echo $user['id']?>" data-bs-toggle="modal" data-bs-target="#userDelete">Delete
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
 <div class="modal fade" id="userDelete">
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
                <form action="users.php" method="post">
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