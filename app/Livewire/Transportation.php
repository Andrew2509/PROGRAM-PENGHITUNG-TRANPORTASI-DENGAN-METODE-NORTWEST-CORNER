<?php

namespace App\Livewire;

use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Transportation extends Component
{
    public $cases = []; // Menyimpan data kasus transportasi
    public $editingSourceName = null;
    public $editingDestinationName = null;
    public $editingSourceUnitName = null;
    public $editingDestinationUnitName = null;

    // Fungsi untuk menambah kasus baru
    public function addCase()
    {
        $this->cases[] = [
            'sources' => 3, // Jumlah sumber (m) default
            'destinations' => 3, // Jumlah tujuan (n) default
            'supply' => array_fill(0, 3, 0), // Array untuk supply default
            'demand' => array_fill(0, 3, 0), // Array untuk demand default
            'costs' => array_fill(0, 3, array_fill(0, 3, 0)), // Matrix biaya transportasi default
            'allocation' => [],
            'totalCost' => 0,
        ];
    }

    // Fungsi untuk menghitung biaya total berdasarkan input
    public function calculate($index)
    {
        // Ambil data untuk kasus yang dipilih
        $case = $this->cases[$index];

        // Validasi jika semua input sudah terisi
        $isValid = true;

        // Cek supply
        foreach ($case['supply'] as $supply) {
            if ($supply == 0) {
                $isValid = false;
                break;
            }
        }

        // Cek demand
        foreach ($case['demand'] as $demand) {
            if ($demand == 0) {
                $isValid = false;
                break;
            }
        }

        // Cek biaya
        foreach ($case['costs'] as $costRow) {
            foreach ($costRow as $cost) {
                if ($cost == 0) {
                    $isValid = false;
                    break 2; // Keluar dari kedua loop
                }
            }
        }

        if (!$isValid) {
            session()->flash('error', 'Semua data (supply, demand, biaya) harus diisi dengan benar sebelum melakukan perhitungan.');
            return;
        }

        // Lanjutkan perhitungan jika valid
        $totalSupply = array_sum($case['supply']);
        $totalDemand = array_sum($case['demand']);

        if ($totalSupply !== $totalDemand) {
            session()->flash('error', 'Total kapasitas supply harus sama dengan total permintaan demand.');
            return;
        }

        // Inisialisasi alokasi dan biaya total
        $allocation = [];
        $tempSupply = $case['supply'];
        $tempDemand = $case['demand'];
        $totalCost = 0;

        // Algoritma Northwest Corner untuk menghitung alokasi
        for ($i = 0; $i < $case['sources']; $i++) {
            for ($j = 0; $j < $case['destinations']; $j++) {
                $allocated = min($tempSupply[$i], $tempDemand[$j]);
                $allocation[$i][$j] = $allocated;
                $totalCost += $allocated * $case['costs'][$i][$j];

                $tempSupply[$i] -= $allocated;
                $tempDemand[$j] -= $allocated;
            }
        }

        // Simpan hasil perhitungan
        $this->cases[$index]['allocation'] = $allocation;
        $this->cases[$index]['totalCost'] = $totalCost;
    }


    // Fungsi untuk menambah baris dalam supply dan biaya
    public function addRow($index)
    {
        $this->cases[$index]['sources']++;
        $this->cases[$index]['supply'][] = 0;
        $this->cases[$index]['costs'][] = array_fill(0, $this->cases[$index]['destinations'], 0);
    }

    // Fungsi untuk menambah kolom dalam demand dan biaya
    public function addColumn($index)
    {
        $this->cases[$index]['destinations']++;
        $this->cases[$index]['demand'][] = 0;
        foreach ($this->cases[$index]['costs'] as $key => $costRow) {
            $this->cases[$index]['costs'][$key][] = 0;
        }
    }

    public function increaseSource($index)
    {
        $this->cases[$index]['sources']++;
        $this->cases[$index]['supply'][] = 0;
        $this->cases[$index]['costs'][] = array_fill(0, $this->cases[$index]['destinations'], 0);
    }

    public function decreaseSource($index)
    {
        if ($this->cases[$index]['sources'] > 1) {
            array_pop($this->cases[$index]['supply']);
            array_pop($this->cases[$index]['costs']);
            $this->cases[$index]['sources']--;
        }
    }

    public function increaseDestination($index)
    {
        $this->cases[$index]['destinations']++;
        $this->cases[$index]['demand'][] = 0;
        foreach ($this->cases[$index]['costs'] as $key => $costRow) {
            $this->cases[$index]['costs'][$key][] = 0;
        }
    }

    public function decreaseDestination($index)
    {
        if ($this->cases[$index]['destinations'] > 1) {
            array_pop($this->cases[$index]['demand']);
            foreach ($this->cases[$index]['costs'] as $key => $costRow) {
                array_pop($this->cases[$index]['costs'][$key]);
            }
            $this->cases[$index]['destinations']--;
        }
    }

    public function downloadAllocation($index)
    {
        $case = $this->cases[$index];
        $allocation = $case['allocation'];
        $costs = $case['costs'];
        $totalCost = $case['totalCost'];

        // Define the CSV file name
        $filename = "alokasi_transportasi_kasus_" . ($index + 1) . ".csv";

        // Start the CSV output stream
        $response = new StreamedResponse(function() use ($allocation, $costs, $totalCost) {
            $handle = fopen('php://output', 'w');

            // Header row for CSV
            fputcsv($handle, ['Sumber', 'Tujuan', 'Unit', 'Biaya per Unit', 'Total']);

            // Data rows for each allocation
            foreach ($allocation as $i => $row) {
                foreach ($row as $j => $unit) {
                    $cost = $costs[$i][$j];
                    $total = $unit * $cost;
                    fputcsv($handle, [
                        'S' . ($i + 1), // Source
                        'D' . ($j + 1), // Destination
                        $unit,           // Unit allocated
                        'Rp ' . number_format($cost, 0, ',', '.'), // Cost per unit
                        'Rp ' . number_format($total, 0, ',', '.') // Total cost
                    ]);
                }
            }

            // Total cost row
            fputcsv($handle, []);
            fputcsv($handle, ['Total Biaya', 'Rp ' . number_format($totalCost, 0, ',', '.')]);

            fclose($handle);
        });

        // Set CSV headers and send the response
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }

    // Fungsi untuk mengedit nama Sumber
    public function editSourceName($index)
    {
        $this->editingSourceName = $index;
        $this->cases[$index]['sourceName'] = $this->cases[$index]['sourceName'] ?? "Sumber " . ($index + 1);
    }

    // Fungsi untuk menyimpan nama Sumber
    public function saveSourceName($index)
    {
        $this->editingSourceName = null;
    }

    // Fungsi untuk mengedit nama Tujuan
    public function editDestinationName($index)
    {
        $this->editingDestinationName = $index;
        $this->cases[$index]['destinationName'] = $this->cases[$index]['destinationName'] ?? "Tujuan " . ($index + 1);
    }

    // Fungsi untuk menyimpan nama Tujuan
    public function saveDestinationName($index)
    {
        $this->editingDestinationName = null;
    }

    // Fungsi untuk mengedit nama Sumber unit (S1, S2, ...)
    public function editSourceUnitName($index, $sourceIndex)
    {
        $this->editingSourceUnitName = $sourceIndex;
        $this->cases[$index]['sourceUnits'][$sourceIndex] = $this->cases[$index]['sourceUnits'][$sourceIndex] ?? "S" . ($sourceIndex + 1);
    }

    // Fungsi untuk menyimpan nama Sumber unit
    public function saveSourceUnitName($index, $sourceIndex)
    {
        $this->editingSourceUnitName = null;
    }

    // Fungsi untuk mengedit nama Tujuan unit (D1, D2, ...)
    public function editDestinationUnitName($index, $destinationIndex)
    {
        $this->editingDestinationUnitName = $destinationIndex;
        $this->cases[$index]['destinationUnits'][$destinationIndex] = $this->cases[$index]['destinationUnits'][$destinationIndex] ?? "D" . ($destinationIndex + 1);
    }

    // Fungsi untuk menyimpan nama Tujuan unit
    public function saveDestinationUnitName($index, $destinationIndex)
    {
        $this->editingDestinationUnitName = null;
    }

    public function resetCase($index)
    {
        // Reset data pada kasus berdasarkan index
        $this->cases[$index] = [
            'sources' => 3,  // Jumlah sumber (m) default
            'destinations' => 3,  // Jumlah tujuan (n) default
            'supply' => array_fill(0, 3, 0),  // Kapasitas supply default
            'demand' => array_fill(0, 3, 0),  // Permintaan demand default
            'costs' => array_fill(0, 3, array_fill(0, 3, 0)),  // Biaya transportasi default
            'allocation' => [],  // Alokasi yang dihitung
            'totalCost' => 0,  // Total biaya default
            'sourceName' => 'Nama',  // Nama sumber default
            'destinationName' => 'Nama',  // Nama tujuan default
            'sourceUnits' => array_fill(0, 3, 'Nama'),  // Nama unit sumber default
            'destinationUnits' => array_fill(0, 3, 'Nama'),  // Nama unit tujuan default
        ];
    }

    public function render()
    {
        return view('livewire.transportation');
    }
}
