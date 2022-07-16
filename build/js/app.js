//const urlApi="http://127.0.0.1:8000";
const urlApi="https://jose.alvarado.herandro.com.mx";
let data = {};
let lang = 'en';
document.addEventListener('alpine:init',   () => {
    let httpClient = new HttpClient({
        baseURL:urlApi+'/api/myportfolio/'
    });
    Alpine.data('myPerfil', () => ({
        myPerfil: {},
        myContacts:{},
        getImage(path){
            let url = "";
            if(path){
                url = urlApi + path;
            }
            return url;
        },
        async init() {
            let res = data.myPerfil;
            let res2 = data.myContacts;
            if(!res){
                res = await httpClient.get(`myperfil/${lang}`);
                data.myPerfil = res;
            }
            if(!res2) {
                res2 = await httpClient.get(`mycontacts/${lang}`);
                data.myContacts = res2;
            }

            this.myContacts = res2;
            this.myPerfil = res;
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

    Alpine.data('myKnowledges', () => ({
        myKnowledges: {},
        myKnowledges_section: false,
        async geMyKnowledges() {
            let res = data.myKnowledges;
            if(!res) {
                res = await httpClient.get(`myknowledges/${lang}`);
                data.myKnowledges = res;
            }

            this.myKnowledges = res;
            this.myKnowledges_section = true;
        },
    }))
    Alpine.data('portfolioCategories', () => ({
        portfolioCategories: {},
        portfolioCategories_section: false,
        async getPortfolioCategories() {
            let res = data.portfolioCategories;
            console.log(res)
            if(!res) {
                res = await httpClient.get(`portfoliocategories/${lang}`);
                data.portfolioCategories = res;
            }

            this.portfolioCategories = await res;
            this.portfolioCategories_section = true;
        },
    }))
    Alpine.data('professionalProjects', () => ({
        professionalProjects: [],
        professionalProjects_section: false,
        async getProfessionalProjects() {
            let res = data.professionalProjects;
            if(!res) {
                res = await httpClient.get(`professionalprojects/${lang}`);
                data.professionalProjects = res;
            }

            this.professionalProjects = await res;
            this.professionalProjects_section = true;
        },
    }))
})

/**observable***/
var images = document.querySelectorAll("[lazy]");
var background_images = document.querySelectorAll("[lazy-background]")
var imgIntersectionObserver =  null;

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
                if(lazyImage.getAttribute("data-src")) lazyImage.src = lazyImage.getAttribute("data-src");
                console.log(lazyImage)
                //lazyImage.classList.remove("lazy");
                imgObserver.unobserve(entry.target);
            }
        });
    }, imgOptions);

    var backgroundImgObserver = new IntersectionObserver((entries, bimgObserver) => {
        entries.forEach((entry) => {
            // If the image is not visible.
            if (!entry.isIntersecting) return;

            let lazyImage = entry.target;
            lazyImage.style.backgroundImage = 'url(' + lazyImage.getAttribute("data-src") + ')';
            //lazyImage.classList.remove("lazy-background");
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
let validation = new Validation("#contact-form");
document.querySelector("#contact-form").addEventListener("submit", function (e){
    e.preventDefault()
    console.log(validation.isValid())
});

