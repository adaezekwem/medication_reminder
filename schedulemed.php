<?php

// MySQL database connection settings
$servername = "localhost";
$username = "adaezekwem";
$password = "adachukwu23";
$dbname = "ada";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve all rows from the firstName column
$sql = "SELECT firstName, lastName, email FROM useraccount";

// Execute the query
$result = $conn->query($sql);

// Create an empty array to store the names
$studentNames = array();

// Check if the query was successful and fetch the data
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Add each name to the array
    $studentNames[] = $row['firstName'] ." ". $row['lastName'] ;
    $emailsend = $row['email'];
  }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i style="font-size:24px" class="fa">&#xf039;</i>
    </label>
    <label class="logo">ATAMRS</label>
    <ul>
      <li><a href="register.php">Registration</a></li>
      <li><a class="active" href="schedulemed.php">Schedule Medication</a></li>
      <li><a href="ongoingmed.php">Ongoing Medication</a></li>
      <li><a href="students.php">Students</a></li>

    </ul>
  </nav>
  </head>

  <body>

    <div class="schedule-container">
      <div class="schedulemed-bigtitle">Put Students On New Medication Schedule</div>
      <div class="schedulemed">
        <div class="schedule-title">Complete the form below</div>
        <form action="#" method="POST">
          <div class="schedulemedform-details">
            <div class="search-container">
              <span class="details">Find Student</span>
              <input type="text" name="search" placeholder="Search for a student" list="student-list">
              <datalist id="student-list">
              <?php
    // Get the list of all students in an array format
    foreach ($studentNames as $name) {
      echo "<option value='$name'>";
    }
    ?>
              </datalist>
            </div>
            <div class="input-box">
              <span class="details">Body Temperature(^c)</span>
              <input name="temperature" type="number" placeholder="Enter Temperature" required>
            </div>
            <div class="input-box">
              <span class="details">Blood Pressure(mmHg)</span>
              <input name="bloodpressure" type="number" placeholder="Enter Blood Pressure" required>
            </div>
            <div class="input-box">
              <span class="details">Prescribe Medicine</span>
              <textarea name="pm" placeholder="Enter Medicine(s)"></textarea>
            </div>
            <div class="input-box">
              <span class="details">Treatment(e.g Malaria)</span>
              <input name="treatment" type="text" placeholder="Enter Treatment" required>
            </div>
            <div class="input-box">
              <span class="details">Frequency per day</span>
              <input name="frequency" type="number" placeholder="e.g 2, 3" required>
            </div>
            <div class="input-box">
              <span class="details">Duration (in days)</span>
              <input name="duration" type="number" placeholder="e.g 2, 3" required>
            </div>
            <div class="input-boxtextarea">
              <span class="details">Additional Information</span>
              <textarea name="info" placeholder="Enter none, if not any." required></textarea>
            </div>
            <div class="input-box">
              <span class="details">Date & Time Started</span>
              <input name="datetime" type="datetime-local" required>
            </div>
          </div>
          <div class="button">
            <input name="calculate" type="submit" value="Schedule Medication">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if all form fields are filled
  if (isset($_POST['search']) && isset($_POST['temperature']) && isset($_POST['bloodpressure']) && isset($_POST['pm']) && isset($_POST['treatment']) && isset($_POST['frequency']) && isset($_POST['duration']) && isset($_POST['info']) && isset($_POST['datetime'])) {
    // Calculate the date after adding the specified number of days
    $startDate = $_POST['datetime'];
    $daysToAdd = $_POST['duration'];

    $timestamp = strtotime($startDate);
    $futureTimestamp = strtotime("+$daysToAdd days", $timestamp);
    $futureDate = date('Y-m-d h:i A', $futureTimestamp); // Format the date with time

    // Create an array to store the form field values
    $name= $_POST['search'];
    $pm =  $_POST['pm'];
    $treatment= $_POST['treatment'];
    $datetime=  $_POST['datetime'];
    $end= $futureDate;
    $formData = array(
      'Name' => $_POST['search'],
      'temp' => $_POST['temperature'],
      'bp' => $_POST['bloodpressure'],
      'pm' => $_POST['pm'],
      'treatment' => $_POST['treatment'],
      'frequency' => $_POST['frequency'],
      'duration' => $_POST['duration'],
      'info' => $_POST['info'],
      'datetime' => $_POST['datetime'],
      'end' => $futureDate
    );

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

    $fname = $_POST['search'];
    $result= $fname;
    $value= explode(" ", $result);
    $output= $value[0];
    // Fetch data from the "medications" column for the specific user
    $sql = "SELECT medications FROM useraccount WHERE firstName='$output'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Get the existing data from the database
      $row = $result->fetch_assoc();
      $existingData = json_decode($row['medications'], true);
  
      // Append the new form data to the existing data
      $existingData[] = $formData;
  
      // Encode the updated data as JSON
      $updatedDataJson = json_encode($existingData);
  
      // Update the data in the database
      $result = $fname;
      $value = explode(" ", $result);
      $output = $value[0];
      require 'NOTIFICATION2.php';
      $message = 'Hi ' . $name . '. Your prescription is: ' . $pm . '. You are being treated for: ' . $treatment . '. Start date: ' . $datetime . '. End date: ' . $end;
      $updateSql = "UPDATE useraccount SET medications='$updatedDataJson' WHERE firstName='$output'";
      if ($conn->query($updateSql) === TRUE) {
       
         sendmail($emailsend,  $message );
          $conn->close();
  
          // header("Location: " . $_SERVER['PHP_SELF']);
          // exit;
      } else {
          echo "Error updating data: " . $conn->error;
      }
  } else {
      echo "No rows found";
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
  }
  
    
    //print_r($formData); // This is for debugging purposes, you can remove it if not needed
    echo '<script>
          $(document).ready(function() {
              // Get the value from the PHP variable "futureDate"
              var futureDate = "' . $futureDate . '";

              // Update the value of "Exp. End Date & Time" element
              $("#date").html("Exp. End Date & Time: " + futureDate);
          });
      </script>';
  }
}

?>