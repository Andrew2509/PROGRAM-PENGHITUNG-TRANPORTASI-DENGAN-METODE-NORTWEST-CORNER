<div class="table-wrapper">
    <h3 class="table-title"><i class="fas fa-shopping-cart"></i> Permintaan (Demand)</h3>
    <table>
        <thead>
            <tr>
                <th>
                    <span class="editable-title">
                        @if(isset($editingDestinationName) && $editingDestinationName == $index)
                            <input type="text"
                                   wire:model="cases.{{ $index }}.destinationName"
                                   wire:keydown.enter="saveDestinationName({{ $index }})"
                                   wire:blur="saveDestinationName({{ $index }})"
                                   autofocus />
                        @else
                            {{ $case['destinationName'] ?? 'Tujuan' }}
                            <i class="fas fa-edit edit-icon"
                               wire:click="editDestinationName({{ $index }})"
                               title="Edit nama permintaan"></i>
                        @endif
                    </span>
                </th>
                <th>Permintaan</th>
            </tr>
        </thead>
        <tbody>
            @for ($j = 0; $j < $case['destinations']; $j++)
                <tr>
                    <td>
                        <span class="editable-title">
                            @if(isset($editingDestinationUnitName)
                                && is_array($editingDestinationUnitName)
                                && isset($editingDestinationUnitName['index'], $editingDestinationUnitName['column'])
                                && $editingDestinationUnitName['index'] === $index
                                && $editingDestinationUnitName['column'] === $j)
                                <input type="text"
                                       wire:model="cases.{{ $index }}.destinationUnits.{{ $j }}"
                                       wire:keydown.enter="saveDestinationUnitName({{ $index }}, {{ $j }})"
                                       wire:blur="saveDestinationUnitName({{ $index }}, {{ $j }})"
                                       autofocus />
                            @else
                                {{ $case['destinationUnits'][$j] ?? 'D' . ($j + 1) }}
                                <i class="fas fa-edit edit-icon"
                                   wire:click="editDestinationUnitName({{ $index }}, {{ $j }})"
                                   title="Edit nama tujuan"></i>
                            @endif
                        </span>
                    </td>
                    <td><input type="number" wire:model="cases.{{ $index }}.demand.{{ $j }}" min="0"></td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>