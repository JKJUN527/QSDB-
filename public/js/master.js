function setError(element, forStr, errorStr) {
    element.parent().addClass('error');
    $(".error[for='" + forStr + "']").html(errorStr);
    element.focus();
}

function removeError(element, forStr) {
    element.parent().removeClass('error');
    $(".error[for='" + forStr + "']").html("");
}
function checkResult(status,msg,element) {
    if(status == 200){
        $('#notes .modal-content').removeClass('notes-error');
        $('#notes .modal-content').addClass('notes-success');
    }else if(status == 400){
        $('#notes .modal-content').removeClass('notes-success');
        $('#notes .modal-content').addClass('notes-error');
    }
    $('#notes .modal-body').html(msg);
    if(element != null){
        element.modal('toggle');
    }
    $('#notes').modal('toggle');
    setTimeout(function(){
        window.location.reload();
    },1500)
}
function toggleModel(element) {
    element.modal('toggle');
}