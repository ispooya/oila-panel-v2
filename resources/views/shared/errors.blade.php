@if ($errors->any())
    <div class="alert alert-danger" style="margin: 16px -5px 16px 5px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
