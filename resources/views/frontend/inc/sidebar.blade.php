{{-- <div class="position-static d-none d-xl-block">
    <div class="aiz-category-menu bg-white rounded-0 border-top" id="category-sidebar" style="width:270px;" id="topBar">


        <ul class="list-unstyled categories no-scrollbar mb-0 text-left">

            @foreach ($categories as $cat)
                <li class="category-nav-element border border-top-0" data-id="2">
                    <a href="category/mens-fashion.html"
                        class="text-truncate text-dark px-4 fs-14 d-block hov-column-gap-1">
                        <img class="cat-image lazyload mr-2 opacity-60"
                            src="{{ asset('/asset/frontend/assets/img/placeholder.jpg') }}"
                            data-src="{{ asset($cat->image) }}" width="16" alt="Mens Fashion"
                            onerror="this.onerror=null;this.src='{{ asset('/asset/frontend/assets/img/placeholder.jpg') }}';">
                        <span class="cat-name has-transition">{{ $cat->title }}</span>
                    </a>

                    <div class="sub-cat-menu c-scrollbar-light border p-4 shadow-none">
                        <ul class="list-unstyled categories no-scrollbar mb-0 text-left">
                            <li class="category-nav-element border border-top-0" data-id="1">
                                <a href="category/womens-fashion.html"
                                    class="text-truncate text-dark px-4 fs-14 d-block hov-column-gap-1">
                                    <img class="cat-image lazyload mr-2 opacity-60"
                                        src="{{ asset('/asset/frontend/assets/img/placeholder.jpg') }}"
                                        data-src="/asset/frontend/uploads/all/fYFHlc12PlTXH6CNsInseoa6vdP1bDjQCJEgNNBS.png"
                                        width="16" alt="Women&#039;s Fashion"
                                        onerror="this.onerror=null;this.src='{{ asset('/asset/frontend/assets/img/placeholder.jpg') }}';">
                                    <span class="cat-name has-transition">Women&#039;s Fashion</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endforeach

            <li class="category-nav-element border border-top-0" data-id="1">
                <a href="category/womens-fashion.html"
                    class="text-truncate text-dark px-4 fs-14 d-block hov-column-gap-1">
                    <img class="cat-image lazyload mr-2 opacity-60"
                        src="{{ asset('/asset/frontend/assets/img/placeholder.jpg') }}"
                        data-src="/asset/frontend/uploads/all/fYFHlc12PlTXH6CNsInseoa6vdP1bDjQCJEgNNBS.png"
                        width="16" alt="Women&#039;s Fashion"
                        onerror="this.onerror=null;this.src='{{ asset('/asset/frontend/assets/img/placeholder.jpg') }}';">
                    <span class="cat-name has-transition">Women&#039;s Fashion</span>
                </a>
                <div class="sub-cat-menu c-scrollbar-light border p-4 shadow-none">
                    <div class="c-preloader text-center absolute-center">
                        <i class="las la-spinner la-spin la-3x opacity-70"></i>
                    </div>
                </div>
            </li>
        </ul>


    </div>
</div> --}}


<div class="sidebar">
    <ul class="menu">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Products</a>
            <ul class="submenu">
                <li><a href="#">Electronics</a></li>
                <li><a href="#">Clothing</a></li>
                <li>
                    <a href="#">Accessories</a>
                    <ul class="submenu">
                        <li><a href="#">Bags</a></li>
                        <li><a href="#">Watches</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Services</a>
        </li>
    </ul>
</div>

