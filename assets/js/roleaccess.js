$('.form-check-input').on('click', function(){
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');
    const submenuID = $(this).data('submenu')
    var url = $(this).data('url');
    var encode = $(this).data('encode');

    $.ajax({
        url: ''+url+'administrator/changeaccess',
        type:'post',
        data: {
            submenuID:submenuID,
            menuId:menuId,
            roleId:roleId
        },
        success: function(){
            document.location.href = ''+url+'administrator/roleaccess/'+encode+''
        }
    })
})