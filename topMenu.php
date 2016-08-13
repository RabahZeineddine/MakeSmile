<header class="headerTopMenu">
    <section class="headerImages">

        <img src="images/title.png" alt="image" class="title" />


        <img src="images/home/header.png" alt="image" class="logo" />

    </section>
    <section>
        <nav>
            <ul>
                <li>
                    <a href="home.php">HOME</a>
                </li>

                <li>
                    <a href="trending.php">TRENDING</a>
                </li>
                </li>
                <li>
                    <a href="contact.php">CONTACT</a>
                </li>
                <li>
                    <a href="about.php">ABOUT</a>
                </li>
            </ul>
         <div>
        <?php 
 
            if(! isset($_SESSION['username'])){
               echo "
                <a href='signup.php'><input type='button' value='Sign up' class='signup_nav_button' /></a>
                <a href='login.php'><input type='button' value='Login' class='login_nav_button'/></a>
                    
          ";
            }
        ?>
       
        <input type="search" placeholder="Search" class="searchInput" /></div>
        </nav>
        
    </section>
</header>