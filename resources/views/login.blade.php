<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>ログイン</title>
</head>
<body>
    <main class="w-100 vh-100 position-relative">
        <div class="form-wrapper mx-auto position-absolute top-50 start-50 translate-middle">
            <h1 class="text-center mb-3">to do list</h1>
            @if ($errors->any() || isset($loginError))
                <div class="text-danger text-center">メールアドレスまたはパスワードが間違っています</div>
            @endif
            <form method="POST" action="{{url('login')}}" class="p-2">
                @csrf
                <label class="form-label">メールアドレス</label>
                <input type="email" name="email" class="form-control">
                <label class="form-label mt-3">パスワード</label>
                <input type="password" name="password" class="form-control">
                <div class="text-center my-4">
                    <button type="submit" class="btn btn-primary mx-auto">ログイン</button>
                </div>
            </form>
            <p class="text-end">
                新規登録の場合<a href="{{ url('sign_up') }}" class="text-decoration-none">こちら</a>をクリック
            </p>
        </div>
    </main>
</body>
</html>