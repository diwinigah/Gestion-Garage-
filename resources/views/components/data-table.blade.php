{{-- Composant Tableau avec Tri et Pagination --}}
<div class="bg-card rounded-xl border border-border shadow-sm overflow-hidden">
    {{-- En-tête avec recherche --}}
    <div class="px-6 py-4 border-b border-border">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-foreground">{{ $title ?? 'Tableau de données' }}</h3>
            <div class="flex items-center space-x-4">
                {{-- Recherche --}}
                @if(!isset($disableSearch) || !$disableSearch)
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-background text-foreground placeholder-muted-foreground">
                </div>
                @endif
                {{-- Bouton d'action --}}
                @if(isset($actionUrl))
                    <a href="{{ $actionUrl }}" class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ $actionLabel ?? 'Ajouter' }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-muted/50">
                <tr>
                    @foreach($headers as $header)
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            <button class="flex items-center hover:text-foreground transition-colors">
                                {{ $header['label'] }}
                                @if($header['sortable'] ?? false)
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                @endif
                            </button>
                        </th>
                    @endforeach
                    <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($rows as $row)
                    <tr class="hover:bg-muted/30 transition-colors">
                        @foreach($headers as $index => $header)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                @php
                                    $fieldKey = $header['key'] ?? strtolower(str_replace([' ', 'é', 'è', 'ê', 'à', 'â', 'ô', 'û', 'ï', 'ü'], ['_', 'e', 'e', 'e', 'a', 'a', 'o', 'u', 'i', 'u'], $header['label']));
                                @endphp
                                @if($fieldKey === 'statut')
                                    <x-status-badge :status="$row[$fieldKey] ?? 'en_attente'" />
                                @else
                                    {{ $row[$fieldKey] ?? '-' }}
                                @endif
                            </td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                @if(isset($row['actions']))
                                    @foreach($row['actions'] as $action)
                                        @if(isset($action['onclick']))
                                            <a href="{{ $action['url'] ?? '#' }}" onclick="{{ $action['onclick'] }}" class="text-{{ $action['color'] ?? 'primary' }}-600 hover:text-{{ $action['color'] ?? 'primary' }}-900 transition-colors">
                                                {{ $action['label'] }}
                                            </a>
                                        @else
                                            <a href="{{ $action['url'] }}" class="text-{{ $action['color'] ?? 'primary' }}-600 hover:text-{{ $action['color'] ?? 'primary' }}-900 transition-colors">
                                                {{ $action['label'] }}
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) + 1 }}" class="px-6 py-12 text-center text-muted-foreground">
                            <svg class="mx-auto h-12 w-12 text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-foreground">Aucune donnée</h3>
                            <p class="mt-1 text-sm text-muted-foreground">Commencez par ajouter des éléments.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($pagination))
        <div class="px-6 py-4 border-t border-border bg-muted/20">
            <div class="flex items-center justify-between">
                <div class="text-sm text-muted-foreground">
                    Affichage de {{ $pagination['from'] ?? 0 }} à {{ $pagination['to'] ?? 0 }} sur {{ $pagination['total'] ?? 0 }} résultats
                </div>
                <div class="flex items-center space-x-2">
                    @if($pagination['prev_url'] ?? false)
                        <a href="{{ $pagination['prev_url'] }}" class="px-3 py-1 text-sm border border-border rounded hover:bg-muted transition-colors">Précédent</a>
                    @endif
                    @if($pagination['next_url'] ?? false)
                        <a href="{{ $pagination['next_url'] }}" class="px-3 py-1 text-sm border border-border rounded hover:bg-muted transition-colors">Suivant</a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>