const hitungTotalHarga = () => {
    let totalHarga = 0;
    $('table tbody tr').each(function () {
        let hargaBarang = parseFloat($(this).find('td[data-field="total"]').text().replace(/[^0-9,-]+/g, "").replace(',', '.'));
        totalHarga += hargaBarang
    });
    $('#intTotalHarga').val(totalHarga); // Update elemen input total
    $('#totalHarga').val(formattedTotal(totalHarga)); // Update elemen input total
}
const formattedTotal = (total) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total / 1);
}
const toNumber = (total) => {
    return parseFloat(total.replace(/[^0-9,-]+/g, "").replace(',', '.'));
}
$(document).ready(function () {
    // supplier filter
    $("#supplierFilter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".supplierItem").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $(".supplierItem").on("click", function () {
        var selectedText = $(this).text();
        var kode = selectedText.split('|')[0].trim();
        var selectedSupplier = supplierData.find(function (supplier) {
            return supplier.kode === kode;
        });
        if (selectedSupplier) {
            $('#kodeSupplier').val(selectedSupplier.kode);
        }
        $('#supplierFilter').val('');
    })

    // barang filter
    $("#barangFilter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".barangItem").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $(".barangItem").on("click", function () {
        var selectedText = $(this).text();
        var kode = selectedText.split('|')[0].trim();
        var selectedBarang = barangData.find(function (barang) {
            return barang.kode === kode;
        });
        if (selectedBarang) {
            $('#kodeBarang').val(selectedBarang.kode);
            $('#namaBarang').val(selectedBarang.nama);
            $('#jumlah').val(1);
            $('#harga').val(formattedTotal(selectedBarang.harpok));
            $('#total').val(formattedTotal(selectedBarang.harpok));
        }
        $('#barangFilter').val('');
    })

    // jumlah func
    $("#jumlah").on("keyup", function () {
        var value = $(this).val();
        let harga = toNumber($('#harga').val());
        $('#total').val(formattedTotal(value * harga))
    });

    // harga func
    $("#harga").on("keyup", function () {
        var value = $(this).val().replace(/\D/g, '');
        $(this).val(formattedTotal(value / 100));
        let harga = toNumber($(this).val());
        let jumlah = $('#jumlah').val();
        $('#total').val(formattedTotal(harga * jumlah))
    });

    // add button 
    $('#addButton').on("click", function () {
        var kodeSupplier = $('#kodeSupplier').val();
        var kodeBarang = $('#kodeBarang').val();
        var checkTable = $('table tbody');
        var existingRowSupplier = $('table tbody tr[id="' + kodeSupplier + '"]');
        var existingRowBarang = $('td[id="' + kodeBarang + '"]');
        console.log(existingRowBarang.length)
        console.log(kodeBarang)
        if (existingRowBarang.length > 0) {
            $('#pesanBarang').removeClass('d-none');
            return
        } else {
            if (existingRowSupplier.length < 1 && checkTable.find("tr").length !== 0) {
                $('#pesanSupplier').removeClass('d-none')
            } else {
                var namaBarang = $('#namaBarang').val();
                var harga = $('#harga').val();
                var jumlah = $('#jumlah').val();
                var total = $('#total').val();

                // Create the row HTML
                var newRow =
                    '<tr id="' + kodeSupplier + '">' +
                    '<td class="align-middle" data-field="kodeSupplier">' + kodeSupplier + '</td>' +
                    '<td class="align-middle" id="' + kodeBarang + '" data-field="kodeBarang">' + kodeBarang + '</td>' +
                    '<td class="align-middle" data-field="namaBarang">' + namaBarang + '</td>' +
                    '<td class="align-middle" data-field="harga">' + harga + '</td>' +
                    '<td class="align-middle" data-field="jumlah">' + jumlah + '</td>' +
                    '<td class="align-middle" data-field="total">' + total + '</td>' +
                    '<td>' +
                    '<button type="button" id="update-' + kodeBarang + '" class="btn btn-primary update-button mb-1 me-md-2"><i class="bi bi-trash"></i> Update</button>' +
                    '<button type="button" id="delete-' + kodeBarang + '" class="btn btn-danger delete-button mb-1"><i class="bi bi-trash"></i> Delete</button>' +
                    '</td>' +
                    '<td class="d-none">' +
                    '<input type="text" readonly hidden name="kodeSupplier[]" value="' + kodeSupplier + '"/>' +
                    '<input type="text" readonly hidden name="kodeBarang[]" value="' + kodeBarang + '"/>' +
                    '<input type="text" readonly hidden name="namaBarang[]" value="' + namaBarang + '"/>' +
                    '<input type="text" readonly hidden name="harga[]" value="' + toNumber(harga) + '"/>' +
                    '<input type="text" readonly hidden name="jumlah[]" value="' + jumlah + '"/>' +
                    '<input type="text" readonly hidden name="total[]" value="' + toNumber(total) + '"/>' +
                    '</td>' +
                    '</tr>';
                // Append the new row to the table
                $('table tbody').append(newRow);
                hitungTotalHarga()
            }
        }
        $('#kodeBarang').val('');
        $('#namaBarang').val('');
        $('#harga').val('');
        $('#jumlah').val('');
        $('#total').val('');

        // update button
        $('table').on("click", '.update-button', function () {
            var row = $(this).closest('tr');
            var kodeSupplier = row.attr('id');
            var kodeBarang = row.find('td[data-field="kodeBarang"]').text();
            var namaBarang = row.find('td[data-field="namaBarang"]').text();
            var harga = row.find('td[data-field="harga"]').text();
            var jumlah = row.find('td[data-field="jumlah"]').text();
            var total = row.find('td[data-field="total"]').text();
            $('#kodeSupplier').val(kodeSupplier);
            $('#kodeBarang').val(kodeBarang);
            $('#namaBarang').val(namaBarang);
            $('#harga').val(harga);
            $('#jumlah').val(jumlah);
            $('#total').val(total);
            row.remove();
            hitungTotalHarga()
        });
    });

    // delete button
    $('table').on("click", '.delete-button', function () {
        var row = $(this).closest('tr');
        row.remove();
        hitungTotalHarga()
    });
});
