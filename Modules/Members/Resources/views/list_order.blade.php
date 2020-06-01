@extends('members::layouts.master')
@section('cssonpage')
    <link rel="stylesheet" href="/modules/members/plugins/jquery-validator/css/screen.css">
    <style>
        table {
            min-height: 300px;
        }
    </style>
@endsection

@section('content')
<div class="container" id="demo">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="wfp-tab" data-toggle="tab" href="#wfp" role="tab"
                                aria-controls="wfp" aria-selected="true">Waitting For Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="awaitpayconfirm-tab" data-toggle="tab" href="#awaitpayconfirm" role="tab"
                                aria-controls="awaitpayconfirm" aria-selected="false">Awaiting Payment Confirmation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="orderprogress-tab" data-toggle="tab" href="#orderprogress" role="tab"
                                aria-controls="orderprogress" aria-selected="false">Order In Prgoress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ordercomplete-tab" data-toggle="tab" href="#ordercomplete" role="tab"
                                aria-controls="ordercomplete" aria-selected="false">Order Complete</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="wfp" role="tabpanel" aria-labelledby="wfp-tab">
                            <table id="tbl_waitforpayment" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Paket</th>
                                        <th>Vendor</th>
                                        <th>Price</th>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="awaitpayconfirm" role="tabpanel" aria-labelledby="profile-tab">
                            <table id="tbl_awaitpayconfirm" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Paket</th>
                                        <th>Vendor</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="orderprogress" role="tabpanel" aria-labelledby="orderprogress-tab">
                            <table id="tbl_orderprogress" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Paket</th>
                                        <th>Vendor</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="ordercomplete" role="tabpanel" aria-labelledby="ordercomplete-tab">
                            <table id="tbl_ordercomplete" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Paket</th>
                                        <th>Vendor</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Upload Struct-->
<div class="modal" id="modal-upload-struct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form enctype="multipart/form-data" name="form_upload_struct">
            <input type="hidden" value="" name="order_id">
            <div class="modal-header">
                <h5 class="modal-title">Upload Proof of Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="proof_of_payment">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="uploadStruct()">Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('jsonpage')
<script src="/modules/members/plugins/jquery-validator/dist/jquery.validate.min.js"></script>
<script src="/modules/members/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
<script src="/modules/members/DataTables-1.10.21/js/dataTables.bootstrap4.js"></script>
<script>
    $(function() {
        $('#tbl_waitforpayment').DataTable({
            "ajax": "{{ route('member.list.order', ['payment_status' => 'unpaid'] )}}",
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
                    data: 'package.title_package'
                }, {
                    data: 'package.vendor.vendor_name'
                }, {
                    data: 'total_price',
                    render: (data) => {
                        return "Rp. "+data
                    }
                }, {
                    data: 'id',
                    render: (data) => {
                        return "<button class='btn btn-primary btn-sm' onClick='showModalUploadStruc("+data+")' title='Upload Struct of Payment'><i class='fa fa-cloud-upload'></i></button>"
                    }
                }
            ]
        })

        $('input[name="proof_of_payment"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('label[for="validatedCustomFile"]').html(fileName)
        });

        $('#tbl_awaitpayconfirm').DataTable({
            "ajax": "{{ route('member.list.order', ['payment_status' => 'confirmation'] )}}",
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
                    data: 'package.title_package'
                }, {
                    data: 'package.vendor.vendor_name'
                }, {
                    data: 'total_price',
                    render: (data) => {
                        return "Rp. "+data
                    }
                }
            ]
        })

        $('#tbl_orderprogress').DataTable({
            "ajax": "{{ route('member.list.order', ['payment_status' => 'paid'] )}}",
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
                    data: 'package.title_package'
                }, {
                    data: 'package.vendor.vendor_name'
                }, {
                    data: 'total_price',
                    render: (data) => {
                        return "Rp. "+data
                    }
                }, {
                    data: 'id',
                    render: (data) => {
                        return '<button class="btn btn-sm btn-success" onClick="completeOrder('+data+')"><i class="fa fa-check-square-o"></i></button>'
                    }
                }
            ]
        })

        $('#tbl_ordercomplete').DataTable({
            "ajax": "{{ route('member.list.order', ['payment_status' => 'paid'] )}}&progress=completed",
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
                    data: 'package.title_package'
                }, {
                    data: 'package.vendor.vendor_name'
                }, {
                    data: 'total_price',
                    render: (data) => {
                        return "Rp. "+data
                    }
                }
            ]
        })

        $('a[data-toggle="tab"]').on('shown.bs.tab', (e) => {
            if (e.target.id == "wfp-tab") {
                $('#tbl_waitforpayment').DataTable().ajax.reload();
            } else if (e.target.id == 'awaitpayconfirm-tab') {
                $('#tbl_awaitpayconfirm').DataTable().ajax.reload();
            } else if (e.target.id == 'orderprogress-tab') {
                $('#tbl_orderprogress').DataTable().ajax.reload();
            } else if (e.target.id == 'orderprogress-tab') {
                $('#tbl_ordercomplete').DataTable().ajax.reload();
            }
        })
        
    })

    function showModalUploadStruc(idOrder) {
        $('#modal-upload-struct').modal({
            show: true,
            backdrop: 'static'
        })

        $('input[name="order_id"]').val(idOrder)
        $('label[for="validatedCustomFile"]').html("Choose File...")        
    }

    function uploadStruct() {
        var formObj = $('form[name="form_upload_struct"]')[0]
        var data = new FormData(formObj)
        
        var validate = $(formObj).validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().parent());
            }
        })
        var url = "{{ route('member.upload.struct', ['id' => ':id'])}}"
        var orderID = $('input[name="order_id"]').val()
        url = url.replace(":id", orderID)

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            processData: false,
  			contentType: false,
            data: data,
            type: "POST",
            success: (resp) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Your payment proof\'s has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#tbl_waitforpayment').DataTable().ajax.reload();
                $('#modal-upload-struct').modal('hide')
            },
            error: (response) => {
                var resp = response.responseJSON
                if (typeof resp.errors === "object") {
                    validate.showErrors(resp.errors)
                    return true;
                }

                Swal.fire({
                    title: 'Error!',
                    text: 'Something goes wrong',
                    icon: 'error',
                })
            }
        })
    }

    function completeOrder(orderID) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, confirm it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                

                var urlConfirm = "{{ route('member.complete.order', ['id' => ':id'])}}"
                urlConfirm = urlConfirm.replace(':id', orderID)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: urlConfirm,
                    type: "PUT",
                    success: () => {
                        $('#tbl_orderprogress').DataTable().ajax.reload();
                    }
                })

                swalWithBootstrapButtons.fire(
                    'Confirmed',
                    'Your order has been completed.',
                    'success'
                )                
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
        })
    }
</script>
@endsection