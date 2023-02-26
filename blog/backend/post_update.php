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
                    <p class="d-inline">Post Update</p>
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
                                    $categories = select('categories','*',$conn);
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