
You have errors in request

@if (session('status'))
    <div class="alert alert-success">
        status:{{ session('status') }}
    </div>
@endif
@if (session('error_code'))
    <div class="alert alert-success">
        error_code:{{ session('error_code') }}
    </div>
@endif