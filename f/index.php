<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<body>
<?php
$target_dir = "uploads/"; 
$uploaded_images = [];

$files = glob('uploads/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
foreach ($files as $file) {
    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
        $uploaded_images[] = $target_dir . basename($file);
    }
}
?>
<h2 style="text-align:center">Lightbox</h2>
<div class="row">
<?php
  if (!empty($uploaded_images)):
    foreach ($uploaded_images as $index => $i): ?>
      <div class="column">
        <img src="<?php echo $i; ?>" style="width:100%" onclick="openModal();currentSlide(<?php echo $index + 1; ?>)" class="hover-shadow cursor">
      </div>
    <?php endforeach;
  else: ?>
    <p>No images uploaded yet.</p>
  <?php endif; ?>
</div>

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">
    <?php
    if (!empty($uploaded_images)):
      foreach ($uploaded_images as $index => $i): ?>
        <div class="mySlides">
          <div class="numbertext"><?php echo ($index + 1); ?> / <?php echo count($uploaded_images); ?></div>
          <img src="<?php echo $i; ?>" style="width:100%">
        </div>
      <?php endforeach;
    endif;
    ?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <?php
    if (!empty($uploaded_images)):
      foreach ($uploaded_images as $index => $i): ?>
        <div class="column">
          <img class="demo cursor" src="<?php echo $i; ?>" style="width:100%" onclick="currentSlide(<?php echo ($index + 1); ?>)" alt="Image <?php echo ($index + 1); ?>">
        </div>
      <?php endforeach;
    endif;
    ?>
  </div>
</div>

<a href='/f/upload.html' style="absolute: center;">Add more</a>

<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</body>
</html>
