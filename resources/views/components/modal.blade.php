<div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title" hidden>
    <div class="modal-backdrop"></div>
    <div class="modal-panel panel">
        <h3 id="modal-title">{{ $title ?? 'Confirmation' }}</h3>
        @if(isset($message))
            <p class="muted">{{ $message }}</p>
        @endif
        {{ $slot ?? '' }}
    </div>
</div>
