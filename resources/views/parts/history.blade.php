<div class="main_wrapper">
    <div class="main_margin">
        @include("parts.subTitle")
        <table>
            <tr class="table_title">
                <th>No</th>
                <th>項目</th>
                <th>期限</th>
                <th>詳細</th>
            </tr>
            @foreach ($lists as $list)
                <tr class="table_tr">
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        <div class="list_name">{{$list->list_name}}</div>
                    </td>
                    <td>
                        <div>{{$list->start_ymd}}</div>
                    </td>
                    <td><a href="./history_details/{{ $list->id }}" class="btn">詳細</a></td>
                </tr>
            @endforeach
        </table>
        <div class="paging">{{$lists->links()}}</div>
        <div class="return_button">
            <a href="/to_do_list/public">戻る</a>
        </div>
    </div>
</div>