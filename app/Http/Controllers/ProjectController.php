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
use Illuminate\Support\Facades\Mail;
use App\Mail\ExcelAttachment;
use Illuminate\Mail\Mailable;

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
      // project.index ⇒　project.mypage　に変更
      return redirect()->route('project.mypage');
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
          // project.index（全てユーザー一覧を取得できる） ⇒　project.mypage（アクティブユーザー情報のみ取得）に変更
          return redirect()->route('project.mypage');
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
      // project.index（全てユーザー一覧） ⇒　project.mypage　に変更
      return redirect()->route('project.mypage');
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
    
    //phpspreadsheetからデータを出力する
    public function export(Request $request)
    {
        //$data = Project::all(); //全てのユーザーデータを取得する
        $user = Auth::user(); // 現在認証されているユーザーを取得する
        $data = $user->projects; // 現在認証されているユーザーが所有する Project モデルを取得する

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        
        // データを縦方向に書きだす方法.タイトルは横方向。
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
    
    // public function submit(Request $request)
    // {
    //     // バリデーション
    //     $request->validate([
    //         'plan_title' => 'required | max:75',
    //         'plan_body' => 'required | max:1250',
    //         'plan_feature_title' => 'required | max:75',
    //         'plan_feature_detail' => 'required | max:500',
            
    //     ]);
        
    //     $user = Auth::user(); // 現在認証されているユーザーを取得する
    //     $data = $user->projects; // 現在認証されているユーザーが所有する Project モデルを取得する
        
        
        
    // }
    
    //     public function sendEmail(Request $request)
    // {
    //     // メールアドレスを格納する配列を初期化
    //     $to = [];

    //     // リクエストから送信先のメールアドレスを取得
    //     if ($request->has('email_list')) {
    //         $to = $request->input('email_list');
    //     }

    //     // Excelファイルを作成して保存
    //      // Spreadsheetオブジェクトを作成
    //     $spreadsheet = new Spreadsheet();
        
    //     // シートの設定
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->setCellValue('A1', 'Hello World!');
        
    //     // Excelファイルを保存
    //     $writer = new Xlsx($spreadsheet);
        
    //     // ファイルの保存先パスを指定する
    //     $filePath = public_path('path/to/file.xlsx'); // publicディレクトリ以下に保存する場合
        
    //     // ディレクトリが存在しない場合は作成する
    //     if (!file_exists(dirname($filePath))) {
    //         mkdir(dirname($filePath), 0777, true);
    //     }
        
    //     // ファイルを保存する
    //     $writer->save($filePath);

    //     // ExcelAttachmentクラスのインスタンスを作成
    //     $mail = new ExcelAttachment($filePath);

    //     // 送信先のメールアドレスを設定
    //     $mail->to($to);

    //     // メールを送信
    //     Mail::send('project.show', $data, function($message) use ($to, $subject, $filePath) {
    //     $message->to($to)
    //         ->subject($subject)
    //         ->attach($filePath);
    //     });

    //     // 送信完了メッセージを表示
    //     return redirect()->back()->with('success', 'メールを送信しました。');
    // }
    
}
