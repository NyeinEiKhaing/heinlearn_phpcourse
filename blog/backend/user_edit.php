<?php
    
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    $id = $_GET['id'];
    $user = edit('users',$id,$conn);


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $datas = [
            "name" =>$name,
            "email" =>$email,
            "password" =>$password,
            "role" => 2, 
        ];

        update('users',$datas,$id,$conn);
        // store('users',$datas,$conn);
        header("location:users.php");

        // var_dump($datas);

    }else{
        include "layouts/nav.php";
?>
    <main>
        <div class="container-fluid px-3">
            <div class="card my-5">
                <div class="card-header">
                    <p class="d-inline">Users Edit</p>
                    <a href="users.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="<?php echo $user['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" id="password" name="password" value="<?php echo $user['password'] ?>">
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