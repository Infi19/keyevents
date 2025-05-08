@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-secondary focus:border-primary focus:ring-primary rounded-md shadow-sm text-text bg-light']) !!}>
