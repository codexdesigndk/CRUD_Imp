<?php include_once "includes/header.php"; ?>
<?php include_once "includes/nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Indholdsredigering</h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
                        <li><i class="fa fa-file"></i> <a href="sider.php">Indholdsredigering</a></li>
                        <li class="active"><i class="fa fa-file"></i> Rediger side</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <h3>Rediger side</h3>

                        <?php
                        if (isset($_GET['id'])) {

                            $id = $_GET['id'];

                            $titel = "";
                            $indhold = "";
                            $sidebar = "";

                            if (isset($_POST['submit'])) {
                                $titel = $_POST['Titel'];
                                $indhold = $_POST['Indhold'];
                                $sidebar = $_POST['Sidebar'];

                                $sql = "UPDATE sider SET Indhold = '$indhold', Sidebar = '$sidebar' WHERE Id=$id";
                                mysqli_query($connection, $sql);
                                header("Location: sider.php");
                                exit;

                            } else {
                                $sql = "SELECT * FROM sider WHERE Id=$id";
                                $result = mysqli_query($connection, $sql);
                                $row = mysqli_fetch_array($result);

                                $titel = $row['Titel'];
                                $indhold = $row['Indhold'];
                                $sidebar = $row['sidebar'];
                            }

                        }

                        ?>
                        <form method="post">
                            Titel:<br>
                            <input class="form-control" type="text" name="Titel" value="<?php echo $titel ?>" disabled/><br><br>
                            Sidebar:<br>
                            <select class="form-control" name="Sidebar">
                                <option value="Nyheder" <?php if ($row['sidebar'] == "Nyheder") echo 'selected="selected"';?>> Nyheder</option>
                                <option value="Produkter" <?php if ($row['sidebar'] == "Produkter") echo 'selected="selected"';?>> Produkter</option>
                                <option value="Tilbud" <?php if ($row['sidebar'] == "Tilbud") echo 'selected="selected"';?>> Tilbud</option>
                            </select><br>
                            Indhold:<br>
                            <textarea name="Indhold" id="" cols="20" rows="4"><?php echo $indhold ?></textarea><br><br>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'Indhold' );
                            </script>
                            <input class="btn btn-primary" type="submit" value="Gem" name="submit"/>&nbsp;&nbsp;&nbsp;<a href='sider.php'>Annuller</a>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->



<?php include_once "includes/footer.php"; ?>