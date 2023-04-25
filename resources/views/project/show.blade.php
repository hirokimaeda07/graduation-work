<!-- 
resources/views/tweet/show.blade.php 
プロジェクト詳細画面

-->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Project Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
          <div class="mb-6">
            

           
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">タイトル</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="plan_title">
                {{$project->plan_title}}
              </p>
            </div>
            
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">プラン説明</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="plan_body">
                {{$project->plan_body}}
              </p>
            </div>
          
            
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">プラン特徴（タイトル）</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="plan_feature_title">
                {{$project->plan_feature_title}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">プラン特徴（本文）</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="plan_feature_detail">
                {{$project->plan_feature_detail}}
              </p>
            </div>
            
            
            
            <!--  下記ボタン類　-->
            <div class="flex">
            <!-- 更新ボタン -->
                <form action="{{ route('project.edit',$project->id) }}" method="GET" class="text-left">
                  @csrf
                  <x-primary-button class="ml-3">
                    <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="gray">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </x-primary-button>
                </form>
                        
     
                <!-- 削除ボタン -->
                <form action="{{ route('project.destroy',$project->id) }}" method="POST" class="text-left">
                    @method('delete')
                    @csrf
                    <x-primary-button class="ml-3">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </x-primary-button>
                </form>
             </div>
             
            <!-- ボタン類 -->
            <div class="flex items-center justify-end mt-4">
              
              <!-- メール送付ボタン -->
              <a href="{{ route('form') }}">
                <x-secondary-button class="ml-3">
                  {{ __('OTAへデータ送付') }}
                </x-primary-button>
              </a>
              
              <!-- Excel出力ボタン -->
              <a href="{{ route('export') }}">
                <x-secondary-button class="ml-3">
                  {{ __('Excel出力') }}
                </x-primary-button>
              </a>
              <!-- バックボタン -->
              <a href="{{ url()->previous() }}">
                <x-secondary-button class="ml-3">
                  {{ __('Back') }}
                </x-primary-button>
              </a>
              
              <!--参考：エクセル出力のコード
              <a href="{{ route('export') }}">Excel出力</a>
              -->

            </div>
            
            <!-- 送信完了メッセージを表示 -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
             
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>