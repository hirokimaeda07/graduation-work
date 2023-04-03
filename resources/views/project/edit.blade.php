<!-- 編集画面 -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Project') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          
          <form class="mb-6" action="{{ route('project.update',$project->id) }}" method="POST">
            @method('put')
            @csrf
            
            <!-- 
            新規構築画面のコードを引用する　/laratter/resources/views/project/create.blade.php
            3行目の　value=""　を修正する必要がある
            -->
            
            <div class="flex flex-col mb-4">
              <x-input-label for="plan_title" :value="__('プランタイトル')" />
              <x-text-input id="plan_title" class="block mt-1 w-full" type="text" name="plan_title" value="{{$project->plan_title}}" placeholder="75文字" required autofocus />
              <x-input-error :messages="$errors->get('plan_title')" class="mt-2" />
              <p class="mt-1 text-sm text-gray-500">参考情報を記載</p>
            </div>
            
            <div class="flex flex-col mb-4">
              <x-input-label for="plan_body" :value="__('プラン説明')" />
              <textarea id="plan_body" rows="4" type="text" name="plan_body"  placeholder="1250文字" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autofocus>{{$project->plan_body}}</textarea>
              <x-input-error :messages="$errors->get('plan_body')" class="mt-2" />
              <p class="mt-1 text-sm text-gray-500">参考情報を記載</p>
            </div>
          
            
            <div class="flex flex-col mb-4">　
              <x-input-label for="plan_feature_title" :value="__('プラン特徴(タイトル)')" />
              <x-text-input id="plan_feature_title" class="block mt-1 w-full" type="text" name="plan_feature_title" value="{{$project->plan_feature_title}}" placeholder="75文字" required autofocus />
              <x-input-error :messages="$errors->get('plan_feature_title')" class="mt-2" />
              <p class="mt-1 text-sm text-gray-500">参考情報を記載</p>
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="plan_feature_detail" :value="__('プラン特徴（本文）')" />
              <textarea id="plan_feature_detail" rows="4" type="text" name="plan_feature_detail" placeholder="500文字" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autofocus>{{$project->plan_feature_detail}}</textarea>
              <x-input-error :messages="$errors->get('plan_feature_detail')" class="mt-2" />
              <p class="mt-1 text-sm text-gray-500">参考情報を記載</p>
            </div>
            
            
            
            
          
            
            <!--　下記ボタン類　-->
            <div class="flex items-center justify-end mt-4">
              
              <a href="{{ url()->previous() }}">
                <x-secondary-button class="ml-3">
                  {{ __('Back') }}
                </x-primary-button>
              </a>
              
              <x-primary-button class="ml-3">
                {{ __('Update') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>