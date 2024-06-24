@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mt-2">
                            <h4 class="card-title">Visi Misi Tujuan</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('visi_misi_tujuan.create')}}" class="btn btn-primary" id="btn-tambah">Tambah Visi Misi</a>
                            <a href="{{ route('visi_misi_tujuan.edit')}}" class="btn btn-warning" id="btn-edit">Edit Visi Misi</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mt-4">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="col-2">Visi</th>
                                    <th class="col-1">=</th>
                                    <td class="col-9" id="isi_visi"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Misi</th>
                                    <th class="col-1">=</th>
                                    <td class="col-9" id="isi_misi"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Tujuan</th>
                                    <th class="col-1">=</th>
                                    <td class="col-9" id="isi_tujuan"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/admin/visi-misi-tujuan',
            method: 'GET',
            success: function(data) {
                var visi = $('#isi_visi');
                var misi = $('#isi_misi');
                var tujuan = $('#isi_tujuan');

                function appendContent(element, content) {
                    var isi = content;
                    var shortened = isi;
                    var showMore = '';
                    var fullText = '<span class="full-text d-none">' + isi + '</span>';

                    if (isi.length > 70) {
                        shortened = isi.substring(0, 70) + '...';
                        showMore = '<a href="#" class="read-more">Selengkapnya</a>';
                    }

                    element.append('<pre style="white-space: pre-wrap; background:000; font-family: sans-serif; line-height: 1.5;">' + shortened + ' ' + showMore + fullText + '</pre>');
                }

                appendContent(visi, data.vmt.isi_visi);
                appendContent(misi, data.vmt.isi_misi);
                appendContent(tujuan, data.vmt.isi_tujuan);

                // Event handler for "Selengkapnya"
                $(document).on('click', '.read-more', function(event) {
                    event.preventDefault();
                    $(this).siblings('.full-text').removeClass('d-none');
                    $(this).addClass('d-none');
                    $(this).parent().contents().filter(function() {
                        return this.nodeType == 3; // nodeType 3 adalah teks
                    }).first().replaceWith('');
                });

                // Tampilkan tombol "Tambah" jika tidak ada data
                $('#btn-tambah').addClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error('There has been a problem with your AJAX operation:', error);
            }
        });
    });
</script>
@endsection
