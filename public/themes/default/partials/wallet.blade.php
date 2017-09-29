<div class="wrap-wallet">


    <div>

        <div class="wrap-new-wallet" >
            <div class="title-new-wallet">
                <i class="icon-wallet svoe-lg svoe-icon"></i>
                {{ trans('sidebar.my_wallet') }}:
            </div>
            <div class="wrap-own-new-wallet">
                <a class="own-new-wallet" data-wallet="etk" href="#etk" aria-controls="etk" role="tab" data-toggle="tab" aria-expanded="true">
                    <h4><i class="fa fa-star" aria-hidden="true"></i>єТокени:</h4>
                    <p>{{ bcdiv($balance->token, 1000, 3) }}<span>etk</span></p>
                </a>
                <a class="own-new-wallet" data-wallet="eur" href="#eur" aria-controls="eur" role="tab" data-toggle="tab" aria-expanded="true">
                    <h4><i class="fa fa-star" aria-hidden="true"></i>{{ trans('common.euro_adj') }}</h4>
                    <p>{{ bcdiv($balance->euro, 100, 2) }}<span>eur</span></p>
                </a>
                <a class="own-new-wallet" data-wallet="usd" href="#usd" aria-controls="usd" role="tab" data-toggle="tab" aria-expanded="true">
                    <h4><i class="fa fa-star" aria-hidden="true"></i>{{ trans('common.dollar_adj') }}</h4>
                    <p>{{ bcdiv($balance->dollar, 100, 2) }}<span>usd</span></p>
                </a>
                <a class="own-new-wallet active-new-wallet" data-wallet="uah" href="#uah" aria-controls="uah" role="tab" data-toggle="tab" aria-expanded="true">
                    <h4><i class="fa fa-star" aria-hidden="true"></i>{{ trans('common.hryvnia_adj') }}</h4>
                    <p>{{ bcdiv($balance->grivna, 100, 2) }}<span>uah</span></p>
                </a>
                <input type="hidden" value="UAH" id="global_currency_selected">
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="pane-real tab-pane fade in active" id="uah">
                <div class="balans  no-padding">
                    <div class="panel-group" id="accordion">
                        <!-- 1 панель -->
                        <div class="panel panel-default no-border-all">
                            <!-- Заголовок 1 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" href="#collapseOne">
                                        <i class="icon icon-left">
                                            <i class="icon-ryka svoe-lg svoe-icon"></i>
                                        </i>
                                        Пополнить баланс
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- Содержимое 1 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="{{ url('/payment/index') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="real-money-currency" value="UAH" id="real-money-currency">
                                        <input type="hidden" name="real-money-ps" value="2" id="real-money-ps">
                                        <ul class="ps-list">
                                            <li class="active">
                                                <input type="radio" id="buy-visa-uah" name="ps-methods" class="radioButton" value="1" required checked>
                                                <label for="buy-visa-uah" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum first-currency-sum active-curr" data-currency="USD" data-ps="2">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="1">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="UAH" data-ps="8">
                                                            uah
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-perfect-uah" name="ps-methods" class="radioButton" value="2">
                                                <label for="buy-perfect-uah" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="4">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="3">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-paypal-uah" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="buy-paypal-uah" style="background-image: url('{!! Theme::asset()->url('images/payPal.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-webmoney-uah" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="buy-webmoney-uah" style="background-image: url('{!! Theme::asset()->url('images/webMoney.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="UAH" data-ps="">--}}
                                                            {{--uah--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="RUB" data-ps="">--}}
                                                            {{--rub--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input type="radio" id="buy-bitcoin-uah" name="ps-methods" class="radioButton">
                                                <label for="buy-bitcoin-uah" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="" data-ps="7">
                                                            btc
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-adv-uah" name="ps-methods" class="radioButton">
                                                <label for="buy-adv-uah" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="5">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="USD" data-ps="6">
                                                            usd
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-paysera-uah" name="ps-methods" class="radioButton">
                                                <label for="buy-paysera-uah" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="9">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="number" step="0.01" name="amount"  class="form-control no-radius" id="buy-summ" placeholder="" required>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                пополнить
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 2 панель -->
                        <div class="panel panel-default">
                            <!-- Заголовок 2 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" aria-expanded="false" href="#collapseTwo">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                        </i>
                                        Вывод средств
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <!-- Содержимое 2 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="text"  class="form-control no-radius" id="buy-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                продолжить
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul class="ps-list" style="margin-top: 20px;">
                                            <li>
                                                <input type="radio" id="out-visa-uah" name="ps-methods" class="radioButton" value="1" required>
                                                <label for="out-visa-uah" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-mastercard-uah" name="ps-methods" class="radioButton" value="2">
                                                <label for="out-mastercard-uah" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input type="radio" id="out-paypal-uah" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="out-paypal-uah" style="background-image: url('{!! Theme::asset()->url('images/payPal.png') !!}');" class="ps-img"></label>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<input type="radio" id="out-webmoney-uah" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="out-webmoney-uah" style="background-image: url('{!! Theme::asset()->url('images/webMoney.png') !!}');" class="ps-img"></label>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input type="radio" id="out-internetcash-uah" name="ps-methods" class="radioButton">
                                                <label for="out-internetcash-uah" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-adv-uah" name="ps-methods" class="radioButton">
                                                <label for="out-adv-uah" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-paysera-uah" name="ps-methods" class="radioButton">
                                                <label for="out-paysera-uah" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 3 панель -->

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" aria-expanded="false" href="#collapseUser">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод между своими счетами
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseUser" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Выберите счет для переводя</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">USD (0.02$)</option>
                                                <option value="">EUR (111.02€)</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" aria-expanded="false" href="#collapseThree">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод средств другому пользователю
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="start_form">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="number" step="0.01" class="form-control" id="send_summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">ID пользователя:</label>
                                            <input type="text" class="form-control" id="send_to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-default ps-submit pull-right transfer-user-by-id">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </div>
                                    <div class="confirmation_form" style="display: none">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Код подтверждения:</label>
                                            <input type="text" class="form-control" id="confirm_code" placeholder="">
                                            <input type="hidden" id="transaction_id" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-default ps-submit pull-right confirm-transfer-user-by-id">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                подтвердить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--<div id="collapseThree" class="panel-collapse collapse">--}}
                                {{--<!-- Содержимое 3 панели -->--}}
                                {{--<div class="panel-body">--}}
                                    {{--<div class="border"></div>--}}
                                    {{--<form action="">--}}
                                        {{--<div class="col-xs-12 col-sm-6 ps-label">--}}
                                            {{--<label for="sell-summ">Сумма(UAH):</label>--}}
                                            {{--<input type="text" class="form-control" id="send-summ" placeholder="">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xs-12 col-sm-6 ps-label">--}}
                                            {{--<label for="send-to">ID пользователя:</label>--}}
                                            {{--<input type="text" class="form-control" id="send-to" placeholder="">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xs-12">--}}
                                            {{--<button type="submit" class="btn btn-default ps-submit pull-right">--}}
                                                {{--<i class="icon-vuvid svoe-lg svoe-icon"></i>--}}
                                                {{--перевести--}}
                                            {{--</button>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" aria-expanded="false" href="#collapseFour">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid-email svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод на E-Mail:
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Адрес електронной почты:</label>
                                            <input type="text" class="form-control" id="send-to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                переслать
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" aria-expanded="false" href="#collapseFive">
                                        <i class="icon icon-left">
                                            <i class="icon-tovary svoe-lg svoe-icon"></i>
                                        </i>
                                        Оплатить товары и услуги
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="wrap-card-wallet row">
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet">
                                                <i class="fa fa-mobile fa-2x" style="left:28px" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильная <br> связь</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-television fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Интернет <br> и телевидение</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-gamepad fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Компьютерные <br> игры</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-futbol-o fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Спорт <br> и туризм</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-heartbeat fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Здоровье <br> и красота</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-ticket fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Билеты <br> и купоны</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильные приложения,<br> софт</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" aria-expanded="false" href="#collapseSix">
                                        <i class="icon icon-left">
                                            <i class="icon-istoriya svoe-lg svoe-icon"></i>
                                        </i>
                                        История транзакций
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse">

                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="form-group date-form">
                                        <input id="date-from-real-money"  type="date" value="{{ date("Y-m-d", strtotime("-7 day")) }}">
                                        <span class="date-symb hidden-xs" >-</span>
                                        <input id="date-to-real-money" type="date" value="{{ date("Y-m-d") }}">
                                        <button id="real-money-new-period" type="button" class="btn btn-primary real-money-new-period" style="font-size: 10px; margin-left: 10px">{{--<i class="fa fa-arrow-right"></i>--}}OK</button>
                                        <input class="real-money-currency" type="hidden" value="UAH">
                                    </div>
                                    <table class=" table-responsive table-hover payment-history">
                                        <thead >
                                        <tr class="active">
                                            <td>
                                                {{ trans('common.description') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.amount_2') }}:
                                            </td>
                                            <td class="table-date">
                                                {{ trans('common.date') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.transaction_type') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.status_2') }}:
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td class="t-title">
                                                <i class="icon">
                                                    <svg xmlns="https://www.w3.org/2000/svg" width="17.969" height="15" viewBox="0 0 17.969 15"><metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?><x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        "><rdf:RDF xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"><rdf:Description rdf:about=""/></rdf:RDF></x:xmpmeta><?xpacket end="w"?></metadata><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs><path id="Forma_1" data-name="Forma 1" class="cls-1" d="M310.614,464.839H300.122a0.4,0.4,0,0,0-.434.547l1.659,4.507a0.717,0.717,0,0,0,.646.44h6.879a0.713,0.713,0,0,0,.645-0.44l1.447-4.613A0.326,0.326,0,0,0,310.614,464.839Zm-9.543,9.231a1.459,1.459,0,1,1-1.569,1.455A1.516,1.516,0,0,1,301.071,474.07Zm6.641,0.019a1.459,1.459,0,1,1-1.569,1.454A1.515,1.515,0,0,1,307.712,474.089Zm1.885-2.275h-9.179l-3.675-9.8h-2.861a0.826,0.826,0,1,0,0,1.647h1.6l3.675,9.8H309.6A0.826,0.826,0,1,0,309.6,471.814Z" transform="translate(-293 -462)"/></svg>
                                                </i>
                                                <p>
                                                    Оплата за квиток Квартал 95
                                                </p>
                                            </td>
                                            <td class="summ">
                                                700,00 еТокенов
                                            </td>
                                            <td class="table-date">
                                                19/06/2017
                                            </td>
                                            <td>
                                                Pay-card
                                            </td>
                                            <td class="status payed">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                Оплачено
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="t-title">
                                                <i class="icon">
                                                    <svg xmlns="https://www.w3.org/2000/svg" width="18" height="11" viewBox="0 0 18 11"><metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?><x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        "><rdf:RDF xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"><rdf:Description rdf:about=""/></rdf:RDF></x:xmpmeta><?xpacket end="w"?></metadata><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs><path id="Shape_1_copy_5" data-name="Shape 1 copy 5" class="cls-1" d="M299.2,349l-0.251,2.866h-3.477a0.465,0.465,0,0,0-.339.141,0.454,0.454,0,0,0-.143.333v2.575a0.454,0.454,0,0,0,.143.333,2.49,2.49,0,0,0,.339-0.387h3.477l0.251,3.13,4.806-4.5ZM308,353.4c1.846,0,2.51-1.506,2.684-2.743,0.215-1.524-.67-2.671-2.684-2.671s-2.9,1.147-2.683,2.671C305.486,351.893,306.149,353.4,308,353.4Zm4.994,3.586a8.387,8.387,0,0,0-.192-1.435,2.624,2.624,0,0,0-.9-1.785,5.658,5.658,0,0,0-1.22-.416c-0.2-.064-0.375-0.127-0.541-0.2a3.392,3.392,0,0,1-4.287,0c-0.167.071-.344,0.134-0.541,0.2a5.64,5.64,0,0,0-1.22.416,2.624,2.624,0,0,0-.9,1.785,8.387,8.387,0,0,0-.192,1.435c-0.016.371,0.21,0.423,0.592,0.536a7.309,7.309,0,0,0,8.8,0C312.779,357.408,313,357.356,312.989,356.985Z" transform="translate(-295 -348)"/></svg>
                                                </i>
                                                <p>
                                                    Перевод еТокенов Андрею Савчину
                                                </p>
                                            </td>
                                            <td class="summ">
                                                1600,00 еТокенов
                                            </td>
                                            <td class="table-date">
                                                19/06/2017
                                            </td>
                                            <td>
                                                Pay-card
                                            </td>
                                            <td class="status payed">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                Оплачено
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="t-title">
                                                <i class="icon">
                                                    <svg xmlns="https://www.w3.org/2000/svg" width="17.969" height="15" viewBox="0 0 17.969 15"><metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?><x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        "><rdf:RDF xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"><rdf:Description rdf:about=""/></rdf:RDF></x:xmpmeta><?xpacket end="w"?></metadata><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs><path id="Forma_1" data-name="Forma 1" class="cls-1" d="M310.614,464.839H300.122a0.4,0.4,0,0,0-.434.547l1.659,4.507a0.717,0.717,0,0,0,.646.44h6.879a0.713,0.713,0,0,0,.645-0.44l1.447-4.613A0.326,0.326,0,0,0,310.614,464.839Zm-9.543,9.231a1.459,1.459,0,1,1-1.569,1.455A1.516,1.516,0,0,1,301.071,474.07Zm6.641,0.019a1.459,1.459,0,1,1-1.569,1.454A1.515,1.515,0,0,1,307.712,474.089Zm1.885-2.275h-9.179l-3.675-9.8h-2.861a0.826,0.826,0,1,0,0,1.647h1.6l3.675,9.8H309.6A0.826,0.826,0,1,0,309.6,471.814Z" transform="translate(-293 -462)"/></svg>
                                                </i>
                                                <p>
                                                    Оплата за квиток Квартал 95
                                                </p>
                                            </td>
                                            <td class="summ">
                                                350,00 еТокенов
                                            </td>
                                            <td class="table-date">
                                                19/06/2017
                                            </td>
                                            <td>
                                                Pay-card
                                            </td>
                                            <td class="status cancel">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                Отмена
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="col-xs-12" id="next-page-real-money" data-next-page="1" class="next-page-real-money">
                                        <button type="submit" class="btn btn-default ps-submit pull-right">
                                            <i class="fa fa-arrow-right"></i>
                                            {{ trans('common.view_more') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="pane-real tab-pane fade" id="usd">
                <div class="balans  no-padding">
                    <div class="panel-group" id="accordion-usd">
                        <!-- 1 панель -->
                        <div class="panel panel-default no-border-all">
                            <!-- Заголовок 1 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-usd" aria-expanded="true" href="#collapseOne-usd">
                                        <i class="icon icon-left">
                                            <i class="icon-ryka svoe-lg svoe-icon"></i>
                                        </i>
                                        Пополнить баланс
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne-usd" class="panel-collapse collapse in">
                                <!-- Содержимое 1 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="{{ url('/payment/index') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="real-money-currency" value="USD" id="real-money-currency">
                                        <input type="hidden" name="real-money-ps" value="2" id="real-money-ps">
                                        <ul class="ps-list">
                                            <li class="active">
                                                <input type="radio" id="buy-visa-usd" name="ps-methods-usd" class="radioButton" value="1">
                                                <label for="buy-visa-usd" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum first-currency-sum active-curr" data-currency="USD" data-ps="2">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="1">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="UAH" data-ps="8">
                                                            uah
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-perfect-usd" name="ps-methods-usd" class="radioButton" value="2">
                                                <label for="buy-perfect-usd" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="4">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="3">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-paypal-usd" name="ps-methods-usd" class="radioButton">--}}
                                                {{--<label for="buy-paypal-usd" style="background-image: url('{!! Theme::asset()->url('images/payPal.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-webmoney-usd" name="ps-methods-usd" class="radioButton">--}}
                                                {{--<label for="buy-webmoney-usd" style="background-image: url('{!! Theme::asset()->url('images/webMoney.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="UAH" data-ps="">--}}
                                                            {{--uah--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="RUB" data-ps="">--}}
                                                            {{--rub--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input type="radio" id="buy-bitcoin-usd" name="ps-methods-usd" class="radioButton">
                                                <label for="buy-bitcoin-usd" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="" data-ps="7">
                                                            btc
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-adv-usd" name="ps-methods-usd" class="radioButton">
                                                <label for="buy-adv-usd" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="5">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="USD" data-ps="6">
                                                            usd
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-paysera-usd" name="ps-methods-usd" class="radioButton">
                                                <label for="buy-paysera-usd" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="9">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="text" name="amount"  class="form-control no-radius" id="buy-summ" placeholder="" required>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                пополнить
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 2 панель -->
                        <div class="panel panel-default">
                            <!-- Заголовок 2 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-usd" aria-expanded="false" href="#collapseTwo-usd">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                        </i>
                                        Вывод средств
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo-usd" class="panel-collapse collapse">
                                <!-- Содержимое 2 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="text"  class="form-control no-radius" id="buy-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                продолжить
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul class="ps-list" style="margin-top: 20px;">
                                            <li>
                                                <input type="radio" id="out-visa-usd" name="ps-methods-usd" class="radioButton" value="1" >
                                                <label for="out-visa-usd" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-mastercard-usd" name="ps-methods-usd" class="radioButton" value="2">
                                                <label for="out-mastercard-usd" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input type="radio" id="out-paypal-usd" name="ps-methods-usd" class="radioButton">--}}
                                                {{--<label for="out-paypal-usd" style="background-image: url('{!! Theme::asset()->url('images/payPal.png') !!}');" class="ps-img"></label>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<input type="radio" id="out-webmoney-usd" name="ps-methods-usd" class="radioButton">--}}
                                                {{--<label for="out-webmoney-usd" style="background-image: url('{!! Theme::asset()->url('images/webMoney.png') !!}');" class="ps-img"></label>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input type="radio" id="out-internetcash-usd" name="ps-methods-usd" class="radioButton">
                                                <label for="out-internetcash-usd" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-adv-usd" name="ps-methods-usd" class="radioButton">
                                                <label for="out-adv-usd" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-paysera-usd" name="ps-methods-usd" class="radioButton">
                                                <label for="out-paysera-usd" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 3 панель -->

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-usd" aria-expanded="false" href="#collapseUser-usd">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод между своими счетами
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseUser-usd" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Выберите счет для переводя</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">USD (0.02$)</option>
                                                <option value="">EUR (111.02€)</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-usd" aria-expanded="false" href="#collapseThree-usd">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод средств другому пользователю
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="false" href="#collapse4-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод средств другому пользователю
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4-usd" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="start_form">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="number" step="0.01" class="form-control" id="send_summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">ID пользователя:</label>
                                            <input type="text" class="form-control" id="send_to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-default ps-submit pull-right transfer-user-by-id">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </div>
                                    <div class="confirmation_form" style="display: none">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Код подтверждения:</label>
                                            <input type="text" class="form-control" id="confirm_code" placeholder="">
                                            <input type="hidden" id="transaction_id" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-default ps-submit pull-right confirm-transfer-user-by-id">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                подтвердить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div id="collapseThree-usd" class="panel-collapse collapse">--}}
                                {{--<!-- Содержимое 3 панели -->--}}
                                {{--<div class="panel-body">--}}
                                    {{--<div class="border"></div>--}}
                                    {{--<form action="">--}}
                                        {{--<div class="col-xs-12 col-sm-6 ps-label">--}}
                                            {{--<label for="sell-summ">Сумма($):</label>--}}
                                            {{--<input type="text" class="form-control" id="send-summ" placeholder="">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xs-12 col-sm-6 ps-label">--}}
                                            {{--<label for="send-to">ID пользователя:</label>--}}
                                            {{--<input type="text" class="form-control" id="send-to" placeholder="">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xs-12">--}}
                                            {{--<button type="submit" class="btn btn-default ps-submit pull-right">--}}
                                                {{--<i class="icon-vuvid svoe-lg svoe-icon"></i>--}}
                                                {{--перевести--}}
                                            {{--</button>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-usd" aria-expanded="false" href="#collapseFour-usd">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid-email svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод на E-Mail:
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour-usd" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Адрес електронной почты:</label>
                                            <input type="text" class="form-control" id="send-to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                переслать
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-usd" aria-expanded="false" href="#collapseFive-usd">
                                        <i class="icon icon-left">
                                            <i class="icon-tovary svoe-lg svoe-icon"></i>
                                        </i>
                                        Оплатить товары и услуги
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive-usd" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="wrap-card-wallet row">
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet">
                                                <i class="fa fa-mobile fa-2x" style="left:28px" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильная <br> связь</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-television fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Интернет <br> и телевидение</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-gamepad fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Компьютерные <br> игры</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-futbol-o fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Спорт <br> и туризм</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-heartbeat fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Здоровье <br> и красота</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-ticket fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Билеты <br> и купоны</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильные приложения,<br> софт</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-usd" aria-expanded="false" href="#collapseSix-usd">
                                        <i class="icon icon-left">
                                            <i class="icon-istoriya svoe-lg svoe-icon"></i>
                                        </i>
                                        История транзакций
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix-usd" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="form-group date-form">
                                        <input id="date-from-real-money"  type="date" value="{{ date("Y-m-d", strtotime("-7 day")) }}">
                                        <span class="date-symb hidden-xs" >-</span>
                                        <input id="date-to-real-money" type="date" value="{{ date("Y-m-d") }}">
                                        <button id="real-money-new-period" type="submit" class="btn btn-primary real-money-new-period" style="font-size: 10px; margin-left: 10px">{{--<i class="fa fa-arrow-right"></i>--}}OK</button>
                                        <input class="real-money-currency" type="hidden" value="USD">
                                    </div>
                                    <table class=" table-responsive table-hover payment-history">
                                        <thead >
                                        <tr class="active">
                                            <td>
                                                {{ trans('common.description') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.amount_2') }}:
                                            </td>
                                            <td class="table-date">
                                                {{ trans('common.date') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.transaction_type') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.status_2') }}:
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody >

                                        </tbody>
                                    </table>
                                    <div class="col-xs-12" id="next-page-real-money" data-next-page="1" class="next-page-real-money">
                                        <button type="submit" class="btn btn-default ps-submit pull-right">
                                            <i class="fa fa-arrow-right"></i>
                                            {{ trans('common.view_more') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="pane-real tab-pane fade " id="eur">
                <div class="balans  no-padding">
                    <div class="panel-group" id="accordion-eur">
                        <!-- 1 панель -->
                        <div class="panel panel-default no-border-all">
                            <!-- Заголовок 1 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="true" href="#collapse1-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-ryka svoe-lg svoe-icon"></i>
                                        </i>
                                        Пополнить баланс
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1-eur" class="panel-collapse collapse in">
                                <!-- Содержимое 1 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="{{ url('/payment/index') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="real-money-currency" value="EUR" id="real-money-currency">
                                        <input type="hidden" name="real-money-ps" value="2" id="real-money-ps">
                                        <ul class="ps-list">
                                            <li class="active">
                                                <input type="radio" id="buy-visa-eur" name="ps-methods" class="radioButton" value="1">
                                                <label for="buy-visa-eur" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum first-currency-sum active-curr" data-currency="USD" data-ps="2">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="1">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="UAH" data-ps="8">
                                                            uah
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-perfect-eur" name="ps-methods" class="radioButton" value="2">
                                                <label for="buy-perfect-eur" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="4">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="3">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-paypal-eur" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="buy-paypal-eur" style="background-image: url('{!! Theme::asset()->url('images/payPal.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-webmoney-eur" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="buy-webmoney-eur" style="background-image: url('{!! Theme::asset()->url('images/webMoney.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="UAH" data-ps="">--}}
                                                            {{--uah--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="RUB" data-ps="">--}}
                                                            {{--rub--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input type="radio" id="buy-bitcoin-eur" name="ps-methods" class="radioButton">
                                                <label for="buy-bitcoin-eur" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="" data-ps="7">
                                                            btc
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-adv-eur" name="ps-methods" class="radioButton">
                                                <label for="buy-adv-eur" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="5">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="USD" data-ps="6">
                                                            usd
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-paysera-eur" name="ps-methods" class="radioButton">
                                                <label for="buy-paysera-eur" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="9">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="text" name="amount"  class="form-control no-radius" id="buy-summ" placeholder="" >
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                пополнить
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 2 панель -->
                        <div class="panel panel-default">
                            <!-- Заголовок 2 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="false" href="#collapse2-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                        </i>
                                        Вывод средств
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2-eur" class="panel-collapse collapse">
                                <!-- Содержимое 2 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="text"  class="form-control no-radius" id="buy-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                продолжить
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul class="ps-list" style="margin-top: 20px;">
                                            <li>
                                                <input type="radio" id="out-visa-eur" name="ps-methods" class="radioButton" value="1">
                                                <label for="out-visa-eur" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-mastercard-eur" name="ps-methods" class="radioButton" value="2">
                                                <label for="out-mastercard-eur" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-internetcash-eur" name="ps-methods" class="radioButton">
                                                <label for="out-internetcash-eur" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-adv-eur" name="ps-methods" class="radioButton">
                                                <label for="out-adv-eur" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-paysera-eur" name="ps-methods" class="radioButton">
                                                <label for="out-paysera-eur" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 3 панель -->

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="false" href="#collapse3-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод между своими счетами
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3-eur" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Выберите счет для переводя</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">USD (0.02$)</option>
                                                <option value="">EUR (111.02€)</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="false" href="#collapse4-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод средств другому пользователю
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4-eur" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="start_form">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="number" step="0.01" class="form-control" id="send_summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">ID пользователя:</label>
                                            <input type="text" class="form-control" id="send_to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-default ps-submit pull-right transfer-user-by-id">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </div>
                                    <div class="confirmation_form" style="display: none">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Код подтверждения:</label>
                                            <input type="text" class="form-control" id="confirm_code" placeholder="">
                                            <input type="hidden" id="transaction_id" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-default ps-submit pull-right confirm-transfer-user-by-id">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                подтвердить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="false" href="#collapse5-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid-email svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод на E-Mail:
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5-eur" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Адрес електронной почты:</label>
                                            <input type="text" class="form-control" id="send-to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                переслать
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="false" href="#collapse6-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-tovary svoe-lg svoe-icon"></i>
                                        </i>
                                        Оплатить товары и услуги
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6-eur" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="wrap-card-wallet row">
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet">
                                                <i class="fa fa-mobile fa-2x" style="left:28px" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильная <br> связь</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-television fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Интернет <br> и телевидение</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-gamepad fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Компьютерные <br> игры</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-futbol-o fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Спорт <br> и туризм</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-heartbeat fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Здоровье <br> и красота</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-ticket fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Билеты <br> и купоны</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильные приложения,<br> софт</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-eur" aria-expanded="false" href="#collapseSix-eur">
                                        <i class="icon icon-left">
                                            <i class="icon-istoriya svoe-lg svoe-icon"></i>
                                        </i>
                                        История транзакций
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix-eur" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="form-group date-form">
                                        <input id="date-from-real-money"  type="date" value="{{ date("Y-m-d", strtotime("-7 day")) }}">
                                        <span class="date-symb hidden-xs" >-</span>
                                        <input id="date-to-real-money" type="date" value="{{ date("Y-m-d") }}">
                                        <button id="real-money-new-period" type="submit" class="btn btn-primary real-money-new-period" style="font-size: 10px; margin-left: 10px">{{--<i class="fa fa-arrow-right"></i>--}}OK</button>
                                        <input class="real-money-currency" type="hidden" value="EUR">
                                    </div>
                                    <table class=" table-responsive table-hover payment-history">
                                        <thead >
                                        <tr class="active">
                                            <td>
                                                {{ trans('common.description') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.amount_2') }}:
                                            </td>
                                            <td class="table-date">
                                                {{ trans('common.date') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.transaction_type') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.status_2') }}:
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody >

                                        </tbody>
                                    </table>
                                    <div class="col-xs-12" id="next-page-real-money" data-next-page="1" class="next-page-real-money">
                                        <button type="submit" class="btn btn-default ps-submit pull-right">
                                            <i class="fa fa-arrow-right"></i>
                                            {{ trans('common.view_more') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="pane-token tab-pane fade " id="etk">
                <div class="balans  no-padding">
                    <div class="panel-group" id="accordion-etk">
                        <!-- 1 панель -->
                        <div class="panel panel-default no-border-all">
                            <!-- Заголовок 1 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-etk" aria-expanded="true" href="#collapseOne-etk">
                                        <i class="icon icon-left">
                                            <i class="icon-ryka svoe-lg svoe-icon"></i>
                                        </i>
                                        Пополнить баланс
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne-etk" class="panel-collapse collapse in">
                                <!-- Содержимое 1 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="{{ url('/payment/index') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="real-money-currency" value="ETK" id="real-money-currency">
                                        <input type="hidden" name="real-money-ps" value="2" id="real-money-ps">
                                        <ul class="ps-list">
                                            <li class="active">
                                                <input type="radio" id="buy-visa-etk" name="ps-methods" class="radioButton" value="1">
                                                <label for="buy-visa-etk" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum first-currency-sum active-curr" data-currency="USD" data-ps="2">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="1">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="own-currency-sum" data-currency="UAH" data-ps="8">
                                                            uah
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-perfect-etk" name="ps-methods" class="radioButton" value="2">
                                                <label for="buy-perfect-etk" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="4">
                                                            usd
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="EUR" data-ps="3">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-paypal-etk" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="buy-paypal-etk" style="background-image: url('{!! Theme::asset()->url('images/payPal.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<input type="radio" id="buy-webmoney-etk" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="buy-webmoney-etk" style="background-image: url('{!! Theme::asset()->url('images/webMoney.png') !!}');" class="ps-img"></label>--}}
                                                {{--<div class="row currency-sum">--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum first-currency-sum" data-currency="USD" data-ps="">--}}
                                                            {{--usd--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="EUR" data-ps="">--}}
                                                            {{--eur--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="UAH" data-ps="">--}}
                                                            {{--uah--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-xs-3">--}}
                                                        {{--<div class="own-currency-sum" data-currency="RUB" data-ps="">--}}
                                                            {{--rub--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input type="radio" id="buy-bitcoin-etk" name="ps-methods" class="radioButton">
                                                <label for="buy-bitcoin-etk" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="" data-ps="7">
                                                            btc
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-adv-etk" name="ps-methods" class="radioButton">
                                                <label for="buy-adv-etk" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="5">
                                                            eur
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="own-currency-sum" data-currency="USD" data-ps="6">
                                                            usd
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="radio" id="buy-paysera-etk" name="ps-methods" class="radioButton">
                                                <label for="buy-paysera-etk" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                                <div class="row currency-sum">
                                                    <div class="col-xs-12">
                                                        <div class="own-currency-sum first-currency-sum" data-currency="EUR" data-ps="9">
                                                            eur
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="text" name="amount"  class="form-control no-radius" id="buy-summ" placeholder="" >
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                пополнить
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 2 панель -->
                        <div class="panel panel-default">
                            <!-- Заголовок 2 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-etk" aria-expanded="false" href="#collapseTwo-etk">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                        </i>
                                        Вывод средств
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo-etk" class="panel-collapse collapse">
                                <!-- Содержимое 2 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-12 ps-field">
                                            <label   for="buy-summ">Введите сумму</label>
                                            <input type="text"  class="form-control no-radius" id="buy-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 ps-btn">
                                            <button type="submit" id="ps-submit" class="btn btn-default ps-submit">
                                                <i class="icon-ryka svoe-lg svoe-icon"></i>
                                                продолжить
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul class="ps-list" style="margin-top: 20px;">
                                            <li>
                                                <input type="radio" id="out-visa-etk" name="ps-methods" class="radioButton" value="1" >
                                                <label for="out-visa-etk" style="background-image: url('{!! Theme::asset()->url('images/visamaster.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-mastercard-etk" name="ps-methods" class="radioButton" value="2">
                                                <label for="out-mastercard-etk" style="background-image: url('{!! Theme::asset()->url('images/perfectmoney.png') !!}');" class="ps-img"></label>
                                            </li>
                                            {{--<li>--}}
                                                {{--<input type="radio" id="out-paypal-etk" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="out-paypal-etk" style="background-image: url('{!! Theme::asset()->url('images/payPal.png') !!}');" class="ps-img"></label>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<input type="radio" id="out-webmoney-etk" name="ps-methods" class="radioButton">--}}
                                                {{--<label for="out-webmoney-etk" style="background-image: url('{!! Theme::asset()->url('images/webMoney.png') !!}');" class="ps-img"></label>--}}
                                            {{--</li>--}}
                                            <li>
                                                <input type="radio" id="out-internetcash-etk" name="ps-methods" class="radioButton">
                                                <label for="out-internetcash-etk" style=" background-image: url('{!! Theme::asset()->url('images/bitcoin.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-adv-etk" name="ps-methods" class="radioButton">
                                                <label for="out-adv-etk" style=" background-image: url('{!! Theme::asset()->url('images/advcash.png') !!}');" class="ps-img"></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="out-paysera-etk" name="ps-methods" class="radioButton">
                                                <label for="out-paysera-etk" style=" background-image: url('{!! Theme::asset()->url('images/paysera.png') !!}');" class="ps-img"></label>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 3 панель -->

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-etk" aria-expanded="false" href="#collapseUser-etk">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод между своими счетами
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseUser-etk" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Выберите счет для переводя</label>
                                            <select class="form-control" name="" id="">
                                                <option value="">USD (0.02$)</option>
                                                <option value="">EUR (111.02€)</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-etk" aria-expanded="false" href="#collapseThree-etk">
                                        <i class="icon icon-left">
                                            <i class="icon-perekaz svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод средств другому пользователю
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree-etk" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">ID пользователя:</label>
                                            <input type="text" class="form-control" id="send-to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                перевести
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-etk" aria-expanded="false" href="#collapseFour-etk">
                                        <i class="icon icon-left">
                                            <i class="icon-vuvid-email svoe-lg svoe-icon"></i>
                                        </i>
                                        Перевод на E-Mail:
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour-etk" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <form action="">
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="sell-summ">Сумма($):</label>
                                            <input type="text" class="form-control" id="send-summ" placeholder="">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ps-label">
                                            <label for="send-to">Адрес електронной почты:</label>
                                            <input type="text" class="form-control" id="send-to" placeholder="">
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-default ps-submit pull-right">
                                                <i class="icon-vuvid svoe-lg svoe-icon"></i>
                                                переслать
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-etk" aria-expanded="false" href="#collapseFive-etk">
                                        <i class="icon icon-left">
                                            <i class="icon-tovary svoe-lg svoe-icon"></i>
                                        </i>
                                        Оплатить товары и услуги
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive-etk" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="wrap-card-wallet row">
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet">
                                                <i class="fa fa-mobile fa-2x" style="left:28px" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильная <br> связь</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-television fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Интернет <br> и телевидение</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-gamepad fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Компьютерные <br> игры</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-futbol-o fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Спорт <br> и туризм</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-heartbeat fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Здоровье <br> и красота</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-ticket fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Билеты <br> и купоны</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 own-card-col">
                                            <div class="own-card-wallet" >
                                                <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                                                <span class="text-card-wallet">Мобильные приложения,<br> софт</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- Заголовок 3 панели -->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-etk" aria-expanded="false" href="#collapseSix-etk">
                                        <i class="icon icon-left">
                                            <i class="icon-istoriya svoe-lg svoe-icon"></i>
                                        </i>
                                        История транзакций
                                        <i class="fa fa-chevron-down icon-right" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-right icon-right " aria-hidden="true"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix-etk" class="panel-collapse collapse">
                                <!-- Содержимое 3 панели -->
                                <div class="panel-body">
                                    <div class="border"></div>
                                    <div class="form-group date-form">
                                        <input id="date-from-real-money"  type="date" value="{{ date("Y-m-d", strtotime("-7 day")) }}">
                                        <span class="date-symb hidden-xs" >-</span>
                                        <input id="date-to-real-money" type="date" value="{{ date("Y-m-d") }}">
                                        <button id="real-money-new-period" type="submit" class="btn btn-primary real-money-new-period" style="font-size: 10px; margin-left: 10px">{{--<i class="fa fa-arrow-right"></i>--}}OK</button>
                                        <input class="real-money-currency" type="hidden" value="ETK">
                                    </div>
                                    <table class=" table-responsive table-hover payment-history">
                                        <thead >
                                        <tr class="active">
                                            <td>
                                                {{ trans('common.description') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.amount_2') }}:
                                            </td>
                                            <td class="table-date">
                                                {{ trans('common.date') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.transaction_type') }}:
                                            </td>
                                            <td>
                                                {{ trans('common.status_2') }}:
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td class="t-title">
                                                <i class="icon">
                                                    <svg xmlns="https://www.w3.org/2000/svg" width="17.969" height="15" viewBox="0 0 17.969 15"><metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?><x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        "><rdf:RDF xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"><rdf:Description rdf:about=""/></rdf:RDF></x:xmpmeta><?xpacket end="w"?></metadata><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs><path id="Forma_1" data-name="Forma 1" class="cls-1" d="M310.614,464.839H300.122a0.4,0.4,0,0,0-.434.547l1.659,4.507a0.717,0.717,0,0,0,.646.44h6.879a0.713,0.713,0,0,0,.645-0.44l1.447-4.613A0.326,0.326,0,0,0,310.614,464.839Zm-9.543,9.231a1.459,1.459,0,1,1-1.569,1.455A1.516,1.516,0,0,1,301.071,474.07Zm6.641,0.019a1.459,1.459,0,1,1-1.569,1.454A1.515,1.515,0,0,1,307.712,474.089Zm1.885-2.275h-9.179l-3.675-9.8h-2.861a0.826,0.826,0,1,0,0,1.647h1.6l3.675,9.8H309.6A0.826,0.826,0,1,0,309.6,471.814Z" transform="translate(-293 -462)"/></svg>
                                                </i>
                                                <p>
                                                    Оплата за квиток Квартал 95
                                                </p>
                                            </td>
                                            <td class="summ">
                                                700,00 еТокенов
                                            </td>
                                            <td class="table-date">
                                                19/06/2017
                                            </td>
                                            <td>
                                                Pay-card
                                            </td>
                                            <td class="status payed">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                Оплачено
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="t-title">
                                                <i class="icon">
                                                    <svg xmlns="https://www.w3.org/2000/svg" width="18" height="11" viewBox="0 0 18 11"><metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?><x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        "><rdf:RDF xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"><rdf:Description rdf:about=""/></rdf:RDF></x:xmpmeta><?xpacket end="w"?></metadata><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs><path id="Shape_1_copy_5" data-name="Shape 1 copy 5" class="cls-1" d="M299.2,349l-0.251,2.866h-3.477a0.465,0.465,0,0,0-.339.141,0.454,0.454,0,0,0-.143.333v2.575a0.454,0.454,0,0,0,.143.333,2.49,2.49,0,0,0,.339-0.387h3.477l0.251,3.13,4.806-4.5ZM308,353.4c1.846,0,2.51-1.506,2.684-2.743,0.215-1.524-.67-2.671-2.684-2.671s-2.9,1.147-2.683,2.671C305.486,351.893,306.149,353.4,308,353.4Zm4.994,3.586a8.387,8.387,0,0,0-.192-1.435,2.624,2.624,0,0,0-.9-1.785,5.658,5.658,0,0,0-1.22-.416c-0.2-.064-0.375-0.127-0.541-0.2a3.392,3.392,0,0,1-4.287,0c-0.167.071-.344,0.134-0.541,0.2a5.64,5.64,0,0,0-1.22.416,2.624,2.624,0,0,0-.9,1.785,8.387,8.387,0,0,0-.192,1.435c-0.016.371,0.21,0.423,0.592,0.536a7.309,7.309,0,0,0,8.8,0C312.779,357.408,313,357.356,312.989,356.985Z" transform="translate(-295 -348)"/></svg>
                                                </i>
                                                <p>
                                                    Перевод еТокенов Андрею Савчину
                                                </p>
                                            </td>
                                            <td class="summ">
                                                1600,00 еТокенов
                                            </td>
                                            <td class="table-date">
                                                19/06/2017
                                            </td>
                                            <td>
                                                Pay-card
                                            </td>
                                            <td class="status payed">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                Оплачено
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="t-title">
                                                <i class="icon">
                                                    <svg xmlns="https://www.w3.org/2000/svg" width="17.969" height="15" viewBox="0 0 17.969 15"><metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?><x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        "><rdf:RDF xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"><rdf:Description rdf:about=""/></rdf:RDF></x:xmpmeta><?xpacket end="w"?></metadata><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs><path id="Forma_1" data-name="Forma 1" class="cls-1" d="M310.614,464.839H300.122a0.4,0.4,0,0,0-.434.547l1.659,4.507a0.717,0.717,0,0,0,.646.44h6.879a0.713,0.713,0,0,0,.645-0.44l1.447-4.613A0.326,0.326,0,0,0,310.614,464.839Zm-9.543,9.231a1.459,1.459,0,1,1-1.569,1.455A1.516,1.516,0,0,1,301.071,474.07Zm6.641,0.019a1.459,1.459,0,1,1-1.569,1.454A1.515,1.515,0,0,1,307.712,474.089Zm1.885-2.275h-9.179l-3.675-9.8h-2.861a0.826,0.826,0,1,0,0,1.647h1.6l3.675,9.8H309.6A0.826,0.826,0,1,0,309.6,471.814Z" transform="translate(-293 -462)"/></svg>
                                                </i>
                                                <p>
                                                    Оплата за квиток Квартал 95
                                                </p>
                                            </td>
                                            <td class="summ">
                                                350,00 еТокенов
                                            </td>
                                            <td class="table-date">
                                                19/06/2017
                                            </td>
                                            <td>
                                                Pay-card
                                            </td>
                                            <td class="status cancel">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                Отмена
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="col-xs-12" id="next-page-real-money" data-next-page="1" class="next-page-real-money">
                                        <button type="submit" class="btn btn-default ps-submit pull-right">
                                            <i class="fa fa-arrow-right"></i>
                                            {{ trans('common.view_more') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
