{{--@foreach($transfers as $transfer)--}}
@foreach($transactions as $transfer)
    <tr>
        <td class="t-title">
            <i class="fa fa-shopping-cart fa-lg" style="color: lightgray"></i>
            <p>
                {{ $transfer['operation_description'] }}
            </p>
        </td>
        <td class="summ">
            {{ $transfer['operation_amount'] }} {{ $transfer['operation_currency'] }}
        </td>
        <td class="table-date">
            {{--19/06/2017 --}}
            {{ date("d/m/Y", $transfer['operation_date']) }}
        </td>
        <td>
            Pay-card
        </td>
        <td class="status payed">
            <i class="fa fa-check" aria-hidden="true"></i>
            Оплачено
        </td>
    </tr>
@endforeach