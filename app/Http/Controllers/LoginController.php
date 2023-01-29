<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller {
    /**
     * ログイン画面
     */
    public function index() {
        return view('login');
    }

    /**
     * 新規登録画面
     */
    public function signUp() {
        return view('sign_up');
    }

    /**
     * ログイン機能
     * 
     * @param $request
     * @return void
     */
    public function login(Request $request) {
        if ($request->isMethod('post')) {
            // パラメータのバリデーションチェック
            $userInfo = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
            // パラメータを用いて、Userテーブルを確認
            $loginUser = User::where([
                ['email', $request->input('email')],
                ['password', $request->input('password')]
            ])
            ->first();
            if (empty($loginUser)) {
                // Userテーブルにアカウントが存在しない場合、ログイン画面を再描画
                return view('login', ['loginError' => 1]);
            }
            // ユーザ情報をセッションに登録
            $request->session()->put('user_info', $loginUser);
            return redirect(url('/'));
        }
    }

    /**
     * 新規登録機能
     * 
     * @param $request
     * @return void
     */
    public function register(Request $request) {
        if ($request->isMethod('post')) {
            // パラメータのバリデーションチェック
            $parameters = $request->validate([
                'name' => 'bail|required|unique:users,name|between:5,20',
                'email' => 'bail|required|email|unique:users,email|max:100',
                'password' => 'bail|required|between:8,15|confirmed',
                'password_confirmation' => 'required|between:8,15'
            ]);
            // Userテーブルに登録
            User::insert([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            // ユーザ情報をセッションに登録
            $request->session()->put('user_info.user_name', $request->input('name'));
            return redirect(url('/'));
        }
    }

    /**
     * ログアウト機能
     */
    public function logout() {
        // セッションを削除
        session()->flush();
        // ログイン画面に遷移
        return redirect(url('/login'));
    }
}