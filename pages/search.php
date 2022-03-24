<?PHP
    $Centre = new Centre($Conn);
    $centres = $Centre->searchCentres($_POST['query']);
?>
<div class = "container">
    <h1 class="mb-4 pb-2">Search results for "<?php echo $_POST['query']; ?>"</h1>
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