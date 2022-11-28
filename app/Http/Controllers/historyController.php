<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lists;

class historyController extends Controller
{
    public function show(){

        return view('top');
    }

    public function func(Request $request){

        
        date_default_timezone_set('Asia/Tokyo');
        $t = date('Y-m-d');

        $sub_title = 'タスク履歴';

        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now.$week[date('w')];

        $lists = lists::select(
            'list_name',
            'list_details',
            lists::raw('substring(start_ymd,1,10) as start_ymd'),
            lists::raw('substring(end_ymd,1,10) as end_ymd'),
            )->where(
                'start_ymd','<',$t
            )->orderby(
                'start_ymd'
            )->paginate(6);

        $row_count = count($lists);
        $data = [
            'lists' => $lists,
            'row_count' => $row_count,
            'sub_title' => $sub_title,
            'today' => $today
        ];
        return view('top',$data);
    }


    public function details(Request $request){
        foreach($_POST as $key => $value){
            if($value=="詳細"){
                $details = $key;
            }
        }

        $sub_title = 'タスク詳細';

        date_default_timezone_set('Asia/Tokyo');
        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now.$week[date('w')];

        $lists = lists::select(
            'list_name',
            'list_details',
            'status',
            lists::raw('replace(substring(start_ymd,1,16)," ", "T") as start_ymd'),
            lists::raw('replace(substring(end_ymd,1,16)," ","T") as end_ymd')
            )->where('list_name',$details
            )->get();

        $task = [
            'lists' => $lists,
            'sub_title' => $sub_title,
            'today' => $today
        ];
        return view('top',$task);
    }
}
