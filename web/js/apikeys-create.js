




$("#"+yiiApiOptions.controller+"-id_merchant").change(function() {
    var idMerchant = this.value;
    $.ajax({
        url: yiiApiOptions.getStores,
        dataType: "json",
        data: {
            id: idMerchant
        },
        beforeSend: function() {
            $("#"+yiiApiOptions.controller+"-id_store").html(yiiApiOptions.spinner);
        },
        success: function(result) {
            console.log(result);
            var my_list = $("#"+yiiApiOptions.controller+"-id_store").empty();
            $.each(result, function(i, v){
                my_list.append($("<option>").attr('value',i).text(v));
            });
        }
    });
});


var btnApikeysCreate = document.querySelector('#btnApikeysCreate');

if ($( "#btnApikeysCreate" ).length){
    btnApikeysCreate.addEventListener('click', function(){
        api.get();
    });
}


var api = {
    get: function(func){
        $.ajax({
            url: yiiApiOptions.getApiKeys,
            type: 'GET',
            dataType: "json",
            complete: function (json) {
                js = json.responseJSON;

                $('#'+yiiApiOptions.controller+'-public_key').val(js.public);
                $('#'+yiiApiOptions.controller+'-secret_key').val(js.secret);
                $('#last-chance').show();
            }
        });
    },
};
