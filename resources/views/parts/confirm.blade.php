<div class="main_wrapper">
    <div class="main_margin">
        @include("parts.subTitle")
        <form action="/to_do_list/public/task_regist" method="POST">
        @csrf
            <div class="item_name">タスク名</div>
            <div class="input_text">
                <label class="ef">
                    <input type="text" name="list_name" value="{{ $post_data->list_name }}" readonly>
                </label>
            </div>
            <div class="item_name">タスクの詳細</div>
            <div class="input_text">
                <label class="ef">
                    <textarea name="list_details" id="" cols="30" rows="1" value="{{ $post_data->list_details }}" readonly>{{ $post_data->list_details }}</textarea>
                </label>
            </div>
            <div class="item_name">期限</div>
            <div class="limit">
                <div class="input_text">
                    <label class="ef">
                        <input type="datetime-local" name="start_ymd" value="{{ $post_data->start_ymd }}" readonly>
                    </label>
                </div>
                <div class="nami">〜</div>
                <div class="input_text">
                    <label class="ef">
                        <input type="datetime-local" name="end_ymd" value="{{ $post_data->end_ymd }}" readonly>
                    </label>
                </div>
            </div>
            <div class="btn">
                <div class="return_button">
                    <a href="/to_do_list/public/task_add" name="back" type="submit" value="true">戻る</a>
                </div>
                <div class="confirm_button">
                    <input type="submit" name="regist" value="登録">
                </div>
            </div>
        </form>
    </div>
</div>