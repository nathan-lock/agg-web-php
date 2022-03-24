<?php
$Category = new Category($Conn);
$categories = $Category->getAllCategories();
?>
<div class="container">
<div id="carouselExampleControls" class="carousel slide d-flex justify-content-center" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php
        $i = 0;
        foreach($categories as $category) {
          ?><a href="index.php?p=centres&id=<?php echo $category['category_id'];?>"><?php
          if ($i == 0) {
            ?>
            <div class="carousel-item active">
          <?php
          } else{
            ?>
            <div class="carousel-item">
            <?php
          }$i++;?>
          <img src="sports_centre_category_images/<?php echo $category['category_image'];?>" alt="<?php echo $category['category_name'];?>">
          </a>
        </div>
      <?php }?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <h1 class="mb-4 pb-2 mt-2">Sports Centre Categories</h1>
  <div class="row">
    <?php foreach($categories as $category) {?>
      <div class="col-md-3">
        <a href="index.php?p=centres&id=<?php echo $category['category_id'];?>">
          <div class="sports-centre-card">
            <div class="sports-centre-card-image" style="background-image: url('sports_centre_category_images/<?php echo $category['category_image'];?>')"></div>
            <h3><?php echo $category['category_name']; ?></h3>
            <p class="mt-2"><?php echo $category['description']; ?></h3>
          </div>
        </a>
      </div>
    <?php }?>
  </div>
</div>