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
                    <h5>Create Product</h5>
                    <a href="{{route('product.index')}}" class="btn btn-primary">All Product</a>
                </div>
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="productImage" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Select multiple images</label>
                            <input type="file" class="form-control" id="productImage" name="images[]" multiple>
                        </div>

                        <div class="mb-3">
                            <label for="productName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="productName" placeholder="Enter product name"
                                name="name">
                        </div>

                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" placeholder="Enter price"
                                name="price">
                        </div>

                        <div class="mb-3">
                            <label for="productColors" class="form-label">Colours</label>
                            <select class="form-control" id="productColors" name="productColors[]" multiple>
                                <option value="">Select a color</option>
                                <option value="Red">Red</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                                <option value="Yellow">Yellow</option>
                                <option value="Black">Black</option>
                                <option value="White">White</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="shortDescription" class="form-label">Short Description</label>
                            <input type="text" class="form-control" id="shortDescription"
                                placeholder="Short summary of the product" name="short_description">
                        </div>

                        <div class="mb-3">
                            <label for="productQty" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="productQty" placeholder="Available quantity"
                                name="qty">
                        </div>

                        <div class="mb-3">
                            <label for="productSKU" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="productSKU" placeholder="Stock Keeping Unit"
                                name="sku">
                        </div>

                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" rows="4"
                                placeholder="Full product description" name="description"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
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
        </script>

    </x-slot>
</x-app-layout>