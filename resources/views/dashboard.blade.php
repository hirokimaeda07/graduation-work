<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!--<div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>-->
            
            <!-- メインエリア -->
                <!-- project.create -->
                 <div class="p-6">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <x-responsive-nav-link :href="route('project.create')" :active="request()->routeIs('project.create')" class="underline text-gray-900 dark:text-white">
                            {{ __('体験サービスを企画する') }}
                            </x-responsive-nav-link>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            体験サービスの企画・計画をまとめる。作成後にはデータ保存できます。また、作成したデータをExcelデータ出力もできます。
                        </div>
                    </div>
                </div>
                
                <hr class="my-8 h-px border-0 bg-gray-300" />

                <!-- mypage -->
                 <div class="p-6">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <x-responsive-nav-link :href="route('project.mypage')" :active="request()->routeIs('project.mypage')" class="underline text-gray-900 dark:text-white">
                            {{ __('企画一覧') }}
                            </x-responsive-nav-link>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            企画を作成して保存されている企画一覧。修正、削除ができます。タイトルを選択すると、保存されている詳細データを表示できます。詳細データを表示後にExcelボタンを選択するとExcelデータが出力されます。
                        </div>
                    </div>
                </div>
                
            </div>            
        </div>
    </div>
</x-app-layout>
