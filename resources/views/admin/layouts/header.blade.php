<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
            integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset("fonts/icomoon/style.css")}}">

    <link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>Админ панель DesigNaEasy</title>
</head>
<body style="height: fit-content;padding-bottom: 50px;">
<header class="site-navbar" style="position:relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-xl-2">
                <h1 class="mb-0 site-logo"><span class="text-primary">Админ панель</span></h1>
            </div>
            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li><a href="{{route("admin")}}" class="nav-link">Главная</a></li>
                        <li class="has-children">
                            <a href="#about-section" class="nav-link">Списки</a>
                            <ul class="dropdown">
                                <li><a href="{{route("courses.show")}}" class="nav-link">Курсы</a></li>
                                <li><a href="{{route("lessens.show")}}" class="nav-link">Уроки</a></li>
                                <li><a href="{{route("tasks.show")}}" class="nav-link">Задания</a></li>
                                <li><a href="{{route("students.show")}}" class="nav-link">Ученики</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route("finaly_task.show")}}" class="nav-link">Решённый задачи</a></li>
                        <li><a href="{{route("index")}}" class="nav-link">Вид от пользователя</a></li>
                        <li><a href="{{route("register")}}" class="nav-link">Регистрация пользователя</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="container mt-3">
    @yield("content")
</div>

</body>
</html>
