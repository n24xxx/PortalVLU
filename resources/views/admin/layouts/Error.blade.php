@if(isset($errors))
@if (count($errors) > 0)
    <div class="alert alert-danger mt-10">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endif
