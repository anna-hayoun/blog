<?php

if(!isset($_SESSION))
{
    session_start();
}

require('alldata/database.php');

@$log = $_SESSION['logged'];

?>

<footer class="text-center text-black">

<div class="foot-contain">

<nav>
    <ul class="foot">
        <div class="foot-el1"><li><a href="index.php">accueil</a></li></div>

        <?php if(isset($log)) { ?>
            <div class="foot-el2"><li><a href="articles.php">articles</a></li></div>
        <?php } ?>
    </ul>
</nav>

<!-- Social media -->
<section class="mb-4">
    <!-- Facebook -->
    <a class="btn btn-floating m-1" href="https://www.facebook.com/" role="button" data-mdb-ripple-color="dark">
        <img src="img/facebook.png" alt="Facebook"/>
    </a>

    <!-- Twitter -->
      <a class="btn btn-floating m-1" href="https://www.instagram.com/" role="button" data-mdb-ripple-color="dark">
        <img src="img/insta.png" alt="Instagram">
    </a>

    <a class="btn btn-floating m-1" href="https://twitter.com/" role="button" data-mdb-ripple-color="dark">
        <img src="img/twi.png" alt="Twitter">
    </a>

    <a class="btn btn-floating m-1" href="https://github.com/anna-hayoun/blog/" role="button" data-mdb-ripple-color="dark">
        <img src="img/github.png" alt="Github">
    </a>

</section>

<!-- <div class="text-center p-3">
    © 2022 Copyright:
    <a href="https://github.com/anna-hayoun/blog">github.com/anna-hayoun</a>
</div> -->
    
</div>

</footer>
  
