<?php
include("connection.php");

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}

// -----------------------CRUD FUNCTION---------------------------

// Retrieve the Uniforms ID from the form nothing is changed
$uniformid = $_POST['Uniforms'];

// Query to get the current quantity of uniforms based on the given ID same paden
$sql = "SELECT Quantity FROM uniforms WHERE id = '$uniformid'";
$result = $conn->query($sql);

// Check if the query returned results same paden
if ($result->num_rows > 0) {
    // Loop through the results to fetch the quantity same paden
    while ($row = $result->fetch_assoc()) {
        $quantity = $row["Quantity"];
    }
} else {
    echo "0 results";
}

if (isset($_POST['Increase'])) {
    $quantityChange = $_POST['Quantity'];
    $totalQuantity = $quantity + $quantityChange;
    $newPrice = $_POST['Price']; // Assuming you retrieve the new price from the form nag place kanang panibago nag taas depending on size
    $updateType = "Product Increased";

    // Update the quantity and price in the uniforms table this is from our table
    $stmt = $conn->prepare("UPDATE uniforms SET Quantity = ?, Price = ? WHERE id = ?");
    $stmt->bind_param('idi', $totalQuantity, $newPrice, $uniformid);
    $stmt->execute();

    // Log the update action into product_updates table the logbook this new table
    $stmt = $conn->prepare("INSERT INTO product_update (product_id, update_type, quantity_change, price_change) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $uniformid, $updateType, $quantityChange, $newPrice);
    $stmt->execute();

    header('Location: AvailableStocks.php');
    exit();
}
else if (isset($_POST['Decrease'])) {
  $quantityChange = $_POST['Quantity'];
  $totalQuantity = $quantity - $quantityChange;
  $newPrice = $_POST['Price']; // same
  $updateType = "Product Decreased";

  // same
  $stmt = $conn->prepare("UPDATE uniforms SET Quantity = ?, Price = ? WHERE id = ?");
  $stmt->bind_param('idi', $totalQuantity, $newPrice, $uniformid);
  $stmt->execute();

  // same in the new table as well
  $stmt = $conn->prepare("INSERT INTO product_update (product_id, update_type, quantity_change, price_change) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("issd", $uniformid, $updateType, $quantityChange, $newPrice);
  $stmt->execute();

  // same
  header('Location: AvailableStocks.php');
  exit();
}

//main purpose was to post and nothing else Created method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $productName = $_POST['ProductName']; 
    $uniform = $_POST['Uniforms'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];
    $status = "Show";

    $file_name = ''; // Initialize with an empty value for some reason it needs a default null value don't ask why

    if (!empty($_FILES['Photo']['name'])) {
        // File upload handling
        $file_name = $_FILES['Photo']['name'];
        $uploads_dir = 'C:/xampp/htdocs/System/uploads/';
        move_uploaded_file($_FILES['Photo']['tmp_name'], $uploads_dir . $file_name);
    }

    // Check if stock number is unique before inserting
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM uniforms WHERE Uniforms = ?");
    $stmt_check->bind_param('s', $uniform);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    // If count is greater than 0, it means the stock number already exists
    if ($count > 0) {
        // Stock number is not unique, show an error alert
        echo "<script>alert('Error: Stock number already exists.');</script>";
    } else {
        // Stock number is unique, continue with the insertion process

        // Set a default value for archived if it's not present in the form
        $archive = isset($_POST['archived']) ? $_POST['archived'] : 1;

        // Database insertion into uniforms table
        $stmt = $conn->prepare("INSERT INTO uniforms (ProductName, Uniforms, Quantity, Price, Photo, display_Status, archived) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssdissi', $productName, $uniform, $quantity, $price, $file_name, $status, $archive); 
        $stmt->execute();

        // Get the ID of the newly inserted product
        $newProductId = $stmt->insert_id;

        // Insert into product_update table
        $updateType = "Product Added";
        $quantityChange = $quantity;
        $priceChange = $price;

        $stmt = $conn->prepare("INSERT INTO product_update (product_id, update_type, quantity_change, price_change) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issd", $newProductId, $updateType, $quantityChange, $priceChange);
        $stmt->execute();

        // Redirect
        echo "<script>alert('Error: Stock number already exists.');</script>";
        header('Location: AvailableStocks.php');
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Archive"])) {
    if (isset($_POST["Uniforms"])) {
        $selectedProduct = $_POST["Uniforms"];

        // Archive the product
        $archiveQuery = "UPDATE `uniforms` SET `archived` = 0, `display_Status` = 'Hidden' WHERE `Uniforms` = '$selectedProduct'"; // 0 means true
        if (mysqli_query($conn, $archiveQuery)) {
            // Retrieve the product ID after archiving
            $newProductIdQuery = "SELECT `id` FROM `uniforms` WHERE `Uniforms` = '$selectedProduct'";
            $result = mysqli_query($conn, $newProductIdQuery);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $newProductId = $row['id'];

                // Prepare and execute the insert into product_update
                $updateType = "Product Archive";

                $stmt = $conn->prepare("INSERT INTO product_update (product_id, update_type) VALUES (?, ?)");
                $stmt->bind_param("is", $newProductId, $updateType);
                $stmt->execute();

                header('Location: AvailableStocks.php');
                exit();
            } else {
                echo 'Error retrieving product ID: ' . mysqli_error($conn);
            }
        } else {
            echo 'Error archiving product: ' . mysqli_error($conn);
        }
    } else {
        echo 'No product selected.';
    }
} else {
    echo "<script>alert('Error: Stock number already exists.');</script>";
    header('Location: AvailableStocks.php');
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Retrieve"])) {
    if (isset($_POST["Uniforms"])) {
        $selectedProduct = $_POST["Uniforms"];

        // Archive the product
        $archiveQuery = "UPDATE `uniforms` SET `archived` = 1, `display_Status` = 'Show' WHERE `Uniforms` = '$selectedProduct'"; // 1 means false
        if (mysqli_query($conn, $archiveQuery)) {
            // Retrieve the product ID after archiving
            $newProductIdQuery = "SELECT `id` FROM `uniforms` WHERE `Uniforms` = '$selectedProduct'";
            $result = mysqli_query($conn, $newProductIdQuery);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $newProductId = $row['id'];

                // Prepare and execute the insert into product_update
                $updateType = "Product Retrieve";

                $stmt = $conn->prepare("INSERT INTO product_update (product_id, update_type) VALUES (?, ?)");
                $stmt->bind_param("is", $newProductId, $updateType);
                $stmt->execute();

                header('Location: AvailableStocks.php');
                exit();
            } else {
                echo 'Error retrieving product ID: ' . mysqli_error($conn);
            }
        } else {
            echo 'Error archiving product: ' . mysqli_error($conn);
        }
    } else {
        echo 'No product selected.';
    }
} else {
    echo 'Invalid request.';
}


//Delete button messes up the IDs still cant do it requires ajax

//-----------------------------------------------------------------


//Reservation Function (Student Dashboard)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_message'])) {
    $name = $_POST['name'];
    $uniform = $_POST['Uniforms'];
    $quantity = $_POST['Quantity'];
    $message = $_POST['message-text'];
    $Status = "Pending";


    // Insert into reservation table
    $stmt = $conn->prepare("INSERT INTO reservations (name, uniforms, quantity, message, Status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssiss', $name, $uniform, $quantity, $message, $Status);
    $stmt->execute();

    $reservation_id = $stmt->insert_id;

    // it suppose to Retrieve product name based on the selected uniform from the 'uniforms' but it dosent work
    $product_name_query = "SELECT ProductName FROM uniforms WHERE id = ?";
    $product_stmt = $conn->prepare($product_name_query);
    $product_stmt->bind_param('i', $uniform);
    $product_stmt->execute();
    $product_result = $product_stmt->get_result();

    if ($product_result && $product_result->num_rows > 0) {
        $product_row = $product_result->fetch_assoc();
        $product_name = $product_row['ProductName'];

        //bitch the name fetching from uniforms table dosent work cant find out why
        $messageContent = "Your reservation form for '$product_name'is being processed. We'll notify you once confirmed.";
    } else {
        //it needs to be put in the else too dont ask me why it dosent work when i only put if
        $messageContent = "Your reservation form is being processed. We'll notify you once confirmed.";
    }

    // Insert the message into the 'message' table
    $messageStmt = $conn->prepare("INSERT INTO message (inbox) VALUES (?)");
    $messageStmt->bind_param('s', $messageContent);
    $messageStmt->execute();
    header('Location: studentdash.php');
    exit();
}


//only purpose was to change the status from pending to reserve thats it! (Admindashboard function) adding decreasing quantiity function on break
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])) {
    $reservation_id = $_POST['reservation_id'];

    // Get the product ID associated with this reservation
    $product_query = "SELECT id FROM reservations WHERE id = $reservation_id";
    $product_result = $conn->query($product_query);

    if ($product_result && $product_result->num_rows > 0) {
        $product_row = $product_result->fetch_assoc();
        $product_id = $product_row['id'];

        // Retrieve the product name from the 'reservations!' table based on the ID
        $product_name_query = "SELECT uniforms FROM reservations WHERE id = $product_id";
        $product_name_result = $conn->query($product_name_query);

        if ($product_name_result && $product_name_result->num_rows > 0) {
            $product_name_row = $product_name_result->fetch_assoc();
            $product_name = $product_name_row['uniforms'];

            // Update the reservation status to 'Reserved'
            $update_query = "UPDATE reservations SET Status = 'Reserved' WHERE id = $reservation_id";
            $update_result = $conn->query($update_query);

            // Insert a message into the 'message' table indicating approval and the product name
            $messageContent = "Your Reservation for '$product_name' has been Approved! Visit the Front Desk for Details";
            $messageStmt = $conn->prepare("INSERT INTO message (inbox) VALUES (?)");
            $messageStmt->bind_param('s', $messageContent);
            $messageStmt->execute();

            header('Location: adminInbox.php');
            exit();
        }
    }
}


//reject function here
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reject'])) {
    $reservation_id = $_POST['reservation_id'];

    // Retrieve product ID associated with this reservation
    $product_query = "SELECT id FROM reservations WHERE id = $reservation_id";
    $product_result = $conn->query($product_query);

    if ($product_result && $product_result->num_rows > 0) {
        $product_row = $product_result->fetch_assoc();
        $product_id = $product_row['id'];

        // Retrieve product name based on the reservations ID
        $product_name_query = "SELECT uniforms FROM reservations WHERE id = $product_id";
        $product_name_result = $conn->query($product_name_query);

        if ($product_name_result && $product_name_result->num_rows > 0) {
            $product_name_row = $product_name_result->fetch_assoc();
            $product_name = $product_name_row['uniforms'];

            // Update reservation status to 'Rejected'
            $update_query = "UPDATE reservations SET Status = 'Rejected' WHERE id = $reservation_id";
            $update_result = $conn->query($update_query);

            // Insert a message into the 'message' table indicating rejection and the product name
            $messageContent = "Your Reservation for '$product_name' has been Declined";
            $messageStmt = $conn->prepare("INSERT INTO message (inbox) VALUES (?)");
            $messageStmt->bind_param('s', $messageContent);
            $messageStmt->execute();

            header('Location: adminInbox.php');
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['undo'])) {
    $reservation_id = $_POST['reservation_id'];

    // Retrieve product ID associated with this reservation
    $product_query = "SELECT id FROM reservations WHERE id = $reservation_id";
    $product_result = $conn->query($product_query);

    if ($product_result && $product_result->num_rows > 0) {
        $product_row = $product_result->fetch_assoc();
        $product_id = $product_row['id'];

        // Retrieve product name based on the reservations ID
        $product_name_query = "SELECT uniforms FROM reservations WHERE id = $product_id";
        $product_name_result = $conn->query($product_name_query);

        if ($product_name_result && $product_name_result->num_rows > 0) {
            $product_name_row = $product_name_result->fetch_assoc();
            $product_name = $product_name_row['uniforms'];

            // Update reservation status to 'Rejected'
            $update_query = "UPDATE reservations SET Status = 'Pending' WHERE id = $reservation_id";
            $update_result = $conn->query($update_query);

            header('Location: adminInbox.php');
            exit();
        }
    }
}



//Message funciton stil dont make sense if i maid a on way message it needs an API to execute this function!



?>