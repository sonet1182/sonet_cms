@extends('backend.layouts.master')

@section('title', 'Category')
@section('breadcrumb', 'Category')

@section('content')

    <div class="">

        <div class="card p-3">
            <div>
                <form class="row" action="{{ route('categories.store') }}" method="post">
                    @csrf

                    <div class="form-group col-md-4">
                        <label for="">Category Name:</label>
                        <input class="form-control" type="text" name="title" id="title" required>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="parent_id">Parent Category:</label>
                        <select name="parent_id" id="parent_id" class="form-control select2bs4">
                            <option value="">No Parent</option>
                            @foreach ($category_list as $id => $title)
                                <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success" type="submit">Add Category</button>
                    </div>
                </form>


            </div>
        </div>


        <div class="card p-3">

            <div class="row">
                <ul class="list-group col-md-6 mx-auto">
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <h5>{{ $category->title }}
                                <a class="btn btn-sm btn-danger float-right"
                                    href="{{ url('/categories/delete/' . $category->id) }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </h5>
                            @if (count($category->subCategories))
                                <ul class="list-group mt-2">
                                    @include('categories.subCategories', [
                                        'subCategories' => $category->subCategories,
                                    ])
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>


    @endsection
