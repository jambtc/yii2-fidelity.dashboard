<?php

use yii\helpers\Url;
use yii\web\View;
use app\assets\LightWalletAsset;
LightWalletAsset::register($this);

$options = [
    'invalidSeedMessage' => Yii::t('app','Invalid seed!'),
    'invalidSeed12Word' => Yii::t('app','Seed hasn\'t 12 words! Words inserted are: '),
    'validSeedMessage' => Yii::t('app','Seed is correct!'),
    'confirmSeedMessage' => Yii::t('app','Check the wallet address derived from the seed you have written. Your address is:'),
    'spinner' => '<div class="button-spinner spinner-border text-primary" style="width:1.3rem; height:1.3rem;" role="status"><span class="sr-only">Loading...</span></div>',
    'spinner2' => '<div class="button-spinner spinner-border text-light" style="width:1.3rem; height:1.3rem;" role="status"><span class="sr-only">Loading...</span></div>',
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
    var seedField = document.querySelector('#stores-derivedkey');
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


    // genera il nuovo seed
    var generateSeedButton = document.querySelector('.btn-generateSeed');
    generateSeedButton.addEventListener('click', function(event){
        $('.btn-generateSeed').html(yiiOptions.spinner2);

        var password = generateEntropy(64);
    	seed = lw.keystore.generateRandomSeed(password);

  		console.log('[Stores]: seed valido', seed);
  		initializeVault(password,seed);
  	});

    // genera la private key dal seed
    var derivedKeyButton = document.querySelector('.btn-derivedKey');
    derivedKeyButton.addEventListener('click', function(event){

  		seed = $.trim($('#stores-derivedkey').val()).toLowerCase();
  		if (WordCount(seed) != 12 || !(isSeedValid(seed)) ){
  			console.log('[Restore]: seed non valido', seed);
  			$('#seed-error').show().text(yiiOptions.invalidSeedMEssage);
  			return;
  		}
  		// $('#seed-error').show().html(yiiOptions.spinner);
        $('.btn-derivedKey').html(yiiOptions.spinner);

  		// la password viene generata in automatico dal sistema di 32 caratteri
  		var password = generateEntropy(64);

  		console.log('[Stores]: seed valido', seed);
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

                            console.log('[Stores]: wallet address is: ', address);
                            console.log('[Stores]: private key is: ', privateKey);

                            $('#stores-wallet_address').val(address);
                            $('#stores-privatekey').val(privateKey);
                            $('#stores-derivedkey').val(seed);

                            $('#stores-derivedkey').prop('readonly',true);
                            $('#seed-error').removeClass('alert-danger');
                            $('#btn-save').removeClass('disabled');
                            $('#btn-save').prop('disabled',false);
                            $('#seed-error').addClass('alert-success');
                            $('#seed-error').show().html(yiiOptions.confirmSeedMessage+' '+address);
                            $('.btn-derivedKey').hide('');
                            $('.btn-generateSeed').hide('');
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
