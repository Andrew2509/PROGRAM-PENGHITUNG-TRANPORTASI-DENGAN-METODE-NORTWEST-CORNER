document.addEventListener("DOMContentLoaded", function () {
    // Update tabel setelah perubahan jumlah sumber atau tujuan
    Livewire.on('updateTable', (index) => {
        updateTable(index);
    });

    // Menambah baris baru pada tabel supply dan biaya
    function addRow(index) {
        const supplyTable = document.querySelector(`#supplyTable${index}`);
        const transportTable = document.querySelector(`#transportTable${index}`);

        const sources = parseInt(document.getElementById(`sources${index}`).value) + 1;
        document.getElementById(`sources${index}`).value = sources;

        // Menambah baris supply
        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td>S${sources}</td><td><input type="number" wire:model="cases.${index}.supply.${sources - 1}" min="0"></td>`;
        supplyTable.appendChild(newRow);

        // Menambah baris biaya transportasi
        const newTransportRow = document.createElement('tr');
        newTransportRow.innerHTML = `<td>S${sources}</td>`;
        const destinations = parseInt(document.getElementById(`destinations${index}`).value);
        for (let j = 0; j < destinations; j++) {
            newTransportRow.innerHTML += `<td><input type="number" wire:model="cases.${index}.costs.${sources - 1}.${j}" min="0"></td>`;
        }
        transportTable.appendChild(newTransportRow);
    }

    // Menambah kolom baru pada tabel demand dan biaya
    function addColumn(index) {
        const demandTable = document.querySelector(`#demandTable${index}`);
        const transportTable = document.querySelector(`#transportTable${index}`);

        const destinations = parseInt(document.getElementById(`destinations${index}`).value) + 1;
        document.getElementById(`destinations${index}`).value = destinations;

        // Menambah kolom demand
        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td>D${destinations}</td><td><input type="number" wire:model="cases.${index}.demand.${destinations - 1}" min="0"></td>`;
        demandTable.appendChild(newRow);

        // Menambah kolom biaya transportasi
        const transportRows = transportTable.querySelectorAll('tr');
        transportRows[0].innerHTML += `<th>D${destinations}</th>`;
        for (let i = 1; i < transportRows.length; i++) {
            transportRows[i].innerHTML += `<td><input type="number" wire:model="cases.${index}.costs.${i - 1}.${destinations - 1}" min="0"></td>`;
        }
    }

    // Menjalankan perhitungan biaya dan menampilkan hasilnya
    function calculateCost(index) {
        const sources = parseInt(document.getElementById(`sources${index}`).value);
        const destinations = parseInt(document.getElementById(`destinations${index}`).value);

        let supply = [];
        let demand = [];
        let costs = [];

        // Ambil nilai supply, demand, dan biaya dari input
        for (let i = 0; i < sources; i++) {
            supply.push(parseInt(document.querySelector(`#supplyTable${index} tr:nth-child(${i + 2}) td input`).value) || 0);
        }

        for (let j = 0; j < destinations; j++) {
            demand.push(parseInt(document.querySelector(`#demandTable${index} tr:nth-child(${j + 2}) td input`).value) || 0);
        }

        for (let i = 0; i < sources; i++) {
            let costRow = [];
            for (let j = 0; j < destinations; j++) {
                costRow.push(parseInt(document.querySelector(`#transportTable${index} tr:nth-child(${i + 2}) td:nth-child(${j + 2}) input`).value) || 0);
            }
            costs.push(costRow);
        }

        // Hitung total biaya menggunakan Algoritma Northwest Corner
        let totalCost = 0;
        let allocation = [];

        let tempSupply = [...supply];
        let tempDemand = [...demand];

        for (let i = 0; i < sources; i++) {
            for (let j = 0; j < destinations; j++) {
                let allocated = Math.min(tempSupply[i], tempDemand[j]);
                totalCost += allocated * costs[i][j];

                // Update supply dan demand yang sudah dialokasikan
                tempSupply[i] -= allocated;
                tempDemand[j] -= allocated;

                if (!allocation[i]) allocation[i] = [];
                allocation[i][j] = allocated;
            }
        }

        // Menampilkan hasil alokasi dan total biaya
        displaySolution(index, allocation, costs, totalCost);
    }

    // Menampilkan hasil perhitungan
    function displaySolution(index, allocation, costs, totalCost) {
        const solutionContainer = document.querySelector(`#solution${index}`);
        let html = `<h3>Hasil Alokasi Kasus ${index + 1}</h3>`;
        html += `<table><thead><tr><th>Sumber</th><th>Tujuan</th><th>Unit</th><th>Biaya per Unit</th><th>Total</th></tr></thead><tbody>`;

        for (let i = 0; i < allocation.length; i++) {
            for (let j = 0; j < allocation[i].length; j++) {
                html += `<tr>
                    <td>S${i + 1}</td>
                    <td>D${j + 1}</td>
                    <td>${allocation[i][j]}</td>
                    <td>${costs[i][j]}</td>
                    <td>${allocation[i][j] * costs[i][j]}</td>
                </tr>`;
            }
        }

        html += `</tbody></table><p>Total Biaya: ${totalCost}</p>`;
        solutionContainer.innerHTML = html;
    }

    // Bind events to buttons
    const addRowButtons = document.querySelectorAll('button[wire\\:click="addRow"]');
    addRowButtons.forEach((button, index) => {
        button.addEventListener('click', () => addRow(index));
    });

    const addColumnButtons = document.querySelectorAll('button[wire\\:click="addColumn"]');
    addColumnButtons.forEach((button, index) => {
        button.addEventListener('click', () => addColumn(index));
    });

    const calculateButtons = document.querySelectorAll('button[wire\\:click="calculate"]');
    calculateButtons.forEach((button, index) => {
        button.addEventListener('click', () => calculateCost(index));
    });
});

document.addEventListener('livewire:load', function () {
    window.addEventListener('downloadImage', event => {
        // Menggunakan html2canvas untuk mengonversi tabel menjadi gambar
        const table = document.getElementById('allocation-table');

        html2canvas(table).then(canvas => {
            // Mengunduh gambar
            const imgURL = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            link.href = imgURL;
            link.download = 'hasil_alokasi.png';  // Nama file gambar
            link.click();
        });
    });
});
