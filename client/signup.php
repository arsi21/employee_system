<!-- add server partials -->
<?php include_once("../server/add-user.php");?>

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
                            <label for="fname-input" class="form-label">First Name</label>
                            <input id="fname-input" type="text" class="form-control" name="fname" required>
                        </div>

                        <div class="mb-3">
                            <label for="lname-input" class="form-label">Last Name</label>
                            <input id="lname-input" type="text" class="form-control" name="lname" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender-input" class="form-label">Gender</label>
                                <select name="gender" id="gender-input"  class="form-select" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="bday-input" class="form-label">Birhtday</label>
                            <input id="bday-input" type="date" class="form-control" name="bday" required>
                        </div>

                        <div class="mb-3">
                            <label for="bday-input" class="form-label">Address</label>
                            <input id="bday-input" type="text" class="form-control" name="address" required>
                        </div>

                        <div class="mb-3">
                            <label for="bday-input" class="form-label">Email</label>
                            <input id="bday-input" type="email" class="form-control" name="email" required>
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
                        
                        <button type="submit" class="btn btn-primary" name="signup">Submit</button>
                    </form>

                    <p class="mt-4 text-black-50">Have already an account? <a href="login.php">login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>