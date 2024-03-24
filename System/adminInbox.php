<?php
include("Authentication.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>AdminReservations</title>
    <link rel="stylesheet" href="./vendor/bootstrap.min.css">
    <link rel="stylesheet" href="css/admindashstyle.css">
    <link rel="stylesheet" href="css/adminInbox.css">
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
                <div class="profile-img bg-img" style="background-image: url(./pictures/person.jpg)"></div>
                <h4>Admin</h4>
                <small>Administrator</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="admindash.php" class="active">
                            <span class="las la-home"></span>
                            <small>Admin Dashboard</small>
                        </a>
                    </li>
                       <a href="AvailableStocks.php">
                            <span class="las la-archive"></span>
                            <small>Inventory</small>
                        </a>
                    </li> 
                    </li>
                       <a href="ProductRecords.php">
                            <span class="las la-table"></span>
                            <small>Product Records</small>
                        </a>
                    </li> 
                    <li>
                       <a href="adminInbox.php">
                            <span class="las la-clipboard-list"></span>
                            <small>Reservations</small>
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
                <h1>Admin</h1>
                <small>Inquiries / Inbox</small>
            </div>
            
            <div class="page-content">
                <!-- Display  Inbox -->
                <div class="container-inbox">
        <div class="row">
            <div class="col-md-12">
            <div class="Inbox">
    <div class="card-body bg-primary text-white mailbox-widget pb-0">
        <h2 class="text-white pb-3">Reservation Mailbox</h2>
        <ul class="nav nav-tabs custom-tab border-bottom-0 mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mailbox-tab" data-bs-toggle="tab" data-bs-target="#mailbox" type="button" role="tab" aria-controls="mailbox" aria-selected="true">Pending Reservation List</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reserved-list-tab" data-bs-toggle="tab" data-bs-target="#reserved-list" type="button" role="tab" aria-controls="reserved-list" aria-selected="false">Reserved Ticket List</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reserved-list-tab" data-bs-toggle="tab" data-bs-target="#rejected-list" type="button" role="tab" aria-controls="reserved-list" aria-selected="false">Rejected Ticket List</button>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <!-- Reservation Mailbox Tab -->
        <div class="tab-pane fade active show" id="mailbox" aria-labelledby="mailbox-tab" role="tabpanel">
            <div class="table-responsive">
        <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
            <!-- Table headers -->
            <?php
                $sql_pending = "SELECT * FROM reservations WHERE Status = 'Pending'"; // It Appears when it is Pending status!
                $result_pending = $conn->query($sql_pending);
                
                if ($result_pending && $result_pending->num_rows > 0) {
                    echo "<table class='table email-table no-wrap table-hover v-middle mb-0 font-14'>";
                    echo "<tr>
                            <th>Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                            </tr>";
                
                    while ($row = $result_pending->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["uniforms"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["Message"] . "</td>";
                        echo "<td>" . $row["Status"] . "</td>";
                        echo "<td>" . $row["reserve_date"] . "</td>";
                
                        // Action buttons for each reservation
                        echo "<td>";
                        echo "<form action='UpdateStock.php' method='POST'>";
                        echo "<input type='hidden' name='reservation_id' value='". $row["id"]."'>";
                        echo "<button type='submit' name='approve' class='btn btn-secondary me-4 btn-sm'>Approve</button>";
                        echo "<button type='submit' name='reject' class='btn btn-secondary btn-sm'>Reject</button>";//Reject button was Complicated it uses DELETE it messes up the IDs again hirap neto no idea pa
                        echo "</form>";
                        echo "</td>";
                
                        echo "</tr>";
                    }
                
                    echo "</table>";
                } else {
                    // If there are no pending reservations
                    echo "<p>No Pending Reservations</p>";
                }
                ?>
            </tbody>
        </table>
            </div>
        </div>
        <!-- Reserved List Tab -->
        <div class="tab-pane fade" id="reserved-list" aria-labelledby="reserved-list-tab" role="tabpanel">
            <div class="table-responsive">
            <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                    <!-- Display Reserved Reservations -->
                    <?php
                        $sql_reserved = "SELECT * FROM reservations WHERE Status = 'Reserved'";
                        $result_reserved = $conn->query($sql_reserved);
                        
                        if ($result_reserved->num_rows > 0) {
                            echo "<table class='table email-table no-wrap table-hover v-middle mb-0 font-14'>";
                            echo "<tr>
                                    <th>Name</th>
                                    <th>Product Reserved</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>";
                        
                            while ($row = $result_reserved->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["uniforms"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["Status"] . "</td>";
                                echo "<td>" . $row["reserve_date"] . "</td>"; 
                                
                                echo "<td>";
                                echo "<form action='UpdateStock.php' method='POST'>";
                                echo "<input type='hidden' name='reservation_id' value='". $row["id"]."'>";
                                echo "<button type='submit' name='undo' class='btn btn-secondary btn-sm'>Undo</button>";
                                echo "</form>";
                                echo "</td>";
                                
                                echo "</tr>";
                            }
                        
                            echo "</table>";
                        } else {
                            echo "<p>No Reserved Tickets</p>";
                        }
                    ?>
                </table>
            </div>
        </div>
        <!-- An other tab for rejected reservations? same process above just update the status as reject and it will fall under here --> 
        <div class="tab-pane fade" id="rejected-list" aria-labelledby="reserved-list-tab" role="tabpanel">
            <div class="table-responsive">
            <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                    <!-- Display Reserved Reservations -->
                    <?php
                        $sql_reserved = "SELECT * FROM reservations WHERE Status = 'Rejected'";
                        $result_reserved = $conn->query($sql_reserved);
                        
                        if ($result_reserved->num_rows > 0) {
                            echo "<table class='table email-table no-wrap table-hover v-middle mb-0 font-14'>";
                            echo "<tr>
                                    <th>Name</th>
                                    <th>Product Reserved</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>";
                        
                            while ($row = $result_reserved->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["uniforms"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["Status"] . "</td>";
                                echo "<td>" . $row["reserve_date"] . "</td>"; 
                                
                                echo "<td>";
                                echo "<form action='UpdateStock.php' method='POST'>";
                                echo "<input type='hidden' name='reservation_id' value='". $row["id"]."'>";
                                echo "<button type='submit' name='undo' class='btn btn-secondary btn-sm'>Undo</button>";
                                echo "</form>";
                                echo "</td>";
                                
                                echo "</tr>";
                            }
                        
                            echo "</table>";
                        } else {
                            echo "<p>No Reserved Tickets</p>";
                        }
                    ?>
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
</body>
<script src="vendor\bootstrap.bundle.min.js"> 

</script>
</html>