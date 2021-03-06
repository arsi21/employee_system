<?php include_once("server/check-access.php");?>

<!-- add server partials -->
<?php include_once("server/show-details.php");?>

<!-- add client partials -->
<?php include_once("partials/header.php")?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <div class="container">
        <div class="d-flex mt-2 mb-3">
            <a class="btn btn-outline-dark" href="index.php">
            <i class="bi bi-arrow-left-circle"></i> back</a>

            <button class="btn btn-secondary mx-2"  data-bs-toggle="modal" data-bs-target="#editEmployeeModal" >Edit</button>
            
            <?php 
                //start session
                if(!isset($_SESSION)){
                    session_start();
                }

                //check if the user is admin
                if(isset($_SESSION['access'])){
                    if($_SESSION['access'] == "admin"){
                ?>
                <!-- if admin show delete button for deleting details -->
                <form action="server/delete.php" method="post">
                    <input type="hidden" value="<?php echo $row['id']?>" name="id">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
                <?php
                    }
                }
            ?>
        </div>

        <p class="mb-0">Name:</p>
        <h2><?php echo $row['first_name']?> <?php echo $row['last_name']?></h2>

        <p class="mb-0">Gender:</p>
        <p class="lead"><?php echo $row['gender']?></p>

        <p class="mb-0">Birthday:</p>
        <p class="lead"><?php echo $row['birthday']?></p>

        <p class="mb-0">Address:</p>
        <p class="lead"><?php echo $row['address']?></p>

        <p class="mb-0">email:</p>
        <p class="lead"><?php echo $row['email']?></p>

    </div>


     <!-- Modal -->
     <form action="server/edit-details.php" method="get">
        <div class="modal fade" id="editEmployeeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" name="id"  value="<?php echo $row['id'];?>" required>



                <?php 
                    //for showing error
                    if(isset($_GET['errorMsg'])){
                        $errorMsg = $_GET['errorMsg'];

                        if($errorMsg == "fname"){
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
                        }elseif($errorMsg == "gender"){
                            echo '
                                <div class="alert alert-warning" role="alert">
                                    Invalid gender!
                                </div>
                            ';
                        }elseif($errorMsg == "bday"){
                            echo '
                                <div class="alert alert-warning" role="alert">
                                    Invalid birthday!
                                </div>
                            ';
                        }elseif($errorMsg == "address"){
                            echo '
                                <div class="alert alert-warning" role="alert">
                                    Address contains an invalid character!
                                </div>
                            ';
                        }elseif($errorMsg == "email"){
                            echo '
                                <div class="alert alert-warning" role="alert">
                                    Email contains an invalid character!
                                </div>
                            ';
                        }elseif($errorMsg == "emptyField"){
                            echo '
                                <div class="alert alert-warning" role="alert">
                                    Fill up all fields!
                                </div>
                            ';
                        }
                    }
                ?>






                <?php
                    //for showing the inputed value
                    if(isset($_GET['fname']) || isset($_GET['lname']) || isset($_GET['gender']) || isset($_GET['bday']) || isset($_GET['address']) || isset($_GET['email'])){
                        //get data from the add-user
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

                        if(isset($_GET['gender'])){
                            $gender = $_GET['gender'];
                        }else{
                            $gender = "";
                        }

                        if(isset($_GET['bday'])){
                            $bday = $_GET['bday'];
                        }else{
                            $bday = "";
                        }

                        if(isset($_GET['address'])){
                            $address = $_GET['address'];
                        }else{
                            $address = "";
                        }

                        if(isset($_GET['email'])){
                            $email = $_GET['email'];
                        }else{
                            $email = "";
                        }
                ?>
                        <div class="mb-3">
                            <label for="fname-input" class="form-label">First Name</label>
                            <input id="fname-input" type="text" class="form-control" name="fname" value="<?php echo $fname;?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="lname-input" class="form-label">Last Name</label>
                            <input id="lname-input" type="text" class="form-control" name="lname" value="<?php echo $lname;?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender-input" class="form-label">Gender</label>
                                <select name="gender" id="gender-input"  class="form-select" required>
                                    <option value="Male" <?php echo ($gender == "Male")? 'selected' : '';?>>Male</option>
                                    <option value="Female" <?php echo ($gender == "Female")? 'selected' : '';?>>Female</option>
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="bday-input" class="form-label">Birhtday</label>
                            <input id="bday-input" type="date" class="form-control" name="bday" value="<?php echo $bday;?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="bday-input" class="form-label">Address</label>
                            <input id="bday-input" type="text" class="form-control" name="address" value="<?php echo $address;?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="bday-input" class="form-label">Email</label>
                            <input id="bday-input" type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
                        </div>
                <?php
                    }else{
                ?>
                        <!-- for showing input fields -->
                        <div class="mb-3">
                            <label for="fname-input" class="form-label">First Name</label>
                            <input id="fname-input" type="text" class="form-control" name="fname"  value="<?php echo $row['first_name'];?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="lname-input" class="form-label">Last Name</label>
                            <input id="lname-input" type="text" class="form-control" name="lname" value="<?php echo $row['last_name'];?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender-input" class="form-label">Gender</label>
                                <select name="gender" id="gender-input" class="form-select" required>
                                    <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '';?>>Male</option>
                                    <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '';?>>Female</option>
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="bday-input" class="form-label">Birhtday</label>
                            <input id="bday-input" type="date" class="form-control" name="bday" value="<?php echo $row['birthday'];?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="grade-input" class="form-label">Address</label>
                            <input id="grade-input" type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="grade-input" class="form-label">Email</label>
                            <input id="grade-input" type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" required>
                        </div>
                <?php
                    }
                ?>




            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="edit">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </form>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        //open modal if have an error
        if(<?php echo(isset($_GET['errorMsg']));?>){
            $(document).ready(function(){
                $("#editEmployeeModal").modal('show');
            });
        }
    </script>

<!-- add client partials -->
<?php include_once("partials/footer.php")?>