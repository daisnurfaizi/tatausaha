<div>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong> Something is very wrong! </strong> There were some problems with your input. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong> Success! </strong> {{ session('success') }}
        </div>
    @endif
</div>
