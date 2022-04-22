<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="../server/verify-login.php" method="post">
        <label for="">Username</label>
        <input type="text" name="username">

        <label for="">Password</label>
        <input type="password" name="password">

        <input type="submit" value="Login" name="loginBtn">
    </form>
</body>
</html>