function toggleButton(isEnabled, selector) {
    if (isEnabled) {
        $(selector).prop('disabled', false); // Activer le bouton
    } else {
        $(selector).prop('disabled', true);  // Désactiver le bouton
    }


}function loader(isEnabled) {
    if (isEnabled) {
        $.blockUI();
        $('#loading-img').attr('display', 'yes')
    } else {
        $.unblockUI();
        $('#loading-img').attr('display', 'no')
    }
}

function loaderTesxt(isEnabled,text) {
    if (isEnabled) {
        $.blockUI();
        $('#loading-img').attr('display', 'yes')
        $('#loading-img').attr('alt', text)
    } else {
        $.unblockUI();
        $('#loading-img').attr('display', 'no')
        $('#loading-img').attr('alt', text)
    }
}