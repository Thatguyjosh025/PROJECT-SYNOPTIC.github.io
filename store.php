<?php
include("connection.php");

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $name = $_POST['f_name'];
    $sname = $_POST['s_name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $usertype = "Student";

    if (!$conn) {
        die("Connection Error: " . mysqli_connect_error());
    }
   
    // Check if the username already exists
    $check_username_query = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $check_username_query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        echo '<script>alert("Email already exists. Please choose a different username.")</script>';
        echo '<script>window.location.href = "signup.php"</script>';
        exit();
    } 
    else {
        // Username is unique, proceed with insertion
        $sql = "INSERT INTO register (email, name, surname, Password, usertype) VALUES ('$email', '$name', '$sname', '$password', '$usertype')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Account Created!")</script>';
            echo '<script>window.location.href = "Index.php"</script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}

?>
