<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Employee System</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">EmployeeInfo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse d-flex-md justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav mt-3 mt-md-0 mt-lg-0">
                    <form class="d-flex pl-2" action="result.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" name="search">
                        <button class="btn btn-light" type="submit" name="searchBtn">Search</button>
                    </form>
                </div>

                <div>
                    <?php 
                    //check if the user is regular
                    if(isset($_SESSION['access'])){
                        if($_SESSION['access'] == "regular"){
                    ?>
                        <!-- if user is regular show the view details link -->
                        <a class="btn btn-outline-light mt-2 mt-md-0 mt-lg-0 me-lg-1" href="employee-details.php?id=<?php echo $_SESSION['employee_id']?>">View details</a>
                    <?php
                        }
                    }
                    ?>
                <div class="btn-group mt-2 mt-md-0 mt-lg-0" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <?php 
                            //check if the user is admin or regular
                            if(isset($_SESSION['access'])){
                                if($_SESSION['access'] == "admin" || $_SESSION['access'] == "regular"){
                                    echo $_SESSION['username'];
                                }
                            }
                        ?>
                        
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <?php if(isset($_SESSION['access'])){?>
                                <a class="dropdown-item" href="../server/logout.php">Logout</a>
                            <?php }?>
                        </li>
                    </ul>
                </div>
                </div>

            </div>
        </div>
    </nav>