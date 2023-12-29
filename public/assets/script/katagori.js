$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_katagori();
});

// Fungsi Load Data Tabel
function load_datatable_katagori(){
    $('#katagori-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "katagori/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id_master_katagori', 
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'kode_katagori', name: 'kode_katagori' },
    { data: 'nama_katagori', name: 'nama_katagori' },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
         });
}

function save() {
    var id = $("#id").val();
    var kode_katagori = $("#kode_katagori").val();
    var nama_katagori = $("#nama_katagori").val();

    if (kode_katagori !== "" || nama_katagori !== "") {
        $.ajax({
            url: "katagori/save",
            type: "POST",
            data: {
                id: id,
                kode_katagori: kode_katagori,
                nama_katagori: nama_katagori,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#katagori-table').dataTable();
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
    $("#kode_katagori").val(p_kode);
    $("#nama_katagori").val(p_nama);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master Katagori");
}

function hapus(id_master_katagori, kode_katagori, nama_katagori) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ kode_katagori +'\n Nama Katagori : '+ nama_katagori,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "katagori/hapus",
                type: "POST",
                data: {
                    id_master_katagori: id_master_katagori,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#katagori-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master Katagori");
    $("#id").val("");
    $("#kode_katagori").val("");
    $("#nama_katagori").val("");
});