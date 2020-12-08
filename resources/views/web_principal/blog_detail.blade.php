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
                    <div class="col-lg-8 post-lists">
                        <div class="single-post row">
                            <div class="col-lg-12">
                                <div class="feature-img">
                                    <img style="object-fit: cover;width:750px;height:350px; "class="img-fluid" src="{{ $entrada->image_path }}" alt="">
                                </div>									
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="blog_info">
                                <div class="post_tag mb-0 pb-0">
                                        @if(count($entrada->categorias)==0)
                                            <a href="#">Sin categoria</A>
                                        @endif 
                                        @foreach($entrada->categorias as $cat) 
                                            <a href="/blog?category={{$cat->id}}" >{{ $cat->name.(($entrada->categorias[count($entrada->categorias)-1] == $cat) ? '':',')}}</a>
                                        @endforeach
                                </div>
                                <div class="blog_details pt-0">
                                        <h2>{{$entrada->title}}</h2>
                                </div>
                                    <ul style="list-style:none!important;display:inline-block;" class="blog_meta list col-md-10 col-lg-10">
                                        <li style="display:inline!important;"><a href="#"> <img style="object-fit: cover;width:2em;height:2em;" src="{{ (($entrada->user->image_path!=null)?$entrada->user->image_path:'/img/person.png') }}" alt="user" class="rounded-circle"> {{ $entrada->user->name }}</a></li>
                                        <li style="display:inline!important;"><a href="#"><i class="lnr lnr-calendar-full"></i> {{ date("F j, Y", strtotime($entrada->created_at)) }}</a></li>
                                        <li style="display:inline!important;"><a href="#"><i class="lnr lnr-eye"></i> {{ $entrada->views }} vistas</a></li>
                                    </ul>
                                    <div class="pull-right col-md-2 col-lg-2" style="display:inline-block;" id="rateYo"></div>
                                    <!--
                                    <ul class="social-links">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-github"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                    </ul>
-->
                                    
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                {!! $entrada->content !!}
                            </div>
                            <div class="col-lg-12 text-center mt-0 mb-5">
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                        </div>
                        <div class="navigation-area mb-5">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    @if($anterior != null)
                                    <div class="thumb">
                                        <a href="/blog/{{$anterior->id}}"><img style="width:48px;"  class="img-fluid" src="/img/left_arrow.png" alt=""></a>
                                    </div>
                                    <div class="arrow">
                                        <a href="/blog/{{$anterior->id}}"><span class="lnr text-white lnr-arrow-left"></span></a>
                                    </div>
                                    <div class="detials">
                                        <p>Anterior</p>
                                        <a href="/blog/{{$anterior->id}}"><h4>{{ $anterior->title }}</h4></a>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    @if($siguiente != null)
                                    <div class="detials">
                                        <p>Siguiente</p>
                                        <a href="/blog/{{$siguiente->id}}"><h4>{{ $siguiente->title }}</h4></a>
                                    </div>
                                    <div class="arrow">
                                        <a href="/blog/{{$siguiente->id}}"><span class="lnr text-white lnr-arrow-right"></span></a>
                                    </div>
                                    <div class="thumb">
                                        <a href="/blog/{{$siguiente->id}}"><img style="width:48px;" class="img-fluid" src="/img/right_arrow.png" alt=""></a>
                                    </div>	
                                    @endif									
                                </div>									
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget search_widget">
                                <form method="get" action="/blog">
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

@section('scripts')

<script>
$(document).ready(function(){
    var rateyo = $("#rateYo").rateYo({
        rating: {{ (($entrada->votes>0)?$entrada->votescore/$entrada->votes:0) }},
        starWidth: "16px",
        fullStar: true,
        onSet: function(rating, rateYoInstance){
            $.ajax({
                url: '/blog/{{$entrada->id}}/puntuar',
                type: 'POST',
                data: {rating: rating},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            }).done(function(resp){
                rateyo.rateYo("rating", resp.rating);
                rateyo.rateYo('option', 'readOnly',true);
            });
        }
    });
});
</script>
@endsection