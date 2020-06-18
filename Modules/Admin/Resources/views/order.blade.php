@extends('admin::layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order(s)</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Order(s)</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="card">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="tab"
                    href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                    aria-selected="true">Unpaid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="tab"
                    href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                    aria-selected="false">Confirmation Payments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="tab"
                    href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                    aria-selected="false">On Progress</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-home-tab">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        #
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="">
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Email
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Mobile Phone
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Vendor
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Package
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Action(s)
                                    </th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-three-profile-tab">
                        <table id="confirmation_table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        #
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="">
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Vendor
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Vendor Package
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Price
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Payment Proof
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Action(s)
                                    </th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">
                        <table id="progress_table" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        #
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="">
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Email
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Mobile Phone
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Vendor
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Vendor Package
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Action(s)
                                    </th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-detail-order">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="modal_loading" class="overlay d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Detail Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#example1').DataTable({
            "ajax": "{{ route('admin.order', ['status' => 'unpaid'] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'inv_number'
                }, {
                    data: 'user.name'
                }, {
                    data: 'user.email'
                }, {
                    data: 'user.mobile_phone'
                }, {
                    data: 'package.vendor.vendor_name'
                }, {
                    data: 'package.title_package'
                }, {
                    data: 'id',
                    className: "text-center",
                    render: (data) => {
                        return '<button type="button" class="btn btn-sm btn-primary" onclick="detailOrder('+data+')"><i class="fas fa-eye"></i></button>'
                    }
                }
            ]
        })

        $('#confirmation_table').DataTable({
            "ajax": "{{ route('admin.order', ['status' => 'confirmation'] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'inv_number',
                }, {
                    data: 'user.name'
                }, {
                    data: 'package.vendor.vendor_name'
                }, {
                    data: 'package.title_package'
                }, {
                    data: 'total_price',
                    render: (data) => {
                        return 'Rp. '+data
                    }
                }, {
                    data: 'payment_proof',
                    className: "text-center",
                    render: (data) => {
                        return '<a href="{{ url("/images/payment") }}/'+data+'" data-toggle="lightbox" class="btn btn-sm btn-default"><i class="fas fa-eye"></i></a>'
                    }
                }, {
                    data: 'id',
                    className: "text-center",
                    render: (data) => {
                        return '<button type="button" class="btn btn-sm btn-primary" onclick="confirmPayment('+data+')"><i class="fas fa-check"></i></button><button type="button" class="btn btn-sm btn-danger" onclick="rejectPayment('+data+')"><i class="fas fa-times-circle"></i></button>'
                    }
                }
            ]
        })

        $('#progress_table').DataTable({
            "ajax": "{{ route('admin.order', ['status' => 'paid'] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'inv_number'
                }, {
                    data: 'user.name'
                }, {
                    data: 'user.email'
                }, {
                    data: 'user.mobile_phone'
                }, {
                    data: 'package.vendor.vendor_name'
                }, {
                    data: 'package.title_package'
                }, {
                    data: 'id',
                    className: "text-center",
                    render: (data) => {
                        return '<button type="button" class="btn btn-sm btn-primary" onclick="detailOrder('+data+')"><i class="fas fa-eye"></i></button>'
                    }
                }
            ]
        })

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // e.target // newly activated tab
            if (e.target.id == 'custom-tabs-three-home-tab') {
                $('#example1').DataTable().ajax.reload();
            } else if (e.target.id == 'custom-tabs-three-profile-tab') {
                $('#confirmation_table').DataTable().ajax.reload();
            } else if (e.target.id == 'custom-tabs-three-messages-tab') {
                // $('#progress_table').DataTable().ajax.reload();
            }
            // e.relatedTarget // previous active tab
        })
    })

    function detailOrder(order_id) {
        $('#modal-detail-order').modal('show')
        var url = "{{ route('admin.detail_order', ':id')}}"
        url = url.replace(":id", order_id)
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

    function confirmPayment(order_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to confirm this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm it'
        }).then((result) => {
            if (result.value) {
                var url = "{{ route('admin.order.confirmation', ':id') }}"
                url = url.replace(":id", order_id)

                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "PUT",
                    data: 'confirmation=true',
                    success: (resp) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Order has been confirmed',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#confirmation_table').DataTable().ajax.reload();
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

    function rejectPayment(order_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to reject this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it'
        }).then((result) => {
            if (result.value) {
                var url = "{{ route('admin.order.confirmation', ':id') }}"
                url = url.replace(":id", order_id)

                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "PUT",
                    data: 'confirmation=false',
                    success: (resp) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment status already set to rollback',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#confirmation_table').DataTable().ajax.reload();
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