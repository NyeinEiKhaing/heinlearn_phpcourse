<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    require "../dbconnect.php";
    require "../QueryBuilder.php";
     
    $id = $_GET['id'];

    $post = edit('posts',$id,$conn);
    

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

        }else{
            $photo = $_POST['old_photo'];
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
        
        update('posts',$datas,$id,$conn);
        // store('posts',$datas,$conn);
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
                            <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>">
                        </div>

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="old_photo-tab" data-bs-toggle="tab" data-bs-target="#old_photo-tab-pane" type="button" role="tab" aria-controls="old_photo-tab-pane" aria-selected="true">Old Photo</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="new_photo-tab" data-bs-toggle="tab" data-bs-target="#new_photo-tab-pane" type="button" role="tab" aria-controls="new_photo-tab-pane" aria-selected="false">New Photo</button>
                            </li>
                        </ul>
                        <div class="tab-content mb-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="old_photo-tab-pane" role="tabpanel" aria-labelledby="old_photo-tab" tabindex="0">
                                <input type="hidden" name="old_photo" value="<?= $post['photo'] ?>">
                                <img src="<?= $post['photo'] ?>" width="200px" alt="">
                            </div>
                            <div class="tab-pane fade" id="new_photo-tab-pane" role="tabpanel" aria-labelledby="new_photo-tab" tabindex="0">
                                <input class="form-control" type="file" id="photo" name="photo">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option selected>Select categories</option>
                                <?php
                                    $categories = selectJoins('categories','*',null,null,"id DESC",$conn);
                                    foreach($categories as $category){
                                ?>
                                <option value="<?php echo $category ['id']?>" <?php if($post['category_id'] == $category['id']){
                                    echo "selected";
                                } ?> ><?php echo $category ['name']?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"> <?= $post['description'] ?> </textarea>
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