@if (count($errors) > 0)
    <div class="row validation">
        <div class="col-md-6">
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li class="list-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
