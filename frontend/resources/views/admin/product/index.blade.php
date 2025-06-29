@extends('admin.layouts.master')

@section('title', 'Products')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">All Products Information</h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm  waves-effect waves-light">
                        Add Product
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="align-middle">Sl.</th>
                                <th class="align-middle">Category Name</th>
                                <th class="align-middle">Sub-category Name</th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Price</th>
                                <th class="align-middle">Image</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->subCategory->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>
                                        <img src="{{ $product->main_image }}" height="80" width="100" class="rounded-2" alt="" />
                                    </td>
                                    <td>
                                            <span class="badge badge-pill {{ $product->status === 1 ? 'badge-soft-success' : 'badge-soft-secondary' }} font-size-11">
                                                {{ $product->status === 1 ? 'Published': 'Unpublished' }}
                                            </span>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary" >
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-success" >
                                                <i class="fa fa-book-open"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-danger" onclick='confirmDelete(event, "deleteForm-{{ $product->id }}")'>
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="deleteForm-{{ $product->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <p class="text-center fs-5 mt-4">Doesn't have any product </p>
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(event, formId) {
            if (confirm('Are you sure to delete this one?')) {
                event.preventDefault();
                document.getElementById(formId).submit();
            }
        }
    </script>
@endpush
