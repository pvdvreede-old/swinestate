/*
 * This file is used to house the function to change the main photo on the listing page
 * Author: Paul Van de Vreede
 */

/*
 * Function called to change the main photo to the one clicked on
 */

function changePhoto(filename) {

    $('#photo_main img').attr({ src: filename});

}


