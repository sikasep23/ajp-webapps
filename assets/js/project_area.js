$(function () {
    
    function get_code() {
        $.ajax({
            url: "project_area_code",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#code_pa').val(data.code)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from database');
            }
        })
    }

    get_code();

    $("#pa").keyup(function () {
        var ucase = $(this).val().toUpperCase()
        $(this).val(ucase);
    });

    $("#address_pa").keyup(function () {
        var ucase = $(this).val().toUpperCase()
        $(this).val(ucase);
    });

    $("#npwp_pa").mask("99.999.999.9-999.999");

    var table;
    table = $('#pa_table').DataTable({
        "processing": true,
        "serverSide": true,
        "bInfo" : false,
        "order": [],
        "ajax": {
            "url": "project_area_get",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [-1],
                "orderable": false,
            },
        ],
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }

    $('#cancel').on('click', function () {
        $('#title-form').html('input data');
        $('action_stat').val('add');
        $('#form')[0].reset();
        get_code();
    });

    $(document).on('click', '#btnSave', function () {
        var code = $('#code_pa').val();
        var pa = $('#pa').val();
        console.log(code);

        if (pa == "" || pa == null) {
            swal("Error", "Field Project Area must be filled!", "error").die();
        }

        var action = $('#action_stat').val();
        console.log(action);
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (action != 'update') {
            url = "project_area_add";
        } else {
            url = "project_area_update";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {

                if (data.status) {
                    swal({
                        title: 'Project Area',
                        text: 'Successfully ' + action + '!',
                        type: 'success'
                    });
                    reload_table();
                }

                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
                $('action_stat').val('add');
                $('#form')[0].reset();
                get_code();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);

            }
        });

    });

    $(document).on('click', '#edit_pa', function () {
        var sid = $(this).data("sid");

        console.log(sid);
        $.ajax({
            url: "project_area_edit/" + sid,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#title-form').html('Update Data');
                $('[name="id"]').val(data.id);
                $('[name="code_pa"]').val(data.projectarea_code);
                $('[name="pa"]').val(data.projectarea_area);
                $('[name="npwp_pa"]').val(data.projectarea_npwp);
                $('[name="address_pa"]').val(data.projectarea_address);
                $('#action_stat').val('update');
                $('[name="code_pa"]').attr('readonly', 'readonly');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });

    $(document).on('click', '#delete_pa', function () {
        var did = $(this).data('did');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-secondary waves-effect',
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "project_area_delete/" + did,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        swal({
                            title: 'Project Area',
                            text: 'Successfully deleted!',
                            type: 'success'
                        });
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }

        });
    });


});