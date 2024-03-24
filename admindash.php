<?php
include("Authentication.php");
include("connection.php");
$view_count = isset($_SESSION['view_count']) ? $_SESSION['view_count'] : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>AdminDashboard</title>
    <link rel="stylesheet" href="./vendor/bootstrap.min.css">
    <link rel="stylesheet" href="css/admindashstyle.css">
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
                        
                        <span class=""></span>
                        <a href="">
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h1>Admin</h1>
                <small>Home / Dashboard</small>
            </div>
            
            <div class="page-content">
            
                <div class="analytics">

                    <div class="card">
                        <?php
                        //All rows are selected and counted at this case
                        $count = "SELECT COUNT(*) FROM uniforms";
                        $count_result = $conn->query("$count");

                        $total_products = 0;

                        if($count_result && $count_result->num_rows > 0){
                            $row = $count_result->fetch_row();
                            $total_products = $row[0];
                        }
                        ?>
                        <div class="card-head">
                            <h2><?php echo $total_products?></h2>
                            <span class="las la-tags"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total of Products</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: <?php echo ($total_products * 2). '%'; ?>"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $view_count; ?></h2>
                            <span class="las la-eye"></span>
                         </div>
                        <div class="card-progress">
                            <small>Page view</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width:<?php echo ($view_count * 2). '%'; ?>"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <?php 
                        $total = "SELECT SUM(Quantity) FROM uniforms";
                        $total_result = $conn->query("$total");

                        $total_quantity = 0;

                        if($total_result && $total_result->num_rows > 0){
                            $row = $total_result -> fetch_row();
                            $total_quantity = $row[0];
                        }   

                        ?>
                        <div class="card-head">
                            <h2><?php echo $total_quantity ?></h2>
                            <span class="las la-shopping-cart"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total Stocks of Products</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: <?php echo ($total_quantity * 2). '%'; ?>"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                         <?php
                        // Query to count pending reservations why does it not SELECT * from reservation?
                        // If i do the standard SELECT * from reservation it will count all rows including the reservation that is labeled RESERVED
                        // We only want to count that has labeled PENDING
                        $count_query = "SELECT COUNT(*) AS total_pending FROM reservations WHERE Status = 'Pending'";
                        $count_result = $conn->query($count_query);

                        $total_pending = 0;

                        if ($count_result && $count_result->num_rows > 0) {
                            $row = $count_result->fetch_assoc();
                            $total_pending = $row['total_pending'];
                        }
                        ?>
                        <div class="card-head">
                            <h2><?php echo $total_pending; ?></h2>
                            <span class="las la-envelope"></span>
                        </div>
                        <div class="card-progress">
                            <small>Reservations received</small>
                            <div class="card-indicator">
                                <div class="indicator four" style="width: <?php echo ($total_pending * 2) . '%'; ?>"></div>
                            </div>
                        </div>
                    </div>


                </div>         
        </div>
            
        </main>
        
    </div>
</body>
<script>

function printTable() { 
    const printContents = document.querySelector('.datatable_update').innerHTML; // Get the HTML content of the element with class 'datatable_update'
    const originalContents = document.body.innerHTML; // Store the original HTML content of the entire document body
    
    document.body.innerHTML = printContents; // Replace the entire document body content with the content of the 'datatable_update' element
    window.print(); // Trigger the browser's print functionality
    
    document.body.innerHTML = originalContents; // Restore the original HTML content of the document body after printing
}


const updateAvailabilityButton = document.getElementById('update-availability');
    updateAvailabilityButton.addEventListener('click', () => {
        alert('Availability updated!'); 
    });

    const btn2Button = document.getElementById('btn2');
          btn2Button.addEventListener('click', () => {
        alert('Product Decrease!'); 
    });
    
    </script>
</html>