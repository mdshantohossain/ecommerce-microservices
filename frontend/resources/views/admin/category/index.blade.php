@extends('admin.layouts.master')

@section('title', 'Categories')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">All Categories</h4>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm  waves-effect waves-light">
                        Add Category
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="align-middle">Sl.</th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Total Sub category</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(count($categories) !== 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ count($category->subCategories) }}
                                        </td>
                                        <td>
                                            <span class="badge badge-pill {{ $category->status === 1 ? 'badge-soft-success' : 'badge-soft-secondary' }}  font-size-11">{{ $category->status === 1 ? 'Published': 'Unpublished' }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary" >
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="#" class="btn btn-sm btn-danger" onclick='confirmDelete(event, "deleteForm-{{ $category->id }}")'>
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" id="deleteForm-{{ $category->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">
                                        <p class="text-center fs-5 mt-4">No category created yet</p>
                                    </td>
                                </tr>
                            @endif

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
