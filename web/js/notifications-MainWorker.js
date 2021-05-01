/**
 * Created by jambtc
 */

var notify;

$(function () {
    'use strict';

    if (typeof(Worker) !== "undefined") {
        // console.log(`[type of bcWorker]`,typeof(bcWorker));

        if (typeof notificationsWorker === "undefined") {
            var notificationsWorker = new Worker("js/web-workers/notificationsWorker.js");
        }
        notificationsWorker.onmessage = function(event) {
            console.log('[From notificationsWorker] data:',event.data);
            var data = event.data;
            notify.handleResponse(data);

        };
    } else {
        console.log('[bcMain] Sorry, your browser does not support Web Workers');
    }

    function stopNotificationsWorker(){
        notificationsWorker.terminate();
        notificationsWorker = undefined;
    }
    // console.log(`[window location]`,window.location.href);


    notify = {
        handleResponse: function(response)
        {
            if (response.playAlarm == true){
                backend.Alarm();
            }
            if (response.playSound == true){
                backend.playSound();
                //VERIFICO QUESTE ULTIME 3 TRANSAZIONI PER AGGIORNARE IN REAL-TIME LO STATO (IN CASO CI SI TROVA SULLA PAGINA TRANSACTIONS)
                // for (var key in response.status) {
                //     var status = response.status[key];
                //     //backend.updateTransactionRows(status,key);
                // }
            }

            $('.quantity_notify').text(response.countedUnread);

            $('.notifications').html(response.htmlTitle);
            $('.notifications').append(response.htmlContent);
            if (response.countedUnread > 0){
                $(".quantity_notify").fadeIn(1000).show();
                //$('.notify-readAll').show();
            } else {
                $(".quantity_notify").fadeIn(1000).hide();
                //$('.notify-readAll').hide();
            }
        },
        openAllEnvelopes: async function(){
            try {
                let response = await $.ajax({
                    url:'index.php?r=backend/update-all-news',
                    type: "POST",
                    data: {},
                    dataType: 'json',
                    success: function(response) {
                        console.log('[notify] All notifications updated.',response);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            } catch (e) {
                console.log("[Backend: open all envelopes] ERRORE in async function. Si è verificato un errore!");
            }
        },
        openEnvelope: async function(id_notification){
            event.preventDefault();
            event.stopPropagation();
            var submitUrl = $('#news_'+id_notification).attr('href');

            // metto a read il valore del messaggio
            try {
                let response = await $.ajax({
                    url:'index.php?r=backend/update-single-news',
                    type: "POST",
                    data: { 'id_notification' : id_notification },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success)
                            location.href = submitUrl;
                        },
                    error: function(data) {
                        console.log(data);
                    },
                });
            } catch (e) {
                console.log("[Backend: open single envelope] ERRORE in async function. Si è verificato un errore!");
            }
        },

    };




    // avvio la sincronizzazione dei messaggi
    notificationsWorker.postMessage({
        action : "start",
    });




});
