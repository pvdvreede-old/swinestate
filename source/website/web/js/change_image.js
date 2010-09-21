/*
 * This file is used to house the function to change the main photo on the listing page
 * Author: Paul Van de Vreede
 */

/*
 * Function called to change the main photo to the one clicked on
 */

function changePhoto(filename, magnify) {

    var p = $('#photo_main img');
    
    $('#photo_main').attr({
        src: filename
    });

    MojoMagnify.makeMagnifiable(
        document.getElementById('photo_main'),
        magnify
        );

}


