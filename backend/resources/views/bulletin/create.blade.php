@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('気軽にプログラム掲示板') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    createです。
                    <!--_id、account_name、title、question、、question_id、registered_date(created_at)、respondant_name、answer、answer_date、resolved、-->
                    <form method="POST" action=" {{ route('bulletin.store') }} ">
                        @csrf
                        学習言語
                        <input type="text" name="language_type">
                        <br>
                        アカウント名
                        <input type="text" name="account_name">
                        <br>
                        つぶやきタイトル
                        <input type="text" name="title">
                        <br>
                        つぶやき内容
                        <input type="text" name="question">
                        <br>
                        <input class="btn btn-info" type="submit" value="投稿する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

