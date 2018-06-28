@foreach ($bosses as $boss)
    <option value="{{ $boss->id }}">{{ $boss->name }}</option>
@endforeach