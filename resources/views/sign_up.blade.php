<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" integrity="sha384-l4UPAMHGzl7zwogLW4nOwaU2XTk6oiM1jhCRQstZEndoIiA2I5bg6fST3wzBSRBD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>新規登録</title>
</head>
<body>
    <main class="w-100 vh-100 position-relative">
        <div class="form-wrapper mx-auto position-absolute top-50 start-50 translate-middle bg-white">
            <div class="sign-up-back position-relative">
                <a href="{{ url('login') }}" class="position-absolute"><i class="bi bi-arrow-left"></i></a>
                <h1 class="text-center mb-3">新規登録</h1>
            </div>
            <form method="POST" action="{{url('sign_up')}}" class="p-2">
                @csrf
                <label class="form-label">アカウント名</label>
                <input type="text" name="name" class="form-control">
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
                <label class="form-label mt-3">メールアドレス</label>
                <input type="email" name="email" class="form-control">
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
                <label class="form-label mt-3">パスワード</label>
                <input type="password" name="password" class="form-control">
                @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
                <label class="form-label mt-3">確認用パスワード</label>
                <input type="password" name="password_confirmation" class="form-control">
                @if ($errors->has('password_confirmation'))
                    <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                @endif
                <div class="text-center my-3">
                    <button type="submit" class="btn btn-primary mx-auto">新規登録</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>