<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/admin_styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <!--[endif]-->

    <?php include '../includes/db_connection.php'; ?>

    <?php
    session_start();
    ob_start();
    ?>

</head>

<body>

<div class="container col-md-4 col-md-offset-4">

    <form class="form-signin" name="login" action="" method="post" role="form">
        <h2 class="form-signin-heading white">Kontrolpanel - Log ind</h2><br>
        <input type="email" name="email" class="form-control" placeholder="Email" required><br>
        <input type="password" name="adgangskode" class="form-control" placeholder="Adgangskode" required><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="Submit" value="Log ind">Log ind</button>
    </form>

    <?php
    if (isset($_POST['Submit'])) {
        $username = $_POST['email'];
        $password = $_POST['adgangskode'];

        $sql = "SELECT * FROM brugere WHERE Email='$username'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);
        $hash = $row['Adgangskode'];


        if (password_verify($password, $hash)) {
            $_SESSION['email'] = $row['Email'];
            $_SESSION['user_id'] = $row['Id'];

            $time = time();
            $sql = "UPDATE brugere SET SidsteBesog ='$time' WHERE Email = '$username'";
            mysqli_query($connection, $sql);

            $log_sql = "INSERT INTO log (Bruger ,Dato , Beskrivelse) VALUES ('$_SESSION[user_id]', '$time', 'Bruger loggede ind med IP: $_SERVER[REMOTE_ADDR]')";
            mysqli_query($connection, $log_sql);

            header('Location: index.php');
        } else {
            echo 'Invalid password.';
            echo "<br>";
            echo $password;
            echo "<br>";
            echo $row['Adgangskode'];
            echo "<br>";

        }

    }
    ?>

</div>
<!-- /container -->


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>