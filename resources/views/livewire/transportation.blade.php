<div class="container">
    <!-- Tombol Logout di bagian atas -->
    <div class="logout-btn">
        <button class="btn btn-danger" wire:click="logout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
    </div>

    <header>
        <h1><i class="fas fa-truck-loading"></i> Metode Transportasi</h1>
        <p class="subtitle">Solusi Optimal dengan Algoritma Northwest Corner</p>
    </header>

    @foreach($cases as $index => $case)
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-calculator"></i>
                    <span contenteditable="true" class="editable-title">Kasus {{ $index + 1 }}</span>
                </h2>
            </div>

            <!-- Input sumber & tujuan -->
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

            <!-- Supply & Demand Table -->
            <div class="tables-container">
                @include('components.supply-table', ['case' => $case, 'index' => $index])
                @include('components.demand-table', ['case' => $case, 'index' => $index])
            </div>

            <!-- Matriks Biaya Transportasi -->
            <div class="table-wrapper">
                <h3 class="table-title"><i class="fas fa-table"></i> Tabel Biaya Transportasi</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            @for ($j = 0; $j < $case['destinations']; $j++)
                                <th>{{ $case['destinationUnits'][$j] ?? 'D' . ($j + 1) }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $case['sources']; $i++)
                            <tr>
                                <td><strong>{{ $case['sourceUnits'][$i] ?? 'S' . ($i + 1) }}</strong></td>
                                @for ($j = 0; $j < $case['destinations']; $j++)
                                    <td><input type="number" wire:model="cases.{{ $index }}.costs.{{ $i }}.{{ $j }}" min="0"></td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- Tombol aksi -->
            <div class="btn-group">
                <button class="btn btn-primary" wire:click="calculate({{ $index }})"><i class="fas fa-calculator"></i> Hitung</button>
                <button class="btn btn-success" wire:click="addRow({{ $index }})"><i class="fas fa-plus-circle"></i> Tambah Baris</button>
                <button class="btn btn-success" wire:click="addColumn({{ $index }})"><i class="fas fa-plus-square"></i> Tambah Kolom</button>
                <button class="btn btn-danger" wire:click="resetCase({{ $index }})"><i class="fas fa-undo"></i> Reset</button>
            </div>

            <!-- Hasil Alokasi -->
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
                    <div class="btn-group">
                        <button class="btn btn-info" wire:click="downloadAllocation({{ $index }})" onclick="showDownloadMessage()">
                            <i class="fas fa-download"></i> Download Hasil Alokasi
                        </button>
                    </div>
                @else
                    <div>Hasil alokasi belum dihitung.</div>
                @endif
            </div>
        </div>
    @endforeach

    <!-- Tombol Tambah Kasus -->
    <div class="footer-buttons">
        <button class="btn btn-warning btn-lg" wire:click="addCase()"><i class="fas fa-plus"></i> Tambah Kasus Baru</button>
    </div>

    <!-- Lihat Bantuan Sistem -->
    <div class="card mt-4" id="bantuan">
        <div class="card-header bg-info text-white">
            <h3><i class="fas fa-question-circle"></i> Lihat Bantuan Sistem</h3>
        </div>
        <div class="card-body">
            <p>Untuk memahami cara penggunaan sistem Northwest Corner, silakan baca panduan berikut:</p>
            <ul>
                <li><strong>Input Data:</strong> Masukkan jumlah supply dan demand.</li>
                <li><strong>Matriks Biaya:</strong> Masukkan biaya transportasi antar titik.</li>
                <li><strong>Perhitungan:</strong> Klik <em>Hitung</em> untuk memulai proses.</li>
                <li><strong>Hasil:</strong> Lihat hasil alokasi dan total biaya.</li>
                <li><strong>Download:</strong> Simpan hasil perhitungan dalam format file.</li>
            </ul>
            <a href="{{ route('bantuan') }}" class="btn btn-outline-info"><i class="fas fa-book"></i> Buka Panduan Lengkap</a>
        </div>
    </div>

    <!-- Logo Footer -->
    <div class="logo mt-5">
        <div class="logo-icon">
            <i class="fas fa-calculator"></i>
        </div>
        <h3>Northwest Corner Solver</h3>
    </div>
</div>
