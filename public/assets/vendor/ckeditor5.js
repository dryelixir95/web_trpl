import {
    ClassicEditor,
    AccessibilityHelp,
    Alignment,
    Autoformat,
    AutoImage,
    AutoLink,
    Autosave,
    BalloonToolbar,
    BlockQuote,
    Bold,
    Clipboard,
    CloudServices,
    Code,
    Essentials,
    FindAndReplace,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    GeneralHtmlSupport,
    Heading,
    Highlight,
    HorizontalLine,
    HtmlEmbed,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    Markdown,
    MediaEmbed,
    Mention,
    Paragraph,
    PasteFromMarkdownExperimental,
    PasteFromOffice,
    SelectAll,
    SimpleUploadAdapter,
    SourceEditing,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Table,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TextTransformation,
    TodoList,
    Underline,
    Undo,
    Plugin,
    ButtonView
} from 'ckeditor5';

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

class UploadPlugin extends Plugin {
    init() {
        const editor = this.editor;

        editor.ui.componentFactory.add('uploadButton', locale => {
            const view = new ButtonView(locale);

            view.set({
                label: 'Upload',
                tooltip: true,
                withText: true
            });

            // Callback executed once the toolbar button is clicked.
            view.on('execute', () => {
                // Trigger the modal with id "mediaLibraryModal"
                $('#mediaLibraryModal').modal('show');
                loadMediaLibrary();
            });

            // Render view and then apply styles
            view.on('render', () => {
                if (view.element) {
                    view.element.style.backgroundColor = 'rgb(0, 0, 0)';
                    view.element.style.color = 'white';
                    view.element.style.border = 'none';
                    view.element.style.padding = '3px 10px';
                    view.element.style.borderRadius = '10px';
                }
            });

            return view;
        });
    }
}

