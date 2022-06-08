@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">eCommerce</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Editează produs</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Editează produs</h5>
                    <hr>
                    <div class="form-body mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">

                                        <div class="mb-3">
                                            <label for="inputProductName" class="form-label">Nume</label>
                                            <input type="text" name="name" class="form-control" id="inputProductName"
                                                value="{{ $product->name }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductCode" class="form-label">Code</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputProductCode" value="{{ $product->product_code }}">
                                        </div>



                                        <div class="mb-3">
                                            <label for="image" class="form-label">Imagine Produs </label>
                                            <input class="form-control" name="image" type="file" id="image">
                                        </div>


                                        <div class="mb-3">
                                            <img id="showImage" src="{{ asset($product->image) }}"
                                                style="width:100px; height: 100px;">
                                        </div>




                                        <div class="mb-3">
                                            <label for="image_one" class="form-label">Imagine 1</label>
                                            <input class="form-control" name="image_one" type="file" id="image_one">
                                        </div>

                                        <div class="mb-3">
                                            <label for="image_two" class="form-label">Imagine 2</label>
                                            <input class="form-control" name="image_two" type="file" id="image_two">
                                        </div>

                                        <div class="mb-3">
                                            <label for="image_three" class="form-label">Imagine 3</label>
                                            <input class="form-control" name="image_three" type="file" id="image_three">
                                        </div>

                                        <div class="mb-3">
                                            <label for="image_four" class="form-label">Imagine 4</label>
                                            <input class="form-control" name="image_four" type="file" , id="image_four">
                                        </div>




                                        <div class="mb-3">
                                            <label for="inputProductShortDescription" class="form-label">Scurtă
                                                Descriere</label>
                                            <textarea name="short_description" class="form-control" id="inputProductShortDescription" rows="3"></textarea>
                                        </div>


                                        <div class="mb-3">
                                            <label for="inputProductLongDescription" class="form-label">Descriere
                                                Lungă</label>
                                            <textarea id="mytextarea" name="long_description">Hello, World!</textarea>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputPrice" class="form-label">Preț</label>
                                                <input type="text" name="price" class="form-control" id="inputPrice"
                                                    value="{{ $product->price }}">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="inputSpecial" class="form-label">Preț Special
                                                </label>
                                                <input type="text" name="special_price" class="form-control"
                                                    id="inputSpecial" value="{{ $product->special_price }}">
                                            </div>

                                            <div class="col-12">
                                                <label for="inputQty" class="form-label">Cantitate</label>
                                                <input type="text" name="qty" class="form-control" id="inputQty">
                                            </div>

                                            {{-- !! --}}


                                            <div class="col-12">
                                                <label for="inputProductCategory" class="form-label">Categorie</label>
                                                <select name="category" class="form-select" id="inputProductCategory">

                                                    <option selected="">Alege categoria</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->category_name }}"
                                                            {{ $item->category_name == $product->category ? 'selected' : '' }}>
                                                            {{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputProductSubcategory"
                                                    class="form-label">Subcategorie</label>
                                                <select name="subcategory" class="form-select"
                                                    id="inputProductSubcategory">

                                                    <option selected="">Alege subcategoria</option>
                                                    @foreach ($subcategory as $item)
                                                        <option value="{{ $item->subcategory_name }}"
                                                            {{ $item->subcategory_name == $product->subcategory ? 'selected' : '' }}>
                                                            {{ $item->subcategory_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-12">
                                                <label for="inputBrand" class="form-label">Brand</label>
                                                <select name="brand" class="form-select" id="inputBrand">
                                                    <option selected="">{{ $product->brand }}</option>
                                                    <option value="NIKE">NIKE</option>
                                                    <option value="GOE">GOE</option>
                                                    <option value="HUGO">HUGO</option>
                                                    <option value="PUMA">PUMA</option>

                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label">Mărime</label>
                                                <input type="text" name="size" class="form-control visually-hidden"
                                                    data-role="tagsinput" value="40,41,43,45">
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label">Culoare</label>
                                                <input type="text" name="color" class="form-control visually-hidden"
                                                    data-role="tagsinput" value="negru,alb,roșu">
                                            </div>


                                            <div class="form-check">
                                                <input class="form-check-input" name="remark" type="checkbox"
                                                    value="featured" id="flexCheckDefault1"
                                                    {{ $product->remark == 'featured' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault1">featured</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" name="remark" type="checkbox" value="new"
                                                    id="flexCheckDefault2"
                                                    {{ $product->remark == 'new' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault2">new</label>
                                            </div>


                                            <div class="form-check">
                                                <input class="form-check-input" name="remark" type="checkbox"
                                                    value="collection" id="flexCheckDefault3"
                                                    {{ $product->remark == 'collection' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault3">collection</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" name="remark" type="checkbox"
                                                    value="standard" id="flexCheckDefault4"
                                                    {{ $product->remark == 'standard' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault4">standard</label>
                                            </div>


                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Editează</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->


                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>





    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>


    <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js'
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection
