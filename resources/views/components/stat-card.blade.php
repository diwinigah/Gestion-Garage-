{{-- Composant Carte Statistique --}}
<div class="bg-card p-6 rounded-xl border border-border shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex items-center">
        <div class="p-3 rounded-lg {{ $bgColor ?? 'bg-primary/10' }}">
            <svg class="w-6 h-6 {{ $iconColor ?? 'text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
            </svg>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm font-medium text-muted-foreground">{{ $title }}</p>
            <div class="flex items-center justify-between">
                <p class="text-2xl font-bold text-foreground">{{ $value }}</p>
                @if(isset($trend))
                    <span class="text-sm {{ $trend > 0 ? 'text-accent' : 'text-red-500' }} font-medium">
                        {{ $trend > 0 ? '+' : '' }}{{ $trend }}%
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>