@extends('welcome')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <form action="{{ route('step.one.post') }}" method="POST">
                        @csrf
                        <div class="card">
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
                                <div class="my-4">
                                    <label for="people">Please select a meal</label>
                                    <select name="meal" class="form-select" aria-label="Default select example">
                                        <option value="" selected>---</option>
                                        @foreach($meals as $meal)
                                            <option value="{{ $meal }}" {{ old('meal', $m) == $meal ? 'selected' : '' }}>{{$meal}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="people">Please enter number of people</label>
                                <input class="form-control" type="number" name="people" max="10" value="{{ old('people', $people) }}"><br><br>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
