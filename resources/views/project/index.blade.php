<!-- 一覧表示 -->
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('企画一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">企画</th>
              </tr>
            </thead>
            
            <tbody>
              @foreach ($projects as $project)
              <tr class="hover:bg-gray-lighter">
                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                  <!-- 詳細画面へのリンク -->
                  <a href="{{ route('project.show',$project->id) }}">               
                  <!-- User名表示 -->
                    <p class="text-left text-gray-800 dark:text-gray-200">{{ __('作成者　：') }}{{$project->user->name}}</p>
                  <!-- 作成日時表示 -->
                    <p class="text-left text-gray-800 dark:text-gray-200">{{ __('作成日時：') }}{{$project->created_at}}</p>
                  <!-- タイトル表示 -->
                    <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">{{ __('タイトル：') }}{{ $project->plan_title}}</h3>
                  </a>
                  
                  <div class="flex">
                    <!-- 条件分岐でログインしているユーザが投稿したprojectのみ編集ボタンと削除ボタンが表示される -->
                    @if ($project->user_id === Auth::user()->id)
                    
                    <!-- 修正ボタン -->
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
                    
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>