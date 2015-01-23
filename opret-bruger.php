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
                        <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
                        <li><i class="fa fa-file"></i> <a href="brugere.php">Brugere</a></li>
                        <li class="active"><i class="fa fa-file"></i> Opret Bruger</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">


                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <?php
                            if (!empty($_POST['submit'])) {
                                $Titel = $_POST['Titel'];
                                $Fornavn = $_POST['Fornavn'];
                                $Efternavn = $_POST['Efternavn'];
                                $Email = $_POST['Email'];
                                $Adgangskode = $_POST['Adgangskode'];

                                $hash = password_hash($Adgangskode, PASSWORD_DEFAULT);

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

                                } else {
                                    $newfilename = 'default.jpg';
                                }

                                $sql = "INSERT INTO brugere (Titel, Fornavn, Efternavn, Email, Adgangskode, Billedeurl) VALUES ('$Titel', '$Fornavn', '$Efternavn', '$Email', '$hash', '$newfilename')";
                                mysqli_query($connection, $sql);
                                header("Location: brugere.php");
                                exit;
                            }


                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Titel</td>
                                        <td><input class="form-control" type="text" name="Titel" value="" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Fornavn</td>
                                        <td><input class="form-control" type="text" name="Fornavn" value="" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Efternavn</td>
                                        <td><input class="form-control" type="text" name="Efternavn" value="" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><input class="form-control" type="email" name="Email" value="" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Adgangskode</td>
                                        <td><input class="form-control" type="password" name="Adgangskode" value="" Placeholder="" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Billede</td>
                                        <td><input class="form-control" type="file" name="Image" id=""/></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <input class="btn btn-primary" type="submit" value="Opret bruger" name="submit"/>&nbsp;&nbsp;&nbsp;<a href='brugere.php'>Annuller</a>
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