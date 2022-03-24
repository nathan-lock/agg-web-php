<?php
    $centre_id = $_GET['id'];

    $Centre = new Centre($Conn);
    $centres = $Centre->getCentre($centre_id);
    $centre = $centres[0];
    if($_POST['rating']) {
        $Review = new Review($Conn);
        $Review->createReview([
            "centre_id" => (int) $_GET['id'],
            "review_rating" => $_POST['rating'],
            "rating_comments" => $_POST['rating_comments']
        ]);
    }

    $Review = new Review($Conn);
    $avg_rating = $Review->calculateRating($_GET['id']);
    $avg_rating = round($avg_rating['avg_rating'], 1);
    $reviews = $Review->getReviews($_GET['id']);
?>
<div class="container">
    <h1><?php echo $centre['centre_name'];?></h1>
    <div class="row">
        <div class="col-md-6 mt-2">    
            <img src="sports_centre_images/<?php echo $centre['centre_image'];?>" alt="<?php echo $centre['centre_name'];?>">
        </div>
        <div class="col-md-6 mt-2">
            <div class="row">
                <p><?php echo $centre['centre_description'];?></p>
                <ul class="centre-features">
                    <li><i class="fas fa-dollar-sign"></i><?php echo $centre['centre_price'];?></li>
                    <li><i class="fas fa-tags"></i> <?php echo $centre['centre_tags'];?></li>
                    <li>
    
                    <li><i class="fas fa-star-half-alt"></i> <?php echo $avg_rating; ?> Stars</li>
                    </li>
                </ul>
                <?php
                    $Favourite = new Favourite($Conn);
                    $is_fav = $Favourite->isFavourite($_GET['id']);

                    if($is_fav) {
                    ?>
                        <button id="removeFav" type="button" class="btn btn-primary mb-3" data-centreid="<?php echo $_GET['id']; ?>">Remove from favourites</button>
                    <?php
                    }else{
                    ?>
                        <button id="addFav" type="button" class="btn btn-primary mb-3" data-centreid="<?php echo $_GET['id']; ?>">Add to favourites</button>
                    <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-2">  
            <h2 class="mt-2">Leave a review</h2>
            <?php
                if(!$_SESSION['is_loggedin']){
            ?>
                <p>Unfortunately, only registered users can leave a review.</p>
            <?php
                } elseif($Review->findUserReview($centre_id)){
            ?>
                <p>Unfortunately, you can only leave one review per sports centre.</p>
            <?php
                }else{
            ?>
                <form id="review-form" action="" method="post">
                    <div class="form-group">
                        <label for="rating_comments">Comments</label>
                        <input type="text" class="form-control" id="rating_comments" name="rating_comments">
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <select class="form-control" id="rating" name="rating">
                            <option value="1">1 Star (Very bad)</option>
                            <option value="2">2 Star (Bad)</option>
                            <option value="3">3 Star (Okay)</option>
                            <option value="4">4 Star (Good)</option>
                            <option value="5">5 Star (Very Good)</option>
                        </select>
                    </div>
                    <button class="mt-2" type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php
                }
            ?>
        </div>
        <div class="col-md-6 mt-2">  
            <h2>Location</h2>
                <div id="googleMap" style="width:100%;height:400px;"></div>
                <script>
                    function myMap() {
                        var mapProp= {
                            center:new google.maps.LatLng(<?php echo $centre['location_long'];?>, <?php echo $centre['location_lat'];?> ),
                            zoom:15,
                        };
                        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                        const image = "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
                        const beachMarker = new google.maps.Marker({
                            position: { lat: <?php echo $centre['location_long'];?>, lng: <?php echo $centre['location_lat'];?> },
                            map,
                            icon: image,
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBk4UehrJ4ROe8uVhHiwNDBUxEKuMZI1jU&callback=myMap"></script>
            </div>
        </div>

    <h2> Reviews </h2>
    <?php foreach($reviews as $review) { ?>
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title"><?php echo $review['first_name']; ?> <?php echo $review['last_name']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?php for ($k = 0 ; $k < $review['review_rating']; $k++){ ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                    </svg>
                    <?php } ?>
                </h6>
                <p class="card-text"><?php echo $review['rating_comments']; ?> </p>
            </div>
        </div>
    <?php }?>
</div>