<form id="edit_form_admin" class="form-horizontal" role="form" novalidate="novalidate">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" name="name" required class="form-control" value="{{ $user->name }}" placeholder="Enter full name ...">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input type="email" name="email" required class="form-control" value="{{ $user->email }}" placeholder="Enter user email ...">
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
            <input type="text" name="mobile_phone" required class="form-control" value="{{ $user->mobile_phone }}" placeholder="Enter mobile phone number ...">
        </div>
    </div>
</form>