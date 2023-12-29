$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_staff();
});

// Fungsi Load Data Tabel
function load_datatable_staff(){
    $('#staff-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "staff/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id_master_staff',
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'kode_staff', name: 'kode_staff' },
    { data: 'nama_staff', name: 'nama_staff' },
    { data: 'password', name: 'password' },
    { data: 'level', name: 'level' },
    { data: 'username', name: 'username' },
    { data: 'wilayah', name: 'wilayah' },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
         });
}

function save() {
    var id = $("#id").val();
    var kode_staff = $("#kode_staff").val();
    var nama_staff = $("#nama_staff").val();
    var password = $("#password").val();
    var level = $("#level").val();
    var username = $("#username").val();
    var wilayah = $("#wilayah").val();
    if (kode_staff !== "" || nama_staff !== "") {
        $.ajax({
            url: "staff/save",
            type: "POST",
            data: {
                id: id,
                kode_staff: kode_staff,
                nama_staff: nama_staff,
                password: password,
                level: level,
                username: username,
                wilayah: wilayah,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#staff-table').dataTable();
                    oTable.fnDraw(false);
                }
            },
        });
    } else {
        swal("Perhatian!", "Silakan Isikan Data Terlebih Dahulu.", "warning");
    }
}

function edit(p_id, p_kode, p_nama, p_password, p_level, p_username, p_wilayah) {
    $("#id").val(p_id);
    $("#kode_staff").val(p_kode);
    $("#nama_staff").val(p_nama);
    $("#password").val(p_password);
    $("#level").val(p_level);
    $("#username").val(p_username);
    $("#wilayah").val(p_wilayah);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master Staff");
}

function hapus(id_master_staff, kode_staff, nama_staff) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ kode_staff +'\n Nama Staff : '+ nama_staff,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "staff/hapus",
                type: "POST",
                data: {
                    id_master_staff: id_master_staff,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#staff-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master Staff");
    $("#id").val("");
    $("#kode_staff").val("");
    $("#nama_staff").val("");
    $("#password").val("");
    $("#level").val("");
    $("#username").val("");
    $("#wilayah").val("");
});
