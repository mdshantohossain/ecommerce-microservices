@extends('admin.layouts.master')

@section('title', 'Product create')

@section('body')
    <div class="row">
        <div class="col-xl-8 mx-auto ">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Product create form</h4>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm  waves-effect waves-light">
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Select category<span class="text-danger">*</span></label>

                            <select name="category_id" class="form-select" id="categoryId">
                                <option value="">Select product category</option>
                                @forelse($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ $category->id === old('category_id') ? 'selected' : '' }}
                                    >{{ $category->name }}</option>
                                @empty
                                    <option value="">haven't any category</option>
                                @endforelse
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Select sub-category<span class="text-danger">*</span></label>
                            <select name="sub_category_id" class="form-select">
                                <option value="">Select product sub-category</option>
                                @forelse($subCategories as $subCategory)
                                    <option
                                        value="{{ $subCategory->id }}"
                                        {{ $subCategory->id === old('sub_category_id') ? 'selected' : '' }}
                                    >{{ $subCategory->name }}</option>
                                @empty
                                    <option value="">haven't any category</option>
                                @endforelse
                            </select>
                            @error('sub_category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Enter product name" />
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Regular price<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('regular_price') }}" name="regular_price" placeholder="Enter regular price" />
                            @error('regular_price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Setting price<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('selling_price') }}" name="selling_price" placeholder="Enter selling price" />
                            @error('selling_price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Discount <sub>(tk/%)</sub><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('discount') }}" name="discount" placeholder="Enter discount amount" />
                            @error('discount')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Quantity<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" min="1" value="{{ old('quantity') }}" name="quantity" placeholder="Enter product quantity" />
                            @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Short description<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="short_description" rows="3"  placeholder="Enter product's short description">{{ old('short_description') }}</textarea>
                            @error('short_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Long description</label>
                            <textarea class="form-control" name="long_description" rows="5" placeholder="Enter product's long description">{{ old('long_description') }}</textarea>
                            @error('long_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Main image<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="main_image"  />
                            @error('main_image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Other images<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" multiple name="other_images[]"  />
                            @error('other_images')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('other_images.*')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="radio" class="form-check-input" id="formrow-for-published" @checked(old('status') === 1) checked name="status" value="1" />
                                    <label for="formrow-for-published" class="form-check-label">Publish</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="radio" class="form-check-input" id="formrow-for-unpublished" @checked(old('status') === 0) name="status" value="0" />
                                    <label for="formrow-for-unpublished" class="form-check-label" >Unpublish</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md">Create</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection


@push('scripts')
    <script>

        document.addEventListener('DOMContentLoaded',  function () {
            const subCategorySelect = document.querySelector('select[name="sub_category_id"]');

            document.getElementById('categoryId').addEventListener('change',  (e) => {
                const categoryId = e.target.value;

                if(categoryId) {
                    fetch(`/get-sub-categories/${categoryId}`)
                        .then(res => res.json())
                        .then(res => {
                            subCategorySelect.innerHTML = '<option value="">Select product sub-category</option>';

                            if(res.length > 0) {
                                res.forEach(subCategory => {
                                    const option = document.createElement('option');
                                    option.value = subCategory.id;
                                    option.textContent = subCategory.name;
                                    subCategorySelect.appendChild(option);
                                })
                            }
                        });
                }
            });
        });

    </script>
@endpush
