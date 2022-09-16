<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">
    <!-- css link -->
    <link rel="stylesheet" type="text/css" href="./style.css">
    <!-- font awsome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Management Information System</title>
</head>

<body>

    <div class="container">
        <nav id="navbar">
            <h2>CyberTM</h2>
            <ul>
                <li><a href="#TheTeam">The Team</a></li>
                <li><a href="#TheMIS">The MIS Model</a></li>
            </ul>
        </nav>
        <main class="MidSpace" id="ripple">

            <!-- <div id="flare-js"></div> -->
            <div class="midtext"  >
                <p data-aos="zoom-in">DevBhoomi Cyber Hackathon 2.0</p>
                <h1 data-aos="zoom-in">The Management Information System Model</h1>

                <button id="getStarted" onclick="login()" > Get Started</button>

                <div id="classic">
                    <ul>
                        <li><a href="./adminlogin.php" >Login as Admin(Head)</a></li>
                        <li><a href="./PoliceRegistration.php" >Login/Register as Police Officer</a></li>
                        <li><a href="./UserRegistration.php" >Login/Register as User</a></li>
                        
                        
                    </ul>
                </div>

            </div>

        </main>

        <div id="TheTeam">
            
            <div class="card-box" data-aos="fade-up" data-aos-duration="2000">
                <div class="heading">
                    <h2>CyberTM</h2>
                </div>

                <div class="main-box">
                    <div class=" box" data-aos="fade-up" data-aos-anchor-placement="top-bottom"  data-aos-delay="1000">
                        <p><i class="fa-solid fa-user"></i> Divyansh Ojha <br> <i class="fa-solid fa-book"></i> Student
                            <br> <i class="fa-solid fa-building-columns"></i> Vellore Institute Of Technology Bhopal
                            <br> <i class="fa-solid fa-fingerprint"></i> Field of Study -
                            Cyber Security <br> <i class="fa-solid fa-location-dot"></i>  India, Madhya Pradesh <br> <i
                                class="fa-solid fa-phone"></i> 8821890661
                        </p>
                    </div>
                    <div class=" box" data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom"  data-aos-delay="1000">
                        <p><i class="fa-solid fa-user"></i> Harish Carpenter <br><i class="fa-solid fa-book"></i>
                            Student <br> <i class="fa-solid fa-building-columns"></i> Vellore Institute Of Technology
                            Bhopal <br> <i class="fa-solid fa-fingerprint"></i> Field of Study
                            -
                            Cyber Security <br> <i class="fa-solid fa-location-dot"></i>  India, Madhya Pradesh <br> <i
                                class="fa-solid fa-phone"></i> 7999365760 </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="TheMIS" data-aos="fade-up" data-aos-duration="2000">
            <div class="newBox">
                <h2 class="Head" style="font-size:2rem; ">The Management Information System Model</h2>
                <p>( Separate Login/Registration functionalities for Police and Normal users. Police head will be the Admin. )</p>
            </div>

            <div class="blocks">
                <div class="rec" data-aos="flip-left"
                data-aos-easing="ease-out-cubic"
                data-aos-duration="1500">
                    <h2 class="h2Edit">Normal Users functionalities.</h2>
                    <ol >
                        <li> Case Submission with evidence to Police. </li>
                        <li> Case Tracking. </li>
                        <li> Send withdraw case Request to police.</li>
                    </ol>
                </div>
                <div class="rec" data-aos="flip-left"
                data-aos-easing="ease-out-cubic"
                data-aos-duration="1500">
                    <h2 class="h2Edit">Police Officer functionalities.</h2>
                    <ol >
                        <li>Access to Every Case Report.</li>
                        <li>Access to Hotspot Areas list.</li>
                        <li>Access to Hotspot Area list based on Crime type.</li>
                        <li>Manage Case Reports like Detetion, Modification, Feedback to user etc.</li>
                        <li>Right to aprove the case withdraw Request after Proper investigation.</li>
                    </ol>
                </div>
                <div class="rec" data-aos="flip-left"
                data-aos-easing="ease-out-cubic"
                data-aos-duration="1500">
                    <h2 class="h2Edit">Police Head functionalities.</h2>
                    <ol >
                        <li>Access to every fuctionalties of Police Officers.</li>
                        <li>Access to the Attendace of the Police Officers.</li>
                        <li>Access to Police officers list.</li>
                    </ol>
                </div>
            </div>

        </div>
        <footer id="footer">

            <div class="foot-nav">
                <h2>CyberTM</h2>
                <a href="#TheTeam">The Team</a></li>
                <a href="#TheMIS">The MIS Model</a></li>

            </div>

            <div class="contact">
                <span><a href="tel:7999365760"><i class="fa-solid fa-phone footIcon"></i>8821890661</a></span>
                <span><a href="tel:8821890661"><i class="fa-solid fa-phone footIcon"></i>7999365760</a></span>
            </div>

            <div class="Mail">
                <span><i class="fa-solid fa-envelope-open-text footIcon"></i> divyansh.ojha2020@vitbhopal.ac.in</span>
                <span><i class="fa-solid fa-envelope-open-text footIcon"></i>
                    harish.carpenter2020@vitbhopal.ac.in</span>
            </div>

        </footer>
    </div>

    

   
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/jquery.ripples@0.6.3/dist/jquery.ripples.min.js'></script>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="script.js"></script>

</body>

</html>