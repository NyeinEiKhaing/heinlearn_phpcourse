<?php
    
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    $id = $_GET['id'];
    $category = edit('categories',$id,$conn);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];

        $datas = [
            "name" =>$name,
            "created_by" => 2,
            "updated_by" =>2
        ];
        
        update('categories',$datas,$id,$conn);
        // store('categories',$datas,$conn);
        header("location:categories.php");

        // var_dump($datas);

    }else{
        include "layouts/nav.php";
?>
    <main>
        <div class="container-fluid px-3">
            <div class="card my-5">
                <div class="card-header">
                    <p class="d-inline">Categories Create</p>
                    <a href="categories.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value=" <?php echo $category['name'] ?>">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php
    include "layouts/footer.php";
    }
?>