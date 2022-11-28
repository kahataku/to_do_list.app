<div class="sub_title">{{$sub_title}}</div>
<div class="today">{{$today}}</div>
<span>
    @if(Request::is('task_add'))
        {{Breadcrumbs::render('task_add')}}
    @elseif(Request::is('task_confirm'))
        {{Breadcrumbs::render('task_confirm')}}
    @elseif(Request::is('task_regist'))
        {{Breadcrumbs::render('task_regist')}}
    @elseif(Request::is('task_change'))
        {{Breadcrumbs::render('task_change')}}
    @elseif(Request::is('task_history'))
        {{Breadcrumbs::render('task_history')}}
    @elseif(Request::is('history_details'))
        {{Breadcrumbs::render('history_details')}}
    @elseif(Request::is('task_achieve'))
        {{Breadcrumbs::render('task_achieve')}}
    @else
        {{Breadcrumbs::render('home')}}
    @endif
</span>