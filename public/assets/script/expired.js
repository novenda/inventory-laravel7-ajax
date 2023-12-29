$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_expired();
});

// Fungsi Load Data Tabel
function load_datatable_expired(){
    $('#expired-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "expired/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id_master_expired', 
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'kode_expired', name: 'kode_expired' },
    { data: 'nama_expired', name: 'nama_expired' },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
         });
}

function save() {
    var id = $("#id").val();
    var kode_expired = $("#kode_expired").val();
    var nama_expired = $("#nama_expired").val();

    if (kode_expired !== "" || nama_expired !== "") {
        $.ajax({
            url: "expired/save",
            type: "POST",
            data: {
                id: id,
                kode_expired: kode_expired,
                nama_expired: nama_expired,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#expired-table').dataTable();
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
    $("#kode_expired").val(p_kode);
    $("#nama_expired").val(p_nama);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master Expired");
}

function hapus(id_master_expired, kode_expired, nama_expired) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ kode_expired +'\n Nama Expired : '+ nama_expired,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "expired/hapus",
                type: "POST",
                data: {
                    id_master_expired: id_master_expired,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#expired-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master Expired");
    $("#id").val("");
    $("#kode_expired").val("");
    $("#nama_expired").val("");
});