{{-- Composant Modale --}}
<div x-data="{ open: @entangle($attributes->get('open', 'open')).live }" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- Overlay --}}
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

    {{-- Contenu --}}
    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-card px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
            <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                <button @click="open = false" type="button" class="rounded-md text-muted-foreground hover:text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <span class="sr-only">Fermer</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="sm:flex sm:items-start">
                @if(isset($icon))
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full {{ $iconBg ?? 'bg-primary/10' }} sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 {{ $iconColor ?? 'text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
                        </svg>
                    </div>
                @endif

                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left flex-1">
                    <h3 class="text-lg font-medium leading-6 text-foreground" id="modal-title">
                        {{ $title }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-muted-foreground">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse sm:space-x-3 sm:space-x-reverse">
                @if(isset($confirmAction))
                    <button @click="{{ $confirmAction }}" type="button" class="inline-flex w-full justify-center rounded-md border border-transparent {{ $confirmClass ?? 'bg-primary text-primary-foreground hover:bg-primary/90' }} px-4 py-2 text-base font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ $confirmLabel ?? 'Confirmer' }}
                    </button>
                @endif
                <button @click="open = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-border bg-card px-4 py-2 text-base font-medium text-muted-foreground shadow-sm hover:bg-muted focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                    {{ $cancelLabel ?? 'Annuler' }}
                </button>
            </div>
        </div>
    </div>
</div>