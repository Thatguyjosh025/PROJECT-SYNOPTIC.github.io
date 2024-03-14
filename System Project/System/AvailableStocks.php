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
            <div class="records table-responsive">

<div>
    <table width="100%">
        
        <tbody>
            <tr>
                <form method="POST" action="UpdateStock.php" enctype="multipart/form-data">
                <div class="home-content">
                    <div class="container mt-2">
                        <h5>ADD PRODUCT</h5>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2 input-group-sm">
                                    <label for="uniforms" class="form-label">Stock Number</label>
                                    <input type="text" class="form-control mb-3" id="uniforms" aria-describedby="uniforms" name="Uniforms" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2 input-group-sm">
                                    <label for="productName" class="form-label">Stock Name</label>
                                    <input type="text" class="form-control mb-3" id="productName" aria-describedby="uniforms" name="ProductName" pattern="[A-Za-z\s\-\/\,\.\']+" title="Name should not contain number and Special Characters">                            
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2 input-group-sm">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" aria-describedby="quantity" name="Quantity" value="0" min="0" max = "99">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2 input-group-sm">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control mb-3" id="price" aria-describedby="price" name="Price">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2 input-group-sm">
                                    <label for="photoUpload" class="form-label">Upload Photo</label>
                                    <input type="file" class="form-control" id="photoUpload" name="Photo" accept="image/*">
                                    <!-- accept="image/*" ensures only image files can be selected do not be intimidated-->
                                </div>
                            </div>
                            <div class="col">
                                <button id="btn3" class="btn btn-md bg-secondary text-white btn-sm mt-4" name="add">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        <hr>

                    <form method="POST" action="UpdateStock.php">
                        <div class="home-content">
                            <div id="content" style="background: white;">
                                <div class="container mt-2">
                    <h5>CONFIGURATION</h5>
                    <div class="row">
                        <div class="col">
                            <label for="uniforms" class="form-label">Stock Number</label>
                            <select class="form-select form-select-sm mt-" aria-label="Large select example" name="Uniforms">
                                <?php
                                $sql = "SELECT * FROM uniforms";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($row['Uniforms']) . '">' . htmlspecialchars($row['Uniforms']) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                                <div class="mb-2 input-group-sm">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" aria-describedby="quantity" name="Quantity" value="0" min="0" max = "99">
                                </div>
                     </div>
                        <div class="col">
                            <div class="mb-2 input-group-sm">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control mb-3" id="price" aria-describedby="price" name="Price">
                            </div>
                        </div>
                        <div class="col">
                            <button id="update-availability" class="btn btn-md bg-secondary text-white btn-sm mt-4" name="Increase">Increase Stock</button>
                        </div>
                        <div class="col">
                            <button id="btn2" class="btn btn-md bg-secondary text-white btn-sm mt-4" name="Decrease">Decrease Stock</button>
                        </div>
                        <div class="col">
                        <button type="submit" class="btn btn-md bg-secondary text-white btn-sm mt-4" name="Archive">Archive Stock</button>
                        </div>
                        <div class="col">
                        <button type="submit" class="btn btn-md bg-secondary text-white btn-sm mt-4" name="Retrieve">Retrieve Stock</button>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </form>

                
                    </td>
              
            </tr>
            
        </tbody>
    </table>

</div>
<hr>
</div>
<div class="col-md-12">
        <div class="datatable">
            <table class="table">
                <?php
                $sqlgetStocks = "SELECT ProductName, Uniforms, Quantity, display_Status FROM uniforms";
                $resultStocks = mysqli_query($conn, $sqlgetStocks);
                
                if ($resultStocks->num_rows > 0) {
                    echo "<h3>Available Stocks</h3>";
                    echo "<table class='table'>";
                    echo "<tr>
                            <th>Stock Number</th>
                            <th>Stock Name</th>
                            <th>Available Stocks</th>
                            <th>Display Status</th>
                        </tr>";
                
                    while ($stockRow = $resultStocks->fetch_assoc()) {
                        $quantity = $stockRow["Quantity"] < 0 ? 0 : $stockRow["Quantity"]; // Set to 0 if negative
                
                        echo "<tr>
                                <td>".$stockRow["Uniforms"]."</td>
                                <td>".$stockRow["ProductName"]."</td>
                                <td>".$quantity."</td>
                                <td>".$stockRow["display_Status"]."</td>
                            </tr>";
                    }
                
                    echo "</table>";
                } else {
                    echo "<p>No stocks available yet.</p>";
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
    const quantityInput = document.getElementById('quantity');

// Add an event listener for the 'input' event
quantityInput.addEventListener('input', function(event) {
    const maxValue = 99;
    if (parseInt(event.target.value) > maxValue) {
        event.target.value = maxValue; // Set value to 99 if it exceeds
    }
});

// Get the quantity input elements within the "CONFIGURATION" section
const quantityInputs = document.querySelectorAll('#quantity');

// Add an event listener for each quantity input field
quantityInputs.forEach((quantityInput) => {
    quantityInput.addEventListener('input', function(event) {
        const maxValue = 99;
        if (parseInt(event.target.value) > maxValue) {
            event.target.value = maxValue; // Set value to 99 if it exceeds
        }
    });
});
//avoid input
document.getElementById('ProductName').addEventListener('input', function() {
      let input = this.value;
      let pattern = /^[A-Za-z\s\-\/\,\.\']+$/;

      if (!pattern.test(input)) {
        document.getElementById('productNameError').textContent = 'Name should not contain numbers or special characters.';
      } else {
        document.getElementById('productNameError').textContent = '';
      }
    });


</script>
</html>