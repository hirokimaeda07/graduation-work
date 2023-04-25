<!-- project 新規作成画面  -->
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('お申込みフォーム') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          
         
          <form class="mb-6" action="{{ route('form') }}" method="POST">
            @csrf　<!-- @csrfはセキュリティ対策．フォームからデータを送信するときには必ず記述 -->
            
            
            <p>注意：本メールフォームは実際に送信されますので、ご自身のメールアドレスを記載してください。</p></br>
            
            <!-- 会社名 -->
            <div class="flex flex-col mb-4">
              <x-input-label for="company" :value="__('会社名：必須')" />
              <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" placeholder="" required autofocus />
              <x-input-error :messages="$errors->get('company')" class="mt-2" />
              <!-- <p class="mt-1 text-sm text-gray-500">参考情報を記載</p> -->
            </div>
            
            <!-- お名前 -->
            <div class="flex flex-col mb-4">
              <x-input-label for="name" :value="__('お名前：必須')" />
              <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="漢字" required autofocus />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
              <!-- <p class="mt-1 text-sm text-gray-500">参考情報を記載</p> -->
            </div>
            
            <!-- フリガナ -->
            <div class="flex flex-col mb-4">
              <x-input-label for="name_kana" :value="__('フリガナ：必須')" />
              <x-text-input id="name_kana" class="block mt-1 w-full" type="text" name="name_kana" :value="old('name_kana')" placeholder="フリガナ" required autofocus />
              <x-input-error :messages="$errors->get('name_kana')" class="mt-2" />
              <!-- <p class="mt-1 text-sm text-gray-500">参考情報を記載</p> -->
            </div>
            
            <!-- 電話番号 -->
            <div class="flex flex-col mb-4">
              <x-input-label for="phone" :value="__('電話番号：必須')" />
              <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" placeholder="○○○-○○○〇-〇〇〇〇" required autofocus />
              <x-input-error :messages="$errors->get('phone')" class="mt-2" />
              <!-- <p class="mt-1 text-sm text-gray-500">参考情報を記載</p> -->
            </div>
            
            <!-- メールアドレス -->
            <div class="flex flex-col mb-4">
              <x-input-label for="email_my" :value="__('メールアドレス：必須')" />
              <x-text-input id="email_my" class="block mt-1 w-full" type="email" name="email_my" :value="old('email_my')" placeholder="" required autofocus />
              <x-input-error :messages="$errors->get('email_my')" class="mt-2" />
              <p class="mt-1 text-sm text-gray-500">返信が来て確認できるアドレスを記載してください</p>
            </div>

            <!-- 問合せ -->
            <div class="flex flex-col mb-4">
              <x-input-label for="body" :value="__('お申込内容：必須')" />
              <textarea id="body" rows="4" type="text" name="body" placeholder="掲載申込の依頼となります。ご対応をお願いいたします。" :value="old('body')" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autofocus></textarea>
              <x-input-error :messages="$errors->get('body')" class="mt-2" />
              <p class="mt-1 text-sm text-gray-500">掲載申込であることを記載してください</p>
            </div>
            <br>
            
            <p>掲載申込をしたい会社を選択してください。選択をした先だけに連絡が行きます。</p></br>
            
            <!-- OTA選択 -->
              <div class="flex flex-col mb-4">
                <x-input-label for="no1-checkbox" :value="__('NO1社に申し込む')" />
                  <input id="no1-checkbox" type="checkbox" value="1" name="no1-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
              </div>
                  
              <div class="flex flex-col mb-4">
                <x-input-label for="no2-checkbox" :value="__('NO2社に申し込む')" />
                  <input id="no2-checkbox" type="checkbox" value="1" name="no2-checkbox"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
              </div>
                  
              <x-input-error :messages="$errors->get('checkbox')" class="mt-2" />
              <p class="mt-1 text-sm text-gray-500">掲載申込をしたい会社を選択してください</p>
          



            
            <!-- クリエイトボタン  -->
            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-3">
                {{ __('送信') }}
              </x-primary-button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
  
</x-app-layout>