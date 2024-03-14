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
    <link rel="stylesheet" href="css/AvailableStocks.css">
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
            <div class="col">
                <button id="btn2" class="btn btn-md bg-secondary text-white btn-sm mt-1 mb-3" name="Print" onclick="printTable()">Print Table</button>
            </div>
            <div class="col-md-12">
            <div class="datatable_update">
                <table class="table">
                    <?php 
                    //linking happens this is the part where sir rod said to us we need to loop and i find out that 2 tables needs to
                    // be link our else we will be stuck at the same output and problem
                    // did not fully understand but i follow what is see on the internet and forums
                    $sqlgetUpdates = "SELECT pu.product_id, ProductName, pu.quantity_change, pu.price_change, pu.update_type, pu.update_date, u.Uniforms 
                    FROM product_update pu
                    INNER JOIN uniforms u ON pu.product_id = u.id
                    ORDER BY pu.update_date ASC"; // asc short for ascending for oldest to newest
                        $resultUpdates = mysqli_query($conn, $sqlgetUpdates);
                        
                        if ($resultUpdates->num_rows > 0) {
                            echo "<h3>Stock Records</h3>";
                            echo "<table class='table'>";
                            echo "<tr>
                                    <th>Stock Number</th>
                                    <th>Stock Name</th>
                                    <th>Quantity Changes</th>
                                    <th>Price Changes</th>
                                    <th>Update Type</th>
                                    <th>Date</th>
                                    </tr>";
                        
                            while ($row = $resultUpdates->fetch_assoc()) {
                                echo "<tr>
                                        <td>".$row["Uniforms"]."</td>
                                        <td>".$row["ProductName"]."</td>
                                        <td>".$row["quantity_change"]."</td>
                                        <td>".$row["price_change"]."</td>
                                        <td>".$row["update_type"]."</td>
                                        <td>".$row["update_date"]."</td>
                                        </tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No quantity updates yet.";
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
<script src="vendor\bootstrap.bundle.min.js"></script>
<script>
function printTable() { 
    const printContents = document.querySelector('.datatable_update').innerHTML; // Get the HTML content of the element with class 'datatable_update'
    const originalContents = document.body.innerHTML; // Store the original HTML content of the entire document body
    
    document.body.innerHTML = printContents; // Replace the entire document body content with the content of the 'datatable_update' element
    window.print(); // Trigger the browser's print functionality
    
    document.body.innerHTML = originalContents; // Restore the original HTML content of the document body after printing
}
</script>
</html>