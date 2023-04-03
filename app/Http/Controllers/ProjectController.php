<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Project;
use Auth;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

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
        return view('form');
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


    public function downloadExcel()
    {
        // Excelファイルに出力するデータを取得する
        $data = $this->getDataForExcel();
        // $plan_title = $request->input('plan_title');
        // $plan_body = $request->input('plan_body');
        
        // Excelファイルを作成する
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($data);
        
        // $worksheet = $spreadsheet->getActiveSheet();
        // $worksheet->setCellValue('A1', 'プランタイトル');
        // $worksheet->setCellValue('B1', 'プラン本文');
        // $worksheet->setCellValue('A2', $plan_title);
        // $worksheet->setCellValue('B2', $plan_body);

        // Excelファイルをダウンロードする
        $writer = new Xlsx($spreadsheet);
        $filename = 'form_data.xlsx';
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend();
    }
    
    // //phpspreadsheetからデータを出力する
    public function export(Request $request)
    {
        $data = Project::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        
        // データを縦方向に書きだす方法
        //ヘッダーの設定
        $header = ['作成日', 'タイトル', 'プラン説明', 'プラン特徴（タイトル）', 'プラン特徴（本文）'];
        $sheet->fromArray($header, NULL, 'A1');

        // データの設定
        $rows = [];
        foreach($data as $item) {
            $rows[] = [$item->created_at, $item->plan_title, $item->plan_body, $item->plan_feature_title, $item->plan_feature_detail];
        }
        $sheet->fromArray($rows, NULL, 'A2');
        
        //データを横方向に書きだす方法
        // $data = ['ID', '名前', 'メールアドレス', '登録日時'];
        // $vertical = array_chunk($data, 1);
        // // 第一引数：書き込むデータ配列
        // // 第二引数：特定の値があったときに書き込みを拒否するか
        // // 第三引数：書き込みを開始するセルの場所(デフォルトは「A1」) // 第四引数：型を厳しく見るか否か(デフォルトは「false」)falseだと「0」を書き込んだ場合空白で表示される
        // $sheet->fromArray($vertical, NULL, 'B20', true);
        // $x = 3;
        
        // //fromArrayで指定したセルからデータをまとめて書き込むことができます。
        
        // foreach ($projects as $project) {
        // $y = 20;
        // $sheet->setCellValueByColumnAndRow($x, $y, $project->id);
        // $sheet->setCellValueByColumnAndRow($x, $y++, $project->plan_title);
        // $sheet->setCellValueByColumnAndRow($x, $y + 2, $project->plan_body);
        // $sheet->setCellValueByColumnAndRow($x, $y + 3, $project->created_at);
        // $x++;
        // }
        

        // ファイルの出力
        $writer = new Xlsx($spreadsheet);
        $filename = 'exported_data.xlsx';
        $writer->save($filename);

        // ファイルのダウンロード
        return response()->download($filename);
    }
}
