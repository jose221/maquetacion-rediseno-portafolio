<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/services/TokenService.php';

$token = TokenService::generateToken();

$availableLangs = ['es', 'en'];
$lang = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'es');

if (!in_array($lang, $availableLangs, true)) {
    $lang = 'es';
}
$_SESSION['lang'] = $lang;

$GLOBALS['translate'] = require __DIR__ . "/lang/{$lang}.php";

function _translate(string $word): string
{
    return $GLOBALS['translate'][$word] ?? $word;
}
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<head>
    <script>
        window.token = "<?=$token?>";
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cross-Platform Application Developer">
    <!--preconnected-->
    <link rel="preconnect" href="https://kit.fontawesome.com/" crossorigin>
    <link rel="preconnect" href="https://ka-f.fontawesome.com/" crossorigin>

    <!--preload-->
    <link rel="preload" href="img/banner-logo.svg" as="image">
    <link rel="preload" href="css/index.min.css?v=1.0.2" as="style">
    <!--tags-->
    <meta name="author" content="José Ángel Alvarado Gonzalez">
    <meta property="og:title" content="José Ángel Alvarado Gonzalez">
    <meta property="og:image:url" content="img/logo.png">
    <meta property="og:image:secure_url" content="img/logo.png">
    <meta property="og:image:width" content="2500">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" href="img/logo.png">
    <link rel="shortcut icon" href="img/logo.png" />
    <link rel="manifest" href="manifest.json">
    <meta property="og:image:height" content="1330">
    <meta property="og:url" content="https://josealvarado.herandro.lat/">
    <meta property="og:site_name" content="José Ángel">
    <meta property="og:type" content="website">
    <link rel="shortcut icon" href="img/logo.png" />
    <title>José Angel Alvarado Gonzalez</title>

    <meta name="keywords" content="jose angel alvarado gonzalez, José Ángel Alvarado González, Desarrollador web, freelancer jose angel, jose angel alvarado gonzalez cancun,+José Ángel Alvarado González Cancún">
    <!--styles-->
    <!--links-->

    <script>
        //let urlApi1="http://localhost:8080";
        let urlApi1="https://api.herandro.lat";
        function setCookie(cName, cValue, expDays=7) {
            let date = new Date();
            date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
        }
        function getCookie(cName) {
            const name = cName + "=";
            const cDecoded = decodeURIComponent(document.cookie); //to be careful
            const cArr = cDecoded .split('; ');
            let res;
            cArr.forEach(val => {
                if (val.indexOf(name) === 0) res = val.substring(name.length);
            })
            return res;
        }
        //var socket = new WebSocket('ws://'+urlApi1+'/test-socket');
        actionDataHerandro = async (target)=>{
            res = await fetch(`${urlApi1}/api/data-herandro`, {
                method: 'POST',
                headers: {
                    Accept: 'application.json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(target),
                //Cache: 'default'
            })
            return  await res.json();
        }
        let eventsHerandro = {
            get(target, property) {
                return property === 'fullName' ?
                    `${target.nombre} ${target.apellidos}` :
                    target[property];
            },
            set(target, property, value) {
                if(target[property] != value){
                    target[property] = value
                    actionDataHerandro(window.dataHerandro)
                    //socket.send(target);
                    console.log("cambiio")
                }
                return target;
            }
        }
        window.dataHerandro = {
            uid:getCookie("herandroID") || "",
            domain:window.location.hostname,
            dtherandro: window.token,
            events:new Proxy([], eventsHerandro)
        }
        //console.log(window.dataHerandro);
        if(!window.dataHerandro.uid){

            actionDataHerandro(window.dataHerandro).then(async (response) => {
                window.dataHerandro.uid = response.uid;
                //console.log(window.dataHerandro)
                setCookie("herandroID",response.uid)
            })
        }

        /**
         socket.addEventListener('error', function (m) {
            console.log("error");
        });
         socket.addEventListener('open', function (m) {
            socket.send(JSON.stringify(window.dataHerandro))
        });
         socket.addEventListener('message', function (result) {
            result = JSON.parse(result.data);
            if(!window.dataHerandro.id){
                setCookie("herandroID",result.id)

            }
            window.dataHerandro = result;
            console.log(window.dataHerandro)
        });
         **/
        console.log(window.dataHerandro)
        window.addEventListener('DOMContentLoaded', (event) => {
            let evt = document.querySelectorAll("[herandro-click]");
            console.log(evt);
            evt.forEach(evtClick =>{
                evtClick.addEventListener("click",function (e){
                    let act = evtClick.getAttribute("herandro-click");
                    let label = evtClick.getAttribute("herandro-label");
                    let value = evtClick.getAttribute("herandro-value");
                    if(act && label && value){
                        window.dataHerandro.events.push({
                            eventCode: act,
                            label: label,
                            value: value
                        })
                    }
                    console.log(window.dataHerandro.events)
                })
            })
        });
    </script>
    <link rel="stylesheet" href="css/index.min.css?v=1.0.2">
    <!--preconnect-->
    <script type="application/ld+json">
        {
            "@context": "http://www.schema.org",
            "@type": "person",
            "name": "José Angel Alvarado Gonzalez",
            "jobTitle": "Cross-Platform Application Developer",
            "url": "https://josealvarado.herandro.lat/",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Cancún",
                "addressRegion": "Quintana Roo",
                "postalCode": "77500",
                "addressCountry": "México"
            },
            "email": "jose.alvarado220@hotmail.com",
            "telephone": "9982132198",
            "birthDate": "1999-25-04",
            "sameAs": [
                "https://web.facebook.com/joseangel.alvarado.735507",
                "https://www.linkedin.com/in/jos%C3%A9-%C3%A1ngel-alvarado-gonzalez-677841220",
                "https://josealvarado.herandro.lat/"
            ]
        }
    </script>
