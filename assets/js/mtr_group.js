$(function () {
    $("input").keyup(function () {
        var ucase = $(this).val().toUpperCase()
        $(this).val(ucase);
    });

    function get_code() {
        $.ajax({
            url: "material_group_code",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $("#code").val('MTG' + data.code)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get code data from ajax');
            }
        });
    }
    get_code();

    $('#add').on('click', function () {
        get_code();
        $('.custom-modal-title').text('Create New Material Group');
        $('form')[0].reset();
        $('.help-block').empty();
        $('#method').val('add');
        var modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#modal-master-group',
                width: '70%'
            }
        });
        modal.open();
    });    

    var table;
    table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "bInfo": false,
        "order": [],
        "ajax": {
            "url": "material_group_get",
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

    $(document).on('click', '#btnSave', function () {
        var code = $('#code').val();
        var type = $('#type').val();
        var group = $('#group').val();
        var cat = $('#plc-cat').val();
        var subcat = $('#plc-subcat').val();
        var logcat = $('#logistic-cat').val();
        if (code == "" || code == null || type == "" || type == null || group == "" || group == null || cat == "" || cat == null || subcat == "" || subcat == null || logcat == "" || logcat == null) {
            toastr["error"]("Required field cannot empty!!")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            },
            die();
        }
        var action = $('#method').val();
        console.log(action);
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;
        if (action != 'update') {
            url = "material_group_add";
        } else {
            url = "material_group_update";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    Custombox.modal.close();
                    swal({
                        title: 'Material group',
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
            url: "material_group_edit/" + sid,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                
                $('form')[0].reset();
                $('#title-form').html('Update Data');
                $('#method').val('update');
                $('[name="id"]').val(data.id);
                $('[name="code"]').val(data.material_gro_code);
                $('[name="group"]').val(data.material_gro_group);
                $('[name="type"]').val(data.material_gro_type);
                $('[name="plc-cat"]').val(data.material_gro_pc_cat);
                $('[name="plc-subcat"]').val(data.material_gro_pc_subcat);
                $('[name="logistic-cat"]').val(data.material_gro_log_cat);
                //$('[name="matcat_category"]').val(data.matcat_category);
                var modal = new Custombox.modal({
                    content: {
                        effect: 'fadein',
                        target: '#modal-master-group',
                        width: '70%'
                    }
                });
                modal.open();
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