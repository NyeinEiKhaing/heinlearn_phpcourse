<?php
    
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $photo_arr = $_FILES['photo'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];

        // echo "$title,$category_id,$description <br>";
        print_r($photo_arr);
        // echo $photo_arr['size'];
        if( isset($photo_arr) && $photo_arr['size']>0){
            $dir = 'images/';
            $photo = $dir.$photo_arr['name'];
            $tmp_name = $photo_arr['tmp_name'];
            move_uploaded_file($tmp_name,$photo);

        }

        // $post_date = date('Y-m-d');
        // $created_by = 2;
        // $updated_by = 2;

        // $sql = "INSERT INTO posts (title,photo,description,category_id,post_date,created_by,updated_by) VALUES(:title,:photo,:description,:category_id,:post_date,:created_by,:updated_by)";
        // $stmt = $conn->prepare($sql);
        // $stmt ->bindParam(':title',$title);
        // $stmt ->bindParam(':photo',$photo);
        // $stmt ->bindParam(':description',$description);
        // $stmt ->bindParam(':category_id',$category_id);
        // $stmt ->bindParam(':post_date',$post_date);
        // $stmt ->bindParam(':created_by',$created_by);
        // $stmt ->bindParam(':updated_by',$updated_by);
        // $stmt->execute();

        // header("location:posts.php");

        $datas = [
            "title" =>$title,
            "photo" =>$photo,
            "description" =>$description,
            "category_id" =>$category_id,
            "post_date" =>date('Y-m-d'),
            "created_by" =>2,
            "updated_by" =>2
        ];
        
        store('posts',$datas,$conn);
        header("location:posts.php");

        // var_dump($datas);

    }else{
        include "layouts/nav.php";
?>
    <main>
        <div class="container-fluid px-3">
            <div class="card my-5">
                <div class="card-header">
                    <p class="d-inline">Post Create</p>
                    <a href="posts.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input class="form-control" type="file" id="photo" name="photo">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option selected>Select categories</option>
                                <?php
                                    $categories = selectJoins('categories','*',null,null,"id DESC",$conn);
                                    foreach($categories as $category){
                                ?>
                                <option value="<?php echo $category ['id']?>"><?php echo $category ['name']?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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