<div class="main_wrapper">
    <div class="main_margin">
        @include("parts.subTitle")
        <form action="/to_do_list/public/task_regist" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ $list->id }}">
            <div class="item_name">タスク名</div>
            <div class="input_text">
                <label class="ef">
                    <input type="text" name="list_name" value="{{$list->list_name}}" readonly>
                </label>
            </div>
            <div class="item_name">タスクの詳細</div>
            <div class="input_text">
                <label class="ef">
                    <textarea name="list_details" id="" cols="30" rows="1" value="{{$list->list_details}}">{{$list->list_details}}</textarea>
                </label>
            </div>
            <div class="item_name">期限</div>
            <div class="limit">
                <div class="input_text">
                    <label class="ef">
                        <input type="datetime-local" name="start_ymd" value="{{$list->start_ymd}}">
                    </label>
                </div>
                <div class="nami">〜</div>
                <div class="input_text">
                    <label class="ef">
                        <input type="datetime-local" name="end_ymd" value="{{$list->end_ymd}}">
                    </label>
                </div>
            </div>
            <div class="btn">
                <div class="return_button">
                    <a href="/to_do_list/public">戻る</a>
                </div>
                @if (Request::is('task_change/*'))
                <div class="delete_button">
                    <input type="submit" name="delete" value="削除">
                </div>
                <div class="confirm_button">
                    <input type="submit" name="update" value="更新">
                </div>
                <div class="complete_button">
                    <input type="submit" name="complete" value="完了">
                </div>
                @elseif (Request::is('history_details/*'))
                <div class="added_button">
                    <input type="submit" name="update" value="今日のタスクに追加"> 
                </div>
                @endif
            </div>
        </form>
    </div>
</div>