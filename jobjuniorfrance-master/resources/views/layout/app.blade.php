<html>

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140619074-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-140619074-2');
    </script>

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = 'a6394835763d1421a03434f3632d3eea40be5982';
        window.smartsupp || (function (d) {
            var s, c, o = smartsupp = function () { o._.push(arguments) }; o._ = [];
            s = d.getElementsByTagName('script')[0]; c = d.createElement('script');
            c.type = 'text/javascript'; c.charset = 'utf-8'; c.async = true;
            c.src = 'https://www.smartsuppchat.com/loader.js?'; s.parentNode.insertBefore(c, s);
        })(document);
    </script>

    <title>Développeur Web Junior - Job Board</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description"
        content="Le seul et unique Job Board pour développeur web junior ! En reconversion, autodidacte ou sans expérience. Ce board est fait pour vous">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/anko.css">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg align-content-center px-0">
                <a class="navbar-brand blue" href="/">{{ config('site.name') }}</a>
                <div class="navbar-collapse text-center" id="menu">
                    <ul class="navbar-nav ml-lg-auto">
                        @foreach (config('pages') as $page)
                        <li class="nav-item dosis">
                            <a class="nav-link bg-bl" href="{{ route($page['url']) }}">{{ $page['name'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    @include('flash-message')
    @include('longboard')
    <div id="app">
        @yield('content')
    </div>
    @include('layout.footer')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> </script>
</body>

</html>