<!-- Media Library Modal -->
<div class="modal fade" id="mediaLibraryModal" tabindex="-1" aria-labelledby="mediaLibraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaLibraryModalLabel">Media Library</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="mediaLibraryBody">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        $(document).on('click', '#openMediaLibrary', function () {
            $('#mediaLibraryModal').modal('show');
            loadMediaLibrary();
        });

        function loadMediaLibrary() {
            $.ajax({
                url: '/api/admin/media',
                method: 'GET',
                success: function (data) {
                    var mediaLibraryBody = $('#mediaLibraryBody');
                    mediaLibraryBody.empty();
                    
                    data.media.forEach(function (file, index) {
                        var filePreview = '';
                        if (file.url.match(/\.(jpeg|jpg|gif|png|svg)$/) != null) {
                            filePreview = '<img src="' + file.url + '" class="card-img-top" alt="File" style="height: 150px; object-fit: cover;">';
                        } else if (file.url.match(/\.(pdf)$/) != null) {
                            filePreview = '<embed src="' + file.url + '" type="application/pdf" class="card-img-top" style="height: 150px;">';
                        } else {
                            filePreview = '<div class="card-img-top" style="height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">Unknown File</div>';
                        }

                        var card = `
                            <div class="col-md-2 mb-3">
                                <div class="card">
                                    ${filePreview}
                                    <div class="card-body text-center">
                                        <h6 class="card-title">${file.nama}</h6>
                                        <button type="button" class="btn btn-primary select-media-file mb-1" data-file-url="${file.url}">Select</button>
                                        <button type="button" class="btn btn-secondary preview-media-file" data-file-url="${file.url}">Preview</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        mediaLibraryBody.append(card);
                    });

                    data.mediaFiles.forEach(function (file, index) {
                        var filePreview = '';
                        if (file.url.match(/\.(jpeg|jpg|gif|png|svg)$/) != null) {
                            filePreview = '<img src="' + file.url + '" class="card-img-top" alt="File" style="height: 150px; object-fit: cover;">';
                        } else if (file.url.match(/\.(pdf)$/) != null) {
                            filePreview = '<embed src="' + file.url + '" type="application/pdf" class="card-img-top" style="height: 150px;">';
                        } else {
                            filePreview = '<div class="card-img-top" style="height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">Unknown File</div>';
                        }

                        var card = `
                            <div class="col-md-2 mb-3">
                                <div class="card">
                                    ${filePreview}
                                    <div class="card-body text-center">
                                        <h6 class="card-title">${file.name}</h6>
                                        <button type="button" class="btn btn-sm btn-primary select-media-file mb-1" data-file-url="${file.url}">Select</button>
                                        <button type="button" class="btn btn-sm btn-secondary preview-media-file" data-file-url="${file.url}">Preview</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        mediaLibraryBody.append(card);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }

        $('#mediaLibraryBody').on('click', '.preview-media-file', function () {
            var fileUrl = $(this).data('file-url');
            window.open(fileUrl, '_blank');
        });
    });
</script>
