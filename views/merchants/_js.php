<?php

use yii\helpers\Url;
use yii\web\View;

$options = [
    'invalidSeedMessage' => Yii::t('app','Invalid seed!'),
    'invalidSeed12Word' => Yii::t('app','Seed hasn\'t 12 words! Words inserted are: '),
    'validSeedMessage' => Yii::t('app','Seed is correct!'),
    'confirmSeedMessage' => Yii::t('app','Check the wallet address derived from the seed you have written. Your address is:'),
    'spinner' => '<div class="button-spinner spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
    'baseUrl' => Yii::$app->request->baseUrl,
    'language' => Yii::$app->language,
    'cryptURL' => Url::to(['/wallet/crypt']),
    // ...
];
$this->registerJs(
    "var yiiOptions = ".\yii\helpers\Json::htmlEncode($options).";",
    View::POS_HEAD,
    'yiiOptions'
);



$wallet_restore = <<<JS

	var seed = null;
	var lw = lightwallet;


    // controlla la validità del seed inserito
    var seedField = document.querySelector('#merchants-derivedkey');
    seedField.addEventListener('input', function(e) {
        var insertedSeed = $.trim(e.target.value).toLowerCase();
        console.log('[verify]:', insertedSeed);
        if (WordCount(insertedSeed) != 12 ){
          $('#seed-error').show().text(yiiOptions.invalidSeed12Word+WordCount(insertedSeed) );
          return;
        }

        if (!(isSeedValid(insertedSeed)) ){
          $('#seed-error').show().text(yiiOptions.invalidSeedMessage);
          return;
        }
        $('#seed-error').removeClass('alert-danger');
        $('#seed-error').addClass('alert-success');
        $('#seed-error').show().text(yiiOptions.validSeedMessage);
    });

    // genera la private key dal seed
    var checkButton = document.querySelector('.derivedKey');
    checkButton.addEventListener('click', function(event){

  		seed = $.trim($('#merchants-derivedkey').val()).toLowerCase();
  		if (WordCount(seed) != 12 || !(isSeedValid(seed)) ){
  			console.log('[Restore]: seed non valido', seed);
  			$('#seed-error').show().text(yiiOptions.invalidSeedMEssage);
  			return;
  		}
  		$('#seed-error').html(yiiOptions.spinner);

  		// la password viene generata in automatico dal sistema di 32 caratteri
  		var password = generateEntropy(64);

  		console.log('[Merchants]: seed valido', seed);
  		initializeVault(password,seed);
  	});

	// verifica la validità di un seed
	function isSeedValid(seed){
		if (!lw.keystore.isSeedValid(seed))
			return false;
	 	else
			return true;
	}

    function WordCount(str) {
      return str.split(" ").length;
    }

    // Generate random entropy for the seed based on crypto.getRandomValues.
    function generateEntropy(length) {
    	var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    	var i;
    	var result = "";

    	values = new Uint32Array(length);
    	window.crypto.getRandomValues(values);
    	for(var i = 0; i < length; i++)
    	{
    		result += charset[values[i] % charset.length];
    	}
    	return result;
    }

    // adesso salviamo in local storage il seed e la password
    function initializeVault(password, seed) {
        //console.log('vault',password,seed);
    	lw.keystore.createVault({
                password: password,
    	        seedPhrase: seed,
    	        hdPathString: "m/0'/0'/0'"
    		},  function (err, ks) {
                    ks.keyFromPassword(password,
                        function (err, pwDerivedKey) {
            		        if (!ks.isDerivedKeyCorrect(pwDerivedKey)) {
                                throw new Error("Incorrect derived key!");
            		        }

            		        try {
                                ks.generateNewAddress(pwDerivedKey, 1);
                		    } catch (err) {
                    		    console.log(err);
                    		    console.trace();
                		    }
                		    var address = ks.getAddresses()[0];
                		    var privateKey = ks.exportPrivateKey(address, pwDerivedKey);

                            console.log('[Merchants]: wallet address is: ', address);
                            console.log('[Merchants]: private key is: ', privateKey);

                            $('#merchants-wallet_address').val(address);
                            $('#merchants-privatekey').val(privateKey);

                            $('#seed-error').removeClass('alert-danger');
                            $('#seed-error').addClass('alert-success');
                            $('#seed-error').show().html(yiiOptions.confirmSeedMessage+' '+address);
                        }
                    )
    		});

    }



JS;

$this->registerJs(
    $wallet_restore,
    View::POS_READY, //POS_END
    'wallet_restore'
);
