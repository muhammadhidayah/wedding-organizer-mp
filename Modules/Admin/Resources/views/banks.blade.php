@extends('admin::layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Bank(s)</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Bank(s)</li>
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
                <i class="fas fa-plus"></i> Add Bank
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
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">#
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">
                                    Bank Code
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Bank Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">Action(s)</th>
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
                <h4 class="modal-title">Add Bank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_bank" class="form-horizontal" role="form" novalidate="novalidate">
                    <div class="form-group row">
                        <label for="bank_code" class="col-sm-3 col-form-label">Bank Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="bank_code" required class="form-control" placeholder="000">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" required name="bank_name" class="form-control" placeholder="Bank Central Asia">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="addBankAccount()" class="btn btn-primary">Save changes</button>
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
                <h4 class="modal-title">Edit Bank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="updateBankAccount()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('jsonpage')
<script>
    $(function () {
        $('#modal-default').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
        });

        $('#modal-default').on('show.bs.modal', function(){
            var form = $('#form_bank').validate()
            form.resetForm()
        });

        $('#modal-edit-form').on('show.bs.modal', function(){
            $('#modal_loading').show()
        });
        

        var listBankTbl = $('#example1').DataTable({
            "ajax": "{{ route('admin.bank', ['data' => 'json'] )}}",
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
                    data: 'bank_code'
                },
                {
                    data: 'bank_name'
                },
                {
                    data: 'id',
                    render: (data) => {
                        return '<button type="button" onclick="editBankAccount('+data+')" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-sm btn-danger" onclick="deleteBank('+data+')"><i class="fas fa-trash"></i></button>'
                    }
                }
            ]
        });

        $('#form_bank').validate({
            rules: {
                bank_name: {
                    required: true
                },
                bank_code: {
                    required: true
                }
            },
            messages: {
                bank_code: "Please enter a bank code",
                bank_name: "Plase enter a bank name"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.col-sm-9').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });


    });

    

    function addBankAccount() { 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.bank') }}",
            data: $('#form_bank').serialize(),
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

    function deleteBank(bank_id) {
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
                $('#example1').DataTable().ajax.reload();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }

    function editBankAccount(id) {
        $('#modal-edit-form').modal('show')
        var url = "{{ route('admin.bank.detail', ':id') }}"
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

    function updateBankAccount() {
        var id = $('form > input[name=id]').val()
        var url = "{{ route('admin.bank.edit', ':id') }}"
        url = url.replace(":id", id)

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: $('#edit_form_bank').serialize(),
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