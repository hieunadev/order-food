@extends('welcome')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <p>Meal: <strong>{{$orders["meal"]}}</strong></p>
                    <p>No. of People: <strong>{{$orders["people"]}}</strong></p>
                    <p>Restaurant: <strong>{{$orders["restaurant"]}}</strong></p>
                    <p>Dishes:
                    <ul class="fw-bold">@for($i = 0; $i < count($dishes); $i++)
                            <li>{{$dishes[$i]}} - {{$servings[$i]}}</li>
                        @endfor </ul>
                    </p>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-start">
                                <a href="{{ route('step.three') }}" class="btn btn-danger pull-right">Previous</a>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", "button", function () {
            let meal = {!! json_encode($orders["meal"]) !!};
            let people = {!! json_encode($orders["people"]) !!};
            let restaurant = {!! json_encode($orders["restaurant"]) !!};
            let dishes = {!! json_encode($dishes) !!};
            let orders_info =
                {
                    'meal': meal,
                    'people': people,
                    'restaurant': restaurant,
                    'dishes': dishes
                }
            console.log(orders_info)
            alert("Order Successful")
        })
    </script>
@endsection
