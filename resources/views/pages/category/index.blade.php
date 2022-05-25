<x-app-layout :libs="['nunito-font', 'jquery', 'sweetalert']">
    <x-slot name="header">
        {{ __('Category') }}
    </x-slot>

    <x-slot name="content">
        {{-- Form --}}
        <div class="modal fade" id="formAddModal" tabindex="-1" aria-labelledby="formAddModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formAddModalLabel">Form Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-add-category">
                            <div class="row g-3 align-items-center">
                                <div>
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submitPost" class="btn btn-primary" onclick="postData()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formAddModalLabel">Form Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edit-category">
                            <div class="row g-3 align-items-center">
                                <div>
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submitPost" class="btn btn-primary" onclick="putData()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- List --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Category List</strong>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddModal">Add Category</button>

                        <div id="box-data-category" class="p-3 bg-white border-b border-gray-200">
                            <table id="table-data-category" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Name</th>
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
        function populate(frm, data) {
            $.each(data, function(key, value) {
                var ctrl = $('[name='+key+']', frm);
                switch(ctrl.prop("type")) {
                    case "radio": case "checkbox":
                        ctrl.each(function() {
                            if($(this).attr('value') == value) $(this).attr("checked",value);
                        });
                        break;
                    default:
                        ctrl.val(value);
                }
            });
        }

        function getData(url = null) {
            let categoryRow = $('#table-data-category').find('tbody')

            categoryRow.empty()
            categoryRow.append('Loading')

            $.get(null === url ? "api/v1/categories" : url)
                .done(function(response) {
                    categoryRow.empty()

                    categoryDataStore = response.data.data

                    for (let category of categoryDataStore) {
                        categoryRow.append(`<tr>
                            <td class="" style="width: 160px">
                                <a href="#" class="btn btn-light" onclick="editData(${category.id})">Edit</a> <a href="#" class="btn btn-danger" onclick="deleteData(${category.id})">Delete</a>
                            </td>
                            <td class="">${category.id}</td>
                            <td class="">${category.name}</td>
                        </tr>`)
                    }

                    prevUrl = response.data.prev_page_url
                    nextUrl = response.data.next_page_url

                    if (null === prevUrl)
                        $('#box-data-category #prev').hide()
                    else
                        $('#box-data-category #prev').show()

                    if (null === nextUrl)
                        $('#box-data-category #next').hide()
                    else
                        $('#box-data-category #next').show()
                })
        }

        function postData() {
            $.post("api/v1/categories", $("#form-add-category").serialize())
                .done(function(response) {
                    if (response.status == 'success') {
                        getData()

                        Swal.fire(
                            'Created!',
                            response.message,
                            response.status
                        )
                    }

                    if (response.status == 'error') {
                        getData()

                        Swal.fire(
                            'Oops!',
                            response.message,
                            response.status
                        )

                        return false
                    }

                    var modalEl = document.querySelector('#formAddModal')
                    var modal = bootstrap.Modal.getInstance(modalEl)
                    modal.hide()

                    $("#form-add-category").trigger('reset')
                })
        }

        function putData() {
            $.ajax({
                url: 'api/v1/categories/' + $("#form-edit-category").data("category_id"),
                data:  $("#form-edit-category").serialize(),
                type: 'PUT'
            }).done(function(response) {
                if (response.status == 'success') {
                    getData()

                    Swal.fire(
                        'Updated!',
                        response.message,
                        response.status
                    )
                }

                if (response.status == 'error') {
                    getData()

                    Swal.fire(
                        'Oops!',
                        response.message,
                        response.status
                    )

                    return false
                }

                var modalEl = document.querySelector('#formEditModal')
                var modal = bootstrap.Modal.getInstance(modalEl)
                modal.hide()

                $("#form-edit-category").trigger('reset')
            })
        }

        function editData(id) {
            var modalEl = document.querySelector('#formEditModal')
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl)
            modal.show()

            populate("#form-edit-category", categoryDataStore.filter((category) => category.id === id)[0])

            $("#form-edit-category").data("category_id", id)
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
                        url: 'api/v1/categories/' + id,
                        type: 'DELETE'
                    }).done(function(response) {
                        getData()

                        // console.log(response)

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
            var categoryDataStore = null
            var prevUrl = null, nextUrl = null

            getData()
        })
        </script>
    @endpush

</x-app-layout>
