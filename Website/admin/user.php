<?php session_start();
include('../login/condb.php');

$ID = $_SESSION['ID'];
$name = $_SESSION['name'];
$username = $_SESSION['username'];
$level = $_SESSION['level'];
if ($level != 'user') {
    Header("Location: ../login/logout.php");
}
?>
<?php
include("../data/condb.php");
?>
<?php
include("../src/asset/main.php");

echo $html5;

echo $head;

?>

<body>

    <?php echo $header; ?>

    <section class="about-area pt-125 pb-130">
        <center>
            <div class="col-lg-11">
                <h2 class="mt-80">QR Users ATK</h2>
                <hr />

                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center">
                        <tr>
                            <th>No.</th>
                            <th>Student ID</th>
                            <th>Name-Surname</th>
                            <th>Timestamp</th>
                            <th>Certificate</th>
                        </tr>
                        <?php
                        $sql = mysqli_query($condb, "SELECT * FROM result WHERE student_id = '$username' ORDER BY no DESC");
                        if (mysqli_num_rows($sql) == 0) {
                            echo '<tr><td colspan="5">Data not found.</td></tr>';
                        } else {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($sql)) {
                                $hostname = "http://102.129.138.164/project/";
                                $ai_filename = $hostname . 'cer/atk/' . $row['file_name'] . '.jpg';
                                $sql_ai = mysqli_query($condb, "SELECT * FROM ai WHERE filename='$ai_filename'");
                                while ($row_ai = mysqli_fetch_assoc($sql_ai)) {
                                    echo '
							<tr>
							<td>' . $no . '</td>
							<td>' . $row['student_id'] . '</td>
							<td>' . $row['student_name'] . ' ' . $row['student_surname'] . '</td>
                            <td>' . $row['timestamp'] . '</td>
							';

                                    if ($row_ai['verify'] == 'none') {
                                        echo '
								<td>
                                    Waiting for Verify 
								</td>							
								';
                                    } else if($row_ai['qr'] != 'match'){
                                        echo '
								<td>
                                    QR is not matched or AI cannot read QR image.
								</td>							
								';      
                                    }else{
                                        echo '							
                                <td> 
                                    <img src="../cer/cer/' . $row['file_name'] . '.jpg" width="100px" height="160px"> 
                                </td>
                                ';
                                    }
                                    echo '							
							</tr>';
                                    $no++;
                                }
                            }
                        }

                        ?>
                    </table>
                </div>
            </div>
        </center>
    </section>

    <?php echo $footer; ?>

</body>

</html>