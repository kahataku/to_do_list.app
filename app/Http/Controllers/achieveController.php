<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lists;

class achieveController extends Controller
{
    public function show(){
        return view('top');
    }

    public function func(){

        date_default_timezone_set('Asia/Tokyo');
        //today
        $t = date('Y-m-d');
        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now.$week[date('w')];

        $sub_title = '達成率';

        //lastweek
        $yesterday = date('Y-m-d',strtotime('-1 day'));
        
        //lastweek
        $lastweek = date('Y-m-d',strtotime('-7 day'));

        //today tasks
        $lists = lists::where(
                'end_ymd','>=',$t
            )->count();
        
        $achieve = lists::where([
                ['end_ymd','>=',$t],
                ['status',1]
            ])->count();
        
        if($lists == 0){
            $raito = 0;
        }else{
            $raito = floor($achieve / $lists * 100);
        }

        //weeks tasks
        $weeklists =lists::whereBetween(
            'start_ymd',[$lastweek,$t]
        )->count();

        $weekachieve =lists::where([
            ['status',1],
            ['start_ymd','<=',$t],
            ['start_ymd','>=',$lastweek]
        ])->count();

        if($weeklists == 0){
            $weekraito = 0;
        }else{
            $weekraito = floor($weekachieve / $weeklists * 100);
        }


        $data = [
            'lists' => $lists,
            'achieve' => $achieve,
            'today' => $today,
            'sub_title' => $sub_title,
            'raito' => $raito,
            'weeklists' => $weeklists,
            'weekachieve' => $weekachieve,
            'weekraito' => $weekraito
        ];
        return view('top',$data);
    }
}
