var photo_counter = 0;
Dropzone.options.realDropzone = {

    uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 8,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',
    dictRemoveFileConfirmation: "Are you sure you wish to delete this image?",

    // The setting up of the dropzone
    init:function() {

        // Add server images
        var myDropzone = this;

        $.get('/admin/event/get-gallery/'+$("#event_id").val(), function(data) {

            $.each(data.images, function (key, value) {

                var file = {name: value.original, size: value.size};
                myDropzone.options.addedfile.call(myDropzone, file);
                myDropzone.createThumbnailFromUrl(file, '/uploads/event/gallery/original/' + value.server);
                myDropzone.emit("complete", file);
                $('.serverfilename', file.previewElement).val(value.server);
                photo_counter++;
                $("#photoCounter").text( "(" + photo_counter + ")");
            });
        });

        this.on("removedfile", function(file) {

            $.ajax({
                type: 'GET',
                url: '/admin/event/remove-gallery-image/',
                data: {file_name: $('.serverfilename', file.previewElement).val() , event_id:$("#event_id").val()},
                dataType: 'html',
                success: function(data){
                    var rep = JSON.parse(data);
                    if(rep.code == 200)
                    {
                        photo_counter--;
                        $("#photoCounter").text( "(" + photo_counter + ")");
                    }

                }
            });

        } );
    },
    error: function(file, response) {
        if($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function(file,response) {
        $('.serverfilename', file.previewElement).val(response.filename);
        photo_counter++;
        $("#photoCounter").text( "(" + photo_counter + ")");
    }
}