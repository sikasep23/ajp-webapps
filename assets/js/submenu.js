$(function () {
    $('#menu_id').select2({
        width: 'resolve'
    });

    const flashData = $('.flash-data').data('flashdata');
    //console.log(flashData);
    if (flashData) {
        swal({
            title: 'Menu Data',
            text: 'Successfully ' + flashData,
            type: 'success'
        });
    }

    $('.delete-button').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        swal({
            title: 'Are  you sure?',
            text: 'Menu data will be delete?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonClass: 'btn-secondary waves-effect',
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                document.location.href = href;
                //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            }
        });
    });

    $('.tambahData').on('click', function () {
        var url = $(this).data('url');
        $('.modal-body form').attr('action', '' + url + 'administrator/submenu');
        $('#newSubMenuLabel').html('Add New Submenu');
        $('#menu_id').select2("destroy").val('').select2();
        $('#title').val('');
        $('#priority').val('');
        $('#url').val('');
        $('.modal-footer button[type=submit]').html('Save');

    });

    $('.modalUpdate').on('click', function () {
        const id = $(this).data('id');
        var url = $(this).data('url');

        $('#newSubMenuLabel').html('Update Submenu');
        $('.modal-footer button[type=submit]').html('Update data');
        $('.modal-body form').attr('action', '' + url + 'administrator/updatesubmenu');

        $.ajax({
            url: ' ' + url + 'administrator/getsubmenu',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#title').val(data.title),
                    $('#id').val(data.id),
                    $('#menu_id').select2("destroy"),
                    $('#menu_id').val(data.menu_id),
                    $('#menu_id').select2(),
                    $('#url').val(data.url),
                    $('#priority').val(data.sort)
                    if (data.is_active == '1') {
                        $('#is_active').attr('checked', 'checked')
                    } else {
                        $('#is_active').removeAttr('checked')
                    }
            }
        })

    });
});