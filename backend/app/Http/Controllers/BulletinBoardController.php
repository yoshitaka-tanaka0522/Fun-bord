<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinBoard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Exception;

class BulletinBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ------Eroquent(エロクワント)を使用する場合------------------------------
        // →https://readouble.com/laravel/8.x/ja/eloquent.html
        // items->attributesにtableのデータが入っている。
        //  $bulletinBoards = BulletinBoard::all();
        //今回は全データ持ってきたいわけではないので、クエリビルダを使用する
        //  dd($bulletinBoards);
        // ----------------------------------------------------------
        //------Facadesを使用する場合(クエリビルダ)------------------------------
        //use Illuminate\Support\Facades\DB;を追加
        $search = $request->input('search');
        //データの中身はdd()で見れる
        // dd($request);

        // $bulletinBoards = DB::table('bulletin_boards')
        // ->select('id','language_type','account_name','title','question','created_at')
        // ->orderBy('created_at','asc')
        // ->paginate(20);
        // return view('bulletin.index',compact('bulletinBoards'));

        //検索処理
        $query = DB::table('bulletin_boards');
        //検索キーワードがある場合
        if($search != null) {
            //全角スペースを半角にする
            $search_split = mb_convert_kana($search,'s');
            //空白で検索文字を区切る
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);
            foreach($search_split2 as $value) 
            {
              $query->where('question','like','%' .$value . '%');
            }
        }
        $query->select('id','language_type','account_name','title','question','created_at');
        $query->orderBy('created_at','asc');
        $bulletinBoards = $query->paginate(20);
        return view('bulletin.index',compact('bulletinBoards'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bulletin.create');
    }


    public function store(Request $request)
    {

        $bulletin = new BulletinBoard;
        $bulletin->language_type = $request->input('language_type');
        $bulletin->account_name = $request->input('account_name');
        $bulletin->title = $request->input('title');
        $bulletin->question = $request->input('question');
        $bulletin->save();
        return redirect('/bulletin');
    }

      public function show($id)
    {
        $bulletin = BulletinBoard::find($id);
        // return view('show')-> with('bulletin', $bulletin);
        $comments = $bulletin->comments()->get();
        return view('bulletin.show',compact('bulletin','comments'));
    }

    public function edit($id)
    {
        //editもshowの時同様に1件のデータがあればいい
        $bulletin = BulletinBoard::find($id);
        return view('bulletin.edit',compact('bulletin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //updateは1件のデータに対してstoreの時と同様の処理を行う。
        $bulletin = BulletinBoard::find($id);
        $bulletin->language_type = $request->input('language_type');
        $bulletin->account_name = $request->input('account_name');
        $bulletin->title = $request->input('title');
        $bulletin->question = $request->input('question');
        $bulletin->save();
        return redirect('/bulletin');
    }

    public function destroy($id)
    {
        //削除ボタンを押下した時に、データ１件分を取得する。
        $bulletin = BulletinBoard::find($id);
        $bulletin->delete();
        return redirect('/bulletin');
    }

}
