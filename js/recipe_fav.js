$(function() {
    $('body').on('click', '#addFav', function(e) {
        var recipe_id = $(this).data('recipeid');
        $.ajax({
            method: "POST",
            url: "./ajax/togglefav.php",
            dataType: 'json',
            data: { recipe_id: recipe_id }
        })
        .done(function( rtnData ) {
            console.log(rtnData);
            $('#addFav').text('Remove from favourites').attr('id', 'removeFav');
        });

    });

    $('body').on('click', '#removeFav', function(e) {
        var recipe_id = $(this).data('recipeid');
        $.ajax({
            method: "POST",
            url: "./ajax/togglefav.php",
            dataType: 'json',
            data: { recipe_id: recipe_id }
        })
        .done(function( rtnData ) {
            console.log(rtnData);
            $('#removeFav').text('Add to favourites').attr('id', 'addFav');
        });
    });
}); 
