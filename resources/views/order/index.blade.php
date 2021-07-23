<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заказ номера</title>
    <!--bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!--air datepicker-->
    <link href="dist/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="dist/js/datepicker.min.js"></script>
</head>
<body>

<div>

    <form action="/calculate"  >
        @csrf
        <input type="hidden" name="hotel_id" value="{{$hotel_id}}">

        <div class="container w-25">

            <div class="row align-items-center">
                <div class="col">
                    @if (isset($errors) && $errors)
                    <p class="alert alert-danger">{{$errors}}</p>
                    @endif

                    @if (isset($info) && $info)
                    <p class="alert alert-info">{{$info}}</p>
                    @endif
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col">
                    <label for="select_dates" class="form-label">Выберите даты заезда и отъезда</label>
                    <input type="text" id="select_dates" name="select_dates" class="datepicker-here form-control"
                           data-range="true" data-multiple-dates-separator=" - " data-inline="true"
                           style="width: 252px;" value="{{$select_dates}}"
                           readonly
                    />
                </div>
            </div>

            <div class="row align-items-center mt-2">
                <div class="col">
                    <label for="qty" class="form-label">Число гостей</label>
                    <select class="form-select" id="qty" name="qty" aria-label="количесто человек">
                        <option value="1" @if ($qty == 1) selected @endif >1</option>
                        <option value="2" @if ($qty == 2) selected @endif >2</option>
                        <option value="3" @if ($qty == 3) selected @endif >3</option>
                        <option value="4" @if ($qty == 4) selected @endif >4</option>
                        <option value="5" @if ($qty == 5) selected @endif >5</option>
                        <option value="6" @if ($qty == 6) selected @endif >6</option>
                        <option value="7" @if ($qty == 7) selected @endif >7</option>
                        <option value="8" @if ($qty == 8) selected @endif >8</option>
                    </select>
                </div>
            </div>


            <div class="row align-items-center  mt-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Заказать</button>
                </div>
            </div>

        </div>

    </form>
</div>

<script>
    var datepicker1 =  $('#select_dates').datepicker({
        // Можно выбрать тольо даты, идущие за сегодняшним днем, включая сегодня
        minDate: new Date(),
        toggleSelected: false
    }).data('datepicker');


    {{--$('#select_dates').datepicker().data('datepicker').selectDate(new Date(2021, 6, 23), new Date(2021, 6, 28) );--}}
@if (isset($date_from) && isset($date_till))
    datepicker1.selectDate(new Date("{{$date_from}}"));
    datepicker1.selectDate(new Date("{{$date_till}}") );
@endif
</script>

</body>
</html>
