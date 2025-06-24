@extends('admin.layouts.master')

@section('title', 'Category edit')

@section('body')
    <div class="row">
        <div class="col-xl-6 mx-auto ">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Category edit form</h4>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm  waves-effect waves-light">
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $category->name }}" name="name" placeholder="Enter category name" />
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="radio" class="form-check-input" id="formrow-for-published" checked name="status" value="1" />
                                    <label for="formrow-for-published" class="form-check-label">Publish</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="radio" class="form-check-input" id="formrow-for-unpublished" name="status" value="0" />
                                    <label for="formrow-for-unpublished" class="form-check-label" >Unpublish</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md">Update</button>
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
