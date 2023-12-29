$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_hakakses();
});

// Fungsi Load Data Tabel
function load_datatable_hakakses(){
    $('#hakakses-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "hakakses/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id_master_hakakses', 
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'kode_hakakses', name: 'kode_hakakses' },
    { data: 'nama_hakakses', name: 'nama_hakakses' },
    { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
         });
}

function save() {
    var id = $("#id").val();
    var kode_hakakses = $("#kode_hakakses").val();
    var nama_hakakses = $("#nama_hakakses").val();

    if (kode_hakakses !== "" || nama_hakakses !== "") {
        $.ajax({
            url: "hakakses/save",
            type: "POST",
            data: {
                id: id,
                kode_hakakses: kode_hakakses,
                nama_hakakses: nama_hakakses,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#hakakses-table').dataTable();
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
    $("#kode_hakakses").val(p_kode);
    $("#nama_hakakses").val(p_nama);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master Hakakses");
}

function hapus(id_master_hakakses, kode_hakakses, nama_hakakses) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ kode_hakakses +'\n Nama Hakakses : '+ nama_hakakses,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "hakakses/hapus",
                type: "POST",
                data: {
                    id_master_hakakses: id_master_hakakses,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#hakakses-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master Hakases");
    $("#id").val("");
    $("#kode_hakakses").val("");
    $("#nama_hakakses").val("");
});