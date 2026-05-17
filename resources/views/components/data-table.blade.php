<section class="panel">
    <div class="page-header">
        <h3>{{ $title ?? 'Tableau de données' }}</h3>
        @if(isset($actionUrl))
            <a href="{{ $actionUrl }}" class="btn">{{ $actionLabel ?? 'Ajouter' }}</a>
        @endif
    </div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ $header['label'] }}</th>
                    @endforeach
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        @foreach($headers as $header)
                            @php
                                $fieldKey = $header['key'] ?? strtolower($header['label']);
                            @endphp
                            <td>
                                @if($fieldKey === 'statut')
                                    <x-status-badge :status="$row[$fieldKey] ?? 'en_attente'" />
                                @else
                                    {{ $row[$fieldKey] ?? '-' }}
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <div class="actions-inline">
                                @foreach($row['actions'] ?? [] as $action)
                                    <a href="{{ $action['url'] ?? '#' }}" class="btn-muted">{{ $action['label'] }}</a>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) + 1 }}" class="muted">Aucune donnée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($pagination))
        <div class="actions-row pagination">
            <span class="muted">Affichage de {{ $pagination['from'] ?? 0 }} à {{ $pagination['to'] ?? 0 }} sur {{ $pagination['total'] ?? 0 }}</span>
            <div class="actions-inline">
                @if($pagination['prev_url'] ?? false)
                    <a href="{{ $pagination['prev_url'] }}" class="btn-muted">Précédent</a>
                @endif
                @if($pagination['next_url'] ?? false)
                    <a href="{{ $pagination['next_url'] }}" class="btn-muted">Suivant</a>
                @endif
            </div>
        </div>
    @endif
</section>
