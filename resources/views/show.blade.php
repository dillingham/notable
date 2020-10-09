@extends('layouts.app')

@section('content')
<div class="flex max-w-screen-lg mx-auto">
    <div class="w-1/5 relative border-r pt-8">
        <div class="p-3 ml-4 mb-6 sticky top-0 max-h-screen overflow-auto">
            @foreach($links as $href => $display)
                <a href="{{ $href }}" class="text-gray-500 hover:text-gray-600 block transition-all duration-75 ease-linear @if(request()->is($href)) text-black font-bold @endif">
                    {{ $display }}
                </a>
            @endforeach
        </div>
    </div>
    <div class="w-3/5 bg-white p-12 rounded-lg shadow">
        <div class="prose">
            {!! $docs->content !!}
        </div>
        <div class="flex justify-between border-t mt-4 pt-4">
            @if($docs->edit_link)
                <a href="{{ $docs->edit_link }}" target="_BLANK" rel="nofollow">
                    Edit this page
                </a>
            @endif
            <a href="#top">Back to top</a>
        </div>
    </div>
    <div class="w-1/5 relative">
        <p>On This Page</p>
        @foreach($docs->sections() as $href => $section)
            <li><a href="{{ $href }}">{{ $section }}</a></li>
        @endforeach
    </div>
</div>
@endsection
