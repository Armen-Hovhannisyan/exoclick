<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="antialiased">

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class=" mt-3 d-flex justify-content-between">
                    <h3>New Campaign</h3>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">{{$errors->first()}}</div>
                @endif
                <form method="POST" action="{{route('campaign.create')}}">
                    @csrf
                    <input type="hidden" name="media_storage_template" value="{{old('media_storage_template')}}" class="form-control" id="media_storage_template">


                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <div>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                @foreach($categories['result'] as $category)
                                    @if(!$category['parent'])
                                        <input type="checkbox" name="category[]" class="btn-check"
                                               id="{{$category['id']}}" value="{{$category['id']}}" autocomplete="off">
                                        <label class="btn btn-outline-primary"
                                               for="{{$category['id']}}">{{$category['name']}} {{$category['id']}}</label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="advertiser_ad_type" class="form-label">Ad Format</label>
                        <select class="form-select advertiser_ad_type" name="advertiser_ad_type">
                            @foreach($advertiserAdTypes['result'] as $adTypes)
                                <option value="{{json_encode($adTypes) }}" >{{$adTypes['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Country</label>
                        <select class="form-select" name="country">
                            <option selected value="">Select Country</option>
                            @foreach($countries['result'] as $country)
                                <option value="{{$country['iso3']}}"
                                        @if (old('country') == $country['iso3']) selected="selected" @endif>{{$country['short_name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="daily_limit_type" class="form-label">Daily Limit Type</label>
                        <select class="form-select" name="daily_limit_type">
                            @foreach($dailyLimitTypes['result'] as $limitTypes)
                                <option value="{{$limitTypes['id']}}"
                                        @if (old('daily_limit_type') == $limitTypes['id']) selected="selected" @endif>{{$limitTypes['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="max_daily_budget" class="form-label">Max Daily Budget</label>
                        <input type="text" value="{{old('max_daily_budget')}}" name="max_daily_budget"
                               class="form-control" id="max_daily_budget">
                    </div>
                    <div class="mb-3">
                        <label for="impressions" class="form-label">Total impressions</label>
                        <input type="text" value="{{old('total_impressions')}}" name="total_impressions"
                               class="form-control" id="impressions">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" value="{{old('price')}}" name="price"
                               class="form-control" id="price">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</section>
</body>
</html>
