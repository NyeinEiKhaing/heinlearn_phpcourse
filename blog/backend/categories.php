<?php
    require "../dbconnect.php";
    require "../QueryBuilder.php";
    
    $categories = select('categories','*',$conn);

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        delete('categories',$id,$conn);
        header("location: categories.php");
    }

    include "layouts/nav.php";
    
?>
            
                <main>
                    <div class="container-fluid px-4">
                        
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">Categories Lists</p>
                                <a href="category_create.php" class="btn btn-sm btn-primary float-end">Categories Create</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($categories as $category){
                                                
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $category['name'] ?></td>
                                            <td>
                                            <a href="category_edit.php?id=<?php echo $category['id']?>" class="btn btn-sm btn-success">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger delete_id" data-id="<?php echo $category['id']?>" data-bs-toggle="modal" data-bs-target="#categoryDelete">Delete
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
                <form action="categories.php" method="post">
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