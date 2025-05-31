
var cacheName = 'js13kPWE-v1';
var appShellFiles = [

    './css/index.min.css',
    './js/globals.min.js',
    './js/index.min.js',
    'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,200;1,700&amp;display=swap',
];
async function addCache(url, data){
    //var formdata = await new FormData();
    //await Object.keys(data).forEach(key => formdata.append(key, data[key]));

    //let request = Object.fromEntries(formdata);
    let request = {
        url: url,
        response:data
    }
    console.log(request)
    let $item = await (await fetch('cache/index.php',{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: JSON.stringify(request)
    })).json();
    console.log($item);
}
async function getCache(url){
    let request = {
        url: url
    }
    let $item = await (await fetch('cache/getData.php',{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: JSON.stringify(request)
    })).json();
    return $item.response || [];
}
self.addEventListener('fetch', function(event) {
    let request = event.request;
    //console.log(event.request.cache,  event.request.mode)
    if (event.request.cache === 'only-if-cached' && event.request.mode !== 'same-origin') return;

    /**if (request.headers.get('Accept').includes('text/html')) {
        event.respondWith(
            fetch(request).then(function (response) {
                caches.open(cacheName+"-templates").then((cache)=> cache.add(request.url)).catch((e)=> console.warn("hubo un error al cachear template"+ e + request.url));
                return response;
            }).catch(function (error) {
                console.warn("no tienes acceso a internet o no encuentra el archivo");
                return caches.match(request).then(function (response) {
                    return response;
                }).catch(function (e){
                    console.warn("hubo un error de solicitud "+ e +" ". request.url);
                });
            })
        );
    }**/
    if(request.url.includes("/api/myportfolio")){
        console.log(request.url)
        event.respondWith(

            fetch('cache/getData.php',{
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: JSON.stringify({url: request.url })}).then(async function(response){
                return response.response || fetch(request).then(async function (response) {
                    await addCache(request.url, response);
                    return response;
                })
            }).catch(function (e){
                console.warn("hubo un error de solicitud "+ e + request.url);
            })
        )
    }else{
        event.respondWith(
            caches.match(request).then(function (response) {
                return response || fetch(request).then(async function (response) {
                    //if(request.headers.get('Accept').includes('image'))
                    if(request.url.indexOf("img/") >= 0){
                        await caches.open(cacheName+"-images").then((cache)=> cache.add(request.url)).catch((e)=> console.warn("hubo un error al cachear "+ e + request.url));
                    }else if(request.headers.get('Accept').includes('text/html')){
                        await caches.open(cacheName+"-templates").then((cache)=> cache.add(request.url)).catch((e)=> console.warn("hubo un error al cachear template"+ e + request.url));
                    }

                    return response;
                }).catch(function (e){
                    console.warn("hubo un error de solicitud "+ e + request.url);
                });
            })
        );
    }
});
self.addEventListener('install', (e) => {
    e.waitUntil(
        caches.open(cacheName).then((cache) => {
            return cache.addAll(appShellFiles).then(res => res).catch(e=>console.warn("Hubo un error al agregar al cache el archivo "+e+" archivo "));
        })
    );
});
self.addEventListener('activate', function(event) {
    return self.clients.claim();
});
// Elimina archivos de cache viejos
var cacheWhitelist = ['js13kPWE-v1'];
/**caches.keys().then(function(cacheNames) {
    return Promise.all(
        cacheNames.map(function(cacheName) {
            if (cacheWhitelist.indexOf(cacheName) === -1) {
                return caches.delete(cacheName);
            }
        })
    );
});**/