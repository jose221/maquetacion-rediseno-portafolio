<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cross-Platform Application Developer">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,200;1,700&amp;display=swap" rel="preload">
    <title>Mi portafolio</title>
    <link rel="stylesheet preload" href="css/portfolio.min.css"  as="style" type="text/css">
    <link rel="stylesheet preload" as="style" type="text/css" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>
<!--head-->
<header>
    <nav class="navbar">
        <div class="container">
            <a alt="logo" class="navbar-brand" href="/"><img width="45" alt="img logo" height="40" src="http://jose.alvarado.herandro.com.mx/storage/UaeMUpmwWHELodPS2eotvVi6VnuIbAdvT9Nlsf9f.svg"></a>
            <ul>
                <li>
                    <a alt="home" href="index.html"><span class="nav-text">Inicio</span></a>
                </li>
                <li>
                    <a alt="about us" href="#about-section">  <span class="nav-text">Acerca de</span></a>
                </li>
                <li>
                    <a alt="my knowledges" href="#knowledges-section"> <span class="nav-text">Mis conocimientos</span></a>
                </li>
                <li>
                    <a alt="my abilities" class="nav-link active" href="#abilities-section"> <span class="nav-text">Mis habilidades</span></a>
                </li>
                <li>
                    <a alt="professional experience" href="portfolio.html"><span class="nav-text">Mi portafolio</span></a>
                </li>
                <li>
                    <a alt="contact" href="#contact-section"> <span class="nav-text">Contacto</span></a>
                </li>
                <li>
                    <a alt="contact" class="translate-btn" href="#contact-section"><i class="fas fa-globe"></i> <span class="nav-text">Español (ES)</span></a>
                </li>
            </ul>
            <div class="responsive-content">
                <a alt="contact" class="translate-btn" href="#contact-section"><i class="fas fa-globe"></i> <span class="nav-text">Español (ES)</span></a>
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
                <img width="45" alt="img logo" height="40" src="http://jose.alvarado.herandro.com.mx/storage/vFkeUrshO8RmAxLgS4gRDneKdzwegtdU5FkbfX7n.svg">
            </div>
            <ul>
                <li>
                    <a alt="home" href="index.html"><span class="nav-text">Inicio</span></a>
                </li>
                <li>
                    <a alt="about us" href="#about-section">  <span class="nav-text">Acerca de</span></a>
                </li>
                <li>
                    <a alt="my knowledges" href="#knowledges-section"> <span class="nav-text">Mis conocimientos</span></a>
                </li>
                <li>
                    <a alt="my abilities" class="nav-link active" href="#abilities-section"> <span class="nav-text">Mis habilidades</span></a>
                </li>
                <li>
                    <a alt="professional experience" href="portfolio.html"><span class="nav-text">Mi portafolio</span></a>
                </li>
                <li>
                    <a alt="contact" href="#contact-section"> <span class="nav-text">Contacto</span></a>
                </li>
            </ul>
            <div class="nav-footer">
                <a class="btn btn-contact" aria-label="fab fa-whatsapp" href="https://wa.me/529983567152" target="_blank" rel="noreferrer noopener">
                    <i class=" fab fa-whatsapp text-center" loading="lazy"></i>
                </a>
                <a class="btn btn-contact" aria-label="fas fa-phone-alt" href="tel:9983567152" target="_blank" rel="noreferrer noopener">
                    <i class=" fas fa-phone-alt text-center" loading="lazy"></i>
                </a>
                <a class="btn btn-contact" aria-label="far fa-envelope" href="mailto:jose.alvarado220@hotmail.com" target="_blank" rel="noreferrer noopener">
                    <i class=" far fa-envelope text-center" loading="lazy"></i>
                </a>
                <a class="btn btn-contact" aria-label="fab fa-facebook " href="https://web.facebook.com/joseangel.alvarado.735507" target="_blank" rel="noreferrer noopener">
                    <i class=" fab fa-facebook text-center" loading="lazy"></i>
                </a>
            </div>
        </nav>
    </div>
    <div class="row container presentation-section">
        <div>
            <h1>Experiencia en los siguientes proyectos</h1>
            <h2>Desarrollando y adaptándome</h2>
        </div>
        <div>
            <img src="./img/header-test.svg"/>
        </div>
    </div>
