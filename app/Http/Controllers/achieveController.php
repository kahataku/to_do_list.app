<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lists;
use Illuminate\Support\Facades\Redirect;

class achieveController extends Controller
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
     * 達成率画面
     * 
     * @return void
     */
    public function index() {
        // 先週の日付
        $lastweek = date('Y-m-d',strtotime('-7 day'));
        // 今日のタスク
        $todayTaskCount = lists::where(
            'end_ymd', '>=', now()
        )
        ->count();
        $todayTaskAchieve = lists::where([
            ['end_ymd', '>=', now()],
            ['status', 1]
        ])
        ->count();
        $raito = $todayTaskCount === 0 ? 0 : floor($todayTaskAchieve / $todayTaskCount * 100);
        // 今週のタスク
        $weekTaskCount = lists::whereBetween(
            'start_ymd', [$lastweek, now()]
        )
        ->count();
        $weekTaskAchieve = lists::where([
            ['status', 1],
            ['start_ymd', '<=', now()],
            ['start_ymd', '>=', $lastweek]
        ])
        ->count();
        $weekRaito = $weekTaskCount == 0 ? 0 : floor($weekTaskAchieve / $weekTaskCount * 100);
        return view('top', [
            'today_task_count' => $todayTaskCount,
            'today_task_achieve' => $todayTaskAchieve,
            'today' => $this->today,
            'sub_title' => '達成率',
            'raito' => $raito,
            'week_task_count' => $weekTaskCount,
            'week_task_achieve' => $weekTaskAchieve,
            'week_raito' => $weekRaito
        ]);
    }
}
