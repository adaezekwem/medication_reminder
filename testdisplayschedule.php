<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Medication Reminder System</title>
    <link rel="stylesheet" href="register.css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        // Function to mark dose as Taken
        function markDoseAsTaken(button) {
            const doseContainer = button.parentElement;
            const missedButton = doseContainer.querySelector('.miss-button');
            
            button.style.display = "none";
            missedButton.style.display = "none";

            const takenLabel = document.createElement('span');
            takenLabel.textContent = "Taken";
            doseContainer.appendChild(takenLabel);

            // Save the status in Local Storage for the specific user
            const firstName = doseContainer.getAttribute('data-student');
            const doseDateTime = doseContainer.getAttribute('data-datetime');
            const key = `doseStatus_${firstName}_${doseDateTime}`;
            localStorage.setItem(key, "Taken");
        }

        // Function to mark dose as Missed
        function markDoseAsMissed(button) {
            const doseContainer = button.parentElement;
            const takeButton = doseContainer.querySelector('.take-button');
            
            button.style.display = "none";
            takeButton.style.display = "none";

            const missedLabel = document.createElement('span');
            missedLabel.textContent = "Missed";
            doseContainer.appendChild(missedLabel);

            // Save the status in Local Storage for the specific user
            const firstName = doseContainer.getAttribute('data-student');
            const doseDateTime = doseContainer.getAttribute('data-datetime');
            const key = `doseStatus_${firstName}_${doseDateTime}`;
            localStorage.setItem(key, "Missed");
        }
    </script>
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
    echo '<div class="container-display">';
    echo '<div class="displaybox">';
    // Fetch the specific user's medication data
    $fullName = $_GET['Name'];   // Get the user's first name from the URL

    // Split the full name into first name and last name
    $nameParts = explode(" ", $fullName);

    // Get the first name
    $firstName = $nameParts[0];

    
    echo "<div class='title'>$fullName's Medication Schedule</div>";

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

    $sql = "SELECT medications FROM useraccount WHERE firstName='$firstName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $medicationsArray = json_decode($row['medications'], true);
    } else {
        echo "No records found for the selected user.";
    }

    $emailsendQuery = "SELECT email FROM useraccount WHERE firstName = '$firstName'";
    $medicationQuery = "SELECT medications FROM useraccount WHERE firstName = '$firstName'";
    $medicationResult = mysqli_query($conn, $medicationQuery);
    $emailsendResult = mysqli_query($conn, $emailsendQuery);

    $emailRow = mysqli_fetch_assoc($emailsendResult);
    $userEmail = $emailRow['email'];

    file_put_contents('user_email.txt', $userEmail);
    
    while ($medicationData = mysqli_fetch_assoc($medicationResult)) {
        $medicationsJson = $medicationData['medications'];
        $medicationsArray = json_decode($medicationsJson, true);

        foreach ($medicationsArray as $medication) {
            $frequency = $medication['frequency'];
            $duration = $medication['duration'];
            $datetime = $medication['datetime'];
            $pm = $medication['pm'];

            $startDateTime = strtotime($datetime);
            $endDateTime = strtotime('+' . $duration . ' days', $startDateTime);

            echo "<p style='text-align: center; margin-top: 20px; color: #032845;'>Medication: $pm&nbsp;&nbsp;&nbsp;&nbsp;Frequency: $frequency per day&nbsp;&nbsp;&nbsp;&nbsp;Duration: $duration days<br><br>";
            echo "Start Time: " . date('Y-m-d H:i:s', $startDateTime) . "&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "End Time: " . date('Y-m-d H:i:s', $endDateTime) . "</p>";

            echo "<table>";
while ($startDateTime <= $endDateTime) {
    $formattedTime = date('Y-m-d H:i:s', $startDateTime);
        echo "<tr style='height: 1px;'>";
        echo "<td style='text-align: center;'>";
echo "<div class='dose' data-student='$firstName' data-datetime='$formattedTime' style='text-align: center; margin-top: 20px; color: #032845;'>";
echo "($formattedTime) &nbsp;&nbsp;&nbsp;&nbsp;";
// Add the schedule to the schedules array
$timestamp = strtotime($formattedTime);

// Convert Unix timestamp to milliseconds
$timestampInMilliseconds = $timestamp * 1000;
$schedule = array(
    $timestampInMilliseconds,
);


$schedules[] = $schedule;

echo "<button class='take-button' onclick='markDoseAsTaken(this)' style='height: 100%;
    width: 70px;
    outline: none;
    color: #fff;
    border: none;
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 1px;
    border-radius: 5px;
    background: linear-gradient(135deg, #51abf0, #0e4167);'>Taken</button> &nbsp;&nbsp;&nbsp;&nbsp;";
echo "<button class='miss-button' onclick='markDoseAsMissed(this)' style='height: 100%;
    width: 70px;
    outline: none;
    color: #fff;
    border: none;
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 1px;
    border-radius: 5px;
    background: linear-gradient(135deg, #51abf0, #0e4167);'>Missed</button>";
echo "<span class='status'></span>";
echo "</div>";
echo "</td>";
echo "</tr>";
    $timeInterval = (24 / $frequency); // Calculate interval in hours
    $startDateTime += $timeInterval * 3600; // Convert to seconds and add to start time
}
$jsonSchedules = json_encode($schedules);
echo "</table>";
// Output the JSON array
echo "<div id='scheduleTimesJson'>$jsonSchedules</div>";
file_put_contents('jsonSchedules.txt', $jsonSchedules);
        }
    }
    // Close the database connection
    mysqli_close($conn);
    echo "</div>";
    echo "</div>";
    ?>
<script>

        // Function to retrieve dose status from Local Storage
        function getDoseStatus(firstName, doseDateTime) {
            const key = `doseStatus_${firstName}_${doseDateTime}`;
            return localStorage.getItem(key);
        }

        // Call this function to initialize status on page load
        function initializeStatus() {
            const doseContainers = document.querySelectorAll('.dose');
            doseContainers.forEach(doseContainer => {
                const firstName = doseContainer.getAttribute('data-student');
                const doseDateTime = doseContainer.getAttribute('data-datetime');
                const status = getDoseStatus(firstName, doseDateTime);
                if (status) {
                    const statusLabel = doseContainer.querySelector('.status');
                    statusLabel.textContent = status;

                    // Hide the buttons if status is set
                    const takeButton = doseContainer.querySelector('.take-button');
                    const missButton = doseContainer.querySelector('.miss-button');
                    takeButton.style.display = "none";
                    missButton.style.display = "none";
                }
            });
        }

        // Initialize the status on page load
        document.addEventListener("DOMContentLoaded", initializeStatus);
    </script>
    
</body>
</html>

