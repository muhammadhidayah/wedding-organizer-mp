@extends('members::layouts.master')

@section('cssonpage')
    <link rel="stylesheet" href="/modules/members/plugins/jquery-validator/css/screen.css">
@endsection

@section('content')
<div class="container" id="demo">
    <div class="row" id="navAddVendor">
        <div class="col-md-12 text-center mt-5 mb-5">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_create_vendor" id="btn_add_vendor">
                ADD VENDOR
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_create_vendor" tabindex="-1" role="dialog" aria-labelledby="modal_create_vendor"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Add Vendor</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('members.create.vendor') }}" name="vendor_create_form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="vendor_name" class="form-control" required data-msg="Please fill this field" placeholder="Name Vendor" />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="vendor_address" rows="3" name="vendor_address" required data-msg="Please fill this field" placeholder="Address"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="number_phone" class="form-control" required data-msg="Please fill this field" placeholder="Number Phone" />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="vendor_about" data-msg="Please fill this field" id="vendor_about" rows="3" placeholder="About"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('jsonpage')
    <script src="/modules/members/plugins/jquery-validator/dist/jquery.validate.min.js"></script>
    <script>
        $('form[name="vendor_create_form"]').on('submit', function(e) {
            e.preventDefault()
            var validate = $(this).validate()
            $.ajax({
                url: "{{ route('members.create.vendor')}}",
                type: "POST",
                data: $(this).serialize(),
                success: (resp) => {
                    location.reload()
                },
                error: (response) => {
                    var resp = response.responseJSON
                    if (typeof resp.errors == "object") {
                        validate.showErrors(resp.errors)
                    }

                    alert(resp)
                }
            })

        })
    </script>
@endsection