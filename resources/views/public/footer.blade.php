<footer class="bg-primary text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <!-- Hubungi Kami section aligned to the left -->
                <div class="d-flex flex-column justify-content-start">
                    <h3>Hubungi Kami</h3>
                    <p>Politeknik Negeri Banyuwangi</p>
                    <p>Jl. Raya Jember KM 13 Labanasem</p>
                    <p>Email: info@poliwangi.ac.id</p>
                    <div class="d-flex gap-3">
                        <a href="#"><img src="src/images/yt.png" alt="YouTube" class="img-fluid" style="width: auto; height: 45px;"></a>
                        <a href="#"><img src="src/images/ig.png" alt="Instagram" class="img-fluid mt-1" style="width: auto; height: 35px;"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="d-flex flex-column align-items-end">
                    <h3>Kerjasama Mitra</h3>
                    <div id="mitra-logos" class="d-flex flex-wrap justify-content-end align-items-center">
                        <!-- Dynamic logos will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p class="mb-0">© 2023 Copyright: <a href="#" class="text-white text-decoration-none">POLIWANGI</a></p>
        </div>
    </div>

</footer>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/public/beranda',
            method: 'GET',
            success: function(data) {
                var dataKerjasamaMitra = data.kategori.filter(kategori => kategori.nama == 'Kerjasama Mitra')[0].post;

                var mitraLogos = [];

                dataKerjasamaMitra.forEach(function(post) {
                    var imageUrls = post.deskripsi.match(/!\[\]\((.*?)\)/g);
                    if (imageUrls) {
                        imageUrls.forEach(function(imageUrl) {
                            var url = imageUrl.match(/\((.*?)\)/)[1]; // Extract the URL from the Markdown
                            mitraLogos.push(`<img src="${url}" alt="${post.judul}" class="img-fluid mx-3" style="height: 60px; border-radius: 10px;">`);
                        });
                    }
                });

                // Display initial set of logos
                function displayLogos(startIndex) {
                    $('#mitra-logos').empty();
                    for (var i = 0; i < 4; i++) {
                        var index = (startIndex + i) % mitraLogos.length;
                        $('#mitra-logos').append(mitraLogos[index]);
                    }
                }

                var currentStartIndex = 0;
                displayLogos(currentStartIndex);

                // Update logos every 2 seconds
                setInterval(function() {
                    currentStartIndex = (currentStartIndex + 4) % mitraLogos.length;
                    $('#mitra-logos').fadeOut(function() {
                        displayLogos(currentStartIndex);
                        $(this).fadeIn();
                    });
                }, 2000);
            },
            error: function(error) {
                console.error("An error occurred:", error);
            }
        });
    });
</script>
