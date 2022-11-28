<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Lists;

class ToppageController extends Controller {
    public function show(){
        return view('top');
    }

    public function func(){

        date_default_timezone_set('Asia/Tokyo');
        $t = date('Y-m-d');
        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now.$week[date('w')];

        $sub_title = 'My Task';

        $lists = lists::select(
            'list_name',
            'list_details',
            lists::raw('(case status when 0 then "未" when 1 then "完" end) as status'),
            lists::raw('substring(start_ymd,12,5) as start_ymd'),
            lists::raw('substring(end_ymd,12,5) as end_ymd'),
            )->where(
                'end_ymd','>',$t
            )->orderby(
                'start_ymd'
            )->paginate(6);

        $row_count = count($lists);
        $data = [
            'lists' => $lists,
            'row_count' => $row_count,
            'today' => $today,
            'sub_title' => $sub_title
        ];
        return view('top',$data);
    }
}