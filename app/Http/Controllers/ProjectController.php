<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Project;
use Auth;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::getAllOrderByUpdated_at();
        return response()->view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'plan_title' => 'required | max:75',
            'plan_body' => 'required | max:1250',
            'plan_feature_title' => 'required | max:75',
            'plan_feature_detail' => 'required | max:500',
            // 'images' => 'array|max:4', //画像枚数4枚まで
            // 'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            //'total_required_time' => 'required',
        ]);
        
        // バリデーション:エラー
        if ($validator->fails()) {
        return redirect()
          ->route('project.create')
          ->withInput()
          ->withErrors($validator);
      }
        // 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
      
      // create()は最初から用意されている関数
      // 戻り値は挿入されたレコードの情報
      $result = Project::create($request->all());
     

      
      // ルーティング「project.index」にリクエスト送信（project一覧ページに移動）
      return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return response()->view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $project = Project::find($id);
        return response()->view('project.edit', compact('project'));
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
          //バリデーション　上部記載のpublic function store　と同じ項目を記載する　
          $validator = Validator::make($request->all(), [
            'plan_title' => 'required | max:75',
            'plan_body' => 'required | max:1250',
            'plan_feature_title' => 'required | max:75',
            'plan_feature_detail' => 'required | max:500',
            // 'images' => 'array|max:4', //画像枚数4枚まで
            // 'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
          ]);
          //バリデーション:エラー
          if ($validator->fails()) {
            return redirect()
              ->route('project.edit', $id)
              ->withInput()
              ->withErrors($validator);
          }
          //データ更新処理
          $result = Project::find($id)->update($request->all());
          return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $result = Project::find($id)->delete();
      return redirect()->route('project.index');
    }
    
    
     public function mydata()
      {
        // Userモデルに定義したリレーションを使用してデータを取得する．
        $projects = User::query()
          ->find(Auth::user()->id)
          ->userProjects()
          ->orderBy('created_at','desc')
          ->get();
        return response()->view('project.index', compact('projects'));
      }
    
    //画像アップロード
    // public function upload(Request $request)
    // {
    //     // ディレクトリ名
    //     $dir = 'project_image';

    //     // sampleディレクトリに画像を保存
    //     $request->file('image')->store('public/' . $dir);

    //     return redirect('/');
    // }
    
    //画像アップロード
    // public function images(): array
    // {
    //     return $this->file('images', []);
    // }

    
}
