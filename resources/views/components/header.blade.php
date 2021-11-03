<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ isset($title) ? $title : '' }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Dashboards</a></li> --}}
                        @for($i = 1; $i <= count($segments); $i++)
                            @if($i < count($segments) && $i > 0)
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ url('/' . $segments[$i-1]) }}">
                                {{ucwords(str_replace('-',' ',$segments[$i-1]))}}
                                </a>
                            </li>
                            @else
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ucwords(str_replace('-',' ',$segments[$i-1]))}}
                            </li>
                            @endif
                        @endfor
                    </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    @if(isset($link) && is_array($link))
                    @foreach($link as $item)
                    <a href="{{ $item['link'] }}" class="btn btn-sm btn-neutral">{{ $item['text_link'] }}</a>
                    @endforeach
                    @elseif(isset($link) && isset($text_link))
                    <a href="{{ $link }}" class="btn btn-sm btn-neutral">{{ $text_link }}</a>
                    @endif
                    {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                </div>
            </div>
            <!-- Card stats -->
            @yield('card_stats')
        </div>
    </div>
</div>