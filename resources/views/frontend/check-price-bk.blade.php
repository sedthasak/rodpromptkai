@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - check-price</title>
@endsection

@section('content')
<section class="row">
    <div class="col-12 bgpage-average wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 average-nopad">
                    <div class="page-average">
                        <div class="topic-average"><img src="{{ asset('frontend/images/icon-average.svg') }}" alt=""> Average</div>
                        
                        <!-- Ensure all wrap-average divs are inside the section-average div -->
                        <div class="section-average">
                            @php
                                $generation = "";
                                $count = 0;
                                $total = count($yearprice);
                            @endphp

                            @if (isset($yearprice))
                                @foreach ($yearprice as $index => $rows)
                                    <!-- Check if the generation has changed or if this is the first item -->
                                    @if ($generation != $rows->generation_name)
                                        <!-- Close the previous wrap-average div if not the first item -->
                                        @if ($count > 0)
                                            </div> <!-- .average-bar -->
                                            </div> <!-- .box-average -->
                                            </div> <!-- .wrap-average -->
                                        @endif

                                        <!-- Start a new wrap-average div for the new generation -->
                                        <div class="wrap-average">
                                            <div class="box-average">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="brandcar-average">
                                                            <img src="{{ asset($brandrow->feature) }}" alt="">
                                                            <span>{{ $brandrow->title }} {{ $modelrow->model }}</span> {{ $rows->generation_name }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="average-bar">
                                                @php
                                                    $generation = $rows->generation_name;
                                                @endphp
                                    @endif

                                    <!-- Render items in average bar -->
                                    <div class="item-bar">
                                        <a href="{{ route('carsearchPage', ['kw1' => $brandrow->title, 'kw2' => $modelrow->model, 'cashtype' => 'cash', 'min_price' => $rows->avg_price, 'max_price' => $rows->avg_price]) }}" class="box-avgprice">
                                            Avg <div>{{ number_format(round($rows->avg_price / 1000000, 2), 2) . 'M' }}</div>
                                        </a>
                                        <a href="{{ route('carsearchPage', ['kw1' => $brandrow->title, 'kw2' => $modelrow->model, 'cashtype' => 'cash', 'min_price' => $rows->max_price, 'max_price' => $rows->max_price]) }}" class="avgprice">{{ number_format(round($rows->max_price / 1000000, 2), 2) . 'M' }}</a>
                                        <div class="animated-progress"> <span data-progress="{{ ceil((100 / $rows->max_price) * $rows->avg_price) }}" style="height: {{ ceil((100 / $rows->max_price) * $rows->avg_price) }}%;"></span></div>
                                        <a href="{{ route('carsearchPage', ['kw1' => $brandrow->title, 'kw2' => $modelrow->model, 'cashtype' => 'cash', 'min_price' => $rows->min_price, 'max_price' => $rows->min_price]) }}" class="avgprice">{{ number_format(round($rows->min_price / 1000000, 2), 2) . 'M' }}</a>
                                        <div class="txt-seeyear">{{ $rows->modelyear }}</div>
                                    </div>

                                    @php $count++; @endphp

                                    <!-- If this is the last item, close the open divs -->
                                    @if (($index + 1) == $total)
                                        </div> <!-- .average-bar -->
                                        </div> <!-- .box-average -->
                                        </div> <!-- .wrap-average -->
                                    @endif
                                @endforeach
                            @endif
                        </div> <!-- .section-average -->

                        <!-- Show button at the end of the content -->
                        <div class="text-center">
                            <button class="more-average">ดูเพิ่ม <i class="bi bi-chevron-down"></i></button>
                        </div>
                    </div> <!-- .page-average -->
                </div> <!-- .col-12 average-nopad -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .col-12 bgpage-average -->
</section>

<!-- Footer Section (Optional) -->
@php
    $arr = [];
    if (isset($setFooterModel)) {
        foreach($setFooterModel as $keyf => $foot) {
            if (!empty($foot->name) && !empty($foot->link)) {
                $arr[$foot->heading][$keyf]['footer_name'] = $foot->name;
                $arr[$foot->heading][$keyf]['footer_link'] = $foot->link;
            }
        }
    }
@endphp

<section class="container box-linkcarseo wow fadeInDown">
    <div class="row">
        @foreach($arr as $keyarray => $arry)
            <div class="col-3 box-linkcar">
                <h2>{{ $keyarray }}</h2>
                <ul>
                    @foreach($arry as $keylst => $lst)
                        <li><a href="{{ $lst['footer_link'] }}" target="_blank">{{ $lst['footer_name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".animated-progress span").each(function () {
            $(this).animate(
                {
                    height: $(this).attr("data-progress") + "%",
                },
                1000
            );
        });
    });
</script>
@endsection
