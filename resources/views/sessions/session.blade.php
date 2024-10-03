    @if (session()->has('Error'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session()->get('Error') }}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
