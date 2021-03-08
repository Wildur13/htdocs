<?php
    $title = "Home Page";
    require_once './elements/header.php';
    $database = new PDO('mysql: host=localhost; dbname=candidate','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $result = $database->query('SELECT * FROM users1');
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
    <a href="<?php if ($i === 1): {echo 'https://snake-game13.netlify.app';}?> <?php endif?>" target="blank">
    <img src="/images/img<?= $i?>.png" style="width: 100%" height="400">
    </a>
    <div class="text">Caption <?= $i?></div>
  </div>
  <?php endfor?>
<?php 
  require_once './elements/social.php';
?>
</div>
<br>
<div style="text-align:center">
    <?php for ($i=1; $i<=4; $i++):?>
  <span class="dot"></span> 
    <?php endfor?>
</div>

<?php
    require_once './elements/footer.php'
?>

<script>
var slideIndex = 0;
var myIndex = 0;
showSlides();
carousel();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
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
};

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000); // Change image every 2 seconds
}
</script>