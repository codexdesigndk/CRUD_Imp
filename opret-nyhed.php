<?php include_once "includes/header.php"; ?>
<?php include_once "includes/nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nyheder</h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
                        <li class="active"><i class="fa fa-file"></i> Nyheder</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <?php

                            if (isset($_POST['submit'])) {
                                $content = array(
                                    'titel' => $_POST['Titel'],
                                    'indhold' => $_POST['Indhold']
                                );
                                CreateItem('nyheder', $content);
                            }
                            ?>

                            <form method="post">
                                Titel:<br>
                                <input class="form-control" type="text" name="Titel" value="" required/><br><br>
                                <legend>Indhold:</legend>
                                <textarea name="Indhold" cols="" rows=""></textarea><br>
                                <input class="btn btn-primary" type="submit" value="Opret" name="submit"/>&nbsp;&nbsp;&nbsp;<a href='nyheder.php'>Annuller</a>
                            </form>


                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->



<?php include_once "includes/footer.php"; ?>