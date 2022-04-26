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

                    <form action="../server/add-user.php" method="post">
                        <?php 
                            //for showing error
                            if(isset($_GET['errorMsg'])){
                                $errorMsg = $_GET['errorMsg'];

                                if($errorMsg == "id"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            The ID contains an invalid character!
                                        </div>
                                    ';

                                }elseif($errorMsg == "fname"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            First name contains an invalid character!
                                        </div>
                                    ';

                                }elseif($errorMsg == "lname"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Last name contains an invalid character!
                                        </div>
                                    ';

                                }elseif($errorMsg == "username"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            The username contains an invalid character!
                                        </div>
                                    ';

                                }elseif($errorMsg == "password"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Password should be at least 5 characters long!
                                        </div>
                                    ';

                                }elseif($errorMsg == "conPassword"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Confirm password should be at least 5 characters long!
                                        </div>
                                    ';

                                }elseif($errorMsg == "userTaken"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Username is already taken!
                                        </div>
                                    ';

                                }elseif($errorMsg == "passNotMatch"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Password and confirm password did not match!
                                        </div>
                                    ';

                                }elseif($errorMsg == "dataNotFound"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Data not found! Make sure you type your information correctly.
                                        </div>
                                    ';

                                }elseif($errorMsg == "fillUpAll"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Fill up all field!
                                        </div>
                                    ';

                                }
                            }
                        ?>



                        <?php
                            //for showing the inputed value
                            if(isset($_GET['id']) || isset($_GET['fname']) || isset($_GET['lname']) || isset($_GET['username'])){
                                //get data from the add-user
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                }else{
                                    $id = "";
                                }

                                if(isset($_GET['fname'])){
                                    $fname = $_GET['fname'];
                                }else{
                                    $fname = "";
                                }

                                if(isset($_GET['lname'])){
                                    $lname = $_GET['lname'];
                                }else{
                                    $lname = "";
                                }

                                if(isset($_GET['username'])){
                                    $username = $_GET['username'];
                                }else{
                                    $username = "";
                                }
                        ?>
                                <div class="mb-3">
                                    <label for="id-input" class="form-label">ID</label>
                                    <input id="id-input" type="number" class="form-control" name="id" value="<?php echo $id;?>" required>
                                    <div class="form-text">This ID is provided by the admin. If you don't have an ID, please contact the admin. <a href="">admin@gmail.com</a></div>
                                </div>
        
                                <div class="mb-3">
                                    <label for="fname-input" class="form-label">First Name</label>
                                    <input id="fname-input" type="text" class="form-control" name="fname" value="<?php echo $fname;?>" required>
                                </div>
        
                                <div class="mb-3">
                                    <label for="lname-input" class="form-label">Last Name</label>
                                    <input id="lname-input" type="text" class="form-control" name="lname" value="<?php echo $lname;?>" required>
                                </div>
        
        
                                <div class="mb-3 mt-5">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required>
                                </div>
        
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
        
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="conPassword" required>
                                </div>
                        <?php
                            }else{
                        ?>
                                <!-- for showing input fields -->
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
                        <?php
                            }
                        ?>
                        
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>

                    <p class="mt-4 text-black-50">Have already an account? <a href="login.php">login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>