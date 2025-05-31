

//init app
function getData (){
   // let new_data = JSON.parse(localStorage.getItem("data"))
    let new_data = JSON.parse(sessionStorage.getItem("data"));
    return  new_data || {};
};
const headers = {
    "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "auth-token": window.token
}
let urlApi="http://api.herandro.lat";
//let urlApi="http://localhost:8080";

let lang = document.querySelector("html").getAttribute("lang");
let data = getData();
//fuargar en localstorage function
async function saveData(new_data){
    sessionStorage.setItem("data", JSON.stringify(new_data));
    sessionStorage.setItem("lang", lang);
    //localStorage.setItem("data", JSON.stringify(new_data));
}
document.addEventListener('alpine:init',   () => {
    let old_lang = sessionStorage.getItem("lang");
    let httpClient = new HttpClient({
        baseURL:urlApi+'/api/',
        headers: headers
    });
    Alpine.data('myPerfil', () => ({
        myPerfil: {},
        myContacts:{},
        language:lang,
        getImage(path=""){
            let url = "";
           try{
               if(path){
                   url = urlApi + path;
               }
           }catch(e){
               console.log(e)
           }
            return url;
        },
        async init() {
            console.time('Timer');
            let res = data.myPerfil;
            let res2 = data.myContacts;
            if(!res || old_lang != lang){
                res = await httpClient.get(`my-information`);
                data.myPerfil = res;
            }
            if(!res2 || old_lang != lang) {
                res2 = await httpClient.get(`my-contacts`);
                data.myContacts = res2;
            }
            saveData(data);
            this.myContacts = res2.data;
            this.myPerfil = res.data;
            console.log(res)
            createLazy();
            this.$nextTick(() => {
                console.timeEnd('Timer')
            })
        },
        //myKnowledges
        myKnowledges: {},
        myKnowledges_section: false,
        async geMyKnowledges() {
            let res = data.myKnowledges;
            if(!res || old_lang != lang) {
                res = await httpClient.get(`my-knowledges`);
                data.myKnowledges = res;
            }

            this.myKnowledges = res.data;
            this.myKnowledges_section = true;
            saveData(data);

            createLazy();
        },
        // portfolioCategories
        portfolioCategories: {},
        portfolioCategories_section: false,
        async getPortfolioCategories() {
            let res = data.portfolioCategories;
            if(!res || old_lang != lang) {
                res = await httpClient.get(`my-portfolio-categories`);
                data.portfolioCategories = res;
            }

            this.portfolioCategories = res.data;
            this.portfolioCategories_section = true;
            saveData(data);
            createLazy();
        },
        //professionalProjects
        professionalProjects: [],
        professionalProjects_section: false,
        async getProfessionalProjects() {
            let res = data.professionalProjects;
            if(!res || old_lang != lang) {
                res = await httpClient.get(`my-professional-experiences`);
                data.professionalProjects = res;
            }

            this.professionalProjects = res.data;
            this.professionalProjects_section = true;
            saveData(data);

            createLazy();
        },
    }))
    /**Alpine.data('myContacts', () => ({
        myContacts: {},
        async init() {
            let res = data.myContacts;
            if(!res) {
                res = await httpClient.get(`mycontacts/${lang}`);
                data.myContacts = res;
            }

            this.myContacts = res;
        },
    }))**/
})

/**observable***/

var imgIntersectionObserver =  null;
function  createLazy(){
   setTimeout(function (){
       var images = document.querySelectorAll("[lazy]");
       var background_images = document.querySelectorAll("[lazy-background]")

       images.forEach((img) => {
           imgIntersectionObserver.observe(img);
       });

       background_images.forEach((img) => {
           backgroundImgObserver.observe(img);
       });
   }, 500)
}
if(typeof IntersectionObserver !== "undefined"){
    var imgOptions = {
        threshold: 0.2
    };

// funciones de observable
    imgIntersectionObserver = new IntersectionObserver((entries, imgObserver) => {
        entries.forEach((entry) => {
            // If the image is not visible.
            if (!entry.isIntersecting){return 0;}
            else{

                let lazyImage = entry.target;


                let options = {};
                let valid = true;
                if(lazyImage.getAttribute("lazy") != null){
                    options = JSON.parse(JSON.stringify(lazyImage.getAttribute("lazy")))
                }

                if(options){
                    if(options?.showMaxWidth && options?.showMaxWidth > screen.width){
                        valid = false;
                    }else{
                        if(options?.showMinWidth && options?.showMinWidth < screen.width){
                            valid = false;
                        }
                    }
                }
                if(valid){
                    if(lazyImage.getAttribute("data-src")) {
                        lazyImage.src = lazyImage.getAttribute("data-src")
                        /**caches.open("images-v1").then((cache) => {
                            return cache.addAll([lazyImage.src]);
                        })**/
                    };

                    lazyImage.classList.remove("lazy");
                    //lazyImage.removeAttribute("lazy");
                    imgObserver.unobserve(entry.target);
                }
            }
        });
    }, imgOptions);

    var backgroundImgObserver = new IntersectionObserver((entries, bimgObserver) => {
        entries.forEach((entry) => {
            // If the image is not visible.
            if (!entry.isIntersecting) return;

            let lazyImage = entry.target;
            let options = {};
            let valid = true;
            if(lazyImage.getAttribute("lazy") != null){
                options = JSON.parse(JSON.stringify(lazyImage.getAttribute("lazy")))
            }

            if(options){
                if(options?.showMaxWidth && options?.showMaxWidth > screen.width){
                    valid = false;
                }else{
                    if(options?.showMinWidth && options?.showMinWidth < screen.width){
                        valid = false;
                    }
                }
            }
            if(valid){
                lazyImage.style.backgroundImage = 'url(' + lazyImage.getAttribute("data-src") + ')';
                lazyImage.classList.remove("lazy-background");
                //lazyImage.removeAttribute("lazy");
                bimgObserver.unobserve(entry.target);
            }
        });
    }, imgOptions);

//instancia de imagenes
    createLazy();
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
let validation = new Validation("#contact-form");
document.querySelector("#contact-form").addEventListener("submit", function (e){


    e.preventDefault()
    const data = new FormData(e.target);

    const body = Object.fromEntries(data.entries());
    if(validation.isValid()){
       {
           let httpClient = new HttpClient({
               baseURL:urlApi+'/api/admin/',
               headers: headers
           });
           httpClient.post(`messages`, body).then(function (res){
               if( (res.status == 201)){
                   Alert.success((lang == 'es') ? "Mensaje enviado exitosamente" : "Message sended successfull",1500)
               }else{
                   Alert.error((lang == 'es') ? "Hubo un error al enviar el mensaje" : "the message send has error",1500)
               }
           })
        }
    }
});
