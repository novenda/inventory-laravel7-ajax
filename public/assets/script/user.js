$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

    load_datatable_users();
});

// Fungsi Load Data Tabel
function load_datatable_users(){
    $('#user-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "users/datatable",
                "type": "GET",
            },
    "columns": [
        {data: 'id',
        render : function(data, type, row, meta)
        {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { data: 'nik', name: 'nik' },
    { data: 'nama_lengkap', name: 'nama_lengkap' },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
         });
}

function save() {
    var id = $("#id").val();
    var nik = $("#nik").val();
    var name = $("#name").val();

    if (nik !== "" || name !== "") {
        $.ajax({
            url: "users/save",
            type: "POST",
            data: {
                id: id,
                nik: nik,
                name: name,
                password: password,
            },
            success: function (data) {
                if(data.code == 0){
                    swal("Gagal!", "Silakan Coba Lagi.", "error");
                } else {
                    swal("Tersimpan!", "Data Anda Sudah Tersimpan.", "success");
                    $("#Modal").modal("hide");
                    var oTable = $('#name-table').dataTable();
                    oTable.fnDraw(false);
                }
            },
        });
    } else {
        swal("Perhatian!", "Silakan Isikan Data Terlebih Dahulu.", "warning");
    }
}

function edit(p_id, p_kode, p_name) {
    $("#id").val(p_id);
    $("#nik").val(p_kode);
    $("#name").val(p_name);
    $("#password").val(p_password);
    $("#Modal").modal("show");
    $("#ModalLabel").html("Edit Master User");
}

function hapus(id, nik, name) {
    swal (
        {
          title: 'Yakin Hapus Data?',
          text : 'Kode Status : '+ nik +'\n Name : '+ name,
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Ya, Hapus Sekarang!',
          closeOnConfirm: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            $.ajax ({
                url: "users/hapus",
                type: "POST",
                data: {
                    id: id,
                },
                success: function (data) {
                    if(data.code == 0){
                        swal("Gagal!", "Silakan Coba Lagi.", "error");
                    } else {
                        swal("Terhapus!", "Data Anda Sudah Terhapus.", "success");
                        var oTable = $('#user-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
            });
          }
        }
      );
}

$("#Modal").on("hide.bs.modal", function () {
    $("#ModalLabel").html("Input Master User");
    $("#id").val("");
    $("#nik").val("");
    $("#name").val("");
});
