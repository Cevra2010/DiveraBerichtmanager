@if($errors->any())
    <div class="w-full bg-red-300 p-3 mb-5 border-b-2 border-red-500 border-t-2">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

@if(session()->get('success'))
    <div class="w-full bg-green-200 p-3 mb-5 border-b-2 border-green-400 text-gray-700 border-t-2">
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->get('custom_error'))
    <div class="w-full bg-red-300 p-3 mb-5 border-b-2 border-red-500 border-t-2">
        {{ session()->get('custom_error') }}
    </div>
@endif
