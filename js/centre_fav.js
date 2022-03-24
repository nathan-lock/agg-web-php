$(function() {
    $('body').on('click', '#addFav', function(e) {
        var centre_id = $(this).data('centreid');
        $.ajax({
            method: "POST",
            url: "./ajax/togglefav.php",
            dataType: 'json',
            data: { centre_id: centre_id }
        })
        .done(function( rtnData ) {
            console.log(rtnData);
            $('#addFav').text('Remove from favourites').attr('id', 'removeFav');
        });

    });

    $('body').on('click', '#removeFav', function(e) {
        var centre_id = $(this).data('centreid');
        $.ajax({
            method: "POST",
            url: "./ajax/togglefav.php",
            dataType: 'json',
            data: { centre_id: centre_id }
        })
        .done(function( rtnData ) {
            console.log(rtnData);
            $('#removeFav').text('Add to favourites').attr('id', 'addFav');
        });
    });
}); 
