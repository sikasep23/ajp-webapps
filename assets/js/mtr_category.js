$(function () {

    function get_code() {
        $.ajax({
            url: "material_category_code",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $("#matcat_code").val('MTC' + data.code)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get code data from ajax');
            }
        });
    }

    get_code();

    var table;
    table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "bInfo": false,
        "order": [],
        "ajax": {
            "url": "material_category_get",
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
        $('[id^="matcat"]').val('');
        $('#matcat_type').select2('destroy');
        $('#matcat_stmain').select2('destroy');
        $('.select2').val('');
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "Select an option",
            width: "resolve"
        });
        $('#action_stat').val('added');
        get_code();
    });

    $('[id^="matcat"]').keyup(function () {
        var ucase = $(this).val().toUpperCase()
        $(this).val(ucase);
    });

    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "Select an option",
        width: "resolve"
    });

    $(document).on('click', '#btnSave', function () {
        var category = $('#matcat_category').val();
        var type = $('#matcat_type').val();
        var stmain = $('#matcat_stmain').val();
        if (category == "" || category == null || type == "" || type == null || stmain == "" || stmain == null) {
            swal("Error", "Required field must be filled!", "error").die();
        }
        var action = $('#action_stat').val();
        console.log(action);
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;
        if (action != 'update') {
            url = "material_category_add";
        } else {
            url = "material_category_update";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    swal({
                        title: 'Material Category',
                        text: 'Successfully ' + action + '!',
                        type: 'success'
                    });
                    reload_table();
                    get_code();
                }
                $('#title-form').html('Input Data');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
                $('#form')[0].reset();
                $('#matcat_type').select2('destroy');
                $('#matcat_stmain').select2('destroy');
                $('.select2').val('');
                $('.select2').select2({
                    theme: 'bootstrap4',
                    placeholder: "Select an option",
                    width: "resolve"
                });
                $('#action_stat').val('add');
                get_code();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            }
        });

    });

    $(document).on('click', '#edit', function () {
        var sid = $(this).data("sid");
        console.log(sid);
        $.ajax({
            url: "material_category_edit/" + sid,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#title-form').html('Update Data');
                $('#action_stat').val('update');
                $('[name="id"]').val(data.id);
                $('[name="matcat_code"]').val(data.matcat_code);
                $('[name="matcat_category"]').val(data.matcat_category);
                $('#matcat_type').select2('destroy');
                $('#matcat_stmain').select2('destroy');
                $('#matcat_type').val(data.matcat_type);
                $('#matcat_stmain').val(data.matcat_stmain);
                $('.select2').select2({
                    theme: 'bootstrap4',
                    placeholder: "Select an option",
                    width: "resolve"
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });

    $(document).on('click', '#delete', function () {
        var did = $(this).data('did');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this !",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-secondary waves-effect',
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "material_category_delete/" + did,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        swal({
                            title: 'Material category',
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