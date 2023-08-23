<?php
// Perform database connection
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

// Fetch all rows from the table
$sql = "SELECT medications FROM useraccount";
$result = $conn->query($sql);

// Array to store decoded medications
$medicationsArray = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Decode JSON data into an array
        $medications = json_decode($row['medications'], true);

        // Add decoded medications to the array
        $medicationsArray[] = $medications;
       
    }
} else {
    echo "No records found.";
}

// Close the database connection
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
            <li><a class="active" href="ongoingmed.php">Ongoing Medication</a></li>
            <li><a href="students.php">Students</a></li>
        </ul>
    </nav>
    <?php
    $currentDateTime = date('Y-m-d H:i:s'); // Get the current time
    
    // ...
    ?>
    <div class="ongoing-container">
        <table class="ongoing-table">
            <tr class="table-head">
                <td>Student Name</td>
                <td>Medicine Prescribed</td>
                <td>Treatment</td>
                <td>Duration</td>
                <td>End date</td>
                <td><button onclick="location.reload();">Refresh</button></td>
            </tr>

            <?php foreach ($medicationsArray as $row): ?>
                <?php foreach ($row as $data): ?>
                    <?php if (isset($data["end"]) && $data["end"] > $currentDateTime): ?>
                        <tr>
                            <td>
                            <a href="testdisplayschedule.php?Name=<?php echo urlencode($data["Name"]); ?>"><?php echo isset($data["Name"]) ? $data["Name"] : ''; ?></a>
                            </td>
                            <td>
                                <?php echo isset($data["pm"]) ? $data["pm"] : ''; ?>
                            </td>
                            <td>
                                <?php echo isset($data["treatment"]) ? $data["treatment"] : ''; ?>
                            </td>
                            <td>
                                <?php echo isset($data["duration"]) ? $data["duration"] : ''; ?>
                            </td>
                            <td>
                                <?php echo isset($data["end"]) ? $data["end"] : ''; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>


        </table>
    </div>

    </table>
    </div>
</body>

</html>

