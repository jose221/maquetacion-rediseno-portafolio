<?php
session_start();
$langs = array('es', 'en');
$lang = (isset($_GET['lang'])) ? $_GET['lang'] : $_SESSION['lang'];
if(!in_array($lang, $langs)){
    $lang = 'es';
}
$_SESSION['lang'] = $lang;
$GLOBALS['translate']= require_once "./lang/".$lang.".php";
function _translate($word){
    return ($GLOBALS['translate'][$word]) ? $GLOBALS['translate'][$word] : $word;
}
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cross-Platform Application Developer">
    <!--tags-->
    <meta name="author" content="José Ángel Alvarado Gonzalez">
    <meta property="og:title" content="José Ángel Alvarado Gonzalez">
    <meta property="og:image:url" content="{{asset('img/logo.png')}}">
    <meta property="og:image:secure_url" content="{{asset('img/logo.png')}}">
    <meta property="og:image:width" content="2500">
    <meta property="og:image:height" content="1330">
    <meta property="og:url" content="https://jose.alvarado.herandro.com.mx/">
    <meta property="og:site_name" content="José Ángel">
    <meta property="og:type" content="website">
    <link rel="shortcut icon" href="/img/logo.png" />
    <title>José Angel Alvarado Gonzalez</title>

    <meta name="keywords" content="jose angel alvarado gonzalez, José Ángel Alvarado González, Desarrollador web, freelancer jose angel, jose angel alvarado gonzalez cancun,+José Ángel Alvarado González Cancún">
    <!--styles-->
    <!--links-->
    <link rel="stylesheet preload" href="css/index.min.css?v=0.2.8"  as="style" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://jose.alvarado.herandro.com.mx/" crossorigin>
    <link rel="preconnect" href="https://kit.fontawesome.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,200;1,700&amp;display=swap" rel="preload">
    <!--preconnect-->

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
                    <a alt="contact" class="translate-btn" href="?lang=<?=($lang == 'es')? 'en': 'es'?>"><i class="fas fa-globe"></i> <span class="nav-text"><?=_translate(($lang))?></span></a>
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
                    <img x-show="myPerfil.logo" x-transition.scale width="45" alt="img logo" height="40" :src="getImage(myPerfil.slogan)">
                </div>
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
                        <a alt="contact" class="translate-btn" href="?lang=<?=($lang == 'es')? 'en': 'es'?>"><i class="fas fa-globe"></i> <span class="nav-text"><?=_translate(($lang))?></span></a>
                    </li>
                </ul>
                <div class="nav-footer">
                    <template x-for="contact in myContacts">
                        <a class="btn btn-contact" :title="contact.name" :href="contact.url_path" :aria-label="contact.icon_path" target="_blank" rel="noreferrer noopener">
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
                        <a class="btn btn-contact" :title="contact.name" :href="contact.url_path" :aria-label="contact.icon_path" target="_blank" rel="noreferrer noopener">
                            <i  :class="contact.icon_path" ></i>
                        </a>
                    </template>
                </div>
                <div>
                    <h2 x-text="myPerfil.name"></h2>
                    <h3 x-text="myPerfil.header_text"></h3>
                </div>
                <a class="btn-portfolio" href="#"><?=_translate("VER MI PORTAFOLIO")?></a>
            </div>
            <img alt="avatar" width="1022" height="1300" :src="getImage(myPerfil.header_image_path)">
        </div>
    </header>
    <!--end head-->
    <!--section information-->
    <section id="about-section" class="information-user-section container" x-data="{myinformation_section: false}" x-intersect.once="myinformation_section = true">
        <div class="section-header">
            <p class="-title"><?=_translate("Acerca de")?></p>
        </div>
        <div class="row" x-show="myinformation_section" x-transition.delay.150ms>
            <img width="100%" height="100%" alt="jose angel alvarado gonzalez" :src="myinformation_section && getImage(myPerfil.my_perfil)">
            <div>
                <h2>
                    <?=_translate("hello")?>
                </h2>
                <div class="description-user ">
                    <p x-text="myPerfil.description"></p>
                </div>
                <div  class="footer-user">
                    <ul>
                        <li><i class="fas fa-at"></i><span x-text="myPerfil.email"></span></li>
                        <li><i class="fas fa-globe-americas"></i> <span x-text="myPerfil.nationality"></span></li>
                    </ul>
                    <div class="count-experiences">
                        <p>30+<span><?=_translate("proyectos")?></span></p>
                        <p>5+<span><?=_translate("años")?></span></p>
                        <p>5+<span><?=_translate("empresas")?></span></p>

                    </div>
                    <div class="action-footer-user">
                        <a class="btn-portfolio " target="_blank" rel="noreferrer noopener" :href="getImage(myPerfil.cv)"> <?=_translate("ver curriculum")?> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end section information-->
    <!--section my knowledges-->
    <section id="knowledges-section" class="knowledges-user-section -bg-blue" x-data="myKnowledges" x-intersect.once="geMyKnowledges()">
        <div class="container" x-show="myKnowledges_section" >
            <div class="section-header -white">
                <p class="-title" title><?=_translate("Mis conocimientos")?></p>
                <p class="-description"><?=_translate("Conocimiento y destrezas en la tecnologías de la información")?></p>
            </div>
            <div  class="row">
                <template x-for="myKnowledge in myKnowledges">
                    <div>
                        <div class="item-header ">
                            <img width="100%" height="100%" class="card-img-top img-circle" :src="myKnowledges_section && getImage(myKnowledge.icon_path)" :alt="myKnowledge.title" loading="lazy">
                        </div>
                        <div class="item-content">
                            <p class="title-item" x-text="myKnowledge.title">
                            </p>
                            <div x-html="myKnowledge.description">

                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </section>
    <!--end section my knowledges-->
    <!--section my abilities-->
    <section id="abilities-section" class="abilities-user-section container" x-data="portfolioCategories" x-intersect.once="getPortfolioCategories()" >
       <div x-show="portfolioCategories_section">
           <div class="section-header">
               <p class="-title"><?=_translate("mis habilidades")?></p>
               <p class="-description"> <?=_translate("Buen manejo y conocimiento en las siguientes Tecnológias")?></p>
           </div>
           <template x-for="category in portfolioCategories">
               <div class="item-abilities">
                   <p class="category-name" x-text="category.title"></p>
                   <div class="row">
                       <template x-for="portfolio in category.portfolios">
                           <div :class="portfolio.show ? 'btn-tooltip' : 'btn-tooltip '" @click="portfolio.show = !portfolio.show">
                               <img width="100" height="120" :src="getImage(portfolio.icon_path)" data-bs-toggle="tooltip" data-bs-placement="top" :title="portfolio.title" :alt="portfolio.title" loading="lazy">
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
            <div class="row" x-data="professionalProjects" x-intersect.once="getProfessionalProjects()">
                <template x-for="professionalProject in professionalProjects">
                    <div class="-pe-auto " @click="professionalProject.show = !professionalProject.show">
                        <img width="100" height="120" :src="getImage(professionalProject.image_path)" :alt="professionalProject.company" :title="professionalProject.company" loading="lazy">
                        <div :class="professionalProject.show ? 'modal show':'modal'">
                            <div class="modal-dialog">
                                <div class="modal-header">
                                    <img class="img-header" height="120" width="100" :src="getImage(professionalProject.image_path)" loading="lazy" :alt="professionalProject.company" :title="professionalProject.company">
                                    <p CLASS="name-company-modal" x-text="professionalProject.company"></p>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <p class="name-company" x-text="professionalProject.job"> </p>
                                        <p class="text-content">
                                            <b><?=_translate("Del")?> </b><span x-text="professionalProject.date_start"></span> <b> <?=_translate("al")?>  </b><span x-text="professionalProject.date_end"></span>
                                        </p>
                                    </div>
                                    <div class="text-justify -mt-1">
                                        <div class="list-badges">
                                            <template x-for="portfolio in professionalProject.portfolio">
                                                <span class="badge rounded-pill outline-badge mt-2"><img :src="getImage(portfolio.icon_path)" width="13" height="10" loading="lazy"> <span x-text="portfolio.title_en"></span></span>
                                            </template>
                                        </div>
                                        <div class="-mt-2 info-job" x-html="professionalProject.description">

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

        <form id="contact-form">
            <div class="container">
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
            </div>
        </form>
    </section>
    <!--end section contact us-->
    <!--footer-->
    <footer id="footer-info">
        <div class="container">
            <img width="90" height="90" :src="getImage(myPerfil.slogan)" alt="Card image cap" loading="lazy">
            <div class="-d-flex -justify-content-center" loading="lazy">
                <template x-for="contact in myContacts">
                    <a class="btn btn-contact " :title="contact.name" :href="contact.url_path" :aria-label="contact.icon_path" target="_blank" rel="noreferrer noopener">
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
                <img width="90" height="90" lazy data-src="img/banner-logo.svg" alt="Card image cap">
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
    <script src="https://kit.fontawesome.com/2c9fd591be.js" crossorigin="anonymous" defer></script>
    <script defer  src="js/globals.min.js?v=0.2.8" ></script>
    <script src="js/index.min.js?v=0.2.8" defer></script>
</body>
</html>
