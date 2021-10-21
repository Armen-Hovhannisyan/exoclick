<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiased">

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class=" mt-3 d-flex justify-content-between">
                    <h3>Campaigns</h3>
                    <div class="col-xs-4 col-sm-2">
                        <a href="{{route('new.campaign')}}" class="btn btn-xs btn-info">
                            New Campaign
                        </a>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">{{$errors->first()}}</div>
                @endif

                <div>
                    @if(isset($campaigns['result']) && count($campaigns['result']) > 0)
                        <table class="table" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Ad Format</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($campaigns['result'] as $result)
                                <tr>
                                    <td>{{$result['id']}}</td>
                                    <td>{{$result['name']}}</td>
                                    <td>{{$result['calculated_status']['status']}}</td>
                                    <td>{{$result['price']}}</td>
                                    <td>{{$result['advertiser_ad_type_label']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
