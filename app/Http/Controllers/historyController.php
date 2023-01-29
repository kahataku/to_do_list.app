<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lists;
use Illuminate\Support\Facades\Redirect;

class historyController extends Controller
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
     * タスク履歴一覧画面
     */
    public function index(Request $request){
        $lists = lists::select(
            'id',
            'list_name',
            'list_details',
            lists::raw('substring(start_ymd,1,10) as start_ymd'),
            lists::raw('substring(end_ymd,1,10) as end_ymd'),
        )
        ->where([
            ['user_id', '=', $this->loginUser->id],
            ['start_ymd', '<', date('Y-m-d')]
        ])
        ->orderby(
            'start_ymd'
        )
        ->paginate(6);
        return view('top', [
            'lists' => $lists,
            'row_count' => count($lists),
            'sub_title' => 'タスク履歴',
            'today' => $this->today
        ]);
    }
}