function loadMediaLibrary() {
    $.ajax({
        url: '/api/admin/media',
        method: 'GET',
        success: function (data) {
            var mediaLibraryBody = $('#mediaLibraryBody');
            mediaLibraryBody.empty();
            
            data.media.forEach(function (media, index) {
                var filePreview = '';
                if (media.media.match(/\.(jpeg|jpg|gif|png|svg)$/) != null) {
                    filePreview = '<img src="/media/' + media.media + '" class="card-img-top" alt="File" style="height: 150px; object-fit: cover;">';
                } else if (media.media.match(/\.(pdf)$/) != null) {
                    filePreview = '<embed src="/media/' + media.media + '" type="application/pdf" class="card-img-top" style="height: 150px;">';
                } else {
                    filePreview = '<div class="card-img-top" style="height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">Unknown File</div>';
                }

                var card = `
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="card">
                            ${filePreview}
                            <div class="card-body text-center">
                                <h6 class="card-title">${media.media}</h6>
                                <button type="button" class="btn btn-sm btn-primary select-media-file mb-1" data-file-url="/media/${media.media}">Select</button>
                                <button type="button" class="btn btn-sm btn-secondary preview-media-file" data-file-url="/media/${media.media}">Preview</button>
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
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="card">
                            ${filePreview}
                            <div class="card-body text-center">
                                <h6 class="card-title">${file.name}</h6>
                                <button type="button" class="btn btn-sm btn-primary select-media-file mb-1" data-file-url="/media/ckeditor/${file.name}">Select</button>
                                <button type="button" class="btn btn-sm btn-secondary preview-media-file" data-file-url="/media/ckeditor/${file.name}">Preview</button>
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

$('#mediaLibraryBody').on('click', '.select-media-file', function () {
    var fileUrl = $(this).data('file-url');
    var editorInstance = window.editor;
    
    if (editorInstance) {
        // Insert the image URL into the editor
        editorInstance.model.change(writer => {
            const imageElement = writer.createElement('imageBlock', {
                src: fileUrl
            });
            editorInstance.model.insertContent(imageElement, editorInstance.model.document.selection);
        });
    }

    $('#mediaLibraryModal').modal('hide');
});

$('#kategori-post').on('change', function () {
    var kategoriId = $(this).val();
    var selectedKategori = window.dataKategori.find(kategori => kategori.id == kategoriId);
    window.selectedKategori = selectedKategori;

    handleTypeHalaman(selectedKategori);
});

function handleTypeHalaman(selectedKategori) {
    var contentContainer = $('#contentContainer');
    contentContainer.empty(); // Kosongkan konten sebelumnya

    if (selectedKategori.type_halaman == 'single-artikel') {
        $.ajax({
            url: `/api/admin/post/${selectedKategori.id}/artikel`,
            method: 'GET',
            success: function (data) {
                var textarea = `
                        <div class="col mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi/isi</label>
                            <textarea class="form-control" id="editor" name="keterangan" rows="10"></textarea>
                        </div>
                `;
                contentContainer.append(textarea);

                ClassicEditor.create(document.querySelector('#editor'), editorConfig)
                    .then(editor => {
                        if (data.post) {
                            editor.setData(data.post.deskripsi); // Muat konten artikel jika ada
                            
                            $('#judul').val(data.post.judul);
                            $('#tanggal').val(data.post.tanggal);
                            $('#submitButton').hide();
                            $('#uploadButton').show();
                        } else {
                            $('#submitButton').show();
                            $('#uploadButton').hide();
                            $('#judul').val('');
                            $('#tanggal').val('');
                            $('#selected-tags-container').empty();
                        }
                        window.editor = editor;
                        editor.editing.view.document.on('clipboardInput', (evt, data) => {
                            console.log('Paste event triggered', data);
                        });
                    })
                    .catch(error => {
                        console.error('Failed to initialize CKEditor:', error);
                    });
                    
            },
            error: function (xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    }
}


const editorConfig = {
    toolbar: {
        items: [
            'undo',
            'redo',
            '|',
            'sourceEditing',
            '|',
            'heading',
            '|',
            'fontSize',
            'fontFamily',
            'fontColor',
            'fontBackgroundColor',
            '|',
            'bold',
            'italic',
            'underline',
            '|',
            'link',
            'insertImage',
            'insertTable',
            'highlight',
            'blockQuote',
            '|',
            'alignment',
            '|',
            'bulletedList',
            'numberedList',
            'todoList',
            'outdent',
            'indent',
            '|',
            'uploadButton',
        ],
        shouldNotGroupWhenFull: true
    },
    plugins: [
        AccessibilityHelp,
        Alignment,
        Autoformat,
        AutoImage,
        AutoLink,
        Autosave,
        BalloonToolbar,
        BlockQuote,
        Bold,
        Clipboard,
        CloudServices,
        Code,
        Essentials,
        FindAndReplace,
        FontBackgroundColor,
        FontColor,
        FontFamily,
        FontSize,
        GeneralHtmlSupport,
        Heading,
        Highlight,
        HorizontalLine,
        HtmlEmbed,
        ImageBlock,
        ImageCaption,
        ImageInline,
        ImageInsert,
        ImageInsertViaUrl,
        ImageResize,
        ImageStyle,
        ImageTextAlternative,
        ImageToolbar,
        ImageUpload,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        List,
        ListProperties,
        Markdown,
        MediaEmbed,
        Mention,
        Paragraph,
        PasteFromMarkdownExperimental,
        PasteFromOffice,
        SelectAll,
        SimpleUploadAdapter,
        SourceEditing,
        SpecialCharacters,
        SpecialCharactersArrows,
        SpecialCharactersCurrency,
        SpecialCharactersEssentials,
        SpecialCharactersLatin,
        SpecialCharactersMathematical,
        SpecialCharactersText,
        Strikethrough,
        Table,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        TextTransformation,
        TodoList,
        Underline,
        Undo,
        UploadPlugin, // Daftarkan plugin save
    ],
    balloonToolbar: ['bold', 'italic', '|', 'link', 'insertImage', '|', 'bulletedList', 'numberedList'],
    fontFamily: {
        supportAllValues: true
    },
    fontSize: {
        options: [10, 12, 14, 'default', 18, 20, 22],
        supportAllValues: true
    },
    heading: {
        options: [
            {
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
            },
            {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
            },
            {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
            },
            {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
            },
            {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4'
            },
            {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5'
            },
            {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6'
            }
        ]
    },
    htmlSupport: {
        allow: [
            {
                name: /^.*$/,
                styles: true,
                attributes: true,
                classes: true
            }
        ]
    },
    image: {
        toolbar: [
            'toggleImageCaption',
            'imageTextAlternative',
            '|',
            'imageStyle:inline',
            'imageStyle:wrapText',
            'imageStyle:breakText',
            '|',
            'resizeImage'
        ]
    },
    initialData:
        '',
    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://',
        decorators: {
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                    download: 'file'
                }
            }
        }
    },
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true
        }
    },
    mention: {
        feeds: [
            {
                marker: '@',
                feed: [
                    /* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
                ]
            }
        ]
    },
    menuBar: {
        isVisible: true
    },
    placeholder: 'Type or paste your content here!',
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
    },
    simpleUpload: {
        uploadUrl: '/api/admin/media/ckeditor', // Ganti dengan URL API unggah Anda
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#editor');

    if (editorElement) {
        ClassicEditor.create(editorElement, editorConfig)
            .then(editorInstance => {
                window.editor = editorInstance;
                editorInstance.editing.view.document.on('clipboardInput', (evt, data) => {
                    console.log('Paste event triggered', data);
                });
            })
            .catch(error => {
                console.error('Failed to initialize CKEditor:', error);
            });
    }
});
