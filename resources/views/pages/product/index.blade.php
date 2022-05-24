<x-app-layout :libs="['nunito-font', 'jquery', 'sweetalert']">
    <x-slot name="header">
        {{ __('Product') }}
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Product List</strong>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-primary">Add Product</button>

                        <div id="box-data-product" class="p-3 bg-white border-b border-gray-200">
                            <table id="table-data-product" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
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
                    </table>

                </div>
            </div>
        </div>
    </x-slot>

    @push('scripts')
        <script>
        function getData(url = null) {
            let productRow = $('#table-data-product').find('tbody')

            productRow.empty()
            productRow.append('Loading')

            $.get(null === url ? "api/v1/products" : url)
                .done(function(response) {

                    productRow.empty()

                    for (let product of response.data.data) {
                        productRow.append(`<tr>
                            <td class="" style="width: 160px"><a href="#" class="btn btn-light">Edit</a> <a href="#" class="btn btn-danger" onclick="deleteData(${product.id})">Delete</a></td>
                            <td class="">${product.id}</td>
                            <td class="">${product.name}</td>
                            <td class="">${product.description}</td>
                            <td class="">${product.category_name}</td>
                        </tr>`)
                    }

                    prevUrl = response.data.prev_page_url
                    nextUrl = response.data.next_page_url

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

        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'api/v1/products/' + id,
                        type: 'DELETE'
                    }).done(function(response) {
                        getData()

                        console.log(response)

                        Swal.fire(
                            'Deleted!',
                            response.message,
                            response.status
                        )
                    })
                }
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
