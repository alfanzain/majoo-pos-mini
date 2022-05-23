<x-app-layout :libs="['nunito-font', 'jquery', 'sweetalert']">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div id="box-data-product" class="p-6 bg-white border-b border-gray-200">
                        <table id="table-data-product" class="table-auto w-full border-collapse border border-slate-400">
                            <thead>
                                <tr>
                                    <th class="border border-slate-300 py-2">ID</th>
                                    <th class="border border-slate-300 py-2">Name</th>
                                    <th class="border border-slate-300 py-2">Description</th>
                                    <th class="border border-slate-300 py-2">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <div class="float-right flex mt-3">
                            <a href="#" id="prev" class="block bg-[#38bdf8] rounded-md px-3 py-3 text-white" onclick="getData(prevUrl)">Prev</a>
                            <a href="#" id="next" class="block bg-[#38bdf8] rounded-md px-3 py-3 ml-2 text-white" onclick="getData(nextUrl)">Next</a>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @push('scripts')
        <script>
        function getData(url = null) {
            $.get(null === url ? "api/v1/products" : url)
                .done(function(response) {
                    let productRow = $('#table-data-product').find('tbody')

                    productRow.empty()

                    for (let product of response.data) {
                        productRow.append(`<tr><td class="border border-slate-300 py-2 px-2">${product.id}</td>
                            <td class="border border-slate-300 py-2 px-2">${product.name}</td>
                            <td class="border border-slate-300 py-2 px-2">${product.description}</td>
                            <td class="border border-slate-300 py-2 px-2">${product.category_name}</td></tr>`)
                    }

                    prevUrl = response.prev_page_url
                    nextUrl = response.next_page_url

                    if (null === prevUrl)
                        $('#box-data-product #prev').hide()
                    else
                        $('#box-data-product #prev').show()

                    if (null === nextUrl)
                        $('#box-data-product #next').hide()
                    else
                        $('#box-data-product #next').show()
                })
        }
        </script>
        <script>
        $(function() {

            var prevUrl = null, nextUrl = null;

            getData()
        })
        </script>
    @endpush

</x-app-layout>
