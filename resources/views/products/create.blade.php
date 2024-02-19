@extends('backend.layouts.master')

@section('title', 'Add New Product')

@section('content')


    <span>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            @if (!empty($post))
                <input type="hidden" name="id" value="{{ $post->id }}" />
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-info  {{ !empty($post) ? 'alert-primary' : '' }}">
                            <h3 class="card-title panel-title float-left">
                                {{ !empty($post) ? 'Edit Product' : 'Add Product' }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control form-control-sm" id="title" name="name"
                                    placeholder="Enter title" value="{{ !empty($post) ? $post->name : '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                @if (!empty($post))
                                    <input class="slug_edit d-none" id="slug_edit" name="slug_edit" type="checkbox">
                                    <label for="slug_edit" class=" font-weight-normal text-success slug_fa" role="button"
                                        style="font-size: 10px;">
                                        <i class="fas fa-edit"></i>
                                    </label>
                                @endif
                                <input type="text"
                                    class="form-control form-control-sm {{ !empty($post) ?: 'slug_active' }}" id="slug"
                                    name="slug" placeholder="Enter Slug" value="{{ !empty($post) ? $post->slug : '' }}"
                                    autocomplete="off" {{ !empty($post) ? 'readonly' : '' }}>
                            </div>

                            <div class="form-group">
                                <label for="post_content">Description</label>
                                <div class="pad">
                                    <textarea xid="compose-textarea" class="form-control compose-textarea-summernote" name="detail">{{ !empty($post) ? $post->description : '' }}</textarea>
                                </div>
                            </div>


                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header card-info  {{ !empty($post) ? 'alert-primary' : '' }}">
                            <h3 class="card-title panel-title float-left">
                                Seo Settings
                            </h3>
                        </div><!-- end card-header-->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control form-control-sm {{ !empty($post) ?: '' }}"
                                    id="meta_title" name="meta_title" placeholder="Enter Meta Title"
                                    value="{{ !empty($post) ? $post->meta_title : '' }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta
                                    Description</label>
                                <input type="text" class="form-control form-control-sm {{ !empty($post) ?: '' }}"
                                    id="meta_description" name="meta_description" placeholder="Enter Meta Description"
                                    value="{{ !empty($post) ? $post->meta_description : '' }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="text" class="form-control form-control-sm {{ !empty($post) ?: '' }}"
                                    id="meta_keyword" name="meta_keyword" placeholder="Enter Meta Keyword"
                                    value="{{ !empty($post) ? $post->meta_keyword : '' }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="meta_author">Meta Author</label>
                                <input type="text" class="form-control form-control-sm {{ !empty($post) ?: '' }}"
                                    id="meta_author" name="meta_author" placeholder="Enter Meta Author"
                                    value="{{ !empty($post) ? $post->meta_author : '' }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-info">
                            <h3 class="card-title panel-title">Product Gallery</h3>
                            <h3 class="card-title panel-title float-right">
                                <a type="button" data-toggle="modal" data-target="#gallery" class="text-primary">Insert
                                    Image</a>
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="galleryimg row mx-auto">
                                <!-- product images and hidden fields -->
                                @if (!empty($product) && $product->product_image)
                                    @foreach ($product->product_image as $key => $photo)
                                        <?php
                                        $pimg = \App\Models\Media::where('id', $photo)->first();
                                        //echo $pimg->filename;
                                        ?>
                                        @if (!empty($pimg->id))
                                            <div class="product-img product-images col-md-2 col-3">
                                                <input type="hidden" name="galleryimg_id[]"
                                                    value="{{ $pimg->id }}">
                                                <img class="img-fluid"
                                                    src="{{ asset('/public/uploads/images/') . '/' . $pimg->filename }}">
                                                <a href="javascript:void()" class="remove"><span
                                                        class="fa fa-trash"></span></a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </form>
    </span>


    <?php echo \App\CustomClass\MediaManager::mediaScript(); ?>
    <?php echo \App\CustomClass\MediaManager::media('multiple', 'gallery', 'galleryimg'); ?>
    <?php echo \App\CustomClass\MediaManager::media('single', 'featured', 'featuredimg'); ?>


@endsection

@section('scripts')


    <script>
        $(".slug_edit").change(function() {
            // console.log(this.checked)
            $("#slug").attr('readonly', !this.checked)
            if (this.checked == true) {
                $("#slug").addClass('slug_active')
                $("label.slug_fa i").addClass('fa-check').removeClass('fa-edit')
            }
            if (this.checked == false) {
                $("#slug").removeClass('slug_active')
                $("label.slug_fa i").addClass('fa-edit').removeClass('fa-check')
            }
        })
        $("#title").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $(".slug_active").val(Text);
        });
    </script>

@endsection
