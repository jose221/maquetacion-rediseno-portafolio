var images = document.querySelectorAll("img.lazy");
var background_images = document.querySelectorAll(".lazy-background")
var imgIntersectionObserver =  null;

if(typeof IntersectionObserver !== "undefined"){
    var imgOptions = {
        threshold: 0.2
    };

// funciones de observable
    imgIntersectionObserver = new IntersectionObserver((entries, imgObserver) => {
        entries.forEach((entry) => {
            // If the image is not visible.
            if (!entry.isIntersecting) return 0;

            let lazyImage = entry.target;
            lazyImage.src = lazyImage.getAttribute("data-src");
            lazyImage.classList.remove("lazy");
            imgObserver.unobserve(entry.target);
        });
    }, imgOptions);

    var backgroundImgObserver = new IntersectionObserver((entries, bimgObserver) => {
        entries.forEach((entry) => {
            // If the image is not visible.
            if (!entry.isIntersecting) return;

            let lazyImage = entry.target;
            lazyImage.style.backgroundImage = 'url(' + lazyImage.getAttribute("data-src") + ')';
            lazyImage.classList.remove("lazy-background");
            bimgObserver.unobserve(entry.target);
        });
    }, imgOptions);

//instancia de imagenes
    images.forEach((img) => {
        imgIntersectionObserver.observe(img);
    });

    background_images.forEach((img) => {
        backgroundImgObserver.observe(img);
    });
}else{
    images.forEach((img) => {
        img.src = img.getAttribute("data-src");
        img.classList.remove("lazy");
    });
    background_images.forEach((img) => {
        img.style.backgroundImage = 'url(' + img.getAttribute("data-src") + ')';
        img.classList.remove("lazy-background");
    });
}


//loading
window.addEventListener("load", function (){
    setTimeout(function (){
       var $loading = document.querySelector("#espera");
       $loading.style.visibility = "hidden";
   }, 1100);
});



//corousel
document.querySelectorAll(`[carousel]`).forEach(parent=>{
    let count = 0;
    let interval = parent.getAttribute('image-interval');
    let $items = parent.querySelectorAll(`[carousel-item]`);
    if($items.length > 1){
        $items.forEach((item)=>{
                item.style.display = "none";
            }
        );
        $items[0].style.display = "block";
        setInterval(function (){
            $items.forEach((item)=>{
                    item.style.display = "none";
                }
            );
            $items[count].style.display = "block";
            count ++;
            if(count >= $items.length){
                count = 0;
            }
        }, (interval) ?interval : 1200 );
    }
});
document.querySelectorAll(`[modal-window]`).forEach(function (element){
    element.addEventListener("click", function (e){
        e.preventDefault();
        var URL = e.target.getAttribute("data-open");

        if(URL){
            window.open(URL,"Link","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=false,resizable=0,width=750,height=500,left=370,top=200, maximize=false");
        }
    });
})
document.querySelectorAll(`[m-toggle-action]`).forEach(function (element){
    element.addEventListener("mouseover", function (e){

        const data_target = e.target.getAttribute('data-target');
        if(data_target) {
            document.querySelector(`${data_target}`).classList.remove("d-none");
        }

    });
    element.addEventListener("mouseout", function (e){

        const data_target = e.target.getAttribute('data-target');

        if(data_target) {
            document.querySelector(`${data_target}`).classList.add("d-none");
        }

    });

});
document.querySelectorAll("[btn-submit]").forEach(function (element){
    element.addEventListener("click", function (e){
        const id_form = e.target.getAttribute("btn-submit");
        if(id_form){
            let form = document.querySelector(id_form);
            if(form) form.submit();
        }
    });
});
$('#cDetail01').hover(function(){
    $('#contentTooltip01').toggleClass('d-none');
});