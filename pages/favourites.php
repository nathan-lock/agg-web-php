<div class="container">
    <h1 class="mb-4 pb-2">My Favourites</h1>
    <p>Welcome to your favourites. From here you can view sports centres added to your favourites list.</p>
    <?php
        $Favourite = new Favourite($Conn);
        $user_favs = $Favourite->getAllFavouritesForUser();
    ?>
    <div class="row">
        <?php
            if($user_favs) { 
                foreach($user_favs as $fav) { 
                ?>
                    <div class="col-md-3">
                        <a href="index.php?p=centre&id=<?php echo $fav['centre_id']; ?>">
                            <div class="sports-centre-card">
                            <div class="sports-centre-card-image" style="background-image: url('./sports_centre_images/<?php echo $fav['centre_image']; ?>');"></div>
                                <h3><?php echo $fav['centre_name']; ?></h3></a>
                            </div>
                        </a>
                    </div>
        <?php
                }   
            }
        ?>
    </div>
    </div>
</div>