</header>
<!--end head-->
<section class="list-projects-section">
    <div class="item">
        <div class="container">
            <div>
                <img src="./img/proyectos-car-rental.svg"/>
            </div>
            <div>
                <p class="title">
                    AMERICA CAR RENTAL
                </p>
                <div class="description">
                    <p>Renta de carros en Cancún con Cancún Car Rental.
                        Sin duda alguna Cancún es uno de los destinos principales a nivel turismo y business en México.</p>
                    <ul>
                        <li>Https://americacarrental.com.mx/</li>
                        <li>Https://www.cancunrentacar.com/</li>
                        <li>Pagina privada administrativa de contratos de la empresa america car rental</li>
                        <li>Pagina privada administrativa de empleados de la empresa america car rental</li>
                    </ul>
                </div>
                <div class="gallery">
                    <img src="./img/item-proyecto.svg"/>
                    <img src="./img/item-proyecto.svg"/>
                    <img src="./img/item-proyecto.svg"/>
                    <img src="./img/item-proyecto.svg"/>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="container">
            <div>
                <img src="./img/proyectos-car-rental.svg"/>
            </div>
            <div>
                <p class="title">
                    AMERICA CAR RENTAL
                </p>
                <div class="description">
                    <p>Renta de carros en Cancún con Cancún Car Rental.
                        Sin duda alguna Cancún es uno de los destinos principales a nivel turismo y business en México.</p>
                    <ul>
                        <li>Https://americacarrental.com.mx/</li>
                        <li>Https://www.cancunrentacar.com/</li>
                        <li>Pagina privada administrativa de contratos de la empresa america car rental</li>
                        <li>Pagina privada administrativa de empleados de la empresa america car rental</li>
                    </ul>
                </div>
                <div class="gallery">
                    <img src="./img/item-proyecto.svg"/>
                    <img src="./img/item-proyecto.svg"/>
                    <img src="./img/item-proyecto.svg"/>
                    <img src="./img/item-proyecto.svg"/>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!--footer-->
        <footer id="footer-info">
            <div class="container">
                <img width="90" height="90" src="http://jose.alvarado.herandro.com.mx/storage/vFkeUrshO8RmAxLgS4gRDneKdzwegtdU5FkbfX7n.svg" alt="Card image cap" loading="lazy">
                <div class="-d-flex -justify-content-center" loading="lazy">
                    <a class="btn btn-contact" title="whatsapp" href="https://wa.me/529983567152" target="_blank" rel="noreferrer noopener" >
                        <i class=" fab fa-whatsapp text-center"></i>
                    </a>
                    <a class="btn btn-contact" title="phone number" href="tel:9983567152" target="_blank" rel="noreferrer noopener" >
                        <i class=" fas fa-phone-alt text-center"></i>
                    </a>
                    <a class="btn btn-contact" title="message" href="mailto:jose.alvarado220@hotmail.com" target="_blank" rel="noreferrer noopener" >
                        <i class=" far fa-envelope text-center"></i>
                    </a>
                    <a class="btn btn-contact" title="facebook" href="https://web.facebook.com/joseangel.alvarado.735507" target="_blank" rel="noreferrer noopener" >
                        <i class=" fab fa-facebook text-center"></i>
                    </a>
                </div>

                <p class="autor-name">Copyright © José Ángel Alvarado Gonzalez 2022</p>
            </div>
        </footer>
        <!--end footer-->
        <div class="splash-loading -hidden">
            <div class="content-splash">
                <img width="90" height="90" src="http://jose.alvarado.herandro.com.mx/storage/vFkeUrshO8RmAxLgS4gRDneKdzwegtdU5FkbfX7n.svg" alt="Card image cap" loading="lazy">
                <p>Cargando Información...</p>
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
        <script src="js/libs/alpinejs.min.js" async></script>
        <script src="js/index.min.js"></script>
</body>
</html>
