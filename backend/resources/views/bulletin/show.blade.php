<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>一件表示画面</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
   <div class="card">
      <h4 class="card-header">
         {{ $bulletin -> title }}
      </h4>
      <div class="card-body">
         <div class="row">
            <h5 class="card-text col-2 mb-2">{{ $bulletin -> language_type}}</h5>
         </div>
         <p class="card-text">{{ $bulletin -> question}}</p>
         <p class="text-right mr-3">{{$bulletin -> account_name}} / {{ $bulletin -> question_id}}</p>
         <div class="row pt-2">
            <a href="/bulletin/edit/{{ $bulletin -> id }}" class="btn btn-primary col-1 ml-3 mr-2">編集する</a>
            <a href="/bulletin/delete/{{ $bulletin -> id }}" class="btn btn-danger col-1">削除する</a>
            <p class="col text-muted text-right mr-3">投稿日 {{$bulletin -> created_at}}</p>
         </div>
      </div>
   </div>
   <div>
      <a href="/bulletin" class="ml-1">back</a>
   </div>
</div>
</body>
</html>