<div class="main_wrapper">
    <div class="main_margin">
        @include("parts.subTitle")
        <form action="/to_do_list/public/task_confirm" method="POST">
        @csrf
            <div class="item_name">タスク名</div>
            <div class="input_text">
                <label class="ef">
                    <input type="text" name="list_name">
                </label>
                @if ($errors->has('list_name'))
                    <div>{{$errors->first('list_name')}}</div>
                @endif
            </div>
            <div class="item_name">タスクの詳細</div>
            <div class="input_text">
                <label class="ef">
                    <textarea name="list_details" id="" cols="30" rows="1"></textarea>
                </label>
                @if ($errors->has('list_details'))
                    <div>{{$errors->first('list_details')}}</div>
                @endif
            </div>
            <div class="item_name">期限</div>
            <div class="limit">
                <div class="input_text">
                    <label class="ef">
                        <input type="datetime-local" name="start_ymd" min="{{$start_date}}">
                    </label>
                    @if ($errors->has('start_ymd'))
                        <div>{{$errors->first('start_ymd')}}</div>
                    @endif
                </div>
                <div class="nami">〜</div>
                <div class="input_text">
                    <label class="ef">
                        <input type="datetime-local" name="end_ymd" min="{{$start_date}}">
                    </label>
                    @if ($errors->has('end_ymd'))
                        <div>{{$errors->first('end_ymd')}}</div>
                    @endif
                </div>
            </div>
            <div class="btn">
                <div class="return_button">
                    <a href="/to_do_list/public">戻る</a>
                </div>
                <div class="added_button">
                    <a href="/to_do_list/public/task_history">過去のタスク参照</a>
                </div>
                <div class="confirm_button">
                    <input type="submit" value="確認">
                </div>
            </div>
        </form>
    </div>
</div>