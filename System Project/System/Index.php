<?php
include("login-access.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="stylesheet" href="./vendor/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Landing Page</title>
</head>
<body>
    <header>
        <a href="#" class="logo"><img src="./pictures/sti-logo.png" alt=""></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#inquire-unif">Inquire</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>


    </header>

    <!-- HOME SECTION-->
    <section class="home" id="home">
        <div class="home-text">
            <span>Welcome To</span>
            <h1>STI Syncquiry</h1>
            <h2>Where Curiosity meets clarity </h2>
            <h2>Within ProWare's innovative Inquiry System</h2>
            <h2>Uncover the depths of information and solutions</h2>
            <h2>through a seamless exploration.</h2>
            <h3>See the Available Uniforms</h3>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
        </div>
        <div class="home-img">
            <img src="./pictures/home-background.png" alt="">
        </div>
    </section>

     <section class="inquire" id="inquire">
        <div class="uniform-container">
            <div class="box2">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./pictures/STI5.jpg" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="./pictures/STI.jpg" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="./pictures/STI3.jpg" class="d-block w-100" alt="Slide 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="inquire-unif" id="inquire-unif">
        <div class="heading">
            <span>Where style meets inquiry</span>
            <h1>View Uniform</h1>
        </div>
        <div class="uniform-container">
            <div class="box">
                <div class="box-img">
                    <img src="./pictures/bsit.png" alt="">
                </div>
                <h2>BSIT Unifrom</h2>
                <!-- Put Price Info Here -->
                <a href="./pictures/bsit.png" class="btn">View Now</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="./pictures/bshm.png" alt="">
                </div>
                <h2>BSHM Unifrom</h2>
                <!-- Put Price Info Here -->
                <a href="pictures\bshm.png" class="btn">View Now</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="./pictures/bsba-unif.jpg" alt="">
                </div>
                <h2>BSBA Unifrom</h2>
                <!-- Put Price Info Here -->
                <a href="pictures\bshm.png" class="btn">View Now</a>
            </div>
        </div>
    </section>
    <div></div>
     <!-- About -->
     <section class="about" id="about">
    <div class="about-img">
        <img src="pictures\STI-PIC.jpg" alt="">
    </div>
    <div class="about-text">
    <h2>Where Curiosity Meets Clarity</h2>
    <p>Welcome to Proware's innovative inquiry system, where we foster an environment where curiosity and clarity intersect.</p>
    <p>Within our platform, you'll delve into the depths of information and solutions, experiencing a seamless exploration designed to simplify your quest for knowledge.</p>
    <p>We believe in the transformative power of exploration and discovery.</p>
    <p>At Proware, we're dedicated to providing an intuitive space that empowers users to uncover solutions effectively.</p>
    <p>Join us in this journey where curiosity leads to clarity, and exploration brings practical solutions at your fingertips.</p>
</div>

</section>


        <section class="contact" id="contact">
            <div class="social">
                <a href="https://www.facebook.com/alabang.sti.edu" target="_blank" ><i class='lab la-facebook'></i> STI College Alabang</a>
                <br>
                <a><i class='lar la-building'></i> RZB Bldg. Interior Montillano St. Alabang, Muntinlupa City</a>
                <br>
                <a><i class='las la-envelope'></i> sti.alabang@gmail.com</a>
                <br>
                <a href="https://www.sti.edu/" target="_blank"><i class='las la-link'></i> sti.edu</a>
            </div>
            <div class="links">
                <a href="https://www.sti.edu/dataprivacy.asp"  target="_blank">Privacy Policy</a>
                <a href="Terms and Conditions.pdf" target="Terms and Conditions.pdf">Term Of Use</a>
                <a href="https://www.facebook.com/alabang.sti.edu" target="_blank">Our School</a>
            </div>
            <p>&#169; 2023 STI Syncquiry All Right Reserved.</p>
        </section>

    <div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="login-container">
                <form id="login-form" action="login.php" method="POST">
                    <h1>LOG-IN</h1>
                    <p>Please fill in this form to login</p>
                    <hr>

                    <div class="input-field">
                        <label for="email">Email/Username</label>
                        <input type="text" class="inpus" id="email" name="email" placeholder="Enter Email or Username" autocomplete="off">
                    </div>

                    <div class="input-field">
                        <label for="password">Password</label>
                        <input type="password" class="inppass" id="password" name="password" placeholder="Enter Password" autocomplete="off">
                    </div>

                    <button type="submit" class="btnlog" id="login-button" name="login">LOGIN</button>
                    <div class="login-signup">
                        <p>No account? <a href="signup.php" style="text-decoration: none;" class="register-link">Sign up now</a></p>
                    </div>
                </form>
    </div>
    </div>
  </div>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-padding-top: 2rem;
            text-decoration: none;
            list-style: none;
            scroll-behavior: smooth;
            font-family: "Poppins", sans-serif;
        }
        :root {
            --main-color: #34425A;
            --second-color: #132135;
        }
        section {
            padding: 50px 10%;
        }
        .inquire-unif{
            padding: 20px 5%;
            background-color: #c1e0f9;
        }
        
        *::selection {
            color: #fff;
            background: var(--main-color);
        }
        img {
            width: 100%;
        }
        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            box-shadow: 0 4px 41px rgb(14 55 54 / 14%);
            padding: 5px 5%;
            transition: 0.2s;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            width: 60px;
        }
        .navbar {
            display: flex;
        }
        .navbar a {
            font-size: 1rem;
            padding: 11px 20px;
            color: var(--second-color);
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: none;
        }
        .navbar a:hover {
            color: #7ec4fd;
        }
        #menu-icon {
            font-size: 24px;
            cursor: pointer;
            z-index: 1001;
            display: none;
        }
        .home {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            background: #c1e0f9;
            gap: 1rem;
        }
        .home-text {
            flex: 1 1 17rem;
        }
        .home-img {
            flex: 1 1 17rem;
        }
        .home-text span {
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--second-color);
        }
        .home-text h1 {
            font-size: 4.2rem;
            color: var(--main-color);
            font-weight: bolder;
        }
        .home-text h2 {
            font-size: 1.8rem;
            font-weight: 600;
            font-family:  'Poppins', sans-serif;
            color: var(--second-color);
            text-transform: uppercase;
            margin: 2rem 0 1.4rem;
        }
        .home-text h3 {
            font-weight: 600;
            color: var(--second-color);
            text-transform: uppercase;
            margin: 0.5rem 0 1.4rem;
            font-size: 1rem;
        }
        .btn {
            padding: 7px 16px;
            border: 2px solid var(--second-color);
            border-radius: 7px;
            color: var(--second-color);
            font-weight: 500;
        }
        .btn:hover {
            color: #fff;
            background-color: var(--second-color);
        }
        .login-btn{
            padding: 0 0;
            border: 1px solid var(--second-color);
            border-radius: 50px;
            
        }
        .login-btn:hover {
            background-color: var(--main-color);
        }
        .heading {
            text-align: center;
            text-transform: uppercase;
        }
        .heading span {
            font-size: 1rem;
            font-weight: 600;
            color: var(--second-color);
        }
        .heading h1 {
            font-size: 2rem;
            color: var(--main-color);
        }
        .uniform-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .uniform-container .box {
            flex: 1 1 10rem;
            background: white;
            padding: 20px;
            display: flex;
            text-align: center;
            flex-direction: column;
            align-items: center;
            border-radius: 0.5rem;
            margin-top: 5rem;
        }
        .box2 {
            flex: 1 1 10rem;
            background: #fff;
            padding: 20px;
            display: flex;
            text-align: center;
            flex-direction: column;
            align-items: center;
            margin-top: 0rem;
            border-radius: 0.5rem;
        }
        .uniform-container .box .box-img {
            width: 150px;
            height: 150px;
        }
        .uniform-container .box .box-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }
        .uniform-container .box h2 {
            color: var(--main-color);
            font-size: 1.2rem;
        }
        .uniform-container .box span {
            color: var(--main-color);
            font-size: 1.4rem;
            font-weight: 500;
            margin: 0.2rem 0 0.5rem;
        }
        .box .btn {
            border: 2px solid var(--main-color);
            color: var(--main-color);
        }
        .box .btn:hover {
            background: var(--main-color);
            color: #fff;
        }
        .home-text{
            margin-bottom: 40%;
        }
        .modal-content{
        width: 80%;
        }
        #carouselExample {
            /* Add specific styles for the carousel container if needed */
            /* For example: */
            width: 100%;
            max-width: 800px; /* Adjust as per your layout */
            margin: auto; /* Center the carousel */
        }
        
        #carouselExample img {
            width: 100%; /* Ensures images fill the carousel container */
            height: 100%; /* Retains aspect ratio */
            object-fit: cover;
        }
        .about {
            display: flex;
            flex-wrap: wrap;
            background: #c1e0f9;;
            gap: 1.5rem;
        }
        .about-img {
            flex: 1 1 5rem;
        }
        .about-text {
            flex: 1 1 17rem;
        }
        .about-text h2 {
            font-size: 1.2rem;
            color: var(--second-color);
        }
        .about-text p {
            margin: 0.5rem 0 1rem;
            text-align: justify;
            font-size: 16px;
        }
        .contact {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .social a {
            font-size: 25px;
            margin: 0.5rem;
            text-decoration: none;
            color: black;
        }
        .social a .bx {
            padding: 5px;
            color: #fff;
            background: black;
            border-radius: 50%;
        }
        .social a .bx:hover {
            background: var(--main-color);
        }
        .links {
            margin: 1rem 0 1rem;
        }
        .links a {
            font-size: 1rem;
            font-weight: 500;
            color: var(--second-color);
            padding: 1rem;
        }
        .links a:hover {
            color: var(--main-color);
        }
        .contact p {
            text-align: center;
        }
        
    </style>
</body>
<script src="./vendor/bootstrap.bundle.min.js"></script>
</html>