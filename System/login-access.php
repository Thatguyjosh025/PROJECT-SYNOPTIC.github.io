<?php 
session_start();
include("connection.php"); // Include the connection file

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Check if the email entered is in student table
        $student_query = "SELECT ID, email, Password FROM register WHERE email = '$email'";
        $student_result = mysqli_query($conn, $student_query);
        $student_user = mysqli_fetch_assoc($student_result);

        // Check if the email entered is in admin table
        $admin_query = "SELECT * FROM `admins` WHERE Username = '$email'";
        $admin_result = mysqli_query($conn, $admin_query);
        $admin_user = mysqli_fetch_assoc($admin_result);

        if ($student_user) {
            // Student login attempt
            if (password_verify($password, $student_user['Password'])) {
                $_SESSION['ID'] = $student_user['ID'];
                $_SESSION['email'] = $student_user['email'];
                $_SESSION['user_type'] = 'Student'; // Set the user_type for students
        
                echo '<script>alert("Student Login successful")</script>';
                echo '<script>window.location.href = "studentdash.php"</script>';
            } else {
                echo '<script>alert("Invalid Student Email or Password")</script>';
                echo '<script>window.location.href = "Index.php"</script>';
            }
        } elseif ($admin_user) {
            // Admin login attempt
            if ($admin_user['Password'] === $password) {
                $_SESSION['username'] = $admin_user['Username'];
                $_SESSION['user_type'] = 'Admin';

                echo '<script>alert("Admin Login successful")</script>';
                echo '<script>window.location.href = "admindash.php"</script>';
            } else {
                echo '<script>alert("Invalid Admin Username or Password")</script>';
                echo '<script>window.location.href = "Index.php"</script>';
            }
        } else {
            echo '<script>alert("Invalid Email/Username")</script>';
            echo '<script>window.location.href = "Index.php"</script>';
        }
    } else {
        echo '<script>alert("Please enter both email/username and password")</script>';
        echo '<script>window.location.href = "Index.php"</script>';
    }
}
?>
