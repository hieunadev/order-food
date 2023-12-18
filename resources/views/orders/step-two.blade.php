@extends('welcome')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{ route('step.two.post') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">Please select a restaurant</div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <select name="restaurant" class="form-select" aria-label="Default select example">
                                <option value="" selected>----</option>
                                @foreach ($res as $key => $re)
                                    <option
                                        value="{{ $re }}" {{ old('restaurant', $restaurant) == $re ? 'selected' : '' }}>{{$re}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer mt-5">
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <a href="{{ route('orders.index') }}" class="btn btn-danger pull-right">Previous</a>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
