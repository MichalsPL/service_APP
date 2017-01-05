jQuery(document).ready(function($) {
    $("tr[name=click]").click(function() {
        window.document.location = $(this).data("href");
    });
});
    
