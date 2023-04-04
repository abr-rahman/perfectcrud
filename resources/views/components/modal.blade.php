@props(['title' => '', ])

<div  {{ $attributes->merge(['class' => 'modal-dialog']) }}>
    <div class="modal-content">
        @isset($title)
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $title }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endisset
        <div class="modal-body">
            {{ $slot }}
        </div>
    </div>
</div>
