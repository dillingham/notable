<div class="p-3 ml-4 sticky top-0 max-h-screen overflow-auto">
    <p class="text-xs text-black pb-2 uppercase">
        Navigation
    </p>
    <ul class="list-none mb-6">
    @foreach($links as $href => $display)
        <li>
            <a href="{{ $href }}" text-gray-500 hover:text-gray-600 block transition-all duration-75 ease-linear @if(request()->is($href)) text-black font-bold @endif>
                {{ $display }}
            </a>
        </li>
    @endforeach
    </ul>
</div>