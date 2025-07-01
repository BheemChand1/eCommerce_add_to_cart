<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Product</h5>
                    <a href="{{route('product.create')}}" class="btn btn-primary">Create Product</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>

                            <tr>
                                <th scope="col">sr no.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date</th>
                                <th scope="col">
                                    Action
                                </th>
                            </tr>


                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        <img src="{{ asset('uploads/' . $product->image) }}" alt="Product Image"
                                            style="width: 60px !important; height: 60px !important; border-radius: 50% !important; object-fit: cover !important;">
                                    </td>


                                    <td>{{$product->price}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary">Edit</a>
                                        &emsp13;
                                        <form action="{{route('product.destroy', $product->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>