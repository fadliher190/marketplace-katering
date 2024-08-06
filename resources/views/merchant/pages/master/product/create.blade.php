@extends('merchant.layout.dashboard')
@section('title')
    Tambah Produk Baru
@endsection
@section('content')
    <form action="{{ route('merchant.product.store') }}" method="POST" class="w-full">
        @csrf
        @include('merchant.layout.messages')
        <div class="grid grid-cols-2 gap-3">
            <div class="col-span-2 mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                <label for="name" class="capitalize">Nama Produk</label>
                <input type="text" name="name" id="name" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0" value="{{ old('name') }}">
            </div>
            <div class="col-span-2 mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                <label for="price" class="capitalize">Harga Produk</label>
                <input type="text" name="price" id="price" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0" value="{{ old('price') }}">
            </div>
            <div class="col-span-1 mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                <label for="description" class="capitalize">Deskripsi Produk</label>
                <textarea name="description" rows="6" id="description" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">{{ old('description') }}</textarea>
            </div>
            <div class="col-span-1 mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                <label for="#" class="capitalize">Gambar</label>
                <div class="flex flex-row gap-4">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="w-20 flex flex-col justify-center">
                            <div class="w-full aspect-square bg-slate-300 relative border-2 border-slate-200">
                                <img src="" alt="" class="hidden" id="imageView{{$i}}" class="absolute top-0 left-0 bottom-0 right-0 cursor-pointer">
                                <input type="file" id="inputImage{{$i}}" class="inputimage absolute top-0 left-0 bottom-0 right-0 opacity-0 cursor-pointer" data-index="{{$i}}">
                                <input type="hidden" name="imagePost[]" id="imagePost{{$i}}" class="h-full w-full opacity-0">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="col-span-2 mt-2 flex flex-row gap-2 min-w-80 sm:min-w-full">
                <div class="flex-auto"></div>
                <button class="bg-blue-400 px-4 py-1 rounded-md text-white"><i class="fa-solid fa-plus"></i> Simpan Product</button>
            </div>
        </div>
    </form>

@endsection

@section('modal')
    <div id="modal" class="fixed top-0 left-0 bottom-0 right-0 backdrop-blur-sm bg-slate-200/10 flex items-center justify-center hidden">
        <div class="w-1/4 flex  flex-col gap-3">
            <div class="w-full aspect-square oveflow-hidden">
                <img src="" alt="" id="img-preview" class="w-full h-full">
            </div>
            <div class="w-full">
                <a href="javascript:void(0)" class="block text-center w-full bg-blue-400 text-white p-1" id="saveImage">Simpan Gambar</a>
            </div>
        </div>

    </div>
@endsection


@section('style-css-child')
    <link rel="stylesheet" href="{{ asset('assets/css/cropper.css') }}">
@endsection
@section('script-js-child')
    <script src="{{ asset('assets/js/cropper.js') }}"></script>
    <script>
        $(document).ready(function () {
            var image = $('#img-preview');
            var cropper;
            let tempId = null;

            $('.inputimage').on('change', function (e) {

                tempId = $(e.target).data('index');

                var files = e.target.files;
                var done = function (url) {
                    $("#modal").removeClass('hidden')
                    image.attr('src', url);
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image[0], {
                        aspectRatio: 1 / 1,
                        crop: function(event) {}
                    });
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                    $("#saveImage").removeClass('hidden')
                }
            });

            $("#saveImage").on('click', (e) => {
                if (cropper) {
                    var croppedCanvas = cropper.getCroppedCanvas();
                    var croppedImage = croppedCanvas.toDataURL('image/png');
                    $('#imagePost'+tempId).val(croppedImage)
                    $('#imageView'+tempId).attr('src', croppedImage)
                    $('#imageView'+tempId).removeClass("hidden")
                    $('#inputImage'+tempId).addClass("hidden")
                    $("#modal").addClass('hidden')
                }
            })
        });
    </script>
@endsection
