@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('気軽にプログラム掲示板') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="GET" action="{{ route('bulletin.create') }}">
                        <!--ボタンのスタイル→https://getbootstrap.jp/docs/4.1/components/buttons/-->
                        <button type="submit" class="btn-primary">
                            新規登録 
                        </button>
                    </form>
                    <form method="GET" class="d-flex" action="{{ route('bulletin.index') }}">
                        <input class="form-control me-2" name="search" type="search" placeholder="検索" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>                    
                    <!--'id','account_name','title','question','question_id','created_at'-->
                    <!--スタイルについて→https://getbootstrap.jp/docs/4.1/content/tables/-->
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">言語</th>
                            <th scope="col">アカウント名</th>
                            <th scope="col">タイトル</th>
                            <th scope="col">詳細</th>
                            {{-- <th scope="col">投稿</th>
                            <th scope="col">投稿ID</th>
                            <th scope="col">投稿日時</th>                             --}}
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($bulletinBoards as $bulletin)
                          <tr>
                            <th>{{ $bulletin->id }}</th>
                            <td>{{ $bulletin->language_type }}</td>
                            <td>{{ $bulletin->account_name }}</td>
                            <td>{{ $bulletin->title }}</td>
                            {{-- 詳細を見るためにはidを指定する必要がある。
                            https://readouble.com/laravel/8.x/ja/routing.html(名前付きルートがパラメータを定義している場合) --}}
                            <td><a href="{{ route('bulletin.show',['id' => $bulletin->id ]) }}">詳細を見る</td>
                            <td></td>
                            {{-- <td>{{ $bulletin->question }}</td>
                            <td>{{ $bulletin->question_id }}</td>
                            <td>{{ $bulletin->created_at }}</td>                           --}}
                          </tr>                  
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
