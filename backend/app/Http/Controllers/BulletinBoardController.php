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
    public function index()
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
        $bulletinBoards = DB::table('bulletin_boards')
        ->select('id','language_type','account_name','title','question','question_id','created_at')
        ->get();
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

    public function show($id)
    {
        $bulletin = BulletinBoard::find($id);
        // return view('show')-> with('bulletin', $bulletin);
        return view('bulletin.show',compact('bulletin'));
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

}
