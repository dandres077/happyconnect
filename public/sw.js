const CACHE_STATIC_NAME = 'static-v3';
const CACHE_DYNAMIC_NAME = 'dynamic-v2';
const CACHE_INMUTABLE_NAME = 'inmutable-v3';
const CACHE_DYNAMIC_LIMIT = 50;

self.addEventListener('install', e => {

	const cacheProm = caches.open( CACHE_STATIC_NAME )
		.then( cache => {
			return cache.addAll([	
					'assets/media/flags/177-colombia.svg',
				]);
		});

	const cacheInmutable = caches.open( CACHE_INMUTABLE_NAME )
		.then( cache => {
			return cache.addAll([	
					'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500',
					'assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
					'assets/plugins/global/plugins.bundle.css',
					'assets/css/style.bundle.css',
					'assets/css/skins/header/base/light.css',
					'assets/css/skins/header/menu/light.css',
					'assets/css/skins/brand/light.css',
					'assets/css/skins/aside/light.css',
					'inspinia/js/plugins/dataTables/datatables.min.js',
					'assets/css/pages/tables/style.css'
				]);
		});

	e.waitUntil( Promise.all([cacheProm, cacheInmutable]) );
});


function limpiarCache( cacheName, numeroItems ){

	caches.open( cacheName )
		.then( cache => {

			return cache.keys()
				.then( keys => {
					//console.log(keys);
					if (keys.lengh > numeroItems ) {
						cache.delete( keys[0])
						.then( limpiarCache(cacheName, numeroItems) );
					}
				});

		});

}


self.addEventListener('fetch', e => {

	const respuesta = fetch( e.request).then( res => {

		if ( !res) return caches.match( e.request );

		//console.log('Fetch', res );
		caches.open( CACHE_DYNAMIC_NAME )
			.then( cache => {
				cache.put( e.request, res );
				limpiarCache( CACHE_DYNAMIC_NAME, CACHE_DYNAMIC_LIMIT );
			});
		return res.clone();
	}).catch( err => {
		return caches.match( e.request );
	});

	e.respondWith( respuesta );


});