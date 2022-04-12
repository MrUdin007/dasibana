@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($product) ? 'Edit Product' : 'Add Product' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($product) ? route('be.product.edit', $product->id) : route('be.product.create') }}">
                            {{ isset($product) ? 'Edit Product' : 'Add Product' }}
                        </a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row gap-20 pos-r">
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <div class="grid_layouts --two-auto">
						<div class="head-lst">
							<h3 class="page-title">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h3>
						</div>
					</div>
                    <div>
                        <form method="POST" class="form-vegan" id="formProduct" action="{{ isset($product) ? $api_url.'product/update' : $api_url.'product/store' }}">
                            <input type="hidden" name="id" id="id" value="{{ isset($product) ? $product->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="code">Product Code
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Product Code" value="{{ isset($product) ? $product->code : '' }}" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="supplier" class="control-label">Supplier</label>
                                    <div class="single-slct">
                                        <select class="form-control select2" name="supplier_id" id="supplier_id">
                                            <option selected disabled>--Select Supplier--</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                    @if(isset($product) && $product->supplier_id == $supplier->id)
                                                        selected
                                                    @endif
                                                >{{ $supplier->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="supplier" class="control-label">
                                        Product Category
                                        <span class="required_label">*</span>
                                    </label>
                                    <div class="multple-selects2">
                                        <select class="form-control select2" name="categories[]" id="categories" multiple="multiple" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @isset($product)
                                                        @foreach ($product_categories as $item)
                                                            @if ($category->id == $item->category_id)
                                                                selected
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                    >{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="name">Product Name
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="{{ isset($product) ? $product->name : '' }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description
                                    <span class="required_label">*</span>
                                </label>
                                <textarea id="prddescription" name="description" required>{{ isset($product) ? $product->description : '' }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="price">Product Price
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="number" min="0" class="form-control" id="price" name="price" placeholder="Product Price" value="{{ isset($product) ? $product->price : '' }}" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="discount">Discount Type</label>
                                    <select class="form-control select2" name="discount_type" id="discount_type">
                                        @foreach ($discount as $key => $item)
                                            <option value="{{ $key }}"
                                                @if (isset($product) && $product->discount_type == $key)
                                                    selected
                                                @endif
                                            >   {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="discount">Discount</label>
                                    <input type="number" min="0" step=".01" class="form-control" id="discount" name="discount" placeholder="Product Discount" value="{{ isset($product) ? $product->discount : 0 }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="discount">Discount Price</label>
                                    <input type="number" min="0" step=".01" class="form-control" id="discount_price" name="discount_price" placeholder="Discount Price" disabled>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="weight">Product Weight
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="number" min="0" class="form-control" id="weight" name="weight" placeholder="Product Weight" value="{{ isset($product) ? $product->weight : '' }}" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="stock">Stock
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="Product Stock" value="{{ isset($product) ? $product->stock : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="additional_note">Additional Note</label>
                                    <textarea id="additional_note" name="additional_note" class="form-control">{{ isset($product) ? $product->additional_note : '' }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tags">Product Tags
                                        <span class="required_label">*</span>
                                    </label>
                                    <div class="multple-selects2">
                                        <select class="form-control select2" name="tags[]" id="tags" multiple="multiple" required>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    @isset($product)
                                                        @foreach ($product_tags as $item)
                                                            @if ($tag->id == $item->tag_id)
                                                                selected
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                >   {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex" style="gap: 60px;">
                                <div class="form-group">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                        @if(isset($product) && $product->is_active == true)
                                            checked
                                        @endif
                                        >
                                        <label for="is_active" class="custom-control-label">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_new" id="is_new"
                                            @if(isset($product) && $product->is_new == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_new" class="custom-control-label">
                                            New
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_sale" id="is_sale"
                                            @if(isset($product) && $product->is_sale == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_sale" class="custom-control-label">
                                            Sale
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_preorder" id="is_preorder"
                                            @if(isset($product) && $product->is_preorder == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_preorder" class="custom-control-label">
                                            Preorder
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_bawang" id="is_bawang"
                                            @if(isset($product) && $product->is_bawang == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_bawang" class="custom-control-label">
                                            Bawang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_variant" id="is_variant"
                                            @if(isset($product) && $product->is_variant == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_variant" class="custom-control-label">
                                            Kaos
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card" style="margin-bottom: 10px;">
                                        <div class="card-body box-shadow-op">
                                            <div class="d-flex align-items-center mb-4">
                                                <h4 class="card-title">
                                                    Produk Cover
                                                    <span class="required_label">*</span>
                                                </h4>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn cur-p btn-success" onclick="openModalCover()">Add</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="produkCover" class="table table-striped table-bordered" width="auto">
                                                        <thead>
                                                            <tr>
                                                                <th width="7.5%">No</th>
                                                                <th>Media</th>
                                                                <th>Tipe</th>
                                                                <th width="10%" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card" style="margin-bottom: 10px;">
                                        <div class="card-body box-shadow-op">
                                            <div class="d-flex align-items-center mb-4">
                                                <h4 class="card-title">
                                                    Related Blog Post
                                                </h4>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn cur-p btn-success" onclick="openModalBlogPost()">Add</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="productBlogPost" class="table table-striped table-bordered" width="auto">
                                                        <thead>
                                                            <tr>
                                                                <th width="7.5%">No</th>
                                                                <th>Title</th>
                                                                <th>Media</th>
                                                                <th width="10%" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.product') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCover" tabindex="-1" role="dialog" aria-labelledby="modalCoverLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCoverLabel">Product Cover</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label id="name" class="control-label">Gambar<span class="text-danger">*</span></label>
                                    <input type="file" id="fileCover" multiple class="form-control">
                                    <small class="form-text">File video hanya boleh satu</small>
                                    <small class="form-text">File foto bisa lebih dari satu</small>
                                    <small class="form-text">Bisa pilih file lebih dari satu</small>
                                    <small class="form-text">Hanya file dengan ekstensi jpg,jpeg,png,mp4 yang akan dianggap sebagai file yang valid</small>
                                    <small class="form-text">Rekomendasi ukuran 1024x1024 pixel dan size 2MB</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="insertCover()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalBlogPost" tabindex="-1" role="dialog" aria-labelledby="modalBlogPostLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBlogPostLabel">Related Blog Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label id="name" class="control-label">Blog Post<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="blog_post" id="blog_post" required>
                                        <option value="" disabled>--Select Tags--</option>
                                        @foreach ($blog_posts as $post)
                                            <option value="{{ $post->id }}"
                                                @isset($product)
                                                    @foreach ($product_tags as $item)
                                                        @if ($tag->id == $item->tag_id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                                @endisset
                                            >   {{ $post->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="blog_post_id" name="blog_post_id" value="">
                            </div>
                        </div>
                        <div class="row" id="blog-post-media" style="display: none;">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label id="title" class="control-label">Title</label>
                                    <p id="blog-post-title"></p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label id="media" class="control-label">Cover Media</label><br>
                                    <img src="" id="blog_post_img" alt="blog-media" style="width: 75px;">
                                    <video src="" id="blog_post_video"></video>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="insertBlogPost()">Add Blog Post</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var table_cover,
            table_blog_post,
            html        = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row">Delete</a>',
            html_blog_post  = '<a href="javascript:void(0)" class="btn btn-circle btn-danger delete-row-blog">Delete</a>',
            blog_post_ids   = [];

        $(function () {
            table_cover = $('#produkCover').DataTable({
                responsive: true,
                scrollX: true,
                dom: "<'row'<'col-sm-12'tr>>",
                rowReorder: {
                    dataSrc: 'no'
                },
                columns: [
                    {data: 'no'},
                    {
                        data: 'media',
                        orderable: false
                    },
                    {
                        data: 'tipe',
                        orderable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        className: 'text-center'
                    },
                ],
            });

            table_blog_post = $('#productBlogPost').DataTable({
                responsive: true,
                scrollX: true,
                dom: "<'row'<'col-sm-12'tr>>",
                rowReorder: {
                    dataSrc: 'no'
                },
                columns: [
                    {data: 'no'},
                    {
                        data: 'title',
                        orderable: false
                    },
                    {
                        data: 'media',
                        orderable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        className: 'text-center'
                    },
                ],
            });

            @isset($product)
                $.ajax({
                    url : "{{ $api_url.'product/cover' }}",
                    method : 'post',
                    data : {
                        _token: '{{ csrf_token() }}',
                        product_id: '{{ $product->id }}',
                        api_token: "{{ auth()->user()->api_token }}"
                    },
                    dataType: 'json',
                    success : function (response) {
                        $.each(response.covers, function (i, v) {
                            if (v.type == 'image') {
                                let img = '<img style="width: 75px;" src="{{ $download_url }}'+v.media+'">';
                                table_cover.row.add({
                                    no: i+1,
                                    cover_id: v.id,
                                    media: img,
                                    tipe : 'image',
                                    rawfoto: '',
                                    action: html,
                                    is_edit: false
                                });
                            } else {
                                let video_html  = '<video width="150px">';
                                    video_html += ' <source src="{{ $download_url }}'+v.media+'">';
                                    video_html += '</video>';
                                table_cover.row.add({
                                    no: i+1,
                                    cover_id: v.id,
                                    media : video_html,
                                    tipe : 'video',
                                    rawfoto : '',
                                    action : html,
                                    is_edit : false,
                                });
                            }
                        });
                        table_cover.draw();
                    }
                });

                $.ajax({
                    url : "{{ $api_url.'product/blog' }}",
                    method : 'post',
                    data : {
                        _token: '{{ csrf_token() }}',
                        product_id: '{{ $product->id }}',
                        api_token: "{{ auth()->user()->api_token }}"
                    },
                    dataType: 'json',
                    success : function (response) {
                        $.each(response.blog_post, function (i, v) {
                            if (v.is_video == false) {
                                let img = '<img style="width: 75px;" src="{{ $download_url }}'+v.image_cover+'">';
                                table_blog_post.row.add({
                                    no: i+1,
                                    id: v.id.toString(),
                                    title: v.title,
                                    media: img,
                                    action: html_blog_post,
                                });
                            } else {
                                let video_html  = '<video width="150px">';
                                    video_html += ' <source src="'+v.video+'">';
                                    video_html += '</video>';
                                table_blog_post.row.add({
                                    no: i+1,
                                    id: v.id.toString(),
                                    title: v.title,
                                    media : video_html,
                                    action : html_blog_post,
                                });
                            }
                            blog_post_ids.push(v.id.toString());
                        });
                        table_blog_post.draw();
                    }
                });
            @endisset
        });

        function openModalCover(){
            $('#modalCover').modal();
        }

        function openModalBlogPost(){
            $('#modalBlogPost').modal();
        }

        function insertCover() {
            let cover_ele = $('#fileCover');
            if (cover_ele[0].files.length) {
                $.each(cover_ele[0].files, function (i,v) {
                    if (isImage(v.name)) {
                        let reader = new FileReader();
                        let img;
                        reader.onload = function(e) {
                            img = '<img style="width: 75px;" src="'+e.target.result+'">';
                            table_cover.row.add({
                                no: i,
                                cover_id: 0,
                                media : img,
                                tipe : 'image',
                                rawfoto : v,
                                action : html,
                                is_edit : false,
                            });
                            reindex(table_cover);
                        }
                        reader.readAsDataURL(v);
                    } else if (isVideo(v.name)) {
                        if (count_video < 1) {
                            count_video++;
                            let video       = URL.createObjectURL(v);
                            let video_html  = '<video width="150px">';
                                video_html += '<source src="'+video+'">';
                                video_html += '</video>';
                            table_cover.row.add({
                                no: i,
                                cover_id: 0,
                                media : video_html,
                                tipe : 'video',
                                rawfoto : v,
                                action : html,
                                is_edit : false,
                            });
                            reindex(table_cover);
                        }
                    }
                });
                cover_ele.val('');
            } else {
                swalWithBootstrapButtons.fire({
                    title: "Warning",
                    text: "File input tidak boleh kosong, mohon cek kembali inputan Anda!",
                    type: "error",
                    allowOutsideClick: false,
                });
            }
        }

        function insertBlogPost() {
            if ($('#blog_post_id').val() == ''){
                alert('Harus memilih salah satu blog post');
                return false;
            }

            let blog_id = $('#blog_post_id').val();

            if (blog_post_ids.includes(blog_id)) {
                alert('This Blog Post has been added to the list');
                return false;
            }

            if ($('#blog_post_img').prop('src') != '') {
                let img = '<img style="width: 75px;" src="'+$('#blog_post_img').prop('src')+'">';
                table_blog_post.row.add({
                    no: 0,
                    id: $('#blog_post_id').val(),
                    title : $('#blog-post-title').text(),
                    media : img,
                    action : html_blog_post,
                });
                reindex(table_blog_post);

            } else if ($('#blog_post_video').prop('src') != '') {
                let video = '<video style="width: 75px;" src="'+$('#blog_post_img').prop('src')+'"></video>';
                table_blog_post.row.add({
                    no: 0,
                    id: $('#blog_post_id').val(),
                    title : $('#blog-post-title').text(),
                    media : video,
                    action : html_blog_post,
                });
                reindex(table_blog_post);
            } else  {
                swalWithBootstrapButtons.fire({
                    title: "Warning",
                    text: "Harus memilih salah satu blog post",
                    type: "error",
                    allowOutsideClick: false,
                });
                return false;
            }

            blog_post_ids.push(blog_id);
        }

        function getExtension(filename) {
            let parts = filename.split('.');
            return parts[parts.length - 1];
        }

        function isImage(filename) {
            let ext = getExtension(filename);
            switch (ext.toLowerCase()) {
                case 'jpeg':
                case 'jpg':
                case 'png':
                    return true;
                    break;
                default:
                    return false;
            }
        }

        function isVideo(filename) {
            let ext = getExtension(filename);
            switch (ext.toLowerCase()) {
                case 'mp4':
                    return true;
                    break;
                default:
                    return false;
            }
        }

        function reindex(table, calculate = false) {
            let total_stock = 0;
            let c = 1;
            table.rows().every( function () {
                let d = this.data();
                d.no = c;
                if (parseInt(d.status)) {
                    total_stock += parseInt(d.stock);
                }
                c++;
                this.invalidate();
            });
            table.draw();

            if (calculate) {
                $('#stock').val(total_stock);
                if (!table.data().count()) {
                    $('#stock').prop('disabled',false);
                }
            }
        }

        $(document).on('click','.delete-row',function () {
            let ele       = $($(this).parent());
            let row_index = table_cover.cell(ele).index().row;
            let d         = table_cover.row(row_index).data();
            if (d.tipe == 'video') {
                count_video--;
            }
            table_cover.row(row_index).remove();
            reindex(table_cover);
        });

        $(document).on('click','.delete-row-blog', function () {
            let ele       = $($(this).parent());
            let row_index = table_blog_post.cell(ele).index().row;
            let d         = table_blog_post.row(row_index).data();

            const index = blog_post_ids.indexOf(d.id);

            if (index > -1) {
                blog_post_ids.splice(index, 1);
            }

            table_blog_post.row(row_index).remove();
            reindex(table_blog_post);
        });

        $(function () {
            $('#discount_type').val(0);
            $('#discount').prop('readonly', true);

            $('#discount').keyup(function (){
                let disc    = $(this).val();
                let price   = $('#price').val();
                let discount_type = $('#discount_type').val();

                if (parseInt(discount_type) == 2) {
                    let percentage_disc = (disc / 100) * price;

                    if (parseFloat(disc) >= 100) {
                        alert('Discount cannot be greater than 100');
                        $(this).val(0);
                    } else if (disc == 0 || disc >= 100) {
                        $('#discount_price').val(0);
                    } else {
                        $('#discount_price').val(price - percentage_disc);
                    }

                } else if (parseInt(discount_type) == 1) {
                    let fixed_disc = $(this).val();

                    if (parseFloat(fixed_disc) >= parseFloat(price)) {
                        alert('Discount cannot be greater than the price');
                        $(this).val(0);
                    } else {
                        $('#discount_price').val(price - fixed_disc);
                    }
                }
            });

            $('#price').keyup(function (){
                let disc    = $('#discount').val();
                let price   = $(this).val();
                let discount_type = $('#discount_type').val();

                if (parseInt(discount_type) == 2 && disc != "" && parseInt(disc) != 0) {
                    let percentage_disc = (disc / 100) * price;

                    $('#discount_price').val(price - percentage_disc);

                } else if (parseInt(discount_type) == 1 && disc != "") {
                    if (parseFloat(disc) >= parseFloat(price)) {
                        alert('Price cannot be less than the discount');
                        $('#discount').val(0);
                    } else {
                        $('#discount_price').val(price - disc);
                    }
                } else if (parseInt(disc) == 0) {

                    $('#discount_price').val(0);
                }
            });

            $('#discount_type').change(function (e) {
                e.preventDefault();
                let disc_type = $(this).val();

                if (parseInt(disc_type) != 0 ) {
                    $('#discount').prop('readonly', false);
                } else if (parseInt(disc_type) == 0) {
                    $('#discount').prop('readonly', true);
                }

                $('#discount').val('');
                $('#discount_price').val('');
            });

            $('#blog_post').change(function () {
                $('#blog-post-media').show();
                let id = $(this).val();
                $.ajax({
                    url : '{{ $api_url."blog/post/list/" }}'+id,
                    method : 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        api_token: "{{ auth()->user()->api_token }}"
                    },
                    beforeSend: function (xhr) {
                    },
                    success : function (response) {
                        if (response.success) {
                            let data = response.data;
                            $('#blog_post_id').val(data.id);
                            $('#blog-post-title').text(data.title);
                            if (data.is_video == false) {
                                $('#blog_post_img').prop('src', '{{ env('APP_DOWNLOAD') }}'+data.image_cover+'');
                            } else if (data.is_video == true) {
                                $('#blog_post_video').prop('src', '{{ env('APP_DOWNLOAD') }}'+data.video+'');
                            }
                        }
                    },
                    error : function (xhr) {
                        if (xhr.status == 401) {
                            swal({
                                type: "error",
                                title: "Your login status in invalid!",
                                text: "Please do login again.",
                            }, function (isConfirm) {
                                $('#formLogout').submit();
                            });
                        }
                    }
                });
            });
        });

        @isset($product)
        $(function () {
            let discount_type = '{{ $product->discount_type }}';
            let price   = $('#price').val();
            let disc = '{{ $product->discount }}';

            if (parseInt(discount_type) === 2) {
                let percentage_disc = (disc / 100) * price;

                $('#discount_price').val(price - percentage_disc);
            } else if (parseInt(discount_type) === 1) {

                $('#discount_price').val(price - disc);
            } else if (parseInt(discount_type) === 0) {
                $('#discount_price').prop('readonly', true);
            }
        });
        @endisset

        CKEDITOR.replace('prddescription');

        submitData('formProduct', '{{ route('be.product') }}');
    </script>
@endpush
