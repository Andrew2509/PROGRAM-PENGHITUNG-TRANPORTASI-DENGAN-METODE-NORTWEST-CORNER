<div class="container">
    <header>
        <h1><i class="fas fa-truck-loading"></i> Metode Transportasi</h1>
        <p class="subtitle">Solusi Optimal dengan Algoritma Northwest Corner</p>
    </header>

    @foreach($cases as $index => $case)
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-calculator"></i> Kasus {{ $index + 1 }}</h2>
            </div>

            <div class="input-group">
                <div class="form-control">
                    <label>Jumlah Sumber (m):</label>
                    <div class="input-group-buttons">
                        <button wire:click="decreaseSource({{ $index }})">-</button>
                        <input type="number" wire:model="cases.{{ $index }}.sources" min="1" value="{{ $case['sources'] }}" readonly>
                        <button wire:click="increaseSource({{ $index }})">+</button>
                    </div>
                </div>

                <div class="form-control">
                    <label>Jumlah Tujuan (n):</label>
                    <div class="input-group-buttons">
                        <button wire:click="decreaseDestination({{ $index }})">-</button>
                        <input type="number" wire:model="cases.{{ $index }}.destinations" min="1" value="{{ $case['destinations'] }}" readonly>
                        <button wire:click="increaseDestination({{ $index }})">+</button>
                    </div>
                </div>
            </div>

            <div class="tables-container">
                <!-- Supply Table -->
                <div class="table-wrapper">
                    <h3 class="table-title"><i class="fas fa-warehouse"></i> Kapasitas (Supply)</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <span wire:click="editSourceName({{ $index }})">
                                        @if(isset($editingSourceName) && $editingSourceName == $index)
                                            <input type="text" wire:model="cases.{{ $index }}.sourceName" wire:keydown.enter="saveSourceName({{ $index }})" />
                                        @else
                                            {{ $case['sourceName'] ?? 'Sumber' }}
                                        @endif
                                    </span>
                                </th>
                                <th>Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $case['sources']; $i++)
                                <tr>
                                    <td>
                                        <span wire:click="editSourceUnitName({{ $index }}, {{ $i }})">
                                            @if(isset($editingSourceUnitName) && $editingSourceUnitName == $i)
                                                <input type="text" wire:model="cases.{{ $index }}.sourceUnits.{{ $i }}" wire:keydown.enter="saveSourceUnitName({{ $index }}, {{ $i }})" />
                                            @else
                                                {{ $case['sourceUnits'][$i] ?? 'S' . ($i + 1) }}
                                            @endif
                                        </span>
                                    </td>
                                    <td><input type="number" wire:model="cases.{{ $index }}.supply.{{ $i }}" min="0"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- Demand Table -->
                <div class="table-wrapper">
                    <h3 class="table-title"><i class="fas fa-shopping-cart"></i> Permintaan (Demand)</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <span wire:click="editDestinationName({{ $index }})">
                                        @if(isset($editingDestinationName) && $editingDestinationName == $index)
                                            <input type="text" wire:model="cases.{{ $index }}.destinationName" wire:keydown.enter="saveDestinationName({{ $index }})" />
                                        @else
                                            {{ $case['destinationName'] ?? 'Tujuan' }}
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
                                        <span wire:click="editDestinationUnitName({{ $index }}, {{ $j }})">
                                            @if(isset($editingDestinationUnitName) && $editingDestinationUnitName == $j)
                                                <input type="text" wire:model="cases.{{ $index }}.destinationUnits.{{ $j }}" wire:keydown.enter="saveDestinationUnitName({{ $index }}, {{ $j }})" />
                                            @else
                                                {{ $case['destinationUnits'][$j] ?? 'D' . ($j + 1) }}
                                            @endif
                                        </span>
                                    </td>
                                    <td><input type="number" wire:model="cases.{{ $index }}.demand.{{ $j }}" min="0"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Biaya Transportasi -->
            <div class="table-wrapper">
                <h3 class="table-title"><i class="fas fa-table"></i> Tabel Biaya Transportasi</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            @for ($j = 0; $j < $case['destinations']; $j++)
                                <th>
                                    <span>{{ $case['destinationUnits'][$j] ?? 'D' . ($j + 1) }}</span>
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $case['sources']; $i++)
                            <tr>
                                <td>
                                    <strong>{{ $case['sourceUnits'][$i] ?? 'S' . ($i + 1) }}</strong>
                                </td>
                                @for ($j = 0; $j < $case['destinations']; $j++)
                                    <td><input type="number" wire:model="cases.{{ $index }}.costs.{{ $i }}.{{ $j }}" min="0"></td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="btn-group">
                <button class="btn btn-primary" wire:click="calculate({{ $index }})"><i class="fas fa-calculator"></i> Hitung</button>
                <button class="btn btn-success" wire:click="addRow({{ $index }})"><i class="fas fa-plus-circle"></i> Tambah Baris</button>
                <button class="btn btn-success" wire:click="addColumn({{ $index }})"><i class="fas fa-plus-square"></i> Tambah Kolom</button>
                <!-- Tombol Reset -->
                <button class="btn btn-danger" wire:click="resetCase({{ $index }})"><i class="fas fa-undo"></i> Reset</button>
            </div>

            <div class="solution">
                <h3 class="solution-title"><i class="fas fa-chart-bar"></i> Hasil Alokasi</h3>
                @if(isset($case['allocation']) && !empty($case['allocation']))
                    <table>
                        <thead>
                            <tr>
                                <th>Sumber</th>
                                <th>Tujuan</th>
                                <th>Unit</th>
                                <th>Biaya per Unit</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($case['allocation'] as $i => $row)
                                @foreach($row as $j => $unit)
                                    <tr>
                                        <td>{{ $case['sourceUnits'][$i] ?? 'S' . ($i + 1) }}</td>
                                        <td>{{ $case['destinationUnits'][$j] ?? 'D' . ($j + 1) }}</td>
                                        <td>{{ $unit }}</td>
                                        <td>Rp {{ number_format($case['costs'][$i][$j], 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($unit * $case['costs'][$i][$j], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="total-cost">Total Biaya: <span class="highlight">Rp {{ number_format($case['totalCost'], 0, ',', '.') }}</span></div>
                @else
                    <div>Hasil alokasi belum dihitung.</div>
                @endif

                <!-- Tombol Download -->
                @if(isset($case['allocation']) && !empty($case['allocation']))
                    <div class="btn-group">
                        <button class="btn btn-info" wire:click="downloadAllocation({{ $index }})">
                            <i class="fas fa-download"></i> Download Hasil Alokasi
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    <div class="footer-buttons">
        <button class="btn btn-warning btn-lg" wire:click="addCase()"><i class="fas fa-plus"></i> Tambah Kasus Baru</button>
    </div>

    <div class="logo">
        <div class="logo-icon">
            <i class="fas fa-calculator"></i>
        </div>
        <h3>Northwest Corner Solver</h3>
    </div>
</div>
