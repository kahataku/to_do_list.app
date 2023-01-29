<div class="main_wrapper">
    <div class="main_margin">
        @include("parts.subTitle")
        <div class="item_flex">
            <div class="title_design  margin_r">
                <div class="sub_title2">本日の達成状況</div>
                <div class="achieve_item">
                    <div class="raito">{{ $raito }}<span class="parsent">%</span></div>
                    <div class="raito_details">
                        <div class="sub_details">
                            <div>達成数</div>
                            <div class="item_count">{{ $today_task_achieve }}<span>個</span></div>
                        </div>
                        <div class="sub_details">
                            <div>総数</div>
                            <div class="item_count">{{ $today_task_count }}<span>個</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title_design margin_l">
                <div class="sub_title2">今週の達成状況</div>
                <div class="achieve_item">
                    <div class="raito">{{ $week_raito }}<span class="parsent">%</span></div>
                    <div class="raito_details">
                        <div class="sub_details">
                            <div>達成数</div>
                            <div class="item_count">{{ $week_task_achieve }}<span>個</span></div>
                        </div>
                        <div class="sub_details">
                            <div>総数</div>
                            <div class="item_count">{{ $week_task_count }}<span>個</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="return_button">
            <a href="/to_do_list/public">戻る</a>
        </div>
    </div>
</div>