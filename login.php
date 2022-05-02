<?php include("server/verify-login.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Login</title>
    <script src="jquery.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="card col-md-7 col-lg-5">
                <div class="card-body p-4">
                    <h1 class="card-title mb-4">Login</h1>

                    <form action="" method="post">
                        <?php 
                            //for showing error
                            if(isset($_GET['errorMsg'])){
                                $errorMsg = $_GET['errorMsg'];

                                if($errorMsg == "username"){
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

                                }elseif($errorMsg == "noUserFound"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            No username found!
                                        </div>
                                    ';

                                }elseif($errorMsg == "completeInfo"){
                                    echo '
                                        <div class="alert alert-warning" role="alert">
                                            Complete the information needed!
                                        </div>
                                    ';

                                }elseif($errorMsg == "wrongPassword"){
                                    echo '
                                        <div id="errorMsgDiv" class="alert alert-warning" role="alert">
                                            Wrong password!
                                            <br>
                                            <span class="fw-bold">'
                                            .$_GET['attempt'].
                                            '</span>
                                        </div>
                                    ';

                                }elseif($errorMsg == "loginRequired"){
                                    echo '
                                        <div id="errorMsgDiv" class="alert alert-warning" role="alert">
                                            Log in is required!
                                        </div>
                                    ';

                                }
                            }
                        ?>


                        <!-- Display the countdown timer in an element -->
                        <div id="countDownCont" class="alert alert-warning" role="alert" style="display:none;">
                            <span>You can log in again in: </span>
                            <span id="countDownElem"></span>
                        </div>



                        <?php
                            //for showing the inputed value
                            if(isset($_GET['username'])){
                                //get data from the verify-login
                                $username = $_GET['username'];
                        ?>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                        <?php
                            }else{
                        ?>
                                <!-- for showing input fields -->
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                        <?php
                            }
                        ?>

                        <button type="submit" class="btn btn-primary" name="loginBtn">Login</button>

                    </form>

                    <p class="mt-4 text-black-50">Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>


    <script>
        const countDownCont = document.getElementById("countDownCont");

        // Set the date we're counting down to
        var database_lock_date = 
            "<?php 
                $get_lock_date = mysqli_query($con, "SELECT * FROM user WHERE username = '$_SESSION[username]'");
                while($row = mysqli_fetch_array($get_lock_date)){
                    echo $row['lock_date'];
                }
            ?>";
        var countDownDate = new Date(database_lock_date).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="countDownElem"
            if(database_lock_date != "")
                countDownCont.style.display = "block";
                document.getElementById("countDownElem").innerHTML = minutes + "m " + seconds + "s ";
                if(document.getElementById("errorMsgDiv") != null){
                    const errorMsgDiv = document.getElementById("errorMsgDiv");
                    if(countDownCont.style.display == "block"){
                    errorMsgDiv.style.display = "none";
                }
                }

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                countDownCont.style.display = "none";
                document.getElementById("countDownElem").innerHTML = "";
                
                $.ajax({
                    url: "server/reset-lock-date.php",
                    method: "POST",
                    data: {

                    },
                    success:function(){
                        alert("You can login again");
                    }
                });
            }
        }, 1000);
    </script>
</body>
</html>