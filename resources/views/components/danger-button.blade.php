<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger py-1']) }}>
    {{ $slot }}
</button>
