<?php
    $category_id = $_GET['id'];
    $Centre = new Centre($Conn);
    $centres = $Centre->getAllCentres($category_id);
?>
    <div class="container">
    <div id="carouselExampleControls" class="carousel slide d-flex justify-content-center" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php
            $i = 0;
            foreach($centres as $centre) {
            ?><a href="index.php?p=centre&id=<?php echo $centre['centre_id'];?>"><?php
            if ($i == 0) {
                ?>
                <div class="carousel-item active">
            <?php
            } else{
                ?>
                <div class="carousel-item">
                <?php
            }$i++;?>
            <img src="sports_centre_images/<?php echo $centre['centre_image'];?>" alt="<?php echo $centre['centre_name'];?>">
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
    <h1 class="mb-4 pb-2 mt-2">Centres</h1>
    <p> Browse the range of sports centres below: </p>
    <div class="row">
        <?php foreach($centres as $centre) { ?>
            <div class="col-md-3">
            <a href="index.php?p=centre&id=<?php echo $centre['centre_id']; ?>">
                <div class="sports-centre-card">
                <div class="sports-centre-card-image" style="background-image: url('./sports_centre_images/<?php echo $centre['centre_image']; ?>');"></div>
                    <h3><?php echo $centre['centre_name']; ?></h3></a>
                </div>
            </a>
            </div>
        <?php }?>
        </div>
    </div>
</div>