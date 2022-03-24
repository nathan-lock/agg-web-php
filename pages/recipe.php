<?php
    if($_POST['rating']) {
        $Review = new Review($Conn);
        $Review->createReview([
            "recipe_id" => (int) $_GET['id'],
            "review_rating" => $_POST['rating']
        ]);
    }
?>
<div class="container">
    <h1 class="test">Test</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/1.jpg');">
                        <a href="./recipe-images/1.jpg" data-lightbox="1"></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/2.jpg');">
                            <a href="./recipe-images/2.jpg" data-lightbox="2"></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/3.jpg');">
                        <a href="./recipe-images/3.jpg" data-lightbox="3"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/1.jpg');">
                        <a href="./recipe-images/1.jpg" data-lightbox="1"></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/2.jpg');">
                            <a href="./recipe-images/2.jpg" data-lightbox="2"></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/3.jpg');">
                        <a href="./recipe-images/3.jpg" data-lightbox="3"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/1.jpg');">
                        <a href="./recipe-images/1.jpg" data-lightbox="1"></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/2.jpg');">
                            <a href="./recipe-images/2.jpg" data-lightbox="2"></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="recipe-image mb-4" style="background-image: url('./recipe-images/3.jpg');">
                        <a href="./recipe-images/3.jpg" data-lightbox="3"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu tincidunt dui. In vulputate eget nisl in sodales. Vestibulum vitae interdum augue, non dictum sapien. Suspendisse et sapien condimentum massa luctus accumsan sit amet eget risus. Praesent in augue tellus. Suspendisse potenti. Vestibulum efficitur condimentum nulla. Ut efficitur, velit in porttitor laoreet, sapien ligula malesuada augue, non porta nisi lacus sed odio. Ut pellentesque condimentum quam, in aliquet mi mollis nec. Vestibulum augue nisi, tempus nec fringilla vel, tempor eu turpis. Sed euismod blandit est, at efficitur ligula eleifend fermentum. Maecenas ut enim enim. Proin quis dolor in massa feugiat vulputate. Nam tempus eros vitae tortor suscipit blandit. Maecenas ornare at lorem eu efficitur. Nam nec nisi erat. </p>
                <ul class="recipe-features">
                    <li><i class="far fa-clock"></i> 20 Min</li>
                    <li><i class="fas fa-users"></i> 4 Servings</li>
                    <li><i class="fas fa-dollar-sign"></i> Budget</li>
                    <li><i class="fas fa-tags"></i> salad, healthy, vegetarian</li>
                    <li>
                    <?php
                        $Review = new Review($Conn);
                        $avg_rating = $Review->calculateRating($_GET['id']);
                        $avg_rating = round($avg_rating['avg_rating'], 1);
                    ?>
                    <li><i class="fas fa-star-half-alt"></i> <?php echo $avg_rating; ?> Stars</li>
                    </li>
                </ul>
                <?php
                    $Favourite = new Favourite($Conn);
                    $is_fav = $Favourite->isFavourite($_GET['id']);

                    if($is_fav) {
                    ?>
                        <button id="removeFav" type="button" class="btn btn-primary mb-3" data-recipeid="<?php echo $_GET['id']; ?>">Remove from favourites</button>
                    <?php
                    }else{
                    ?>
                        <button id="addFav" type="button" class="btn btn-primary mb-3" data-recipeid="<?php echo $_GET['id']; ?>">Add to favourites</button>
                    <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <h2>Location</h2>
    <div id="googleMap" style="width:100%;height:400px;"></div>
    <script>
        function myMap() {
            var mapProp= {
                center:new google.maps.LatLng( -33.89, 151.274 ),
                zoom:15,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            const image = "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
            const beachMarker = new google.maps.Marker({
                position: { lat: -33.89, lng: 151.274 },
                map,
                icon: image,
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBk4UehrJ4ROe8uVhHiwNDBUxEKuMZI1jU&callback=myMap"></script>

    <h2>Leave a review</h2>
    <?php
        if(!$_SESSION['is_loggedin']){
    ?>
        <p>Unfortunately, only registered users can leave a review.</p>
    <?php
        }else{
    ?>
        <form action="" method="post">
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php
        }
    ?>
    </div>
</div>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./node_modules/lightbox2/dist/js/lightbox.min.js"></script>