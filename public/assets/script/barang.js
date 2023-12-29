$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_barang();
});

// Fungsi Load Data Tabel
function load_datatable_barang(){
    $('#barang-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "barang/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id_master_barang', 
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'kode_barang', name: 'kode_barang' },
    { data: 'nama_barang', name: 'nama_barang' },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
         });
}

function save() {
    var id = $("#id").val();
    var kode_barang = $("#kode_barang").val();
    var nama_barang = $("#nama_barang").val();

    if (kode_barang !== "" || nama_barang !== "") {
        $.ajax({
            url: "barang/save",
            type: "POST",
            data: {
                id: id,
                kode_barang: kode_barang,
                nama_barang: nama_barang,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#barang-table').dataTable();
                    oTable.fnDraw(false);
                }
            },
        });
    } else {
        swal("Perhatian!", "Silakan Isikan Data Terlebih Dahulu.", "warning");
    }
}

function edit(p_id, p_kode, p_nama) {
    $("#id").val(p_id);
    $("#kode_barang").val(p_kode);
    $("#nama_barang").val(p_nama);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master Barang");
}

function hapus(id_master_barang, kode_barang, nama_barang) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ kode_barang +'\n Nama Barang : '+ nama_barang,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "barang/hapus",
                type: "POST",
                data: {
                    id_master_barang: id_master_barang,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#barang-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master Barang");
    $("#id").val("");
    $("#kode_barang").val("");
    $("#nama_barang").val("");
});