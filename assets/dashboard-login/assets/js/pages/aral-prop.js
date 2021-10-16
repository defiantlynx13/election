jQuery(document).ready(function ($) {

    $('[data-toggle="tooltip"]').tooltip();
    let magnificPopupGalleryConfig = {
        type: 'image',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    };

    $('.image-popup-gallery-item').magnificPopup(magnificPopupGalleryConfig);
});