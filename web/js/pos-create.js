

$("#pos-id_merchant").change(function() {
    var idMerchant = this.value;
    $.ajax({
        url: yiiPosOptions.getStores,
        dataType: "json",
        data: {
            id: idMerchant
        },
        beforeSend: function() {
            $("#pos-id_store").html(yiiPosOptions.spinner);
        },
        success: function(result) {
            console.log(result);
            var my_list = $("#pos-id_store").empty();
            $.each(result, function(i, v){
                my_list.append($("<option>").attr('value',i).text(v));
            });
        }
    });
});
