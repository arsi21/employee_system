<!-- add server partials -->
<?php 
include_once("../server/search.php");
include_once("../server/check-access.php");
?>


<!-- add client partials -->
<?php include_once("partials/header.php");?>

    <div class="container">
        <h1 class="h3 my-3">List of Employee</h1>

        <?php 
        //check if the user is admin
        if(isset($_SESSION['access'])){
            if($_SESSION['access'] == "admin"){
        ?>
        <!-- if admin show add button -->
        <button  class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#addStudentModal">Add New</button>
        <?php
            }
        }
        ?>
        
    </div>

    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>

                    <?php 
                    //start session
                    if(!isset($_SESSION)){
                        session_start();
                    }

                    //check if the user is admin
                    if(isset($_SESSION['access'])){
                        if($_SESSION['access'] == "admin"){
                    ?>
                    <!-- if yes show action th -->
                    <th>Action</th>
                    <?php
                        }
                    }
                    ?>
                    
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
        
            <tbody>
        <?php //output data of each row
        while($row = $result->fetch_assoc()) {?>
                <tr>

                    <?php 
                    //start session
                    if(!isset($_SESSION)){
                        session_start();
                    }

                    //check if the user is admin
                    if(isset($_SESSION['access'])){
                        if($_SESSION['access'] == "admin"){
                    ?>
                    <!-- if admin show view link for showing data -->
                    <td><a href="details.php?id=<?php echo $row['id']?>">view</a></td>
                    <?php
                        }
                    }
                    ?>
                   
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                </tr>
        <?php }?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <form action="../server/add.php" method="post">
        <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
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
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Add</button>
            </div>
            </div>
        </div>
        </div>
    </form>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- add client partials -->
<?php include_once("partials/footer.php")?>