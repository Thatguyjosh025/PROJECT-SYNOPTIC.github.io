<?php
include("studentAuthentication.php");
include("connection.php");
if (!isset($_SESSION['view_count'])) {
    $_SESSION['view_count'] = 0;
}
$_SESSION['view_count']++; // Increment the view count on each refresh
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>StudentDashboard</title>
    <link rel="stylesheet" href="./vendor/bootstrap.min.css">
    <link rel="stylesheet" href="css/studentstyle.css">
    <link rel="stylesheet" href="">
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

            if(isset($_SESSION['ID'])) {
                $profile = $_SESSION['ID'];
                $profile_query = "SELECT name, surname, usertype FROM register WHERE ID = $profile"; 
                $result = mysqli_query($conn, $profile_query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name'];
                    $sname = $row['surname'];
                    $usertype = $row['usertype'];

                    echo '<div class="profile-img bg-img" style="background-image: url(./pictures/person.jpg)"></div>';
                    echo "<h4>$name $sname</h4>";
                    echo "<small>$usertype</small>";
                } else {
                    echo "User not found";
                }
            } else {
                echo "User not logged in";
            }
            ?>
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
                    
                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>
                        
                    </div>
                </div>
            </div>
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h1>Student</h1>
                <small>Home / Dashboard</small>
            </div>
            
            <div class="page-content">
                <!-- Display -->
                <div class="col-md-2">
                    <!-- Search input -->
                    <div class="input-group mb-3">
                    <span class="input-group-text"><i class="las la-search"></i></span>
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search...">
                    </div>
                </div>
                    <div class="analytics">
                    <?php
                        $sqlget = "SELECT ProductName, Photo, Quantity, Price FROM uniforms WHERE archived = 1";
                        $result = mysqli_query($conn, $sqlget);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($uniform = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="card">
                                    <div class="card-head">
                                        <h4><?php echo $uniform['ProductName']; ?></h4>
                                    </div>
                                    <div class="card-progress">
                                        <img src="uploads/<?php echo $uniform['Photo']; ?>">
                                        <div class="card-indicator">
                                            <!-- Hidden inputs for submitting data -->
                                            <input type="hidden" name="uniforms[]" value="<?php echo $uniform['ProductName']; ?>">
                                            <label for="">Quantity</label>
                                            <br>
                                            <input type="text" name="quantity[]" value="<?php echo ($uniform['Quantity'] == 0) ? 'Unavailable' : $uniform['Quantity']; ?>" disabled>
                                            <br>
                                            <label for="">Price</label>
                                            <br>
                                            <input type="text" name="price[]" value="<?php echo $uniform['Price']; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No uniform data available.";
                        }
                     ?>
                     <!-- Display -->
                                          
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


    </div>
</div>
</body>
<script src = "vendor\bootstrap.bundle.min.js"></script>
<script>

function filterItems() {
    // Get the search query entered by the user
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    
    // Get all the cards containing items
    const cards = document.querySelectorAll('.analytics .card');
    
    // Iterate through the cards using a for loop
    for (let i = 0; i < cards.length; i++) {
        const card = cards[i];
        const productName = card.querySelector('.card-head h4').textContent.toLowerCase();
        
        // Toggle the card's display based on search query match
        if (productName.includes(searchQuery)) {
            card.style.display = 'block'; // Show the card if it matches the search
        } else {
            card.style.display = 'none'; // Hide the card if it doesn't match the search
        }
    }
}


// Event listener for the search input
document.getElementById('searchInput').addEventListener('input', filterItems);

//reservation notif
const btn = document.querySelector('button[name="send_message"]');
btn.addEventListener('click', () => {
    alert('Reservation Sent! Please always check your inbox.'); 
});

//limit
document.addEventListener('DOMContentLoaded', function() {
    var quantityInput = document.getElementById('quantity');
    
    quantityInput.addEventListener('input', function() {
        var enteredValue = parseInt(quantityInput.value, 10);
        if (enteredValue > 99) {
            quantityInput.value = 99; // Set the value to 99 if it exceeds
        }
    });
});
</script>
</html>