@extends('admin::layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Customer(s)</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Customer(s)</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="card">
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
    <i class="fas fa-eyes"></i>
    <!-- /.card-body -->
</div>


@endsection

@section('jsonpage')
<script>
    $(function() {
        $('#modal-default').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
        });

        $('#example1').DataTable({
            "ajax": "{{ route('admin.listcustomer', ['data' => 'json'] )}}",
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
                        return '<button type="button" class="btn btn-sm btn-danger" onclick="deleteCustomerAccount('+data+')"><i class="fas fa-trash"></i></button>'
                    }
                }
            ]
        });
    });

    function deleteCustomerAccount(id) {
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
                var url = "{{ route('admin.customer.delete', ':id') }}"
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
</script>
@endsection

