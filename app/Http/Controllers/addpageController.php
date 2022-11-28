<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lists;

class addpageController extends Controller
{
    //task_add
    public function show(){
        date_default_timezone_set('Asia/Tokyo');
        $start_day = date('Y-m-d');
        $start_time = date('H:i');
        $start_date = $start_day."T".$start_time;

        $sub_title = 'タスクの追加';

        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now.$week[date('w')];

        $add_data = [
            'start_date' => $start_date,
            'sub_title' => $sub_title,
            'today' => $today
        ];

        return view('top',$add_data);
    }

    // change tasks
    public function func(Request $request){
        foreach($_POST as $key => $value){
            if($value=="詳細"){
                $details = $key;
            }
        }

        $sub_title = 'タスクの編集';

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

        $data = [
            'lists' => $lists,
            'sub_title' => $sub_title,
            'today' => $today
        ];
        return view('top',$data);
    }

    //task_confirm
    public function form(Request $request){

        $validatedDate = $request->validate([
            'list_name' => 'required|unique:lists',
            'list_details' => 'required',
            'start_ymd' => 'required',
            'end_ymd' => 'required|after:start_ymd',
        ]);

        $sub_title = '追加タスク確認';

        date_default_timezone_set('Asia/Tokyo');
        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now.$week[date('w')];

        $form_data = array(
            'list_name' => $request->input('list_name'),
            'list_details' => $request->input('list_details'),
            'start_ymd' => $request->input('start_ymd'),
            'end_ymd' => $request->input('end_ymd')
        );

        $confirm_data = [
            'sub_title' => $sub_title,
            'today' => $today
        ];

        return view('top',$confirm_data,$form_data);
    }

    //task_regist
    public function registration(Request $request){

        foreach($_POST as $key => $value){
            if($value=="更新" || $value=="削除" || $value=="完了" || $value=="今日のタスクに追加"){
                $regist = $key;
            }else{
                $regist = null;
            }
        }

        $sub_title = 'タスク登録完了';

        date_default_timezone_set('Asia/Tokyo');
        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now.$week[date('w')];
        $upd_end_ymd = date('Y-m-d H:i',strtotime('+1 hour'));

        //update tasks
        if($regist=='update'){

            $updlists = lists::where(
                'list_name',$request->input('list_name')
                )->update([
                    'list_details' => $request->input('list_details'),
                    'start_ymd' => $request->input('start_ymd'),
                    'end_ymd' => $request->input('end_ymd'),
                    'updated_at' => now()
                ]);
            
            $msg = 'タスクを更新しました。';
        
        //add today's tasks
        }elseif($regist=='today_add'){
            $updlists = lists::where(
                'list_name',$request->input('list_name')
                )->update([
                    'status' => 0,
                    'start_ymd' => now(),
                    'end_ymd' => $upd_end_ymd,
                    'updated_at' => now()
                ]);

                $msg = '本日のタスクに追加しました。';
        
        //complete task
        }elseif($regist=='complete'){
            $completelists = lists::where(
                'list_name',$request->input('list_name')
            )->update(
                ['status' => 1],
                ['update_at' => now()]
            );

            $msg = 'タスク完了！お疲れ様でした。';

        //delte tasks
        }elseif($regist=='delete'){
            $dellists = lists::where(
                'list_name',$request->input('list_name')
            )->delete();

            $msg = 'タスクを削除しました。';

        //insert tasks
        }else{
            $lists = new lists();
            $lists->list_name = $request->input('list_name');
            $lists->list_details = $request->input('list_details');
            $lists->status = 0;
            $lists->start_ymd = $request->input('start_ymd');
            $lists->end_ymd = $request->input('end_ymd');
            $lists->save();

            $msg = 'タスクの登録完了しました。';

            //var_dump($lists);
            //exit;
            //$lists->fill($request->all())->save();
        }

        $regist_data = [
            'msg' => $msg,
            'sub_title' => $sub_title,
            'today' => $today
        ];

        return view('top',$regist_data);


    }
}
