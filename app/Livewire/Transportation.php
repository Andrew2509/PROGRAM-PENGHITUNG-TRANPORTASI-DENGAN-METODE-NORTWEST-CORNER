<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Transportation extends Component
{
    public $cases = []; // Menyimpan data kasus transportasi
    public $editingSourceName = null;
    public $editingDestinationName = null;
    public $editingSourceUnitName = null;
    public $editingDestinationUnitName = null;

    public function addCase()
    {
        $this->cases[] = [
            'sources' => 3,
            'destinations' => 3,
            'supply' => array_fill(0, 3, 0),
            'demand' => array_fill(0, 3, 0),
            'costs' => array_fill(0, 3, array_fill(0, 3, 0)),
            'allocation' => [],
            'totalCost' => 0,
            'sourceName' => 'Sumber',
            'destinationName' => 'Tujuan',
            'sourceUnits' => array_fill(0, 3, 'Unit'),
            'destinationUnits' => array_fill(0, 3, 'Unit'),
        ];
    }

    public function calculate($index)
    {
        $case = $this->cases[$index];
        $isValid = true;

        foreach ($case['supply'] as $supply) {
            if ($supply == 0) {
                $isValid = false;
                break;
            }
        }

        foreach ($case['demand'] as $demand) {
            if ($demand == 0) {
                $isValid = false;
                break;
            }
        }

        foreach ($case['costs'] as $costRow) {
            foreach ($costRow as $cost) {
                if ($cost == 0) {
                    $isValid = false;
                    break 2;
                }
            }
        }

        if (!$isValid) {
            session()->flash('error', 'Semua data (supply, demand, biaya) harus diisi dengan benar sebelum melakukan perhitungan.');
            return;
        }

        $totalSupply = array_sum($case['supply']);
        $totalDemand = array_sum($case['demand']);

        if ($totalSupply !== $totalDemand) {
            session()->flash('error', 'Total kapasitas supply harus sama dengan total permintaan demand.');
            return;
        }

        $allocation = [];
        $tempSupply = $case['supply'];
        $tempDemand = $case['demand'];
        $totalCost = 0;

        for ($i = 0; $i < $case['sources']; $i++) {
            for ($j = 0; $j < $case['destinations']; $j++) {
                $allocated = min($tempSupply[$i], $tempDemand[$j]);
                $allocation[$i][$j] = $allocated;
                $totalCost += $allocated * $case['costs'][$i][$j];

                $tempSupply[$i] -= $allocated;
                $tempDemand[$j] -= $allocated;
            }
        }

        $this->cases[$index]['allocation'] = $allocation;
        $this->cases[$index]['totalCost'] = $totalCost;
    }

    public function addRow($index)
    {
        $this->cases[$index]['sources']++;
        $this->cases[$index]['supply'][] = 0;
        $this->cases[$index]['costs'][] = array_fill(0, $this->cases[$index]['destinations'], 0);
        $this->cases[$index]['sourceUnits'][] = 'Nama';
    }

    public function addColumn($index)
    {
        $this->cases[$index]['destinations']++;
        $this->cases[$index]['demand'][] = 0;
        foreach ($this->cases[$index]['costs'] as $key => $costRow) {
            $this->cases[$index]['costs'][$key][] = 0;
        }
        $this->cases[$index]['destinationUnits'][] = 'Nama';
    }

    public function increaseSource($index)
    {
        $this->addRow($index);
    }

    public function decreaseSource($index)
    {
        if ($this->cases[$index]['sources'] > 1) {
            array_pop($this->cases[$index]['supply']);
            array_pop($this->cases[$index]['costs']);
            array_pop($this->cases[$index]['sourceUnits']);
            $this->cases[$index]['sources']--;
        }
    }

    public function increaseDestination($index)
    {
        $this->addColumn($index);
    }

    public function decreaseDestination($index)
    {
        if ($this->cases[$index]['destinations'] > 1) {
            array_pop($this->cases[$index]['demand']);
            array_pop($this->cases[$index]['destinationUnits']);
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
        $sourceUnits = $case['sourceUnits'] ?? [];
        $destinationUnits = $case['destinationUnits'] ?? [];
        $totalCost = $case['totalCost'];

        $filename = 'alokasi_transportasi_kasus_' . ($index + 1) . '.csv';

        $response = new StreamedResponse(function () use ($allocation, $costs, $sourceUnits, $destinationUnits, $totalCost) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Sumber', 'Tujuan', 'Unit', 'Biaya per Unit', 'Total']);

            foreach ($allocation as $i => $row) {
                foreach ($row as $j => $unit) {
                    $cost = $costs[$i][$j];
                    $total = $unit * $cost;
                    fputcsv($handle, [$sourceUnits[$i] ?? 'S' . ($i + 1), $destinationUnits[$j] ?? 'D' . ($j + 1), $unit, 'Rp ' . number_format($cost, 0, ',', '.'), 'Rp ' . number_format($total, 0, ',', '.')]);
                }
            }

            fputcsv($handle, []);
            fputcsv($handle, ['Total Biaya', 'Rp ' . number_format($totalCost, 0, ',', '.')]);

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }

    public function editSourceName($index)
    {
        $this->editingSourceName = $index;
        $this->cases[$index]['sourceName'] = $this->cases[$index]['sourceName'] ?? 'Sumber ' . ($index + 1);
    }

    public function saveSourceName($index)
    {
        $this->editingSourceName = null;
    }

    public function editDestinationName($index)
    {
        $this->editingDestinationName = $index;
    }

    public function saveDestinationName($index)
    {
        $this->editingDestinationName = null;
    }

    public function editSourceUnitName($index, $i)
    {
        $this->editingSourceUnitName = ['index' => $index, 'row' => $i];
        $this->cases[$index]['sourceUnits'][$i] = $this->cases[$index]['sourceUnits'][$i] ?? 'S' . ($i + 1);
    }

    public function saveSourceUnitName($index, $i)
    {
        $this->editingSourceUnitName = null;
    }

    public function editDestinationUnitName($index, $j)
    {
        $this->editingDestinationUnitName = ['index' => $index, 'column' => $j];
        $this->cases[$index]['destinationUnits'][$j] = $this->cases[$index]['destinationUnits'][$j] ?? 'D' . ($j + 1);
    }

    public function saveDestinationUnitName($index, $j)
    {
        $this->editingDestinationUnitName = null;
    }

    public function resetCase($index)
    {
        $this->cases[$index] = [
            'sources' => 3,
            'destinations' => 3,
            'supply' => array_fill(0, 3, 0),
            'demand' => array_fill(0, 3, 0),
            'costs' => array_fill(0, 3, array_fill(0, 3, 0)),
            'allocation' => [],
            'totalCost' => 0,
            'sourceName' => 'Sumber',
            'destinationName' => 'Tujuan',
            'sourceUnits' => array_fill(0, 3, 'Unit'),
            'destinationUnits' => array_fill(0, 3, 'Unit'),
        ];
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.transportation');
    }
}
