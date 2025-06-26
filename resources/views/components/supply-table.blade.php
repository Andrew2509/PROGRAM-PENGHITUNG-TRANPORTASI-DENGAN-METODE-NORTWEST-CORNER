<div class="table-wrapper">
    <h3 class="table-title"><i class="fas fa-warehouse"></i> Kapasitas (Supply)</h3>
    <table>
        <thead>
            <tr>
                <th>{{ $case['sourceName'] ?? 'Sumber' }}</th>
                <th>Kapasitas</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $case['sources']; $i++)
                <tr>
                    <td>
                        <span class="editable-title">
                            @if(isset($editingSourceUnitName)
                                && is_array($editingSourceUnitName)
                                && isset($editingSourceUnitName['index'], $editingSourceUnitName['row'])
                                && $editingSourceUnitName['index'] === $index
                                && $editingSourceUnitName['row'] === $i)
                                <input type="text"
                                       wire:model="cases.{{ $index }}.sourceUnits.{{ $i }}"
                                       wire:keydown.enter="saveSourceUnitName({{ $index }}, {{ $i }})"
                                       wire:blur="saveSourceUnitName({{ $index }}, {{ $i }})"
                                       autofocus />
                            @else
                                {{ $case['sourceUnits'][$i] ?? 'S' . ($i + 1) }}
                                <i class="fas fa-edit edit-icon"
                                   wire:click="editSourceUnitName({{ $index }}, {{ $i }})"
                                   title="Edit nama sumber"></i>
                            @endif
                        </span>
                    </td>
                    <td>
                        <input type="number" wire:model="cases.{{ $index }}.supply.{{ $i }}" min="0">
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>