</head>
<body x-data="myPerfil">
    <!--head-->
    <header id="home-section" x-show="myPerfil" x-transition>
        <nav class="navbar">
            <div class="container">
                <a alt="logo" class="navbar-brand" href="/"><img x-show="myPerfil.logo" x-transition.scale width="45" alt="img logo" height="40" :src="getImage(myPerfil.logo)"></a>
            <ul>
                <li>
                    <a alt="home" href="#home-section"><span class="nav-text"><?=_translate('Inicio')?></span></a>
                </li>
                <li>
                    <a alt="about us" href="#about-section">  <span class="nav-text"><?=_translate('Acerca de')?></span></a>
                </li>
                <li>
                    <a alt="my knowledges" href="#knowledges-section"> <span class="nav-text"><?=_translate('Mis conocimientos')?></span></a>
                </li>
                <li>
                    <a alt="my abilities" class="nav-link active" href="#abilities-section"> <span class="nav-text"><?=_translate('mis habilidades')?></span></a>
                </li>
                <li>
                    <a alt="professional experience" href="#bussiness-section"><span class="nav-text"> <?=_translate("Mi Portafolio")?></span></a>
                </li>
                <li>
                    <a alt="contact" href="#contact-section"> <span class="nav-text"><?=_translate("Contacto")?></span></a>
                </li>
                <li>
                    <a alt="language" class="translate-btn" href="?lang=<?=($lang == 'es')? 'en': 'es'?>"><i class="fas fa-globe"></i> <span class="nav-text"><?=_translate(($lang))?></span></a>
                </li>
            </ul>
                <div class="responsive-content">
                    <a alt="contact" class="translate-btn" href="?lang=<?=($lang == 'es')? 'en': 'es'?>"><i class="fas fa-globe"></i> <span class="nav-text"><?=_translate(($lang))?></span></a>
                    <button type="button" class="collapse-btn" data-target="#menuResponsive" aria-controls="menuResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </nav>
        <!--mobile-component-->
        <div class="navbar-mobile collapse-btn" data-target="#menuResponsive" aria-controls="menuResponsive" aria-expanded="false" id="menuResponsive">
            <nav>
               <!--<div class="close-nav">
                   <button class="collapse-btn" data-target="#menuResponsive" aria-controls="menuResponsive" aria-expanded="false"><i class="fas fa-angle-down -ep-none"></i></button>
               </div>-->
                <div class="nav-header">
                    <img x-show="myPerfil.logo" x-transition.scale width="45" alt="img logo" height="40" :src="getImage(myPerfil['slogan_'+language])">
                </div>
                <ul>
                    <li>
                        <a alt="home" close-btn=".navbar-mobile" href="#home-section"><span class="nav-text"><?=_translate('Inicio')?></span></a>
                    </li>
                    <li>
                        <a alt="about us" close-btn=".navbar-mobile" href="#about-section">  <span class="nav-text"><?=_translate('Acerca de')?></span></a>
                    </li>
                    <li>
                        <a alt="my knowledges" close-btn=".navbar-mobile" href="#knowledges-section"> <span class="nav-text"><?=_translate('Mis conocimientos')?></span></a>
                    </li>
                    <li>
                        <a alt="my abilities" close-btn=".navbar-mobile" class="nav-link active" href="#abilities-section"> <span class="nav-text"><?=_translate('mis habilidades')?></span></a>
                    </li>
                    <li>
                        <a alt="professional experience" close-btn=".navbar-mobile" href="#bussiness-section"><span class="nav-text"> <?=_translate("Mi Portafolio")?></span></a>
                    </li>
                    <li>
                        <a alt="contact" close-btn=".navbar-mobile" href="#contact-section"> <span class="nav-text"><?=_translate("Contacto")?></span></a>
                    </li>
                    <li>
                        <a alt="contact" class="translate-btn" href="?lang=<?=($lang == 'es')? 'en': 'es'?>"><i class="fas fa-globe"></i> <span class="nav-text"><?=_translate(($lang))?></span></a>
                    </li>
                </ul>
                <div class="nav-footer">
                    <template x-for="contact in myContacts">
                        <a class="btn btn-contact" :title="contact['name_'+language]" :href="contact.url_path" :aria-label="contact.icon_path" target="_blank" rel="noreferrer noopener">
                            <i  :class="contact.icon_path" ></i>
                        </a>
                    </template>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="text-header">
                <div class="list-contacts">
                    <template x-for="contact in myContacts">
                        <a class="btn btn-contact" :title="contact['name_'+language]" :href="contact.url_path" :aria-label="contact.icon_path" target="_blank" rel="noreferrer noopener">
                            <i  :class="contact.icon_path" ></i>
                        </a>
                    </template>
                </div>
                <div>
                    <h2 x-text="myPerfil.name"></h2>
                    <h3 x-text="myPerfil['header_text_'+language]"></h3>
                </div>
                <a class="btn-portfolio" href="#bussiness-section"><?=_translate("VER MI PORTAFOLIO")?></a>
            </div>
            <img lazy="{showMaxWidth:'900'}" alt="avatar" class="lazy" width="1022" height="1300" :data-src="getImage(myPerfil.header_image_path)">
        </div>
    </header>
    <!--end head-->
    <!--section information-->
    <section id="about-section" class="information-user-section container" x-data="{myinformation_section: false}" x-intersect.once="myinformation_section = true">
        <div class="section-header">
            <p class="-title"><?=_translate("Acerca de")?></p>
        </div>
        <div class="row" x-show="myinformation_section" x-transition.delay.150ms>
            <img lazy width="100%" class="lazy" height="100%" alt="jose angel alvarado gonzalez" :data-src="myinformation_section && getImage(myPerfil.my_perfil)">
            <div>
                <h2>
                    <?=_translate("hello")?>
                </h2>
                <div class="description-user ">
                    <p x-html="myPerfil['description_'+language]"></p>
                </div>
                <div  class="footer-user">
                    <ul>
                        <li><i class="fas fa-at"></i><span x-text="myPerfil.email"></span></li>
                        <li><i class="fas fa-globe-americas"></i> <span x-text="myPerfil['nationality_'+language]"></span></li>
                    </ul>
                    <div class="count-experiences">
                        <!--<p>30+<span><?=_translate("proyectos")?></span></p>
                        <p>5+<span><?=_translate("años")?></span></p>
                        <p>5+<span><?=_translate("empresas")?></span></p>-->

                    </div>
                    <div class="action-footer-user">
                        <a class="btn-portfolio " target="_blank" rel="noreferrer noopener" :href="getImage(myPerfil.HistoryCurriculumVitae?.path)"> <?=_translate("ver curriculum")?> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end section information-->
    <!--section my knowledges-->
    <section id="knowledges-section" class="knowledges-user-section -bg-blue" x-intersect.once="geMyKnowledges()">
        <div class="container" x-show="myKnowledges_section" >
            <div class="section-header -white">
                <p class="-title" title><?=_translate("Mis conocimientos")?></p>
                <p class="-description"><?=_translate("Conocimiento y destrezas en la tecnologías de la información")?></p>
            </div>
            <div  class="row">
                <template x-for="myKnowledge in myKnowledges">
                    <div>
                        <div class="item-header ">
                            <img lazy width="100%" height="100%" class="card-img-top img-circle lazy" :data-src="myKnowledges_section && getImage(myKnowledge.icon_path)" :alt="myKnowledge['title_'+language]" loading="lazy">
                        </div>
                        <div class="item-content">
                            <p class="title-item" x-text="myKnowledge['title_'+language]">
                            </p>
                            <div x-html="myKnowledge['description_'+language]">

                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </section>
    <!--<button alt="language" herandro-click="DATA_EXPORT_ACTION" herandro-label="Cambió de idioma" herandro-value="<?=$lang?>" class="translate-btn">213123123312</button>-->
    <!--end section my knowledges-->
    <!--section my abilities-->
    <section id="abilities-section" class="abilities-user-section container" x-intersect.once="getPortfolioCategories()" >
       <div x-show="portfolioCategories_section">
           <div class="section-header">
               <p class="-title"><?=_translate("mis habilidades")?></p>
               <p class="-description"> <?=_translate("Buen manejo y conocimiento en las siguientes Tecnológias")?></p>
           </div>
           <template x-for="category in portfolioCategories">
               <div class="item-abilities container">
                   <p class="category-name" x-text="category['title_'+language]"></p>
                   <div class="row">
                       <template x-for="portfolio in category.Portfolios">
                           <div :class="portfolio.show ? 'btn-tooltip' : 'btn-tooltip '" @click="portfolio.show = !portfolio.show">
                               <img width="100" class="lazy" height="120" lazy :data-src="getImage(portfolio.icon_path)" data-bs-toggle="tooltip" data-bs-placement="top" :title="portfolio.title" :alt="portfolio.title" loading="lazy">
                               <div :class="portfolio.show ? 'tooltip btn-tooltip-close show' : 'tooltip btn-tooltip-close'">
                                   <div class="content-tooltip">
                                       <div class="header-tooltip">
                                           <button class="close"><?=_translate("Cerrar")?></button>
                                           <p class="title" x-text="portfolio.title"></p>
                                           <p class="sub-title" x-text="portfolio.description"></p>
                                       </div>
                                       <div class="body-tooltip">
                                           <!--<p>Conocimiento en Javascript, async y await</p>-->
                                           <div class="count-experiences">
                                               <p ><span x-text="portfolio.years_experience+'+'"></span><?=_translate("Experiencia")?></p>
                                               <p><span x-text="portfolio.knowledge_level ? portfolio.knowledge_level+'%' : '20%'"></span> Conocimientos</p>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </template>
                   </div>
               </div>
           </template>
       </div>
    </section>
    <!--end section my abilities-->
    <!--section bussiness proyects -->
    <section id="bussiness-section" class="bussiness-user-section">
        <div class="container">
            <div class="section-header">
                <p class="-title"><?=_translate("Empresas desarrollando")?></p>
                <p class="-description"> <?=_translate("Experiencia trabajando en diferentes empresas y proyectos nacionales e internacionales")?></p>
            </div>
            <div class="row" x-intersect.once="getProfessionalProjects()">
                <template x-for="professionalProject in professionalProjects">
                    <div class="-pe-auto " @click="professionalProject.show = !professionalProject.show">
                        <img lazy width="100" class="lazy" height="120" :data-src="getImage(professionalProject.image_path)" :alt="professionalProject.company" :title="professionalProject.company" loading="lazy">
                        <div :class="professionalProject.show ? 'modal show':'modal'">
                            <div class="modal-dialog">
                                <div class="modal-header">
                                    <img lazy class="img-header lazy" height="120" width="100" :data-src="getImage(professionalProject.image_path)" :alt="professionalProject.company" :title="professionalProject.company">
                                    <p CLASS="name-company-modal" x-text="professionalProject.company"></p>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <p class="name-company" x-text="professionalProject['job_'+language]"> </p>
                                        <p class="text-content">
                                            <b><?=_translate("Del")?> </b><span x-text="professionalProject.date_start"></span> <b> <?=_translate("al")?>  </b><span x-text="professionalProject.date_end"></span>
                                        </p>
                                    </div>
                                    <div class="text-justify -mt-1">
                                        <div class="list-badges">
                                            <template x-for="portfolio in professionalProject.portfolio">
                                                <span class="badge rounded-pill outline-badge mt-2"><img lazy class="lazy" :data-src="getImage(portfolio.icon_path)" width="13" height="10" loading="lazy"> <span x-text="portfolio['title_'+language]"></span></span>
                                            </template>
                                        </div>
                                        <div class="-mt-2 info-job" x-html="professionalProject['description_'+language]">

                                        </div>
                                    </div>
                                    <!--<div class="mt-4 text-center">
                                        <button class="btn outliner-primary"  data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
    <!--end section bussiness proyects -->
    <!--section contact us-->
    <section id="contact-section" class="contact-user-section -bg-blue">

        <form class="container" id="contact-form">
            <div class="section-header -white">
                <p class="-title"><?=_translate("Contacto")?></p>
                <p class="-description"> <?=_translate("Puedes contactarme enviandome un mensaje")?></p>
            </div>
            <div class="row">
                <div class="c-6">
                    <input required="true" class="form-control" data-invalid="name-required-invalid" aria-label="name user" id="name" name="name" required="" type="text" placeholder="<?=_translate("Nombre")?>">
                    <div id="name-required-invalid" class="invalid-feedback pl-2">
                        ¡Por favor escriba su nombre completo!
                    </div>
                </div>
                <div class="c-6">
                    <input required="true" data-invalid="phone-required-invalid" value="" class="form-control " min="8" max="12" id="phone" aria-label="phone user" name="phone" type="tel" placeholder="<?=_translate("Número telefónico")?>" required="required">
                    <div id="phone-required-invalid" class="invalid-feedback pl-2">
                        ¡Por favor escriba correctamente su número de teléfono!
                    </div>
                </div>
                <div class="c-12">
                    <input required="true" data-invalid="email-required-invalid" value="" class="form-control  " id="email" aria-label="email user" name="email" type="email" placeholder="<?=_translate("Email")?>" required="required">
                    <div id="email-required-invalid" class="invalid-feedback pl-2">
                        ¡Por favor escriba correctamente su correo!
                    </div>
                </div>
                <div class="c-12">
                    <textarea required="true" data-invalid="message-required-invalid" class="form-control  " name="message" aria-label="message user" id="message" rows="5" cols="5" placeholder="<?=_translate("Mensaje")?>" required="required"></textarea>
                    <div id="message-required-invalid" class="invalid-feedback pl-2">
                        ¡Por favor escriba un mensaje!
                    </div>
                </div>
                <div class="c-12 -d-flex -justify-content-center -align-items-center">
                    <button class="btn-portfolio -white "> <?=_translate("Envíar mensaje")?> </button>
                </div>
            </div>
        </form>
    </section>
    <!--end section contact us-->
    <!--footer-->
    <footer id="footer-info">
        <div class="container">
            <img lazy width="90" class="lazy" height="90" :data-src="getImage(myPerfil['slogan_'+language])" alt="Card image cap" loading="lazy">
            <div class="-d-flex -justify-content-center" loading="lazy">
                <template x-for="contact in myContacts">
                    <a class="btn btn-contact " :title="contact['name_'+language]" :href="contact.url_path" :aria-label="contact.icon_path" target="_blank" rel="noreferrer noopener">
                        <i  :class="contact.icon_path" loading="lazy"></i>
                    </a>
                </template>
            </div>

            <p class="autor-name">Copyright © José Ángel Alvarado Gonzalez 2022</p>
        </div>
    </footer>
    <!--end footer-->
    <div x-show="!myPerfil.id" >
        <div class="splash-loading">
            <div class="content-splash">
                <img width="90" height="90" src="img/banner-logo.svg" alt="Card image cap">
                <p><?=_translate("Cargando Información")?>...</p>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: block;" width="54px" height="54px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <g transform="rotate(0 50 50)">
                        <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-1.443001443001443s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(32.72727272727273 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-1.2987012987012987s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(65.45454545454545 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-1.1544011544011545s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(98.18181818181819 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-1.0101010101010102s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(130.9090909090909 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-0.8658008658008658s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(163.63636363636363 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-0.7215007215007215s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(196.36363636363637 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-0.5772005772005773s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(229.0909090909091 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-0.4329004329004329s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(261.8181818181818 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-0.28860028860028863s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(294.54545454545456 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="-0.14430014430014432s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(327.27272727272725 50 50)">
                    <rect x="47" y="20" rx="3" ry="3.2" width="6" height="20" fill="#3058a6">
                        <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.5873015873015872s" begin="0s" repeatCount="indefinite"></animate>
                    </rect>
                </g>
                </svg>
            </div>
            <div class="footer-splash">
                <p>Copyright © José Ángel Alvarado Gonzalez 2022</p>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/2c9fd591be.js" crossorigin="anonymous" async></script>
    <script src="js/globals.min.js?v=1.0.2" async></script>
    <script src="js/index.min.js?v=1.0.2" async></script>
    <script async>
        //service woker
        if('serviceWorker' in navigator) {
            navigator.serviceWorker.register('./sw.js');
        };

        //getCache("https://admin.herandro.com.mx/api/myportfolio/myknowledges/es")
        //addCache('https://admin.herandro.com.mx/api/myportfolio/myknowledges/es',
          //  [{"id":1,"code":"lenguajes_programacion","title":"Lenguajes de Programaci\u00f3n","description":"Lenguajes de Programaci\u00f3n","portfolios":[{"id":1,"code":"javascript","icon_path":"\/storage\/b0yNHu68FP5WyEcjf61e596fFSfychw0ZQHgvhws.svg","title":"JavaScript","description":"Conocimiento de javascript","years_experience":2,"knowledge_level":null},{"id":2,"code":"php","icon_path":"\/storage\/eJrvIIjhts9bIrBgj98Suw5kwudBiUaJpdlGaYD8.svg","title":"PHP","description":"PHP","years_experience":3,"knowledge_level":null},{"id":3,"code":"kotlin","icon_path":"\/storage\/8R9VOgwZVofJIJEQXOyuA6q9Jwh1GBLjseVZDEre.svg","title":"kotlin","description":"kotlin","years_experience":1,"knowledge_level":null},{"id":4,"code":"java","icon_path":"\/storage\/sz4y6nrWNehRIiyjBxl3YNBoh0DFhUHorjiQzSQI.svg","title":"Java","description":"java","years_experience":null,"knowledge_level":null},{"id":5,"code":"python","icon_path":"\/storage\/F6hANVCjBkvpNrgZIxcFIAgeS770Pw9KZow7y2fH.svg","title":"Python","description":"eqwe","years_experience":1,"knowledge_level":50},{"id":6,"code":"TypeScript","icon_path":"\/storage\/8vjKP2pDftubTisvAqCMFRbt4nRWNKcNKDJZ0rUs.svg","title":"TypeScript","description":"TypeScript","years_experience":3,"knowledge_level":null}]},{"id":2,"code":"frameworks","title":"Frameworks","description":"Frameworks","portfolios":[{"id":7,"code":"Angular","icon_path":"\/storage\/YbjE8InSN5g5lUtVuamVGJuzbAzNLpjm6hLwRWQN.svg","title":"Angular","description":"Angular","years_experience":3,"knowledge_level":50},{"id":8,"code":"Laravel","icon_path":"\/storage\/9VcCyi1DP0GpWReFncHT3sYI8Gs5mHgbvnt8Qbor.svg","title":"Laravel","description":"Laravel","years_experience":3,"knowledge_level":50},{"id":9,"code":"Android","icon_path":"\/storage\/g2OFwWSPeQpM8kbu42h93WntQ6eVXwVGwO0o1Ery.svg","title":"Android","description":"Android","years_experience":1,"knowledge_level":null},{"id":10,"code":"Vue","icon_path":"\/storage\/bKmb91V3ExdP0BROrD0nSWSLh2bslOGQFIrIh0AX.svg","title":"Vue","description":"Vue","years_experience":2,"knowledge_level":60},{"id":11,"code":"Node JS","icon_path":"\/storage\/qbqr20WrYSwaQKZvYT6ZlTeNdYTOjCRcfvp9EYnT.svg","title":"Node JS","description":"Node JS","years_experience":1,"knowledge_level":null},{"id":29,"code":"Ionic","icon_path":"\/storage\/eXb6KC63m6iqbPDPMGNDJ7XzteoP4TV8ofPR3s2X.svg","title":"Ionic","description":"Ionic","years_experience":3,"knowledge_level":null},{"id":30,"code":"Yii PHP","icon_path":"\/storage\/zlj2ghdTlHvkNAggbyeJJuL1OVgpkU5ewUbirhGh.svg","title":"Yii PHP","description":"Yii PHP","years_experience":1,"knowledge_level":null},{"id":31,"code":"Nest JS","icon_path":"\/storage\/3koezjisO4GogPzsHj7HAeWRo0PfQ8emDxYa1CZW.svg","title":"Nest JS","description":"Nest JS","years_experience":1,"knowledge_level":null},{"id":32,"code":"CodeIgniter PHP","icon_path":"\/storage\/lqMgfx7qaoOVA1LVX8PHO7LvDfcwiHTdHUEUQUoj.svg","title":"CodeIgniter","description":"CodeIgniter","years_experience":1,"knowledge_level":50}]},{"id":3,"code":"frameworks CSS","title":"frameworks CSS","description":"frameworks CSS","portfolios":[{"id":12,"code":"bootstrap","icon_path":"\/storage\/DvoWIGHbe0N2nFoigeevZJsbwUAQ5Q2bat9DjjRJ.svg","title":"Bootstrap","description":"Bootstrap","years_experience":4,"knowledge_level":100},{"id":13,"code":"material design","icon_path":"\/storage\/ghRlnOLqjLmECtfUcHho8v2PqvOBlD9T9gaTJaKh.svg","title":"Material Design","description":"Material Design","years_experience":2,"knowledge_level":50}]},{"id":4,"code":"herramientas","title":"Herramientas y librer\u00edas","description":"Herramientas y librer\u00edas","portfolios":[{"id":14,"code":"Adobe Illustrator","icon_path":"\/storage\/sQyDE9pU4EhWBUDNDZh2MPNBFToBIqy8eTP7r0hy.svg","title":"Adobe Illustrator","description":"Adobe Illustrator","years_experience":1,"knowledge_level":null},{"id":15,"code":"Adobe Photoshop","icon_path":"\/storage\/lr0LGePGmJvoKrDNPNo0Kj1EZWqarPEeeLNG6EJB.svg","title":"Adobe Photoshop","description":"Adobe Photoshop","years_experience":1,"knowledge_level":50},{"id":16,"code":"GitHub","icon_path":"\/storage\/c3KdWxSaVdHNIQmIGPeyFRlczSFAHCUgNP9DbnQV.svg","title":"GitHub","description":"GitHub","years_experience":3,"knowledge_level":null},{"id":17,"code":"GitLab","icon_path":"\/storage\/h1J2eBG3HWFeqcMB56mNHxAgiNI8GNtTCohaL9uB.svg","title":"GitLab","description":"GitLab","years_experience":3,"knowledge_level":50},{"id":18,"code":"IntelliJ IDEA","icon_path":"\/storage\/Lh8Rm59cHrh7yTFia77kqd9uzWoRatlpxmdKmTfp.svg","title":"IntelliJ IDEA","description":"IntelliJ IDEA","years_experience":2,"knowledge_level":50},{"id":19,"code":"Eclipse","icon_path":"\/storage\/3YrgfPDgCnoi4sGOhYfg0GT512yJun6HjcZGd7bW.svg","title":"Eclipse","description":"Eclipse","years_experience":3,"knowledge_level":null},{"id":21,"code":"Visual Studio Code","icon_path":"\/storage\/Gm7p5MDHkiMftk4mMH5B67c71ha61N4zye7BwnW4.svg","title":"Visual Studio Code","description":"Visual Studio Code","years_experience":3,"knowledge_level":50},{"id":22,"code":"Microsoft Visual Studio","icon_path":"\/storage\/OmY1KSGKyKc420pCrIO0RFfYHKNwRVRb60SIMz3Y.svg","title":"Microsoft Visual Studio","description":"Microsoft Visual Studio","years_experience":1,"knowledge_level":50},{"id":23,"code":"Adobe XD","icon_path":"\/storage\/wmoQqMlogLW3DtJCBwnsoYve9ZEemhWYOU9dy7Yk.svg","title":"Adobe XD","description":"Adobe XD","years_experience":3,"knowledge_level":50},{"id":34,"code":"vuex","icon_path":"\/storage\/ZjGTO6YQd8ojn6UjqBTLLCWuhuoY2tKN0U3s9elw.svg","title":"Vuex(Redux)","description":"knowledge with the Vue js library","years_experience":1,"knowledge_level":50},{"id":35,"code":"ngrx","icon_path":"\/storage\/3nYxRSm97uoD7UH0vcdfMow3fPEKdOIk23NJQR57.svg","title":"NgRx(Redux)","description":"knowledge with the NgRx library","years_experience":2,"knowledge_level":null},{"id":36,"code":"gulpjs","icon_path":"\/storage\/qNVKORp8aHjJn8R55Cf4ZLOm5bWxpiNsQk3KLAmy.svg","title":"Gulp js","description":"knowledge with the Gulp js library","years_experience":2,"knowledge_level":50},{"id":37,"code":"scss","icon_path":"\/storage\/JMzgXnAzGC9ugkt6xtQ6DfcAroHbh5si42SoXKpp.svg","title":"Sass(Scss)","description":"High knowledge in layout with Sass","years_experience":4,"knowledge_level":null}]},{"id":5,"code":"Base de datos","title":"Base de Datos","description":"Base de Datos","portfolios":[{"id":24,"code":"MySQL","icon_path":"\/storage\/NsREmgDDjCGgyhqt2gqOakltYGn2ROy7s4xZrW1T.svg","title":"MySQL","description":"MySQL","years_experience":4,"knowledge_level":50},{"id":25,"code":"Mongo DB","icon_path":"\/storage\/rWdPwFMsrXfK3t4NZG5KHIn4o42s8juRxeSAEJ7K.svg","title":"Mongo DB","description":"Mongo DB","years_experience":2,"knowledge_level":50},{"id":26,"code":"Firebase","icon_path":"\/storage\/Rtqim7sHu8WW6G3VXNEdqTvoWUrobPa7ojnuf8Iu.svg","title":"Firebase","description":"Firebase","years_experience":3,"knowledge_level":50},{"id":27,"code":"PostgreSQL","icon_path":"\/storage\/78wzxvxFvBpuGwLbw6QKJG0lRt8dPTzFwr9XzxhX.svg","title":"PostgreSQL","description":"PostgreSQL","years_experience":1,"knowledge_level":50},{"id":28,"code":"SQL Server","icon_path":"\/storage\/cy8zePNKaFHxnkS23qLq33LIhhSnvpTAcTnDRkm2.svg","title":"SQL Server","description":"SQL Server","years_experience":3,"knowledge_level":null}]}]);

    </script>
</body>
</html>
