document.querySelectorAll(".collapse-btn").forEach( function (element) {
    element.addEventListener("click",function (e) {
        let  target = e.target;
        document.querySelector(target.getAttribute("data-target")).classList.toggle("show");
        if(document.querySelector(target.getAttribute("data-target")).classList.contains("show")){
            document.querySelector("body").style.overflow="hidden";
        }else {
            document.querySelector("body").style.overflow=null;
        }
    })
})

window.addEventListener("DOMContentLoaded", function (){
    console.log("ready")
    document.querySelectorAll(".btn-tooltip").forEach( function (element) {
        console.log(element)
        element.addEventListener("click",function (e) {
            console.log(element)
            try{
                let  target = e.target;
                console.log( e.target);
                document.querySelectorAll(".tooltip").forEach(function (target1){
                    if(target1.classList.contains("show")){
                        target1.classList.remove("show");
                    }
                })
                target.querySelector(".tooltip").classList.toggle("show");
            }catch (e){
                console.log(e)
            }
        })
    })
    document.querySelectorAll(".btn-tooltip-close").forEach( function (element) {
        element.addEventListener("click",function (e) {
            let  target = e.target;
            document.querySelectorAll(".tooltip").forEach(function (target1){
                if(target1.classList.contains("show")){
                    target1.classList.remove("show");
                }
            })
        })
    })
})



/**menu scripts **/
function initialHash() {
    //'use strict';
    //window.location.href = "#";
}
var default_height = "85%";
function handleTouch(e) {
    var y = e.changedTouches[0].clientY;
    var total = this.clientHeight;
   // console.log("eje y "+y, "total "+ total, "height "+this.style.height)
    var position = total - y;
    //this.style.height = `${position}px`;
    if ( position < 0 ) this.style.height = `0px`;
    else if (position >= 0) this.style.height = `${position}px`;
}
function handleTouchEnd(e) {
    var y = e.changedTouches[0].clientY;
    var total = this.clientHeight;
    var position = total - y;
    console.log(e.target)
    if(!e.target.getAttribute("href")){
        if(total/2 <= y ){
            this.style.height = null;
            document.querySelector(".navbar-mobile").classList.remove("show")
            document.querySelector("body").style.overflow=null;
        }
        else this.style.height = default_height;
    }
}

//document.querySelector('.navbar-mobile nav').addEventListener('touchstart', handleTouch, {passive: false})
document.querySelector('.navbar-mobile nav').addEventListener('touchmove', handleTouch, {passive: false})
document.querySelector('.navbar-mobile nav').addEventListener('touchend', handleTouchEnd,   {passive: false})
//document.getElementById('nav_modal').addEventListener('click', initialHash, {passive: false});

