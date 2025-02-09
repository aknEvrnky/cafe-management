@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center mb-4">Menü Kategorileri</h2>
            <p class="text-center text-muted">Lezzetli menümüzü keşfedin</p>
        </div>
    </div>

    <div class="row g-4">
        @foreach($categories as $category)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm hover-scale">
                    <img src="{{ $category->imageUrl() }}"
                         class="card-img-top object-fit-cover"
                         alt="{{ $category->title }}"
                         style="height: 200px;">

                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">{{ $category->title }}</h5>
                        <a href="{{route('product-categories.view', [$cafe, $category])}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
