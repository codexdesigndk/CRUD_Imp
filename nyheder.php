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
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <a class='btn btn-primary' href='opret-nyhed.php'>Tilføj Nyhed</a><br /><br />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                        $sql = "SELECT * FROM N_Nyheder";
                        $result = mysqli_query($connection, $sql);

                        echo "<table id='usertable' class='table'>";
                        echo "<thead>";
                        echo "<tr>" . "<th>Titel</th>" . "<th>Oprettet</th>" . "<th class='text-center'>Slet</th>";
                        echo "</thead>";

                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {

                            $date_timestamp = $row['Dato'];
                            $oprettet = date('Y-n/j, H:i:s', $date_timestamp);
                            $linkrow = "ret-nyhed.php?id=" . $row['Id'];


                            echo "<tr class='linkrow' href='$linkrow'>";
                            echo "<td>" . $row['Titel'] . "</td>";
                            echo "<td>" . $oprettet . "</td>";
                            echo "<td class='text-center'><a class='btn btn-danger' href='slet-nyhed.php?id=" . $row['Id'] . "'>Slet</a></td>";
                            echo "</tr>";

                        }
                        echo "</tbody>";
                        echo "</table>";

                        ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <script>
        $(function(){
            $("#usertable").dataTable();
        })
        jQuery(document).ready(function($) {
            $(".linkrow").click(function() {
                window.document.location = $(this).attr("href");
            });
        });
    </script>


<?php include_once "includes/footer.php"; ?>