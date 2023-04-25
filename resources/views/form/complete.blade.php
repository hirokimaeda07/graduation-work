<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('送信完了') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">{{ __('お申込みいただきありがとうございます!') }}</h3>
            <p class="mb-4">{{ __('各社の担当者が確認次第、登録されたメールアドレスにご連絡が来ますので、確認をお願いいたします。') }}</p>
            <a href="{{ route('dashboard') }}" class="bg-blue-500 text-gray font-bold py-2 px-4 rounded">{{ __('ダッシュボードに戻る') }}</a>
        </div>
    </div>
</div>
</x-app-layout>