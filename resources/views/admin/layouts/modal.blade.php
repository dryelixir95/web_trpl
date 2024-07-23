<!-- Media Library Modal -->
<div class="modal fade" id="mediaLibraryModal" tabindex="-1" aria-labelledby="mediaLibraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaLibraryModalLabel">Media Library</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>File Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="mediaLibraryBody">
                            <!-- Dynamic content will be loaded here -->
                        </tbody>
                    </table>
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

        $('#mediaLibraryBody').on('click', '.select-media-file', function () {
            var fileUrl = $(this).data('file-url');
            var fileInput = $('#openMediaLibrary').siblings('input[type="file"]');
            var filePreview = '';

            if (fileUrl.match(/\.(jpeg|jpg|gif|png|svg)$/) != null) {
                filePreview = '<img src="' + fileUrl + '" alt="Image Preview" style="width: 500px; height: auto; margin-top: 10px;">';
            } else if (fileUrl.match(/\.(pdf)$/) != null) {
                filePreview = '<embed src="' + fileUrl + '" type="application/pdf" style="width: 500px; height: 750px; margin-top: 10px;">';
            }

            fileInput.siblings('.file-preview').remove(); // Remove previous previews
            fileInput.after('<div class="file-preview text-center">' + filePreview + '</div>');

            $('#selectedMediaFile').val(fileUrl);
            $('#mediaLibraryModal').modal('hide');
        });

        function loadMediaLibrary() {
            $.ajax({
                url: '/api/admin/media',
                method: 'GET',
                success: function (data) {
                    var mediaLibraryBody = $('#mediaLibraryBody');
                    mediaLibraryBody.empty();
                    
                    data.media.forEach(function (file) {
                        var row = '<tr>';
                        row += '<td><img src="/media/' + file.media + '" alt="File" width="50"></td>';
                        row += '<td>' + file.nama + '</td>';
                        row += '<td><button type="button" class="btn btn-primary select-media-file" data-file-url="' + file.url + '">Select</button></td>';
                        row += '</tr>';
                        mediaLibraryBody.append(row);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });
        }
    });
</script>
