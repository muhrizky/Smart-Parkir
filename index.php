<html>
 <head>
 <Title>Parkir Kendaraan Bermotor</Title>
 <style type="text/css">
 	body { background-color: #fff; border-top: solid 10px #000;
 	    color: #333; font-size: .85em; margin: 20; padding: 20;
 	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 	}
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
 <h1>Registeri Parkir Kendaraan Bermotor Fakultas Teknik</h1>
 <p>Isikan Nama, NIM dan nomor palt kendaraan Anda, Kemudian Klik <strong>Submit</strong> Untuk mendaftar.</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Nama  <input type="text" name="name" id="name"/></br></br>
       NIM <input type="text" name="nim" id="nim"/></br></br>
       NPK <input type="text" name="npk" id="npk"/></br></br>
       <input type="submit" name="submit" value="Submit" />
       <input type="submit" name="load_data" value="Load Data" />
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
            // $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (nama, nim, npk) 
                        VALUES (1,2,3,4)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $nim);
            $stmt->bindValue(3, $npk);
            // $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Mahasiswa Yang sudah Tergistrasi Kendarrannya:</h2>";
                echo "<table>";
                echo "<tr><th>Name</th>";
                echo "<th>NIM</th>";
                echo "<th>NPK</th>";
                // echo "<th>Date</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['nama']."</td>";
                    echo "<td>".$registrant['nim']."</td>";
                    echo "<td>".$registrant['npk']."</td>";
                    // echo "<td>".$registrant['date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>