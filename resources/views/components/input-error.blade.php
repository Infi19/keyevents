@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-accent text-sm space-y-1 mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
