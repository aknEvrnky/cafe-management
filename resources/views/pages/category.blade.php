@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('cafes.view', $cafe) }}" class="text-decoration-none">{{ $cafe->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $productCategory->title }}</li>
                </ol>
            </nav>

            <h2 class="text-center mb-4">{{ $productCategory->title }}</h2>
            <p class="text-center text-muted">{{ $productCategory->description ?? 'Bu kategorideki ürünlerimizi inceleyin' }}</p>
        </div>
    </div>

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm product-card" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                    <img src="{{ $product->imageUrl() }}"
                         class="card-img-top object-fit-cover"
                         alt="{{ $product->title }}"
                         style="height: 200px;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text text-primary fw-bold">{{ number_format($product->price, 2) }} ₺</p>
                    </div>
                </div>
            </div>

            <!-- Ürün Detay Modal -->
            <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <img src="{{ $product->imageUrl() }}"
                                 class="img-fluid rounded mb-3"
                                 alt="{{ $product->title }}"
                                 style="max-height: 300px; width: 100%; object-fit: cover;">

                            <h3 class="mb-3">{{ $product->title }}</h3>

                            <p class="text-muted mb-4">{{ $product->description }}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary h4 mb-0">{{ number_format($product->price, 2) }} ₺</span>

                                @if($product->calories)
                                    <span class="text-muted">
                                        <i class="bi bi-fire"></i> {{ $product->calories }} kcal
                                    </span>
                                @endif
                            </div>

                            @if($product->ingredients)
                                <div class="mt-4">
                                    <h6 class="text-muted mb-2">İçindekiler</h6>
                                    <p class="small text-muted">{{ $product->ingredients }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
