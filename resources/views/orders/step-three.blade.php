@extends('welcome')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <button class="btn btn-success add-select mb-3" type="button">Add</button>
                <button class="btn btn-danger remove-select mb-3" type="button" disabled>Remove</button>
                <form action="{{ route('review.post') }}" method="POST">
                    @csrf
                    <div class="addMore card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body" id="add">
                            @foreach(old('dishes', ['']) as $key => $value)
                                <div class="row">
                                    <div class="col">
                                        <label>Please select dishes</label>
                                        <select name="dishes[]" class="form-select form-select mb-3"
                                                aria-label="Large select example">
                                            <option value="">----</option>
                                            @foreach ($orders as $order)
                                                <option
                                                    value="{{ $order }}" {{ old('dishes.'.$key) == $order ? 'selected' : '' }}>
                                                    {{ $order }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="serving">Please enter no of servings</label>
                                        <input type="number" name="serving[]" min="1" max="10"
                                               value="{{ old('serving.'.$key, 1) }}" class="form-control">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <a href="{{ route('step.two') }}" class="btn btn-danger pull-right">Previous</a>
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
    <select class="form-select form-select-lg mb-3 d-none" id="clone" aria-label="Large select example">
        <option selected value="0">----</option>
        @foreach ($orders as $key => $order)
            <option value="{{$order}}">{{$order}}</option>
        @endforeach
    </select>
    <script>
        $(document).ready(function () {
            updateSelects()
            $(".addMore").on("change", "select", function () {
                updateSelects()
            })

            if ($('select#clone option').length == $('.addMore div.row').length) {
                $("button.add-select").prop('disabled', true);
            }

            function updateSelects() {
                let selected = [];
                $("div.addMore").find("option").prop("disabled", false).removeClass('text-danger');
                $("div.addMore select").each(function (index, select) {
                    if (select.value !== "") {
                        selected.push(select.value);
                    }
                })
                for (let index in selected) {
                    $('option[value="' + selected[index] + '"]:not(:selected)').prop("disabled", true).addClass('text-danger');
                }
            }

            $(document).on("click", ".add-select", function () {
                let tag = $('#clone').html();
                let addUpdate =
                    `<div class="row">` +
                    `<div class="col">` +
                    `<label>Please select dishes</label>` +
                    `<select name="dishes[]" class="form-select mb-3"><option value="">---</option` +
                    tag +
                    `</select>` +
                    `</div>` +
                    `<div class="col">` +
                    `<label>Please enter no of servings</label>` +
                    `<input type="text" name="serving[]" class="form-control mb-3" value="1">` +
                    `</div>` +
                    `</div>`
                $('.addMore > #add').append(addUpdate);
                if ($('select#clone option').length == $('.addMore div.row').length) {
                    $("button.add-select").prop('disabled', true);
                }
                $('.remove-select').prop('disabled', false)
                updateSelects()
            });

            $(document).on("click", ".remove-select", function () {
                let $list_dishes = $('#add .row');

                if ($list_dishes.length > 1) {
                    $('#add div.row').last().remove();
                    $("button.add-select").prop('disabled', false);
                    updateSelects()
                } else {
                    $('.remove-select').prop('disabled', true)
                    updateSelects()
                }
            });
        });
    </script>
@endsection
