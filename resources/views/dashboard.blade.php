<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <div class="mas-w-7x1 mx-auto sm:px-6 lg-px-8">
                <x-form post :action="route('question.store')">
                    <x-textarea label="Question" name="question" />    
            </div>
            <div>
                    <x-btn.submit>Submit</x-btn.submit>
                    <x-btn.reset>Reset</x-btn.reset>
                </x-form>                         
            </div>
    </div>
</x-app-layout>
