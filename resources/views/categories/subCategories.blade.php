<style>
    .custom-card:hover {
        background-color: salmon;
        color: #fff;
    }
</style>


<ul>
    @foreach ($subCategories as $subCategory)
        <li class="" style="list-style: none;">
            <div style="border: 1px solid salmon;
            padding: 5px 10px;     margin: 4px 0px;" class="rounded custom-card">
                <span class="px-2">{{ $subCategory->title }}</span>
                <a class="text-danger float-right" href="{{ url('/categories/delete/' . $subCategory->id) }}">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
            </div>
            @if (count($subCategory->subCategories))
                @include('categories.subCategories', ['subCategories' => $subCategory->subCategories])
            @endif
        </li>
    @endforeach
</ul>
