// This file install service worker and manage changes
var deferredPrompt;

//Polyfill: per i browser più vecchi che non hanno window.Promise
if (!window.Promise){
	window.Promise = Promise;
}

let newWorker;

function showUpdateBar() {
	if ($('#snackbar').length){
		let snackbar = document.getElementById('snackbar');
		snackbar.className = 'show';
	}
}

// chiede di salvare l'applicazione sulla home
function saveOnDesktop() {
    if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then(function(choiceResult) {
             console.log('[deferred prompt]',choiceResult.outcome);
            if (choiceResult.outcome === 'dismissed') {
                console.log('[deferred prompt] User cancelled installation');
            } else {
                console.log('[deferred prompt] User added to home screen');
            }
        });
        deferredPrompt = null;
    }
}


// The click event on the pop up notification
if($('#reload').length){
	document.getElementById('reload').addEventListener('click', function(){
		newWorker.postMessage({ action: 'skipWaiting' });
	});
}

if ('serviceWorker' in navigator){
	navigator.serviceWorker.register('service-worker.js').then(reg => {
		reg.installing; // the installing worker, or undefined
		reg.waiting; // the waiting worker, or undefined
		reg.active; // the active worker, or undefined

		reg.addEventListener('updatefound', () => {
		    // A wild service worker has appeared in reg.installing!
		    newWorker = reg.installing;

		    newWorker.state;
		    // "installing" - the install event has fired, but not yet complete
		    // "installed"  - install complete
		    // "activating" - the activate event has fired, but not yet complete
		    // "activated"  - fully active
		    // "redundant"  - discarded. Either failed install, or it's been
		    //                replaced by a newer version

		    newWorker.addEventListener('statechange', () => {
		    	// newWorker.state has changed
			  	console.log('[Service worker] ... new state',newWorker.state);
				// Has network.state changed?
				switch (newWorker.state) {
					case 'installed':
			  			if (navigator.serviceWorker.controller) {
			    			// new update available
			    			showUpdateBar();
			  			}
			  			// No update available
			  			break;
				}
		    });
		});
	})
	.then(function (){
		console.log('[Service worker] ... from service registered.');
	})
	.catch(function(err) {
   		console.log("[Service worker] Service Worker Failed to Register", err);
	});

	let refreshing;
	navigator.serviceWorker.addEventListener('controllerchange', function () {
		if (refreshing) return;
		window.location.reload();
		refreshing = true;
	});
}



window.addEventListener('beforeinstallprompt', function(event){
	console.log('[Service worker] beforeinstallprompt fired!');
	event.preventDefault();
	deferredPrompt = event;
	return false;
});
