Привіт <i>{{ $user->name }}</i>,
<p>{{ $title }} "{{ $event->name }}". </p>
<div>
{{--  event type  --}}

    @if(isset($event->start_date, $event->end_date))
        <p><b>Початок події:</b>&nbsp;{{ $event->start_date }}</p>
        <p><b>Кінець події:</b>&nbsp;{{ $demo->end_date }}</p>

{{--  reminder type  --}}
    @elseif($event->date)
        <p><b>Дата події:</b>&nbsp;{{ $event->date }}</p>
        <p><b>Частота повторень події:</b>&nbsp; $event->date  </p>
    @endif
</div>
