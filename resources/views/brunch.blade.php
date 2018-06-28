<ul>
    @foreach ($workers as $worker)
        <li class="list-group-item list-group-item-action list-group-item-warning worker" id="{{ $worker->id }}">
                {{ $worker->post->name }} - {{ $worker->name }}
        </li>
    @endforeach
</ul>