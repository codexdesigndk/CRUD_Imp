<?php include_once "includes/header.php"; ?>
<?php include_once "includes/nav.php"; ?>
    <div id="page-wrapper">

    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Brugere
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-file"></i> <a href="brugere.php">Brugere</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Rediger bruger
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->


    <div class="row">
    <div class="col-lg-12">


    <div class="row">
    <div class="col-lg-8 col-lg-offset-2">
    <?php
        if (isset($_GET['id'])) {


            $id = $_GET['id'];


            $sql = "SELECT * FROM brugere WHERE Id=$id";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($result);

            $time = time();
            $Titel = (isset($_POST['Titel']) ? $_POST['Titel'] : $row['Titel']);
            $Fornavn = (isset($_POST['Fornavn']) ? $_POST['Fornavn'] : $row['Fornavn']);
            $Efternavn = (isset($_POST['Efternavn']) ? $_POST['Efternavn'] : $row['Efternavn']);
            $Email = (isset($_POST['Email']) ? $_POST['Email'] : $row['Email']);

            $passwordset = (isset($_POST['Adgangskode']) ? $_POST['Adgangskode'] : "");
            $password = password_hash($passwordset, PASSWORD_DEFAULT);

            $date_timestamp = $row['SidsteBesog'];
            $lastlogin_string = date('Y-n/j, H:i:s', $date_timestamp);

            $Billede = (isset($_POST['Billede']) ? $_POST['Billede'] : $row['Billedeurl']);


            if (isset($_POST['submit'])) {


                $id_sql = "`Id`='$id'";

                if ($Titel != $row['Titel']) {
                    $new_Titel = $Titel;
                    $Titel_sql = ", `Titel`='$Titel'"; //this is the first one so no coma is required at the front
                    /* LOGGING */
                    $log_sql = "INSERT INTO log (Bruger ,Dato , Beskrivelse) VALUES ('$_SESSION[user_id]', '$time', 'Bruger-ID($id) - Titel ændret til ( $Titel )')";
                    mysqli_query($connection, $log_sql);
                } else {
                    $Titel_sql = "";
                }

                if ($Fornavn != $row['Fornavn']) {
                    $new_Fornavn = $Fornavn;
                    $Fornavn_sql = ", `Fornavn`='$Fornavn'"; //this is the first one so no coma is required at the front
                    /* LOGGING */
                    $log_sql = "INSERT INTO log (Bruger ,Dato , Beskrivelse) VALUES ('$_SESSION[user_id]', '$time', 'Bruger-ID($id) - Fornavn ændret til ( $Fornavn )')";
                    mysqli_query($connection, $log_sql);
                } else {
                    $Fornavn_sql = "";
                }

                if ($Efternavn != $row['Efternavn']) {
                    $new_Efternavn = $Efternavn;
                    $Efternavn_sql = ", `Efternavn`='$Efternavn'"; //this is the first one so no coma is required at the front
                    /* LOGGING */
                    $log_sql = "INSERT INTO log (Bruger ,Dato , Beskrivelse) VALUES ('$_SESSION[user_id]', '$time', 'Bruger-ID($id) - Efternavn ændret til ( $Efternavn )')";
                    mysqli_query($connection, $log_sql);
                } else {
                    $Efternavn_sql = "";
                }

                if ($Email != $row['Email']) {
                    $new_Email = $Email;
                    $Email_sql = ", `Email`='$Email'"; //this is the first one so no coma is required at the front
                    /* LOGGING */
                    $log_sql = "INSERT INTO log (Bruger ,Dato , Beskrivelse) VALUES ('$_SESSION[user_id]', '$time', 'Bruger-ID($id) - Email ændret til ( $Email )')";
                    mysqli_query($connection, $log_sql);
                } else {
                    $Email_sql = "";
                }

                if (!empty($_POST['Adgangskode'])) {
                    $passwordset = $_POST['Adgangskode'];
                    $hash = password_hash($passwordset, PASSWORD_DEFAULT);
                    $password_sql = ", `Adgangskode`='$hash'";
                    /* LOGGING */
                    $log_sql = "INSERT INTO log (Bruger ,Dato , Beskrivelse) VALUES ('$_SESSION[user_id]', '$time', 'Bruger-ID($id) - Adgangskode ændret')";
                    mysqli_query($connection, $log_sql);
                } else {
                    $password_sql = "";
                }

                // Image change code below
                // Definerer $file til at indeholde $_FILES for nemmere adgang
                $file = $_FILES['Image'];

                // Tjekker om der sker en fejl, f.eks forkert datatype, mistet forbindelse osv.
                if ($file['error'] == 0) {

                    // Sletter valgte fil fra mappen
                    if ($row['Bannerurl'] != 'thumb_default.jpg') {

                        unlink("../images/medarbejdere/" . $row['Billedeurl']);
                        unlink("../images/medarbejdere/thumb_" . $row['Billedeurl']);
                    }

                    // Giver fil et unikt navn så der ikke sker en konflikt med andre filer
                    $newfilename = time() . "_" . $file['name'];

                    //Gemmer billedemappe i variabel
                    $imagefolder = '../images/medarbejdere/';

                    // Flyt midlertidig fil til dens desitnation
                    //$moveresult = move_uploaded_file($file['tmp_name'], $newpath);

                    //WideImage
                    $wi_image_full = WideImage::load($file['tmp_name']);
                    $wi_image_full = $wi_image_full->resizeDown(150, 150);
                    $wi_image_full->saveToFile($imagefolder . $newfilename);

                    $Billede_sql = ", `Billedeurl`='$newfilename'";

                } else {
                    $Billede_sql = "";
                }



                $processor = $id_sql . $Titel_sql . $Fornavn_sql . $Efternavn_sql . $Email_sql . $password_sql . $Billede_sql; //add all the fields on this line
                $sql = "UPDATE brugere SET " . $processor . " WHERE id=$id";
                mysqli_query($connection, $sql);

                header("location: brugere.php");

            }

        }
    ?>
    <form method="post" enctype="multipart/form-data">
        <table class="table">
            <tbody>
            <tr>
                <td>Titel</td>
                <td><input class="form-control" type="text" name="Titel" value="<?= $Titel ?>" required/></td>
            </tr>
            <tr>
                <td>Fornavn</td>
                <td><input class="form-control" type="text" name="Fornavn" value="<?php echo $Fornavn ?>" required/></td>
            </tr>
            <tr>
                <td>Efternavn</td>
                <td><input class="form-control" type="text" name="Efternavn" value="<?php echo $Efternavn ?>" required/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input class="form-control" type="email" name="Email" value="<?php echo $Email ?>" required/></td>
            </tr>
            <tr>
                <td>Adgangskode</td>
                <td><input class="form-control" type="password" name="Adgangskode" value="" Placeholder="*************"/></td>
            </tr>
            <tr>
                <td>Sidste Besøg</td>
                <td><?php echo $lastlogin_string ?></td>
            </tr>
            <tr>
                <td>Billede</td>
                <td><input class="form-control" type="file" name="Image" id=""/></td>
            </tr>
            <tr>
                <td>Nuværende billede</td>
                <?php
                $sql = "SELECT * FROM brugere WHERE Id=$id";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result);

                echo "<td><img src='../images/medarbejdere/";
                echo $row['Billedeurl'];
                echo "'/></td>";
                ?>
            </tr>
            </tbody>
        </table>
        <input class="btn btn-primary" type="submit" value="Gem ændringer" name="submit"/>&nbsp;&nbsp;&nbsp;<a href='brugere.php'>Annuller</a>
    </form>
    </div>
    </div>


    </div>
    </div>
    <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include_once "includes/footer.php"; ?>