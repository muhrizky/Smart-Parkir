<html>
 <head>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://raw.githubusercontent.com/muhrizky/Smart-Parkir/master/parking_meter__2__Mrq_icon.ico">

    <title>Undip Smart Parkir</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>
 <body>
 <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="https://smart-parkir.azurewebsites.net/">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="https://smart-parkir.azurewebsites.net/analyze.php">Analisis Kendaraan<span class="sr-only">(current)</span></a>
			</li>
		</div>
		</nav>

    <main role="main" class="container">
    <div class="starter-template"> <br><br><br>
        <h1>Smart Parkir Universitas Diponegoro</h1>
        <p class="lead">Isikan dengan lengkap dari <b>Nama, NIM, TNBK, Foto Kendaraan </b> anda.<br> Kemudian Click <b>Submit Data Kendaraan</b> untuk Registrasi Kendaraan anda.</p> <br>
        <span class="border-top my-3"></span>
      </div>
        <form action="index.php" method="POST">
          <div class="form-group">
            <label for="name">Nama: </label>
            <input type="text" class="form-control" name="nama" id="name" required="" >
        </div>
        <div class="form-group">
            <label for="email">Nomor Induk Mahasiswa (NIM): </label>
            <input type="text" class="form-control" name="nim" id="nim" required=""maxlength="15">
        </div>
        <div class="form-group">
            <label for="NPK">Tanda Nomor Kendaraan Bermotor (TKNB): </label>
            <input type="text" class="form-control" name="npk" id="npk" required=""maxlength="8">
        </div>
        <!-- <div class="form-group" action="index.php" method="post" enctype="multipart/form-data">
            <label for="upload">Unggah Foto Kendaraan : </label> <br>
            <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
            <br><br> -->
            <input type="submit" class="btn btn-success" name="submit" value="Submit Data Kendaraan">
        </form>
        <!-- <br><br> -->
        <form action="index.php" method="GET">
          <div class="form-group">
            <input type="submit" class="btn btn-info" name="load_data" value="Lihat Data Yang Sudah Registrasi">
          </div>
        </form>   
   
 <?php
    $host = "registration1.database.windows.net";
    $user = "dicoding";
    $pass = "@Qwerty123";
    $db = "Registration";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['nama'];
            $nim = $_POST['nim'];
            $npk = $_POST['npk'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (nama, nim, npk, date) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $nim);
            $stmt->bindValue(3, $npk);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        echo "<h3>Your're registered!</h3>";
    } else if (isset($_GET['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Mahasiswa yang sudah teregistrasi kendaraannya sebanyak : ".count($registrants)." Orang</h2>";
                echo "<table class='table table-hover'><thead>";
                echo "<tr><th>Name</th>";
                echo "<th>NIM</th>";
                echo "<th>TKNB</th>";
                echo "<th>Date</th></tr></thead><tbody>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['nama']."</td>";
                    echo "<td>".$registrant['nim']."</td>";
                    echo "<td>".$registrant['npk']."</td>";
                    echo "<td>".$registrant['date']."</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </div>
    </main><!-- /.container -->

</tbody>
</table>
 
<!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>