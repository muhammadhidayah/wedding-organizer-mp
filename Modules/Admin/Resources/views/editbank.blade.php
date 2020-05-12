<form id="edit_form_bank" class="form-horizontal" role="form" novalidate="novalidate">
    <input type="hidden" name="id" value="{{ $bank->id }}">
    <div class="form-group row">
        <label for="bank_code" class="col-sm-3 col-form-label">Bank Code</label>
        <div class="col-sm-9">
            <input type="text" name="bank_code" required class="form-control" value="{{ $bank->bank_code }}" placeholder="000">
        </div>
    </div>
    <div class="form-group row">
        <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
        <div class="col-sm-9">
            <input type="text" value="{{ $bank->bank_name }}" required name="bank_name" class="form-control" placeholder="Bank Central Asia">
        </div>
    </div>
</form>