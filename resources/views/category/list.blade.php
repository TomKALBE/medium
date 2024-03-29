@extends('layouts.main')

@section('styles')

@endsection

@section('scripts')
<script src="{{ asset('js/categories.js') }}"></script>
@endsection

@section('content')

<section class="hero hero-with-header separator-bottom">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Ok !</strong> {!! session('success') !!}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreur !</strong> Action non exécutée.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="font-weight-bold">Catégories</h1>
            </div>
        </div>
    </div>
</section>



<div class="row">
    <div class="col-lg-7">
        <section id="default" class="">
            <div class="tab-content" id="component-2">

                <div class="tab-pane show active" id="component-2-1" role="tabpanel" aria-labelledby="component-2-1">
                    <div class="component-example">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-lined" dusk="categoryList">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Slug</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $category)
                                            <tr>
                                                <th scope="row">{{ $category->name }}</th>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-ico btn-warning"
                                                        dusk="update-{{ $category->slug }}" data-action="edit"
                                                        data-name="{{ $category->name }}"
                                                        data-slug="{{ $category->slug }}">
                                                        <i class="icon-pencil text-white"></i>
                                                    </button>

                                                    <form method="POST" class="d-inline"
                                                        action="{{ route('categories.delete', ['id' => $category->slug]) }}"
                                                        id="delete-form">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-ico btn-danger"
                                                            dusk="delete-{{ $category->slug }}" data-action="delete"
                                                            data-slug="{{ $category->slug }}">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th scope="row" colspan="3">Pas de catégorie</th>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <div class="col lg-5">
        <div class="tab-content" id="component-1">

            <div class="tab-content">
                <div class="tab-pane  show active" id="component-1-1" role="tabpanel" aria-labelledby="component-1-1">
                    <div class="component-example">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="nav nav-tabs mb-2 lavalamp">
                                        <div class="lavalamp-object ease"
                                            style="transition-duration: 0.2s; width: 72.7054px; height: 33px; transform: translate(0px, 0px);">
                                        </div>
                                        <a class="nav-item nav-link lavalamp-item  @if (session('action') != 'update') active @endif"
                                            data-toggle="tab" href="#create-form"
                                            style="z-index: 5; position: relative;">Ajout
                                            categorie</a>
                                        <a class="nav-item nav-link lavalamp-item @if (session('action') == 'update') active @endif"
                                            data-toggle="tab" href="#edit-form-pane" dusk="edit-form-pane"
                                            style="z-index: 5; position: relative;">Edition
                                            categorie</a>
                                    </div>
                                    <div class="tab-content" id="demo-2">
                                        <div class="tab-pane show  @if (session('action') != 'update') active @endif"
                                            id="create-form" role="tabpanel" aria-labelledby="create-form">
                                            @include('category.create-form')
                                        </div>
                                        <div class="tab-pane @if (session('action') == 'update') active @endif"
                                            id="edit-form-pane" role="tabpanel" aria-labelledby="edit-form-pane">
                                            @include('category.edit-form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
