<?php
$host = "registration1.database.windows.net";
$user = "dicoding";
$pass = "@Qwerty123";
$db = "Registration";
try {
    $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    // echo "Success connected.";
} catch(Exception $e) {
    echo "Failed: " . $e;
}
?>

<?php
if (isset($_POST['submit'])) {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $job = $_POST['job'];
        $date = date("Y-m-d");
            // Insert data
        $sql_insert = "INSERT INTO persons (name, email, job, date) 
        VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $job);
        $stmt->bindValue(4, $date);
        $stmt->execute();
        header("Location: index.php");
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submission 1 Dicoding</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <div class="container">

        <h1 class="text-center">Azure Cloud Development!</h1>
        <form action="index.php" method="POST">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required="">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="job">Job:</label>
            <input type="text" class="form-control" name="job" id="job">
        </div>
        <input type="submit" class="btn btn-default" name="submit" value="Submit">
    </form>

    <br>
    <br>
    <?php
    try {
        $sql_select = "SELECT * FROM persons";
        $stmt = $conn->query($sql_select);
        $persons = $stmt->fetchAll(); 
        if(count($persons) > 0) {
            echo "<h2>Total people who are registered : ".count($persons)."</h2>";
            echo "<table class='table table-hover'><thead>";
            echo "<tr><th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Job</th>";
            echo "<th>Date</th></tr></thead><tbody>";
            foreach($persons as $person) {
                echo "<tr><td>".$person['name']."</td>";
                echo "<td>".$person['email']."</td>";
                echo "<td>".$person['job']."</td>";
                echo "<td>".$person['date']."</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<h3>No one is currently registered.</h3>";
        }
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    ?>

</div>

</tbody>
</table>

</body>
</html>