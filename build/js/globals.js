class Alert{
    static alert(status){
        document.querySelectorAll(".alert-tooltip").forEach(el=>document.querySelector(".alert-tooltip").remove())
        let $alert = document.createElement("div");
        $alert.classList.add("alert-tooltip", status);
        $alert.innerHTML=`
        <i class="alert-icon"></i>
       <span class="alert-message"></span>`;
        return $alert;
    }
    static success(message, time=1000, icons=["fas","fa-check-circle"]){
        let $target_alert = this.alert("success");
        icons.forEach(icon=>$target_alert.querySelector(".alert-icon").classList.add(icon));
        $target_alert.querySelector(".alert-message").innerHTML= message;
        document.querySelector("body").appendChild($target_alert);
        setTimeout(()=>{
            $target_alert.classList.add("show");
            setTimeout(()=>{
                let el = document.querySelector(".alert-tooltip.success")
                if(el){
                    el.classList.remove("show");
                    setTimeout(()=>el.remove(), 1000)
                }
            }, time);
        }, 100)
    }
    static warning(message,time=1000, icons=["fas","fa-exclamation-triangle"]){
        let $target_alert = this.alert("warning");
        icons.forEach(icon=>$target_alert.querySelector(".alert-icon").classList.add(icon));
        $target_alert.querySelector(".alert-message").innerHTML= message;
        document.querySelector("body").appendChild($target_alert);
        setTimeout(()=>{
            $target_alert.classList.add("show");
            setTimeout(()=>{
                let el = document.querySelector(".alert-tooltip.success")
                if(el){
                    el.classList.remove("show");
                    setTimeout(()=>el.remove(), 1000)
                }
            }, time);
        }, 100)
    }
    static error(message,time=1000, icons=["fas","fa-exclamation-triangle"]){
        let $target_alert = this.alert("error");
        icons.forEach(icon=>$target_alert.querySelector(".alert-icon").classList.add(icon));
        $target_alert.querySelector(".alert-message").innerHTML= message;
        document.querySelector("body").appendChild($target_alert);
        setTimeout(()=>{
            $target_alert.classList.add("show");
            setTimeout(()=>{
                let el = document.querySelector(".alert-tooltip.success")
                if(el){
                    el.classList.remove("show");
                    setTimeout(()=>el.remove(), 1000)
                }
            }, time);
        }, 100)
    }
}
window.onload = function (){
    $offline = false;
    window.addEventListener('offline', (event) => {
        setTimeout(()=>{
            $offline = true;
            Alert.error("No tienes acceso a internet")
        }, 2000)
    });
    window.addEventListener('online', (event) => {
        setTimeout(()=>{
            if ($offline){
                Alert.success("Tienes acceso a internet", 4000, ["fas","fa-wifi"])
                $offline = false;
                setTimeout(()=>window.location.reload(), 1000);
            }
        }, 2000)
    });
}
//Alert.error("No tienes conexión a internet", 1000);

document.querySelectorAll(".collapse-btn").forEach( function (element) {
    element.addEventListener("click",function (e) {
        let  target = e.target;
        let item = document.querySelector(target.getAttribute("data-target"));
        if(item){
            item.classList.toggle("show");
            if(item.classList.contains("show")){
                document.querySelector("body").classList.add("overflow-hidden");
            }else {
                document.querySelector("body").classList.remove("overflow-hidden");
            }
        }
    })
})

window.addEventListener("DOMContentLoaded", function (){
    document.querySelectorAll(".btn-tooltip").forEach( function (element) {
        element.addEventListener("click",function (e) {
            try{
                let  target = e.target;
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
    var position = total - y;
    //this.style.height = `${position}px`;
    if ( position < 0 ) this.style.height = `0px`;
    else if (position >= 0) this.style.height = `${position}px`;
}
function handleTouchEnd(e) {
    var y = e.changedTouches[0].clientY;
    var total = this.clientHeight;
    var position = total - y;
    if(!e.target.getAttribute("href")){
        if(total/2 <= y ){
            this.style.height = null;
            document.querySelector(".navbar-mobile").classList.remove("show")
            document.querySelector("body").classList.remove("overflow-hidden");
        }
        else this.style.height = default_height;
    }
}

//document.querySelector('.navbar-mobile nav').addEventListener('touchstart', handleTouch, {passive: false})
document.querySelector('.navbar-mobile nav').addEventListener('touchmove', handleTouch, {passive: false})
document.querySelector('.navbar-mobile nav').addEventListener('touchend', handleTouchEnd,   {passive: false})
//document.getElementById('nav_modal').addEventListener('click', initialHash, {passive: false});


/**navegation functions**/
document.querySelectorAll("nav a").forEach(element=>{
    element.addEventListener("click", function (e){
        let click_close_nav = e.target.getAttribute("close-btn");
       const href = e.target.getAttribute("href");
       if (href){
           if(href[0] == '#'){
               let upElement = document.querySelector(href);
               if(upElement){
                   document.querySelector(href).scrollIntoView({ behavior: 'smooth', block: 'center' }, true);
               }
               if(click_close_nav){
                   document.querySelector(click_close_nav).classList.remove("show"); //remover show del menu
                   document.querySelector("body").classList.add("overflow-hidden");
               }
           }
       }
    });
})

navObserver = new IntersectionObserver((entries, imgObserver) => {
    entries.forEach((entry) => {
        // If the image is not visible.
        if (!entry.isIntersecting){return 0;}
        else{
            let elementT = entry.target;
            document.querySelectorAll("nav a").forEach(el =>{
                let el_id = el.getAttribute("href");
                if(el_id == `#${elementT.id}`){
                    if(!el.classList.contains("active")){
                        el.classList.add("active")
                    }
                }else{
                    if(el.classList.contains("active")){
                        el.classList.remove("active")
                    }
                }
            })

        }
    });
}, {threshold: 0.2});
document.querySelectorAll("section, header").forEach(element =>{
    navObserver.observe(element);
})



function addStyleHeader(list ){
    if(list.length){
        list.forEach(item =>{
            let node = document.createElement("link");
            for (const [key, value] of Object.entries(item)) {
                node.setAttribute(key,value);
            }
            document.querySelector("head").appendChild(node);
        });
    }
}

function addScriptbody(list ){
    if(list.length){
        for (const item of list) {
            let node = document.createElement("script");
            for (const [key, value] of Object.entries(item)) {
                node.setAttribute(key,value);
            }
            document.querySelector("body").appendChild(node);
            node.onload = function () {
                if(item.children){
                    loadChild(item.children);
                }
            }
        }
    }
}
function loadChild(nodes){
    if(nodes.length){
        for (const item of nodes) {
            let node = document.createElement("script");
            for (const [key, value] of Object.entries(item)) {
                node.setAttribute(key,value);
            }
            document.querySelector("body").appendChild(node);
            node.onload = function () {
                if(item.children){
                    loadChild(item.children);
                }
            }

        }
    }
}

document.addEventListener('readystatechange', (event) => {
});