@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - check-price</title>
@endsection

@section('content')
<?php
// echo "<pre>";
// print_r($result);
// echo "</pre>";
?>

<section class="row">
    <div class="col-12 bgpage-average wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 average-nopad">
                    <div class="page-average">
                        <div class="topic-average"><img src="{{ asset('frontend/images/icon-average.svg') }}" alt=""> Average</div>
                        <div>
                            @php
                                // Define a local function to format price in millions
                                function formatPrice($price) {
                                    return number_format($price / 1000000, 2) . 'M';
                                }
                            @endphp

                            @if(isset($result['generation']) && count($result['generation']) > 0)
                                @foreach($result['generation'] as $generation)
                                    <div class="wrap-average">
                                        <div class="box-average">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="brandcar-average">
                                                        <span>{{ $result['brand'] }} {{ $result['model'] }}</span> {{ $generation['generation_name'] }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="average-bar">
                                                @foreach($generation['modelyear'] as $year => $values)
                                                    <div class="item-bar">
                                                        <a href="{{ route('carsearchPage', ['kw1' => $result['brand'], 'kw2' => $result['model'], 'kw3' => $generation['generation_name']]) }}" class="box-avgprice">
                                                            Avg <div>{{ is_numeric($values['avg']) ? formatPrice($values['avg']) : 'N/A' }}</div>
                                                        </a>
                                                        <a href="{{ route('carsearchPage', ['kw1' => $result['brand'], 'kw2' => $result['model'], 'cashtype' => 'cash', 'min_price' => $values['max'], 'max_price' => $values['max']]) }}" class="avgprice">{{ is_numeric($values['max']) ? formatPrice($values['max']) : 'N/A' }}</a>
                                                        <div class="animated-progress">
                                                            @php
                                                                // Check if max and avg are numeric and calculate progress
                                                                $progress = (is_numeric($values['max']) && is_numeric($values['avg']) && $values['max'] > 0) 
                                                                            ? ($values['avg'] / $values['max']) * 100 
                                                                            : 0;
                                                            @endphp
                                                            <span data-progress="{{ $progress }}" style="height: {{ $progress }}%;"></span>
                                                        </div>
                                                        <a href="{{ route('carsearchPage', ['kw1' => $result['brand'], 'kw2' => $result['model'], 'cashtype' => 'cash', 'min_price' => $values['min'], 'max_price' => $values['min']]) }}" class="avgprice">{{ is_numeric($values['min']) ? formatPrice($values['min']) : 'N/A' }}</a>
                                                        <div class="txt-seeyear">{{ $year }}</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No data available.</p>
                            @endif
                        </div>

                        <!-- <div class="text-center">
                            <button class="more-average">ดูเพิ่ม <i class="bi bi-chevron-down"></i></button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection
