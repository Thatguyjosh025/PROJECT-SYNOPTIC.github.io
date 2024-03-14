<?php
include("studentAuthentication.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>StudentInbox</title>
    <link rel="stylesheet" href="./vendor/bootstrap.min.css">
    <link rel="stylesheet" href="css/admindashstyle.css">
    <link rel="stylesheet" href="./css/studentInbox.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>I<span>nquiry</span></h3>
        </div>
        
        <div class="side-content">
        <div class="profile">
        <?php

        $name = "";
        $usertype = "";

        if (isset($_SESSION['ID'])) {
            $profile = $_SESSION['ID'];
            $profile_query = "SELECT name, surname, usertype FROM register WHERE ID = $profile";
            $result = mysqli_query($conn, $profile_query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['name'];
                $sname = $row['surname'];
                $usertype = $row['usertype'];
            } else {
                echo "User not found";
            }
        } else {
            echo "User not logged in";
        }
        ?>

    <div class="profile-img bg-img" style="background-image: url(./pictures/person.jpg)"></div>
    <h4><?php echo $name, ' ', $sname; ?></h4>
    <small><?php echo $usertype; ?></small>
</div>


            <div class="side-menu">
                <ul>
                    <li>
                       <a href="studentdash.php" class="active">
                            <span class="las la-home"></span>
                            <small>Student Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="studentInbox.php">
                            <span class="las la-envelope"></span>
                            <small>Inbox</small>
                        </a>
                    </li>
                    <li>
                    <a href="#exampleModal" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                            <span class="las la-clipboard-list"></span>
                            <small>Reservation Form</small>
                        </a>
                    </li>
                    <li>
                       <a href="Logout.php">
                            <span class="las la-power-off"></span>
                            <small>Logout</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                    <label for="">
                        <span class=""></span>
                    </label>
                    
                    <div class="">
                        <span class=""></span>
                        <span class=""></span>
                    </div>
                    
                    <div class="">
                        <span class=""></span>
                        <span class=""></span>
                    </div>
                    
                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>
                        
                        <span class="#"></span>
                        <a href="#">
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h1>Student</h1>
                <small>Inbox</small>
            </div>
            
            <div class="page-content">
                <!-- Display  Inbox -->
                <div class="container-inbox">
        <div class="row">
            <div class="col-md-12">
            <div class="Inbox">
    <div class="card-body bg-primary text-white mailbox-widget pb-0">
        <h2 class="text-white pb-3">Mailbox</h2>
        <ul class="nav nav-tabs custom-tab border-bottom-0 mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mailbox-tab" data-bs-toggle="tab" data-bs-target="#mailbox" type="button" role="tab" aria-controls="mailbox" aria-selected="true">Messages</button>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <!--Mailbox Tab -->
        <div class="tab-pane fade active show" id="mailbox" aria-labelledby="mailbox-tab" role="tabpanel">
            <div class="table-responsive">
        <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
        <?php
$sql_pending = "SELECT * FROM message";
$result_pending = $conn->query($sql_pending);

if ($result_pending && $result_pending->num_rows > 0) {
    echo "<form action='UpdateStock.php' method='POST'>"; 
    echo "<table class='table email-table no-wrap table-hover v-middle mb-0 font-14'>";

    while ($row = $result_pending->fetch_assoc()) {
        echo "<tr>";
        echo "<td><i class='las la-square-full'></i></td>"; 
        echo "<td>" . $row["inbox"] . "</td>";
        // Display the product name from 'uniforms' table based on message
        $product_id = $row["mess_id"]; // Assuming there's a 'product_id' in the 'message' table linking to 'uniforms'
        $product_query = "SELECT uniforms FROM reservations WHERE id = $product_id";
        $product_result = $conn->query($product_query);
        if ($product_result && $product_result->num_rows > 0) {
            $product_row = $product_result->fetch_assoc();
            $product_name = $product_row['uniforms'];
            echo "<input type='hidden' name='product_id[]' value='$product_id'>"; // Include product ID in form for processing
            echo "<input type='hidden' name='product_name[]' value='$product_name'>"; // Include product name in form for processing
        } else {
            echo "<td> </td>";
        }
        echo "</tr>";
    }   
} else {
    // If there are no pending reservations
    echo "<p>Empty</p>";
}
?>




            </tbody>
        </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

                </div>

            </div>
        </div>
    </div>

                  
                <!-- Display -->
            </div>

                                                                    
                                        
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            
            </div>
            
        </main>
        
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="UpdateStock.php" method="POST"> <!-- Change action to the appropriate PHP script -->
                    <div class="mb-3">
                        <label for="recipient-name" class="form-label">Name:</label>
                        <input type="text" class="form-control text-right" id="recipient-name" name="name"> <!-- Added 'name' attribute -->
                    </div>
                    <div class="mb-3">
                        <label for="uniform-select" class="form-label">Uniforms:</label>
                        <select class="form-select form-select-sm" id="uniform-select" name="Uniforms">
                            <?php
                            $sql = "SELECT * FROM uniforms";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row['ProductName']) . '">' . htmlspecialchars($row['ProductName']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="Quantity" value="0" min="0" max="99">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="form-label">Message:</label>
                        <textarea class="form-control" id="message-text" name="message-text"></textarea> <!-- Added 'name' attribute -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary" name="send_message">Send Reservation</button> <!-- Added 'name' attribute and changed button type to submit -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="vendor\bootstrap.bundle.min.js"></script>
<script>
const btn = document.querySelector('button[name="send_message"]');
btn.addEventListener('click', () => {
    alert('Reservation Sent! Please always check your inbox.'); 
});
</script>
</html>