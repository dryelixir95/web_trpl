document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const container = document.querySelector('#table-custom');
    if (container) {
        window.hot = new Handsontable(container, {
            rowHeaders: true,
            colHeaders: ['Column 1', 'Column 2', 'Column 3'],
            contextMenu: true,
            manualRowMove: true,
            manualColumnMove: true,
            licenseKey: 'non-commercial-and-evaluation',
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ],
            colWidths: [150, 150, 150],
            afterOnCellMouseDown: function(event, coords, td) {
                if (coords.row === -1) { // Click on header
                    const colIndex = coords.col;
                    const headerCell = td;

                    if (!headerCell.querySelector('input')) {
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.value = window.hot.getColHeader()[colIndex] || '';
                        headerCell.innerHTML = '';
                        headerCell.appendChild(input);
                        input.focus();

                        input.addEventListener('blur', function() {
                            const newHeader = input.value.trim();
                            if (newHeader) {
                                const currentHeaders = window.hot.getColHeader();
                                currentHeaders[colIndex] = newHeader;
                                window.hot.updateSettings({
                                    colHeaders: currentHeaders
                                });
                            }
                            headerCell.innerHTML = newHeader;
                        });
                    }
                }
            }
        });
    }

    function fileRenderer(instance, td, row, col, prop, value, cellProperties) {
        Handsontable.renderers.BaseRenderer.apply(this, arguments);
        td.innerHTML = `<input type="file" onchange="handleFileChange(event, ${row}, ${col})"/>`;
        if (value) {
            const extension = value.split('.').pop();
            if (['jpg', 'jpeg', 'png', 'svg'].includes(extension)) {
                td.innerHTML += `<br><img src="${value}" class="file-preview" style="max-width: 100px; max-height: 100px;" />`;
            } else if (['pdf'].includes(extension)) {
                const fileName = value.split('/').pop();
                td.innerHTML += `<br><div class="file-preview">${fileName}</div>`;
            } else {
                const fileName = value.split('/').pop();
                td.innerHTML += `<br><div class="file-preview">${fileName}</div>`;
            }
        }
    }
    
    window.handleFileChange = function(event, row, col) {
        const file = event.target.files[0];

        if (file) {
            var formData = new FormData();
            formData.append('file', file);
    
            $.ajax({
                url: '/api/admin/media/handsontable',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    window.hot.setDataAtCell(row, col, data.url);
                },
                error: function(xhr, status, error) {
                    console.error('There has been a problem with your AJAX operation:', error);
                }
            });        }
    }

    window.addColumn = function(type) {
        let newColumn = {};
        let newHeader = '';

        if (type === 'file') {
            newColumn = { renderer: fileRenderer };
            newHeader = 'File';
        } else {
            newColumn = { type: 'text' };
            newHeader = 'Text';
        }

        const currentData = window.hot.getData();
        currentData.forEach(row => row.push(null));

        window.hot.updateSettings({
            data: currentData,
            columns: window.hot.getSettings().columns.concat(newColumn),
            colHeaders: window.hot.getColHeader().concat(newHeader),
            colWidths: window.hot.getSettings().colWidths.concat(150)
        });
    }

    window.removeColumn = function() {
        const currentColumns = window.hot.getSettings().columns;
        if (currentColumns.length > 0) {
            currentColumns.pop();
            const currentData = window.hot.getData();
            currentData.forEach(row => row.pop());

            window.hot.updateSettings({
                data: currentData,
                columns: currentColumns,
                colHeaders: window.hot.getColHeader().slice(0, -1),
                colWidths: window.hot.getSettings().colWidths.slice(0, -1)
            });
        }
    }
});
