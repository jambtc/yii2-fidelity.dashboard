

$("#cssmodeSwitch").click(function() {
    $.ajax({
        url: yiiCssOptions.changeCssMode,
        success: function() {
            window.location.href = window.location.href;
        }
    });
});
