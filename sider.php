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
                        <li class="active"><i class="fa fa-file"></i> Indholdsredigering</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                        $sql = "SELECT * FROM sider";
                        $result = mysqli_query($connection, $sql);

                        echo "<table id='usertable' class='table'>";
                        echo "<thead>";
                        echo "<tr>" . "<th>Titel</th>". "<th>Sidebar</th>";
                        echo "</thead>";

                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {

                            $linkrow = "ret-sider.php?id=" . $row['Id'];


                            echo "<tr class='linkrow' href='$linkrow'>";
                            echo "<td>" . $row['Titel'] . "</td>";
                            echo "<td>" . $row['sidebar'] . "</td>";
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