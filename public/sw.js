// Nombre del cache
const CACHE_NAME = 'mi-sitio-cache-v2';

// Archivos a cachear (puedes agregar más recursos aquí)
const urlsToCache = [
  '/',
  'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500',
  'assets/css/pages/login/login-3.css',
  'assets/plugins/global/plugins.bundle.css',
  'assets/css/style.bundle.css',
  'assets/media/logos/favicon.png',
  'assets/media/logos/logo-5.png',
  'assets/media/bg/bg-3.jpg',
  'img/icons/icon-192x192.png',
  'assets/css/skins/header/base/light.css',
  'assets/css/skins/header/menu/light.css',
  'assets/css/skins/brand/light.css',
  'assets/css/skins/aside/light.css'
];

// Variable para forzar la revisión de todos los recursos
const forceCacheUpdate = false;

// Instalación del Service Worker y cacheo inicial
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

// Activación del Service Worker y eliminación de caches antiguos
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

// Intercepta las peticiones y responde con recursos cacheados
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          // Recurso encontrado en cache, lo retornamos
          return response;
        }

        // Si la variable forceCacheUpdate es true, forzamos la actualización de todos los recursos
        if (forceCacheUpdate) {
          return fetchAndUpdateCache(event.request);
        }

        // Recurso no encontrado en cache, hacemos la petición al servidor
        return fetch(event.request);
      })
  );
});

// Función para hacer una petición al servidor, actualizar el cache y retornar la respuesta
function fetchAndUpdateCache(request) {
  return fetch(request)
    .then(response => {
      // Si la petición fue exitosa, actualizamos el cache
      if (response && response.status === 200) {
        const clonedResponse = response.clone();
        caches.open(CACHE_NAME)
          .then(cache => {
            cache.put(request, clonedResponse);
          });
      }
      return response;
    })
    .catch(error => {
      console.error('Error al hacer la petición:', error);
    });
}


// --------------------------------------------------------------------------------

// Variable para definir el tiempo en milisegundos antes de que expire el token (por ejemplo, 5 minutos)
// AuthController - API (view)
const TOKEN_EXPIRATION_THRESHOLD = 5 * 60 * 1000; // 5 minutos

// Función para renovar el token
function renewToken() {
  // Realiza una petición al servidor para renovar el token
  fetch('/api/renew-token', {
    method: 'POST',
    credentials: 'include', // Incluir cookies de autenticación
    // Puedes incluir cualquier información adicional necesaria para la renovación del token
    // body: JSON.stringify({}),
    // headers: {
    //   'Content-Type': 'application/json',
    // },
  })
    .then(response => response.json())
    .then(data => {
      // Guarda el nuevo token en el almacenamiento local
      localStorage.setItem('authToken', data.token);
    })
    .catch(error => {
      console.error('Error al renovar el token:', error);
    });
}

// Evento para renovar automáticamente el token antes de que expire
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          // Recurso encontrado en cache, lo retornamos
          return response;
        }

        // Verificar si el token está almacenado en el almacenamiento local
        const authToken = localStorage.getItem('authToken');
        if (authToken) {
          // Verificar si el token está próximo a expirar
          const tokenData = JSON.parse(atob(authToken.split('.')[1]));
          const expirationTime = tokenData.exp * 1000; // Convertir a milisegundos

          if (expirationTime - Date.now() < TOKEN_EXPIRATION_THRESHOLD) {
            // El token está próximo a expirar, renovarlo
            renewToken();
          }
        }

        // Recurso no encontrado en cache, hacemos la petición al servidor
        return fetch(event.request);
      })
  );
});
