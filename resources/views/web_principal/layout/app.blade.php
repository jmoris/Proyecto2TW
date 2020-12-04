
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="/vendors/linericon/style.min.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="/vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="/vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="/vendors/animate-css/animate.min.css">
		<link rel="stylesheet" href="/vendors/flaticon/flaticon.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Goldman:wght@700&display=swap" rel="stylesheet">
        <!-- main css -->
        <link rel="stylesheet" href="/css/style.min.css">
        <link rel="stylesheet" href="/css/responsive.css">
    </head>
    <body>
        @include('web_principal.layout.header')
        @yield('contenido')
        @include('web_principal.layout.footer')
 
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js" integrity="sha512-7yA/d79yIhHPvcrSiB8S/7TyX0OxlccU8F/kuB8mHYjLlF1MInPbEohpoqfz0AILoq5hoD7lELZAYYHbyeEjag==" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
