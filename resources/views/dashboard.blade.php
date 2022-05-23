<x-app-layout :libs="['nunito-font', 'sweetalert']">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
            <div class="max-w-7xl flex flex-auto mx-auto sm:px-6 lg:px-8 py-2">
                <div class="w-1/2 mr-1.5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            Transaction <br />
                            Selling: 0 <br />
                            Buying: 0
                        </div>
                    </div>
                </div>
                <div class="w-1/2 ml-1.5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            Transaction <br />
                            Selling: 0 <br />
                            Buying: 0
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

</x-app-layout>
