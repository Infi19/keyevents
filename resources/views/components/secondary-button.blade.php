<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-light border border-secondary rounded-md font-semibold text-xs text-primary uppercase tracking-widest shadow-sm hover:bg-blue-gray focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
