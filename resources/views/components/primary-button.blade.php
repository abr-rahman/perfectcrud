<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary py-1']) }}>
    {{ $slot }}
</button>
