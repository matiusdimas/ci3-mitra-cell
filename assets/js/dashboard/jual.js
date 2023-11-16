const hitungTotalHarga = () => {
    let totalHarga = 0;
    $('table tbody tr').each(function () {
        let hargaBarang = parseFloat($(this).find('td[data-field="total"]').text().replace(/[^0-9,-]+/g, "").replace(',', '.'));
        totalHarga += hargaBarang
    });
    $('#intTotalHarga').val(totalHarga);
    $('#totalHarga').val(formattedTotal(totalHarga));
}
const formattedTotal = (total) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total / 1);
}
const toNumber = (total) => {
    return parseFloat(total.replace(/[^0-9,-]+/g, "").replace(',', '.'));
}
$(document).ready(function () {
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
            $('#kode').val(selectedBarang.kode);
            $('#namaBarang').val(selectedBarang.nama);
            $('#jumlah').val(1);
            $('#harpok').val(formattedTotal(selectedBarang.harpok));
            $('#harjul').val(formattedTotal(selectedBarang.harjul));
            $('#stok').val(selectedBarang.stok);
            $('#total').val(formattedTotal(selectedBarang.harjul));
        }
        $('#barangFilter').val('');
    })

    // jumlah func
    $("#jumlahUang").on("keyup", function () {
        var value = $(this).val().replace(/\D/g, '');
        $(this).val(formattedTotal(value / 100));
        let totalHarga = toNumber($('#totalHarga').val());
        let jumlahUang = toNumber($('#jumlahUang').val());
        let kembalian = formattedTotal(jumlahUang - totalHarga);
        $('#intJumlahUang').val(toNumber($('#jumlahUang').val()));
        $('#intKembalian').val(toNumber(kembalian));
        $('#kembalian').val(kembalian)
    });


    // qty func
    $('#qty').on("keyup", function () {
        let harga = toNumber($('#harjul').val());
        let qty = parseFloat($('#qty').val());
        let diskon = parseFloat($('#diskon').val());
        let total = (qty * harga) - ((qty * harga * diskon) / 100);
        $('#total').val(formattedTotal(total));
    });

    // diskon func
    $('#diskon').on("keyup", function () {
        let harga = toNumber($('#harjul').val());
        let qty = parseFloat($('#qty').val());
        let diskon = parseFloat($('#diskon').val());
        let total = (qty * harga) - ((qty * harga * diskon) / 100);
        $('#total').val(formattedTotal(total));
    });

    // add button
    $('#addButton').on("click", function () {
        var kode = $('#kode').val();
        var existingRow = $('table tbody tr[id="' + kode + '"]');
        if (existingRow.length > 0) {
            $('#pesan').removeClass('d-none')
        } else {
            var namaBarang = $('#namaBarang').val();
            var harpok = $('#harpok').val();
            var harjul = $('#harjul').val();
            var stok = $('#stok').val();
            var qty = $('#qty').val();
            var diskon = $('#diskon').val();
            var total = $('#total').val();
            var newRow =
                '<tr id="' + kode + '">' +
                '<td class="align-middle" data-field="kode">' + kode + '</td>' +
                '<td class="align-middle" data-field="namaBarang">' + namaBarang + '</td>' +
                '<td class="align-middle" data-field="harpok">' + harpok + '</td>' +
                '<td class="align-middle" data-field="harjul">' + harjul + '</td>' +
                '<td class="align-middle" data-field="qty">' + qty + '</td>' +
                '<td class="align-middle" data-field="diskon">' + diskon + '</td>' +
                '<td class="align-middle" data-field="total">' + total + '</td>' +
                '<td>' +
                '<button type="button" id="update-' + kode + '" class="btn btn-primary update-button mb-1 me-md-2"><i class="bi bi-trash"></i> Update</button>' +
                '<button type="button" id="delete-' + kode + '" class="btn btn-danger delete-button mb-1"><i class="bi bi-trash"></i> Delete</button>' +
                '</td>' +
                '<td class="d-none">' +
                '<input type="text" readonly hidden name="kode[]" value="' + kode + '"/>' +
                '<input type="text" readonly hidden name="namaBarang[]" value="' + namaBarang + '"/>' +
                '<input type="text" readonly hidden name="harpok[]" value="' + toNumber(harpok) + '"/>' +
                '<input type="text" readonly hidden name="harjul[]" value="' + toNumber(harjul) + '"/>' +
                '<input type="text" readonly hidden name="stok[]" value="' + stok + '"/>' +
                '<input type="text" readonly hidden name="qty[]" value="' + qty + '"/>' +
                '<input type="text" readonly hidden name="diskon[]" value="' + diskon + '"/>' +
                '<input type="text" readonly hidden name="total[]" value="' + toNumber(total) + '"/>' +
                '</td>' +
                '</tr>';
            $('table tbody').append(newRow);
            hitungTotalHarga()
        }
        $('#kode').val('');
        $('#namaBarang').val('');
        $('#harpok').val('');
        $('#harjul').val('');
        $('#stok').val('');
        $('#diskon').val(0);
        $('#qty').val(1);
        $('#total').val('');
    });

    // delete button
    $('table').on("click", '.delete-button', function () {
        var row = $(this).closest('tr');
        row.remove();
        hitungTotalHarga()
    });

    // update button
    $('table').on("click", '.update-button', function () {
        var row = $(this).closest('tr');
        var kode = row.attr('id');
        var namaBarang = row.find('td[data-field="namaBarang"]').text();
        var harpok = row.find('td[data-field="harpok"]').text();
        var harjul = row.find('td[data-field="harjul"]').text();
        var stok = row.find('td[data-field="stok"]').text();
        var diskon = row.find('td[data-field="diskon"]').text();
        var qty = row.find('td[data-field="qty"]').text();
        var total = row.find('td[data-field="total"]').text();
        $('#kode').val(kode);
        $('#namaBarang').val(namaBarang);
        $('#harpok').val(harpok);
        $('#harjul').val(harjul);
        $('#stok').val(stok);
        $('#diskon').val(diskon);
        $('#qty').val(qty);
        $('#total').val(total);
        row.remove();
        hitungTotalHarga()
    });

});