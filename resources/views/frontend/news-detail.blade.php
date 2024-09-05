@extends('../frontend/layouts/layout')

@section('subhead')
    <title>{{ $mynews->title }} | รถพร้อมขาย</title>
    <meta property="og:title" content="{{ $mynews->title }} | รถพร้อมขาย" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ decode_url(url()->current()) }}" />
    <meta property="og:image" content="{{ asset($mynews->feature) }}" />
    <meta property="og:site_name" content="rodpromptkai.com - รถพร้อมขาย เว็บไซต์รถยนต์">
    <meta property="og:description" content="{{ strip_tags($mynews->excerpt) }}" />
    <meta property="og:locale" content="th_TH">
    <!-- <meta name="description" content="{{ strip_tags($mynews->excerpt) }}">
    <meta name="keywords" content="{{ $mynews->meta_keyword }}"> -->
@endsection

@section('content')

<section class="row">
    <div class="col-12 wrap-page wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 news-detail">
                    <h1>{{ $mynews->title }}</h1>
                    <div class="news-boxshare">
                        <div class="news-date"><i class="bi bi-calendar3"></i> {{ date('d M Y H:i', strtotime($mynews->created_at)) }}</div>
                        <div class="news-share">
                            <span><img src="{{ asset('frontend/images/icon-share.svg') }}" alt="Share"> แชร์</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><img src="{{ asset('frontend/images/facebook.svg') }}" alt="Share on Facebook"></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($mynews->title) }}" target="_blank"><img src="{{ asset('frontend/images/twitter.svg') }}" alt="Share on Twitter"></a>
                            <a href="https://lineit.line.me/share/ui?url={{ urlencode(url()->current()) }}" target="_blank"><img src="{{ asset('frontend/images/line.svg') }}" alt="Share on Line"></a>
                        </div>
                    </div>
                    <div class="content-editor">
                        @php
                        $myfeature_news = $mynews->feature ? asset($mynews->feature) : asset('uploads/default-car.jpg');
                        @endphp
                        <img src="{{ $myfeature_news }}" alt="{{ $mynews->title }}" style="width: 100%;" loading="lazy">
                        {!! $mynews->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row">
    <div class="col-12 wrap-recentnews">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h1 class="topic-insidepage"><i class="bi bi-circle-fill"></i> อัพเดทข่าวยานยนต์</h1>
                </div>
                <div class="col-4 text-end">
                    <a href="{{ route('newsPage') }}" class="btn-red">ดูทั้งหมด</a>
                </div>
                <div class="col-12">
                    <div class="owl-recentnews owl-carousel owl-theme">
                        @foreach($othernews as $newsres)
                            @php
                            $feature_news = $newsres->feature ? asset($newsres->feature) : asset('uploads/default-car.jpg');
                            @endphp

                            <a href="{{ route('newsdetailPage', ['slug' => $newsres->slug]) }}" class="home-itemnews">
                                <figure>
                                    <div class="cover-news">
                                        <img src="{{ $feature_news }}" alt="{{ $newsres->title }}" loading="lazy">
                                    </div>
                                    <figcaption>
                                        <div class="item-topicnews">{{ $newsres->title }}</div>
                                        <div class="news-date"><i class="bi bi-calendar3"></i> {{ date('d M Y H:i', strtotime($newsres->created_at)) }}</div>
                                    </figcaption>
                                </figure>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
