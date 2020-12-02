
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <!-- Primary Meta Tags -->
        <title>Web personal - Jesús Moris</title>
        <meta name="title" content="Web personal - Jesús Moris">
        <meta name="description" content="Web con contenido relacionado a mi vida, ya sean mis estudios basicos, medios y superiores. Ademas, de las diferentes experiencias obtenidas a lo largo de la carrera de Ing. Civil En Computacion.">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://jesusmoris.cl/">
        <meta property="og:title" content="Web personal - Jesús Moris">
        <meta property="og:description" content="Web con contenido relacionado a mi vida, ya sean mis estudios basicos, medios y superiores. Ademas, de las diferentes experiencias obtenidas a lo largo de la carrera de Ing. Civil En Computacion.">
        <meta property="og:image" content="http://jesusmoris.cl/logojm.png">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="http://jesusmoris.cl/">
        <meta name="twitter:site" content="@jesusmoris">
        <meta name="twitter:creator" content="@jesusmoris">
        <meta name="twitter:title" content="Web Personal - Jesús Moris">
        <meta name="twitter:description" content="Web con contenido relacionado a mi vida, ya sean mis estudios basicos, medios y superiores. Ademas, de las diferentes experiencias obtenidas a lo largo de la carrera de Ing. Civil En Computacion.">
        <meta name="twitter:image" content="http://jesusmoris.cl/logojm.png">

        <!-- Bootstrap CSS -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/vendors/linericon/style.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="/vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="/vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="/vendors/animate-css/animate.css">
		<link rel="stylesheet" href="/vendors/flaticon/flaticon.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Goldman:wght@700&display=swap" rel="stylesheet">
        <!-- main css -->
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/responsive.css">
    </head>
    <body>
        @include('web_principal.layout.header')
        @yield('contenido')
        @include('web_principal.layout.footer')

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/popper.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/stellar.js"></script>
        <script src="/vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="/vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="/vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="/vendors/isotope/isotope-min.js"></script>
        <script src="/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="/js/jquery.ajaxchimp.min.js"></script>
        <script src="/vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="/vendors/counter-up/jquery.counterup.min.js"></script>
        <script src="/js/mail-script.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="/js/gmaps.min.js"></script>
        <script src="/js/theme.js"></script>
        <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fc6a8e9cabef10011d3fa3e&product=inline-share-buttons" async="async"></script>
        @yield('scripts')
    </body>
</html>
