<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Lists;
use Illuminate\Support\Facades\Redirect;

class ToppageController extends Controller {
    /**
     * ユーザ情報
     */
    private $loginUser = [];

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
    }

    /**
     * トップ画面表示
     * 
     * @return void
     */
    public function index() {
        // タイムゾーンを設定
        date_default_timezone_set('Asia/Tokyo');
        // 本日の日付
        $now = date('Y年m月d日');
        $week = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');
        $today = $now. $week[date('w')];
        // タスクを取得する
        $lists = lists::select(
            'id',
            'list_name',
            'list_details',
            lists::raw('(case status when 0 then "未" when 1 then "完" end) as status'),
            lists::raw('substring(start_ymd,12,5) as start_ymd'),
            lists::raw('substring(end_ymd,12,5) as end_ymd'),
        )
        ->where([
            ['user_id', '=', $this->loginUser->id],
            ['end_ymd', '>', date('Y-m-d')]
        ])
        ->orderby(
            'start_ymd'
        )
        ->paginate(6);
        return view(
            'top', [
                'lists' => $lists,
                'row_count' => count($lists),
                'today' => $today,
                'sub_title' => 'My Task'
            ]
        );
    }
}