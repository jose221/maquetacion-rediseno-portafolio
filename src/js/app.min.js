//const urlApi="http://127.0.0.1:8000";
const urlApi="https://jose.alvarado.herandro.com.mx";
let httpClient = new HttpClient({
    baseURL:urlApi+'/api/myportfolio/'
});
let data = {};
let lang = 'en';
document.addEventListener('alpine:init',   () => {

    Alpine.data('myPerfil', () => ({
        myPerfil: {},
        myContacts:{},
        getImage(path){
            console.log( urlApi + path)
            return urlApi + path;
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
        async init() {
            let res = data.myKnowledges;
            if(!res) {
                res = await httpClient.get(`myknowledges/${lang}`);
                data.myKnowledges = res;
            }

            this.myKnowledges = res;
        },
    }))
    Alpine.data('portfolioCategories', () => ({
        portfolioCategories: {},
        async init() {
            let res = data.portfolioCategories;
            if(!res) {
                res = await httpClient.get(`portfoliocategories/${lang}`);
                data.portfolioCategories = res;
            }

            this.portfolioCategories = await res;
        },
    }))
    Alpine.data('professionalProjects', () => ({
        professionalProjects: {},
        async init() {
            let res = data.professionalProjects;
            if(!res) {
                res = await httpClient.get(`professionalprojects/${lang}`);
                data.professionalProjects = res;
            }

            this.professionalProjects = await res;
        },
    }))
})
