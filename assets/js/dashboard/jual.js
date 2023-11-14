const hitungTotalHarga = () => {
    let totalHarga = 0;
    $('table tbody tr').each(function () {
        let hargaBarang = parseFloat($(this).find('td[data-field="total"]').text().replace(/[^0-9,-]+/g, "").replace(',', '.'));
        totalHarga += hargaBarang
    });
    $('#total_harga').val(formattedTotal(totalHarga)); // Update elemen input total
}
const formattedTotal = (total) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total / 1);
}
const toNumber = (total) => {
    return parseFloat(total.replace(/[^0-9,-]+/g, "").replace(',', '.'));
}
$(document).ready(function () {
    $("#jumlah_uang").on("keyup", function () {
        var value = $(this).val().replace(/\D/g, '');
        $(this).val(formattedTotal(value / 100));
        let totalHarga = toNumber($('#total_harga').val());
        let jumlahUang = toNumber($('#jumlah_uang').val());
        let kembalian = formattedTotal(jumlahUang - totalHarga)
        $('#kembalian').val(kembalian)
    });

    $("#myInput").on("keyup", function () {
        $(window).on("click", function () {
            $("#myList button").addClass('d-none');
        });
        var value = $(this).val().toLowerCase();
        if (value.length > 3) {
            $("#myList button").filter(function () {
                if ($(this).text().toLowerCase().indexOf(value) > -1) {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }
            });
        } else {
            $("#myList button").addClass('d-none');
        }
    });
    $("#myList button").on("click", function () {
        var buttonValue = $(this).text();
        // Cari data barang berdasarkan kode yang cocok
        var selectedBarang = barangData.find(function (barang) {
            return barang.kode === buttonValue;
        });

        if (selectedBarang) {
            let total = selectedBarang.harjul * $('#qty').val()
            $('#kode').val(selectedBarang.kode);
            $('#nama_barang').val(selectedBarang.nama);
            $('#harpok').val(formattedTotal(parseFloat(selectedBarang.harpok)));
            $('#harjul').val(formattedTotal(parseFloat(selectedBarang.harjul)));
            $('#stok').val(selectedBarang.stok);
            $('#total').val(formattedTotal(total));
        }
        $(window).on("click", function () {
            $('#myInput').val('')
            $("#myList button").addClass('d-none');
        });
    });
    $('#qty').on("keyup", function () {
        let harga = toNumber($('#harjul').val());
        let qty = parseFloat($('#qty').val());
        let diskon = parseFloat($('#diskon').val());
        let total = (qty * harga) - ((qty * harga * diskon) / 100);
        $('#total').val(formattedTotal(total));
    });
    $('#diskon').on("keyup", function () {
        let harga = toNumber($('#harjul').val());
        let qty = parseFloat($('#qty').val());
        let diskon = parseFloat($('#diskon').val());
        let total = (qty * harga) - ((qty * harga * diskon) / 100);
        $('#total').val(formattedTotal(total));
    });
    $('#addButton').on("click", function () {
        var kode = $('#kode').val();

        // Check if a row with the same kode already exists
        var existingRow = $('table tbody tr[id="' + kode + '"]');

        if (existingRow.length > 0) {
            $('#pesan').removeClass('d-none')
        } else {
            var nama_barang = $('#nama_barang').val();
            var harpok = $('#harpok').val();
            var harjul = $('#harjul').val();
            var stok = $('#stok').val();
            var qty = $('#qty').val();
            var diskon = $('#diskon').val();
            var total = $('#total').val();

            // Create the row HTML
            var newRow =
                '<tr id="' + kode + '">' +
                '<td class="align-middle" data-field="kode">' + kode + '</td>' +
                '<td class="align-middle" data-field="nama_barang">' + nama_barang + '</td>' +
                '<td class="align-middle" data-field="harpok">' + harpok + '</td>' +
                '<td class="align-middle" data-field="harjul">' + harjul + '</td>' +
                '<td class="align-middle" data-field="qty">' + qty + '</td>' +
                '<td class="align-middle" data-field="diskon">' + diskon + '</td>' +
                '<td class="align-middle" data-field="total">' + total + '</td>' +
                '<td>' +
                '<button id="update-' + kode + '" class="btn btn-primary update-button mb-1 me-md-2"><i class="bi bi-trash"></i> Update</button>' +
                '<button id="delete-' + kode + '" class="btn btn-danger delete-button mb-1"><i class="bi bi-trash"></i> Delete</button>' +
                '</td>' +
                '<td class="d-none">' +
                '<input type="text" readonly hidden name="kode[]" value="' + kode + '"/>' +
                '<input type="text" readonly hidden name="nama_barang[]" value="' + nama_barang + '"/>' +
                '<input type="text" readonly hidden name="harpok[]" value="' + harpok + '"/>' +
                '<input type="text" readonly hidden name="harjul[]" value="' + harjul + '"/>' +
                '<input type="text" readonly hidden name="stok[]" value="' + stok + '"/>' +
                '<input type="text" readonly hidden name="qty[]" value="' + qty + '"/>' +
                '<input type="text" readonly hidden name="diskon[]" value="' + diskon + '"/>' +
                '<input type="text" readonly hidden name="total[]" value="' + total + '"/>' +
                '</td>' +
                '</tr>';
            // Append the new row to the table
            $('table tbody').append(newRow);
            hitungTotalHarga()
        }
        $('#kode').val('');
        $('#nama_barang').val('');
        $('#harpok').val('');
        $('#harjul').val('');
        $('#stok').val('');
        $('#diskon').val(0);
        $('#qty').val(1);
        $('#total').val('');
    });

    $('table').on("click", '.delete-button', function () {
        var row = $(this).closest('tr');
        var kode = row.attr('id');
        row.remove();
        hitungTotalHarga()
    });
    $('table').on("click", '.update-button', function () {
        var row = $(this).closest('tr');
        var kode = row.attr('id');

        // Ambil nilai dari elemen-elemen td dalam baris yang akan dihapus
        var nama_barang = row.find('td[data-field="nama_barang"]').text();
        var harpok = row.find('td[data-field="harpok"]').text();
        var harjul = row.find('td[data-field="harjul"]').text();
        var stok = row.find('td[data-field="stok"]').text();
        var diskon = row.find('td[data-field="diskon"]').text();
        var qty = row.find('td[data-field="qty"]').text();
        var total = row.find('td[data-field="total"]').text();


        // Masukkan nilai-nilai ke dalam elemen input
        $('#kode').val(kode);
        $('#nama_barang').val(nama_barang);
        $('#harpok').val(harpok);
        $('#harjul').val(harjul);
        $('#stok').val(stok);
        $('#diskon').val(diskon);
        $('#qty').val(qty);
        $('#total').val(total);

        // Hapus baris dari tabel
        row.remove();
        hitungTotalHarga()
    });

});