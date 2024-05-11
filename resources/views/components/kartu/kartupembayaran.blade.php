<table id="kartupembayaran" class="table table-bordered dt-responsive nowrap table-striped align-middle"
    style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Januari</th>
            <th>Februari</th>
            <th>Maret</th>
            <th>April</th>
            <th>Mei</th>
            <th>Juni</th>
            <th>Juli</th>
            <th>Agustus</th>
            <th>September</th>
            <th>Oktober</th>
            <th>November</th>
            <th>Desember</th>

        </tr>
    </thead>
    <tbody>
        <!-- Isi tabel di sini -->
    </tbody>
</table>
<script>
    $('#kartupembayaran').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('tagihan.getKartuPembayaranTagihan') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_siswa',
                name: 'nama_siswa'
            },
            {
                data: 'January',
                name: 'January'
            },
            {
                data: 'February',
                name: 'February'
            },
            {
                data: 'March',
                name: 'March'
            },
            {
                data: 'April',
                name: 'April'
            },
            {
                data: 'May',
                name: 'May'
            },
            {
                data: 'June',
                name: 'June'
            },
            {
                data: 'July',
                name: 'July'
            },
            {
                data: 'August',
                name: 'August'
            },
            {
                data: 'September',
                name: 'September'
            },
            {
                data: 'October',
                name: 'October'
            },
            {
                data: 'November',
                name: 'November'
            },
            {
                data: 'December',
                name: 'December'
            },
        ],
    })
</script>
