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
                <table id="tbl_vendor"  class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                aria-describedby="tbl_vendor_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vendor</th>
                            <th>Vendor Phone</th>
                            <th>Account Number</th>
                            <th>Bank</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsonpage')
    <script>
        $(function() {
            $('#tbl_vendor').DataTable({
                "ajax": "{{ route('admin.vendor.list', ['data' => 'json'])}}",
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
                    }
                ]
            })
        })
    </script>
@endsection