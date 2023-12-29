$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_gudang();
});

// Fungsi Load Data Tabel
function load_datatable_gudang(){
    $('#gudang-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "gudang/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id_master_gudang', 
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'kode_gudang', name: 'kode_gudang' },
    { data: 'nama_gudang', name: 'nama_gudang' },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
         });
}

function save() {
    var id = $("#id").val();
    var kode_gudang = $("#kode_gudang").val();
    var nama_gudang = $("#nama_gudang").val();

    if (kode_gudang !== "" || nama_gudang !== "") {
        $.ajax({
            url: "gudang/save",
            type: "POST",
            data: {
                id: id,
                kode_gudang: kode_gudang,
                nama_gudang: nama_gudang,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#gudang-table').dataTable();
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
    $("#kode_gudang").val(p_kode);
    $("#nama_gudang").val(p_nama);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master Gudang");
}

function hapus(id_master_gudang, kode_gudang, nama_gudang) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ kode_gudang +'\n Nama Gudang : '+ nama_gudang,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "gudang/hapus",
                type: "POST",
                data: {
                    id_master_gudang: id_master_gudang,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#gudang-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master Gudang");
    $("#id").val("");
    $("#kode_gudang").val("");
    $("#nama_gudang").val("");
});