<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Data Pembayaran Batal</h5>
    </div>
    <div class="card-body">

        <div id="filter-bulan"></div>


        <div id="filter-nama"></div>


        <table id="paymentdatabatal" class="table table-bordered dt-responsive nowrap table-striped align-middle"
            style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tagihan Bulan</th>
                    <th>Tahun Tagihan</th>
                    <th>Jumlah Tagihan</th>
                    <th>Jumlah Dibayar</th>
                    <th>Sisa Tagihan</th>
                    <th>Tgl Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Keterangan</th>
                    <th>Bukti Transfer</th>
                    {{-- <th>User Input</th> --}}
                </tr>
            </thead>
            <tbody>
                <!-- Isi tabel di sini -->
            </tbody>
        </table>

    </div>
</div>
<script>
    $('#paymentdatabatal').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pembayaran.getDataPembayaranBatal') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'student_name',
                name: 'student_name'
            },
            {
                data: 'bulan_tagihan',
                name: 'bulan_tagihan'
            },
            {
                data: 'tahun_tagihan',
                name: 'tahun_tagihan'
            },
            {
                data: 'jumlah_tagihan',
                name: 'jumlah_tagihan'
            },
            {
                data: 'jumlah_pembayaran',
                name: 'jumlah_pembayaran'
            },

            {
                data: 'sisatagihan',
                name: 'sisatagihan'
            },
            {
                data: 'tanggal_pembayaran',
                name: 'tanggal_pembayaran'
            },
            {
                data: 'metode_pembayaran',
                name: 'metode_pembayaran'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            },
            {
                data: 'bukti_pembayaran',
                name: 'bukti_pembayaran'
            },
            // {
            //     data: 'user',
            //     name: 'user'
            // },
        ],
        // dom: 'lBfrtip', // Menampilkan elemen filter
        // buttons: [
        //     'csv', 'excel', 'pdf', // Menambahkan tombol eksport CSV, Excel, dan PDF
        //     {
        //         extend: 'print',
        //         text: 'Print',
        //         exportOptions: {
        //             modifier: {
        //                 selected: null
        //             }
        //         }
        //     }
        // ],
        // initComplete: function() {
        //     this.api().columns('1').every(function() {
        //         var column = this;
        //         var select = $('<select><option value="">Filter Nama</option></select>')
        //             .appendTo($('#filter-nama').empty())
        //             .on('change', function() {
        //                 var val = $.fn.dataTable.util.escapeRegex(
        //                     $(this).val()
        //                 );
        //                 column.search(val ? '^' + val + '$' : '', true, false).draw();
        //             });

        //         column.data().unique().sort().each(function(d, j) {
        //             select.append('<option value="' + d + '">' + d + '</option>');
        //         });
        //     });
        //     $('#filter-nama').appendTo('.dataTables_filter');
        //     // Membuat filter berdasarkan bulan
        //     this.api().columns('3').every(function() {
        //         var column = this;
        //         var select = $('<select><option value="">Filter Bulan</option></select>')
        //             .appendTo($('#filter-bulan')
        //                 .empty()) // ID filter-bulan adalah div tempat filter ditempatkan
        //             .on('change', function() {
        //                 var val = $.fn.dataTable.util.escapeRegex(
        //                     $(this).val()
        //                 );
        //                 column.search(val ? '^' + val + '$' : '', true, false).draw();
        //             });

        //         column.data().unique().sort().each(function(d, j) {
        //             select.append('<option value="' + d + '">' + d + '</option>');
        //         });
        //     });
        //     $('#filter-bulan').appendTo('.dataTables_filter');
        //     $('#filter-nama').appendTo('.dataTables_filter');
        // }


    });
</script>
