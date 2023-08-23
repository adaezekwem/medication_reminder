<?php
// Replace with your database credentials
$servername = "localhost";
$username = "adaezekwem";
$password = "adachukwu23";
$dbname = "ada";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT firstName, lastName, email, phoneNumber, age, matricNumber, gender FROM useraccount";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>
        Medication Reminder System
    </title>
    <link rel="stylesheet" href="register.css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i style="font-size:24px" class="fa">&#xf039;</i>
        </label>
        <label class="logo">ATAMRS</label>
        <ul>
            <li><a href="register.php">Registeration</a></li>
            <li><a href="schedulemed.php">Schedule Medication</a></li>
            <li><a href="ongoingmed.php">Ongoing Medication</a></li>
            <li><a class="active" href="students.php">Students</a></li>
        </ul>
    </nav>

    <div class="ongoing-container">
        <table class="ongoing-table">
            <tr class="table-head">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Matric</th>
                <th>Gender</th>
                <td><button onclick="location.reload();">Refresh</button></td>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["firstName"] . "</td>";
                    echo "<td>" . $row["lastName"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phoneNumber"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["matricNumber"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            ?>


        </table>
    </div>

    </table>
    </div>
</body>

</html>