

<div class="mt-8"></div>

<p>On This Page</p>
@foreach($docs->sections() as $href => $section)
    <li><a href="{{ $href }}">{{ $section }}</a></li>
@endforeach
