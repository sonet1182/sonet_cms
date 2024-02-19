@extends('backend.layouts.master')

@section('title', 'Products')
@section('breadcrumb', 'Product List')

@section('content')

    <div class="card card-default">

        <div class="card-header">
            <div class="d-flex">
                <div class="ml-auto">
                    @can('product-create')
                        <a class="btn btn-sm btn-success" href="{{ route('products.create') }}"> <i class="fa fa-plus"
                                aria-hidden="true"></i> Create New Product </a>
                    @endcan
                </div>
            </div>
        </div>


        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>



    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('products.list') }}",
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr(
                            'content'));
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'detail',
                        name: 'detail'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@endsection
