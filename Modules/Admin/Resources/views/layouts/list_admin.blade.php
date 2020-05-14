@extends('admin::layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Admin(s)</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Admin(s)</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="card">
    <div class="card-header">
        <div class="btn-group">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                <i class="fas fa-plus"></i> Add Admin
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">
                                    #
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Email
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Mobile Phone
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                    Action(s)
                                </th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>



<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_admin" class="form-horizontal" role="form" novalidate="novalidate">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" required class="form-control" placeholder="Enter full name ...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" required class="form-control" placeholder="Enter user email ...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" required class="form-control" placeholder="Enter user password ...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mobile_phone" class="col-sm-3 col-form-label">Moblie Phone</label>
                        <div class="col-sm-9">
                            <input type="text" name="mobile_phone" required class="form-control" placeholder="Enter mobile phone number ...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="addAdminAccount()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-edit-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="modal_loading" class="overlay d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Edit Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="updateAdminAccount()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('jsonpage')
<script>
    $(function() {
        $('#modal-default').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
        });

        $('#example1').DataTable({
            "ajax": "{{ route('admin.listadmin', ['data' => 'json'] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'mobile_phone'
                },
                {
                    data: 'id',
                    render: (data) => {
                        return '<button type="button" onclick="editAdminAccount('+data+')" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-sm btn-danger" onclick="deleteAdminAccount('+data+')"><i class="fas fa-trash"></i></button>'
                    }
                }
            ]
        });
    });

    function addAdminAccount() { 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.add') }}",
            data: $('#form_admin').serialize(),
            type: "POST",
            success: (resp) => {
                Swal.fire(
                    'Successfully!',
                    'Your file has been saved.',
                    'success'
                )
                $('#modal-default').modal('hide')
                $('#example1').DataTable().ajax.reload();
            },
            error: (resp) => {
                console.log(resp)
            }
        })
    }

    function deleteAdminAccount(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                var url = "{{ route('admin.delete', ':id') }}"
                url = url.replace(":id", id)

                var deleteAjx = () => {
                    return $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: "DELETE",
                    })
                }

                deleteAjx().then((resp) => {
                    $('#example1').DataTable().ajax.reload();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )    
                }).fail((resp) => {
                    Swal.fire(
                        'Try Again ...',
                        'Oooppsss!! Something goes wrong.',
                        'error'
                    ) 
                })                
            }
        })
    }

    function editAdminAccount(id) {
        $('#modal-edit-form').modal('show')
        var url = "{{ route('admin.edit', ':id') }}"
        url = url.replace(":id", id)
        $.ajax({
            url: url,
            type: "GET",
            success: (resp) => {
                $('#modal_body').html(resp)
                $('#modal_loading').attr('style', 'display: none !important')
            },
            error: (resp) => {                
                Swal.fire(
                    'Try Again ...',
                    'Oooppsss!! Something goes wrong.',
                    'error'
                )
                $('#modal-edit-form').css('display','none')
            }
        })
    }

    function updateAdminAccount() {
        var id = $('form > input[name=user_id]').val()
        var url = "{{ route('admin.update', ':id') }}"
        url = url.replace(":id", id)

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: $('#edit_form_admin').serialize(),
            type: "POST",
            success: (resp) => {
                Swal.fire(
                    'Successfully!',
                    'Your file has been updated.',
                    'success'
                )
                $('#modal-edit-form').modal('hide')
                $('#example1').DataTable().ajax.reload();
            },
            error: (resp) => {
                console.log(resp)
            }
        })
    }
</script>
@endsection

