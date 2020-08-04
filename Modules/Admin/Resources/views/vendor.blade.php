@extends('admin::layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Vendor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Vendor</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-item nav-link active" id="vendor-confirm-tab" data-toggle="tab" href="#nav-vendor-confirm" role="tab" aria-controls="vendor-confirm" aria-selected="true">Vendor Waitting Confirm</a>
                    </li>
                    <li>
                        <a class="nav-item nav-link" id="vendor-tab" data-toggle="tab" href="#nav-vendor" role="tab" aria-controls="vendor" aria-selected="false">Vendor</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="nav-vendor-confirm" role="tabpanel" aria-labelledby="vendor-confirm-tab">
                        <table id="tbl_vendor_confirm"  class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="tbl_vendor_confirm_info">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor</th>
                                    <th>Vendor Phone</th>
                                    <th>Account Number</th>
                                    <th>Bank</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-vendor" role="tabpanel" aria-labelledby="nav-vendor-tab">
                        <table id="tbl_vendor"  class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="tbl_vendor_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>Vendor Phone</th>
                                <th>Account Number</th>
                                <th>Bank</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsonpage')
    <script>
        $(function() {
            var urlConfirm = "{{ route('admin.vendor.list', ['data' => 'json', 'confirm' => false])}}"
            urlConfirm = urlConfirm.replace(/&amp;/g, "&")
            $('#tbl_vendor_confirm').DataTable({
                "ajax": urlConfirm,
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
                        data: 'vendor_name'
                    },
                    {
                        data: 'vendor_phone'
                    },
                    {
                        data: 'bank.bank_account_number',
                        defaultContent: "<i>Not set</i>"
                    }, 
                    {
                        data: 'bank.bank.bank_name',
                        defaultContent: "<i>Not set</i>"
                    },
                    {
                        data: 'id',
                        render: function(data) {
                            return '<button type="button" class="btn btn-sm btn-primary" onclick="confirmVendor('+data+')"><i class="fas fa-check"></i></button><button type="button" class="btn btn-sm btn-danger" onclick="rejectVendor('+data+')"><i class="fas fa-times-circle"></i></button>'
                        }
                    }
                ]
            })

            var urlVendor = "{{ route('admin.vendor.list', ['data' => 'json', 'confirm' => true])}}"
            urlVendor = urlVendor.replace(/&amp;/g, "&")
            $('#tbl_vendor').DataTable({
                "ajax": urlVendor,
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
                        data: 'vendor_name'
                    },
                    {
                        data: 'vendor_phone'
                    },
                    {
                        data: 'bank.bank_account_number',
                        defaultContent: "<i>Not set</i>"
                    }, 
                    {
                        data: 'bank.bank.bank_name',
                        defaultContent: "<i>Not set</i>"
                    },
                    {
                        data: 'id',
                        render: function(data) {
                            return '<button type="button" class="btn btn-sm btn-danger" onclick="deleteVendor('+data+')"><i class="fas fa-times-circle"></i></button>'
                        }
                    }
                ]
            })
        })

        function confirmVendor(vendor_id) {
            Swal.fire({
            title: 'Are you sure?',
                text: "You want to confirm this vendor?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it'
            }).then((result) => {
                if (result.value) {
                    var url = "{{ route('admin.vendor.confirm', ['id' => ':id']) }}"
                    url = url.replace(":id", vendor_id)
                    $.ajax({
                        type: 'PUT',
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (resp) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Vendor is confirm',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#tbl_vendor_confirm').DataTable().ajax.reload();
                            $('#tbl_vendor').DataTable().ajax.reload();
                        },
                        error: () => {
                            Swal.fire(
                                'Try Again ...',
                                'Oooppsss!! Something goes wrong.',
                                'error'
                            ) 
                        }

                    })
                }
            })
        }

        function rejectVendor(vendor_id) {
            Swal.fire({
            title: 'Are you sure?',
                text: "You want to reject this vendor?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it'
            }).then((result) => {
                if (result.value) {
                    var url = "{{ route('admin.vendor.reject', ['id' => ':id']) }}"
                    url = url.replace(":id", vendor_id)
                    $.ajax({
                        type: 'DELETE',
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (resp) => {
                            Swal.fire({
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#tbl_vendor_confirm').DataTable().ajax.reload();
                            $('#tbl_vendor').DataTable().ajax.reload();
                        },
                        error: () => {
                            Swal.fire(
                                'Try Again ...',
                                'Oooppsss!! Something goes wrong.',
                                'error'
                            ) 
                        }

                    })
                }
            })
        }

        function deleteVendor(vendor_id) {
            Swal.fire({
            title: 'Are you sure?',
                text: "You want to delete this vendor?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it'
            }).then((result) => {
                if (result.value) {
                    var url = "{{ route('admin.vendor.delete', ['id' => ':id']) }}"
                    url = url.replace(":id", vendor_id)
                    $.ajax({
                        type: 'PUT',
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (resp) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Vendor is delete',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#tbl_vendor_confirm').DataTable().ajax.reload();
                            $('#tbl_vendor').DataTable().ajax.reload();
                        },
                        error: () => {
                            Swal.fire(
                                'Try Again ...',
                                'Oooppsss!! Something goes wrong.',
                                'error'
                            ) 
                        }

                    })
                }
            })
        }
    </script>
@endsection