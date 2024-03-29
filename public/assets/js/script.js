function readURL(input) {
    if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
    $('.image-upload-wrap').hide();

    $('.file-upload-image').attr('src', e.target.result);
    $('.file-upload-content').show();

    };

    reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload();
    }
}
function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
    }
    $('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

function submitForm() {
    // Show loading indicator
    $('#loadingIndicator').show();

    // Simulate API request with a delay (replace with actual API call)
    setTimeout(() => {
    // Hide loading indicator
        $('#loadingIndicator').hide();
    }, 10000); // Simulating a delay of 10 seconds
}


