<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lists;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * ユーザ情報
     */
    private $loginUser = [];

    /**
     * 本日の日付
     */
    private $today = null;

    /**
     * コンストラクタ
     * 
     * @return void
     */
    public function __construct() {
        // 未ログインの場合、ログイン画面へ返す
        if (!session()->has('user_info')) {
            Redirect::to(url('/login'))->send();
        }
        $this->loginUser = session('user_info');
        date_default_timezone_set('Asia/Tokyo');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $this->today = date('Y年m月d日'). $week[date('w')];
    }

    /**
     * タスク追加画面
     * 
     * @return void
     */
    public function add() {
        return view('top', [
            'sub_title' => 'タスクの追加',
            'start_date' => date('Y-m-d'). "T". date('H:i'),
            'today' => $this->today
        ]);
    }

    /**
     * タスク編集画面
     * 
     * @param int id タスクid
     * @return void
     */
    public function detail($id) {
        // タスクidが設定されていない場合、エラーを返す
        if (empty($id)) {
            abort(403);
        }
        $list = lists::select(
            'id',
            'list_name',
            'list_details',
            'status',
            lists::raw('replace(substring(start_ymd,1,16)," ", "T") as start_ymd'),
            lists::raw('replace(substring(end_ymd,1,16)," ","T") as end_ymd')
        )
        ->where(
            'id', $id
        )
        ->first();
        // タスクidに紐づくタスクが存在しない場合、エラーを返す
        if (empty($list)) {
            abort(403);
        }
        $data = [
            'list' => $list,
            'sub_title' => 'タスクの編集',
            'today' => $this->today
        ];
        return view('top',$data);
    }

    /**
     * タスク追加入力確認画面
     * 
     * @param $request
     * @return void
     */
    public function confirm(Request $request) {
        // 入力値のバリデーションチェック
        $validatedDate = $request->validate([
            'list_name' => 'required|unique:lists',
            'list_details' => 'required',
            'start_ymd' => 'required',
            'end_ymd' => 'required|after:start_ymd',
        ]);
        return view('top', [
            'sub_title' => '追加タスク確認',
            'today' => $this->today,
            'post_data' => $request
        ]);
    }

    /**
     * 処理完了画面
     * 
     * @param Request $request
     * @return void
     */
    public function registration(Request $request) {
        // 処理のタイプを判断する
        foreach($_POST as $key => $value) {
            if($value == "更新" || $value == "削除" || $value == "完了" || $value == "登録" || $value == "今日のタスクに追加") {
                $type = $key;
                break;
            }
        }
        // 削除、更新（完了）以外の場合、バリデーションチェックする
        if ($type !== 'delete' && $type !== 'complate') {
            $postData = $request->validate([
                'list_name' => 'bail|required|max:25',
                'list_details' => 'bail|required|max:150',
                'start_ymd' => 'bail|required|after:now',
                'end_ymd' => 'bail|required|after:now|after:start_ymd',
            ]);
        }
        // 登録・更新処理を行い、メッセージを返す
        $msg = $this->{$type}($request);
        return view('top', [
            'msg' => $msg,
            'sub_title' => 'タスク登録完了',
            'today' => $this->today
        ]);
    }

    /**
     * 登録処理
     * 
     * @param array $postData
     * @return string message
     */
    private function regist($postData) {
        lists::insert([
            'user_id' => $this->loginUser->id,
            'list_name' => $postData->list_name,
            'list_details' => $postData->list_details,
            'status' => 0,
            'start_ymd' => $postData->start_ymd,
            'end_ymd' => $postData->end_ymd,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return 'タスクの登録完了しました。';
    }

    /**
     * 更新処理
     * 
     * @param array $postData
     * @return string message
     */
    private function update($postData) {
        lists::where(
            'id', $postData->id
        )
        ->update([
            'list_details' => $postData->list_details,
            'start_ymd' => $postData->start_ymd,
            'end_ymd' => $postData->end_ymd,
            'statys' => 0,
            'updated_at' => now()
        ]);
        return 'タスクを更新しました。';
    }

    /**
     * 更新（完了）処理
     * 
     * @param array $postData
     * @return string message
     */
    private function complete($postData) {
        lists::where(
            'id', $postData->id
        )
        ->update([
            'status' => 1,
            'updated_at' => now()
        ]);
        return 'タスク完了！お疲れ様でした。';
    }

    /**
     * 削除処理
     * 
     * @param Request $deleteData
     * @return string message
     */
    private function delete($deleteData) {
        lists::where(
            'id', $deleteData->id
        )
        ->delete();
        return 'タスクを削除しました。';
    }
}
