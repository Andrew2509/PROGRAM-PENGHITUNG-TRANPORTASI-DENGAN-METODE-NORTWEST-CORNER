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

        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td>S${sources}</td><td><input type="number" wire:model="cases.${index}.supply.${sources - 1}" min="0"></td>`;
        supplyTable.appendChild(newRow);

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

        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td>D${destinations}</td><td><input type="number" wire:model="cases.${index}.demand.${destinations - 1}" min="0"></td>`;
        demandTable.appendChild(newRow);

        const transportRows = transportTable.querySelectorAll('tr');
        transportRows[0].innerHTML += `<th>D${destinations}</th>`;
        for (let i = 1; i < transportRows.length; i++) {
            transportRows[i].innerHTML += `<td><input type="number" wire:model="cases.${index}.costs.${i - 1}.${destinations - 1}" min="0"></td>`;
        }
    }

    // Jalankan perhitungan biaya menggunakan Northwest Corner
    function calculateCost(index) {
        const sources = parseInt(document.getElementById(`sources${index}`).value);
        const destinations = parseInt(document.getElementById(`destinations${index}`).value);

        let supply = [];
        let demand = [];
        let costs = [];

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

        let totalCost = 0;
        let allocation = [];

        let tempSupply = [...supply];
        let tempDemand = [...demand];

        for (let i = 0; i < sources; i++) {
            for (let j = 0; j < destinations; j++) {
                let allocated = Math.min(tempSupply[i], tempDemand[j]);
                totalCost += allocated * costs[i][j];

                tempSupply[i] -= allocated;
                tempDemand[j] -= allocated;

                if (!allocation[i]) allocation[i] = [];
                allocation[i][j] = allocated;
            }
        }

        displaySolution(index, allocation, costs, totalCost);
    }

    // Menampilkan hasil ke DOM
    function displaySolution(index, allocation, costs, totalCost) {
        const solutionContainer = document.querySelector(`#solution${index}`);
        let html = `<h3>Hasil Alokasi Kasus ${index + 1}</h3>`;
        html += `<table id="allocation-table"><thead><tr><th>Sumber</th><th>Tujuan</th><th>Unit</th><th>Biaya per Unit</th><th>Total</th></tr></thead><tbody>`;

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

        html += `</tbody></table><p><strong>Total Biaya:</strong> ${totalCost}</p>`;
        html += `<button class="btn btn-info mt-3" onclick="triggerDownload()">Download Hasil Alokasi</button>`;
        solutionContainer.innerHTML = html;
    }

    // Event binding tombol-tombol
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

    // Tambahkan animasi fokus input
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function () {
            this.parentNode.querySelector('.input-icon').style.color = '#4f46e5';
        });
        input.addEventListener('blur', function () {
            this.parentNode.querySelector('.input-icon').style.color = '#94a3b8';
        });
    });
});

// Fungsi Download sebagai Gambar
function triggerDownload() {
    const table = document.getElementById('allocation-table');
    html2canvas(table).then(canvas => {
        const imgURL = canvas.toDataURL('image/png');
        const link = document.createElement('a');
        link.href = imgURL;
        link.download = 'hasil_alokasi.png';
        link.click();

        // Penjelasan setelah download
        setTimeout(() => {
            alert("✅ File hasil alokasi berhasil diunduh sebagai gambar.\nSilakan periksa folder 'Downloads' Anda.");
        }, 1000);
    });
}