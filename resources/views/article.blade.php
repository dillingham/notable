@extends('docs::layout')

@section('content')
    <div class="prose w-3/5 bg-white p-12 rounded-lg shadow">
        {!! $docs->content !!}
        @if($docs->edit_link)
            <div class="border-t mt-4 pt-4">
                <a href="{{ $docs->edit_link }}" target="_BLANK" rel="nofollow">
                    Edit this page
                </a>
            </div>
        @endif
    </div>
@endsection
