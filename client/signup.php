<!-- add server partials -->
<?php 
//include_once("../server/add.php");
include_once("../server/add-user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Signup</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="card col-md-7 col-lg-5">
                <div class="card-body p-4">
                    <h1 class="card-title mb-4">Sign Up</h1>

                    <form action="" method="post">

                        <div class="mb-3">
                            <label for="id-input" class="form-label">ID</label>
                            <input id="id-input" type="number" class="form-control" name="id" required>
                            <div class="form-text">This ID is provided by the admin. If you don't have an ID, please contact the admin. <a href="">admin@gmail.com</a></div>
                        </div>

                        <div class="mb-3">
                            <label for="fname-input" class="form-label">First Name</label>
                            <input id="fname-input" type="text" class="form-control" name="fname" required>
                        </div>

                        <div class="mb-3">
                            <label for="lname-input" class="form-label">Last Name</label>
                            <input id="lname-input" type="text" class="form-control" name="lname" required>
                        </div>





                        <div class="mb-3 mt-5">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="conPassword" required>
                        </div>

                        <?php if(isset($errorMsg)){ echo $errorMsg;}?>
                        
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>

                    <p class="mt-4 text-black-50">Have already an account? <a href="login.php">login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>