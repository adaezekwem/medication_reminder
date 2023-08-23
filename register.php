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
            <li><a class="active" href="register.php">Registeration</a></li>
            <li><a href="schedulemed.php">Schedule Medication</a></li>
            <li><a href="ongoingmed.php">Ongoing Medication</a></li>
            <li><a href="students.php">Students</a></li>

        </ul>
    </nav>
    <div class="container">
        <div class="regstudent">
            <div class="title">Register New Student</div>
            <form action="register.php" method="POST">
                <div class="studentform-details">
                    <fieldset>
                        <legend>Personal Information</legend>
                        <div class="input-box">
                            <span class="details">First Name</span>
                            <input name="first_name" type="text" placeholder="Enter First Name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Last Name</span>
                            <input name="last_name" type="text" placeholder="Enter Last Name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input name="email" type="email" placeholder="Enter Email" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input name="phone_number" type="number" placeholder="Enter Phone Number" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Age</span>
                            <input name="age" type="number" placeholder="Enter Age" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Matric Number</span>
                            <input name="matric_num" type="text" placeholder="Enter Matric Number" required>
                        </div>
                        <div class="gender-details">
                            <input type="radio" name="gender" id="dot-1" value="male">
                            <input type="radio" name="gender" id="dot-2" value="female">
                            <span class="gender-title">Gender</span>
                            <div class="category">
                                <label for="dot-1">
                                    <span class="dot one"></span>
                                    <span class="gender">Male</span>
                                </label>
                                <label for="dot-2">
                                    <span class="dot two"></span>
                                    <span class="gender">Female</span>
                                </label>
                            </div>
                        </div>

                    </fieldset>
                    <fieldset>
                        <legend>Medical Information</legend>
                        <div class="input-box">
                            <span class="details">Height(cm)</span>
                            <input name="height" type="number" placeholder="Enter Height" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Weight(kg)</span>
                            <input name="weight" type="number" placeholder="Enter Weight" required>
                        </div>
                        <div class="input-boxtextarea">
                            <span class="details">Additional Information (e.g allergies)</span>
                            <textarea name="info" placeholder="Enter none, if not any." required></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="button">
                    <input type="submit" value="Register Student">
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all form fields are filled
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['age']) && isset($_POST['matric_num']) && isset($_POST['gender']) && isset($_POST['height']) && isset($_POST['weight']) && isset($_POST['info'])) {

        // Retrieve form values
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone_number'];
        $age = $_POST['age'];
        $matricNumber = $_POST['matric_num'];
        $gender = $_POST['gender'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $additionalInfo = $_POST['info'];
        $medications = "[]";

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

        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO useraccount (firstName, lastName, email, phoneNumber, age, matricNumber, gender, height, weight, additionalInfo, medications) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Check if the prepare statement was successful
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssisssiss", $firstName, $lastName, $email, $phoneNumber, $age, $matricNumber, $gender, $height, $weight, $additionalInfo, $medications);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();

    } else {
        // Some form fields are missing
        $message = "Please fill in all the details.";
        echo '<script>alert("' . $message . '");</script>';
    }
}
?>