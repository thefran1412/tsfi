<h1>Resources</h1>
    <ul class="list-group">
@foreach($notes as $note)
    {{--<li>--}}
    {{--@if(strlen($note->note) > 50)--}}
    {{--<strong>--}}
    {{--{{ substr($note->note, 0, 50) }} ...--}}
    {{--</strong>--}}
    {{--</li>--}}
    {{--@else--}}
    <li class="list-group-item">
        {{ $note->note }}
    </li>
    {{--@endif--}}
    @endforeach
    </ul>

    {!! $notes->render() !!}