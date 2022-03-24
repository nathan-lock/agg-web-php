<?php
    $category_id = $_GET['id'];
    $Recipe = new Recipe($Conn);
    $recipes = $Recipe->getAllRecipes($category_id);
?>
<div class="container">
    <h1 class="mb-4 pb-2">Lunch Recipes</h1>
    <p> Browse out wide range of recipes below. </p>
    <div class="row">
        <?php foreach($recipes as $recipe) { ?>
            <div class="col-md-3">
            <a href="index.php?p=recipe&id=<?php echo $recipe['recipe_id']; ?>">
                <div class="recipe-card">
                <div class="recipe-card-image" style="background-image: url('./recipe-images/<?php echo $recipe['recipe_image']; ?>');"></div>
                    <h3><?php echo $recipe['recipe_name']; ?></h3></a>
                </div>
            </a>
            </div>
        <?php }?>
        </div>
    </div>
</div>