$('.checkbox').click(function () {
    if ($(this).hasClass("permission-active")) {
        turnOff($(this));
    } else {
        turnOn($(this));
    }

    updateInput();
});

function turnOn(_checkbox) {
    _checkbox.html("<i class='mdi mdi-check'></i>");
    _checkbox.addClass("permission-active");

    const checkboxPermissionItem = _checkbox.closest('.permission-item');
    const checkboxPermissionParent = checkboxPermissionItem.parents('.permission-item').eq(0);

    if (checkboxPermissionParent.hasClass('permission-item')) {
        turnOn(checkboxPermissionParent.find('.checkbox').eq(0));
    }
}

function turnOff(_checkbox) {
    _checkbox.html("");
    _checkbox.removeClass("permission-active");

    const checkboxPermissionItem = _checkbox.closest('.permission-item');


    checkboxPermissionItem.find(".checkbox").removeClass("permission-active").html("");
}

function updateInput() {
    let anchors = [];

    $(".permission-active").each(function () {
        anchors.push($(this).data('anchor'));
    });

    if (anchors.length == 0) {
        $("#anchors").val('');
        return false;
    }

    $("#anchors").val(JSON.stringify(anchors));

}

$(function () {
    if (anchors) {

        anchors = JSON.parse(anchors);

        anchors.forEach((anchor) => {
           $(`.checkbox[data-anchor="${anchor}"]`).html("<i class='mdi mdi-check'></i>").addClass("permission-active");
        });

        updateInput();
    }
});


