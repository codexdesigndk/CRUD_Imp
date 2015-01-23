<?php include_once "includes/header.php"; ?>
<?php include_once "includes/nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nyheder</h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> <a href="index.php"> Dashboard</a></li>
                        <li><i class="fa fa-file"></i> <a href="nyheder.php"> Nyheder</a></li>
                        <li class="active"><i class="fa fa-file"></i> Rediger nyhed</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <section>
                                <h3>Rediger nyhed</h3>

                                <?php
                                if (isset($_GET['id'])) {

                                    $id = $_GET['id'];

                                    $titel = "";
                                    $indhold = "";

                                    if (isset($_POST['submit'])) {
                                        $titel = $_POST['Titel'];
                                        $indhold = $_POST['Indhold'];

                                        $sql = "UPDATE nyheder SET Titel = '$titel', Indhold = '$indhold' WHERE Id=$id";
                                        mysqli_query($connection, $sql);
                                        header("Location: nyheder.php");
                                        exit;

                                    } else {
                                        $sql = "SELECT * FROM nyheder WHERE Id=$id";
                                        $result = mysqli_query($connection, $sql);
                                        $row = mysqli_fetch_array($result);

                                        $titel = $row['Titel'];
                                        $indhold = $row['Indhold'];
                                    }

                                }

                                ?>
                                <form method="post">
                                    Titel:<br>
                                    <input class="form-control" type="text" name="Titel" value="<?php echo $titel ?>" required/><br><br>
                                    Indhold:<br>
                                    <textarea name="Indhold" id="" cols="20" rows="4"><?php echo $indhold ?></textarea><br>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'Indhold' );
                                    </script>
                                    <input class="btn btn-primary" type="submit" value="Gem ændringer" name="submit"/>&nbsp;&nbsp;&nbsp;<a href='nyheder.php'>Annuller</a>
                                </form>
                            </section>


                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->



<?php include_once "includes/footer.php"; ?>