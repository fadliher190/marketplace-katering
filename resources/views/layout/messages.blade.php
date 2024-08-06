@if (count($errors) > 0)
    <div class="w-full rounded-xl p-4 bg-red-300">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="w-full rounded-xl p-4 bg-green-300">
        {{ session('success') }}
    </div>
@endif

