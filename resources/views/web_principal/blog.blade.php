@extends('web_principal.layout.app')

@section('contenido')

        <!--================Blog Categorie Area =================-->
        <section class="blog_categorie_area d-none d-sm-block">
        </section>
        <!--================Blog Categorie Area =================-->
        
        <!--================Blog Area =================-->
        <section class="blog_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog_left_sidebar">
                            @if(count($entradas)==0)
                                <span>No hay entradas publicadas.</span>
                            @endif 
                            @foreach($entradas as $entry)
                                <article class="row blog_item">
                                <div class="col-md-3">
                                    <div class="blog_info text-right">
                                            <div class="post_tag">
                                                @if(count($entry->categorias)==0)
                                                    <a href="#">Sin categoria</A>
                                                @endif 
                                                @foreach($entry->categorias as $cat) 
                                                    <a href="/blog?category={{$cat->id}}" >{{ $cat->name.(($entry->categorias[count($entry->categorias)-1] == $cat) ? '':',')}}</a>
                                                @endforeach
                                            </div>
                                            <ul class="blog_meta blog_meta_list list">
                                                <li><a href="#">{{ $entry->user->name }}<i class="lnr lnr-user"></i></a></li>
                                                <li><a href="#">{{ date("F j, Y", strtotime($entry->created_at)) }}<i class="lnr lnr-calendar-full"></i></a></li>
                                                <li><a href="#">{{ $entry->views }} vistas<i class="lnr lnr-eye"></i></a></li>
                                                <li><a href="#">{{ (($entry->votes>0)?number_float($entry->votescore/$entry->votes, 1):0) }}<i class="lnr lnr-star"></i></a></li>
                                            </ul>
                                        </div>
                                </div>
                                    <div class="col-md-9">
                                        <div class="blog_post">
                                            <img class="blog-image" src="{{ $entry->image_path }}" alt="">
                                            <div class="blog_details">
                                                <a href="/blog/{{$entry->id}}"><h2>{{ $entry->title }}</h2></a>
                                                <p>{{ substr(strip_tags($entry->content), 0, 200)}}...</p>
                                                <a href="/blog/{{$entry->id}}" class="blog_btn">Leer mas</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                            <div class="justify-content-center d-flex">
                                {!! $entradas->withQueryString()->links() !!}
		                    </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget search_widget">
                                <form method="get">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Buscar entradas">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                        </span>
                                    </div><!-- /input-group -->
                                </form> 
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title">Entradas Populares</h3>
                                @foreach($populares as $popular)
                                <div class="media post_item">
                                    <img style="object-fit: cover;width:100px;height:60px; " src="{{ $popular->image_path }}" alt="post">
                                    <div class="media-body">
                                        <a href="/blog/{{$popular->id}}"><h3>{{ $popular->title }}</h3></a>
                                        <p>{{ \App\Tools\Helpers::time_elapsed_string($popular->created_at) }}</p>
                                    </div>
                                </div>
                                @endforeach
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget post_category_widget">
                                <h4 class="widget_title">Categorias</h4>
                                <ul class="list cat-list">
                                    @foreach($categorias as $cat)
                                    <li>
                                        <a href="/blog?category={{$cat->id}}" class="d-flex justify-content-between">
                                            <p>{{ $cat->name }}</p>
                                            <p>{{ count($cat->entradas) }}</p>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="br"></div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection