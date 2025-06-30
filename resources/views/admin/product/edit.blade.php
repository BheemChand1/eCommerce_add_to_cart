<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Edit Product</h5>
                    <a href="{{route('product.index')}}" class="btn btn-primary">All Products</a>
                </div>
                <div class="card-body">
                    <form action="{{route('product.update', $product->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Current Image Display --}}
                        @if($product->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <img src="{{asset('uploads/' . $product->image)}}" alt="Current Image"
                                        class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="productImage" class="form-label">Change Image</label>
                            <input type="file" class="form-control" id="productImage" name="image">
                            <small class="form-text text-muted">Leave empty to keep current image</small>
                        </div>

                        {{-- Current Multiple Images Display --}}
                        @if($product->images && count($product->images) > 0)
                            <div class="mb-3">
                                <label class="form-label">Current Images</label>
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-md-3 mb-2">
                                            <div class="position-relative">
                                                <img src="{{asset('uploads/' . $image->path)}}" alt="Product Image"
                                                    class="img-thumbnail" style="width: 100%;">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image"
                                                    data-image="{{$image}}">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="productImages" class="form-label">Add More Images</label>
                            <input type="file" class="form-control" id="productImages" name="images[]" multiple>
                            <small class="form-text text-muted">Select additional images to add</small>
                        </div>

                        <div class="mb-3">
                            <label for="productName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="productName" placeholder="Enter product name"
                                name="name" value="{{old('name', $product->name)}}">
                        </div>

                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" placeholder="Enter price"
                                name="price" value="{{old('price', $product->price)}}" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="productColors" class="form-label">Colours</label>
                            <select class="form-control" id="productColors" name="productColors[]" multiple>
                                <option value="">Select a color</option>
                                <option @selected(in_array('Red', $color)) value="Red">Red</option>
                                <option @selected(in_array('Blue', $color)) value="Blue">Blue</option>
                                <option @selected(in_array('Green', $color)) value="Green">Green</option>
                                <option @selected(in_array('Yellow', $color)) value="Yellow">Yellow</option>
                                <option @selected(in_array('Black', $color)) value="Black">Black</option>
                                <option @selected(in_array('White', $color)) value="White">White</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="shortDescription" class="form-label">Short Description</label>
                            <input type="text" class="form-control" id="shortDescription"
                                placeholder="Short summary of the product" name="short_description"
                                value="{{old('short_description', $product->short_description)}}">
                        </div>

                        <div class="mb-3">
                            <label for="productQty" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="productQty" placeholder="Available quantity"
                                name="qty" value="{{old('qty', $product->qty)}}">
                        </div>

                        <div class="mb-3">
                            <label for="productSKU" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="productSKU" placeholder="Stock Keeping Unit"
                                name="sku" value="{{old('sku', $product->sku)}}">
                        </div>

                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" rows="4"
                                placeholder="Full product description"
                                name="description">{{old('description', $product->description)}}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Update Product</button>
                            <a href="{{route('product.show', $product->id)}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <x-slot name="scripts">
        <!-- Place the first <script> tag in your HTML's <head> -->
        <script src="https://cdn.tiny.cloud/1/zxrzo7nqjsltkmmhdny4c4o1rx8pje6xgnfg51awphcfqmbt/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>

        <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: [
                    // Core editing features
                    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                    // Your account includes a free trial of TinyMCE premium features
                    // Try the most popular premium features until Jul 13, 2025:
                    'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
                ],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                    { value: 'First.Name', title: 'First Name' },
                    { value: 'Email', title: 'Email' },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
            });

            // Handle image removal
            document.addEventListener('DOMContentLoaded', function () {
                const removeButtons = document.querySelectorAll('.remove-image');
                removeButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const imagePath = this.getAttribute('data-image');
                        if (confirm('Are you sure you want to remove this image?')) {
                            // You can implement AJAX call here to remove the image
                            // or add a hidden input to track removed images
                            this.closest('.col-md-3').remove();

                            // Add hidden input to track removed images
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'removed_images[]';
                            hiddenInput.value = imagePath;
                            document.querySelector('form').appendChild(hiddenInput);
                        }
                    });
                });
            });
        </script>

    </x-slot>
</x-app-layout>