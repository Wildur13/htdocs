<?php
    $title = "Home Page";
    require_once './elements/header.php';
    $database = new PDO('mysql: host=localhost; dbname=candidate','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $result = $database->query('SELECT * FROM users1');
    $games=["Snake", "Mario", "Subway surfers", "Top Eleven"];
?>

<div class="text-center">
    <h1>
      Welcome
    </h1>
</div>
<div class="text1 monster text-center">
</div>
<div class="slideshow-container">
  <?php for($i=1; $i<=4; $i++):?>
  <div class="mySlides fade">
    <a href="<?php if ($i === 1): {echo 'https://snake-game13.netlify.app';} else: {echo '#';}?> <?php endif?>" target="_blank">
    <img src="/images/img<?= $i?>.png" style="width: 100%" height="400">
    </a>
  </div>
  <?php endfor?>
<?php 
  require_once './elements/social.php';
?>
</div>
<br>
<div class="m-b-20" style="text-align:center">
    <?php for ($i=1; $i<=4; $i++):?>
  <span class="dot"></span>
    <?php endfor?>
</div>
<div class="container">
    <div class="row m-b-20" style="justify-content: space-between;">
        <?php for($i=0; $i<=3; $i++): ?>
        <div class="col-md-3 card shadow" style="width: 19rem; cursor: pointer">
            <img src="./images/img<?=$i+1?>.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $games[$i]?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="<?php if ($i === 0): {echo 'https://snake-game13.netlify.app';} else: {echo '#';}?> <?php endif?>" target="_blank" class="btn btn-primary">Go to the game</a>
            </div>
        </div>
        <?php endfor ?>
    </div>
</div>
<?php
    require_once './elements/footer.php'
?>

<script>
    let slideIndex = 0;
    let myIndex = 0;
    showSlides();
carousel();

function showSlides() {
    let i;
    const slides = document.getElementsByClassName("mySlides");
    const dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
}

function carousel() {
    let i;
    const x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000); // Change image every 2 seconds
}
</script>