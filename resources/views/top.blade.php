<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>to do list app</title>
        <meta name="description" content="to do listのアプリです。">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/header_style.css')}}">
        <link rel="stylesheet" href="{{asset('css/footer_style.css')}}">
        <link rel="stylesheet" href="{{asset('css/main_style.css')}}">
        <link rel="stylesheet" href="{{asset('css/form_style.css')}}">
        <link rel="stylesheet" href="{{asset('css/sidebar_style.css')}}">
        <link rel="stylesheet" href="{{asset('css/breadcrumbs_style.css')}}">
        <link rel="stylesheet" href="{{asset('css/achieve_style.css')}}">
    </head>
    <body>
        @include("parts.header")
        <main>
            <div class="main_div">
                @include("parts.sidebar")
                @if(Request::is('task_add'))
                    @include("parts.add")
                @elseif(Request::is('task_confirm'))
                    @include("parts.confirm")
                @elseif(Request::is('task_change/*') || Request::is('history_details/*'))
                    @include("parts.task_detail")
                @elseif(Request::is('task_regist'))
                    @include("parts.regist")
                @elseif(Request::is('task_history'))
                    @include("parts.history")
                @elseif(Request::is('task_achieve'))
                    @include("parts.achieve")
                @else
                    @include("parts.main")
                @endif
            </div>
        </main>
        @include("parts.footer")
    </body>
</html>