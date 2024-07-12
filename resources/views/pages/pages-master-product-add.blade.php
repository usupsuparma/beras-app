@extends('layouts.master-layouts')

@section('title')
    Tambah Produk
@endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Produk</h4>
                    <p class="card-title-desc">Mohon Isi Data dibawah ini</p>
                </div>
                <form id="product-form" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="productname">Nama Produk</label>
                                    <input id="productname" name="nama" type="text" class="form-control"
                                        placeholder="Nama Produk" required>
                                </div>
                                <div class="mb-3">
                                    <label class="control-label">Jenis</label>
                                    <select class="form-control select2" name="jenis" required>
                                        <option>Select</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Biasa">Biasa</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price">Harga</label>
                                    <input id="price" name="harga" type="number" class="form-control"
                                        placeholder="Harga" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="productdesc">Deskripsi Produk</label>
                                    <textarea name="deskripsi" class="form-control" id="productdesc" rows="5" placeholder="Deskripsi Produk"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="images">Gambar Produk</label>
                                    <input type="file" class="form-control" id="images" multiple
                                        onchange="previewImages()">
                                    <div id="image-preview" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                onclick="submitForm()">Simpan
                                Perubahan</button>
                            <button type="reset" class="btn btn-secondary waves-effect waves-light"
                                onclick="resetPreview()">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.init.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script>
        let selectedFiles = [];

        function previewImages() {
            var files = document.getElementById('images').files;

            if (files) {
                [].forEach.call(files, readAndPreview);
            }

            function readAndPreview(file) {
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                }

                selectedFiles.push(file);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var div = document.createElement('div');
                    div.classList.add('image-container');

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail');

                    var removeButton = document.createElement('button');
                    removeButton.innerText = 'Hapus';
                    removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-image');
                    removeButton.onclick = function() {
                        var index = selectedFiles.indexOf(file);
                        if (index > -1) {
                            selectedFiles.splice(index, 1);
                        }
                        div.remove();
                    };

                    div.appendChild(img);
                    div.appendChild(removeButton);
                    document.getElementById('image-preview').appendChild(div);
                }
                reader.readAsDataURL(file);
            }
        }

        function resetPreview() {
            document.getElementById('image-preview').innerHTML = '';
            selectedFiles = [];
        }

        function submitForm() {
            let formData = new FormData(document.getElementById('product-form'));

            selectedFiles.forEach(file => {
                formData.append('images[]', file);
            });

            fetch('{{ route('master.product.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // if (data)
                    Swal.fire({
                        title: "Success!",
                        text: "Sukses menambahakn produk!",
                        icon: "success"
                    });
                    // Handle success or redirect as needed
                })
                .catch(error => {
                    console.error('Error:', error);

                    Swal.fire({
                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "error"
                    });
                });
        }
    </script>

    <style>
        .image-container {
            position: relative;
            display: inline-block;
            margin: 5px;
        }

        .image-container img {
            max-width: 150px;
            max-height: 150px;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    </style>
@endsection
