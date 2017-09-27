<div class="container container-grid">
    <div class="row">
        <div class="col-sm-3">
            <div class="wrap-name-game">
                <div class="img-sett-name"></div>
                <div class="name-game">Documentation</div>
                <div class="clearfix"></div>
            </div>
            <!-- Nav tabs -->
            {!! Theme::partial('developer.menu') !!}
        </div>
        <div class="col-sm-9">
            <!-- Tab panes -->
            <div class="tab-content content-sett-app">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            JS API
                        </div>
                        <div class="panel-body" style="padding: 20px;">

                            <!-- content -->

                            <h1 style='background:#FBFBFB'>
                                <span style='font-family:"Arial",sans-serif; color:#333333'>
                                    JavaScript SDK
                                </span>
                            </h1>

                            <p style='background:#FBFBFB'>
                                <span style='font-size:10.5pt; font-family:"Arial",sans-serif; color:#333333'>
                                    Javascript SDK - это SDK для встроенных приложений, которые представляют собой iframe, контент которого расположен на сервере разработчика.
                                </span>
                            </p>

                            <p style='background:#FBFBFB'><span style='font-size:10.5pt;font-family:"Arial",sans-serif; color:#333333'>
                                    SDK содержит 4 группы методов:
                                </span>
                            </p>

                            <ul type=disc>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt: auto;mso-list:l2 level1 lfo1;tab-stops:list 36.0pt;background:#FBFBFB'>
                                    <span style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family: "Times New Roman"'>
                                        <a href="#" onclick="$(this).parent().siblings('figure').toggle(); return false;">ESAPI.init</a>
     - инициализация SDK. Должна вызываться до вызова какого-либо метода (как
     при первом открытии приложений, так и при внутренних переходах по фрейму).
                                    </span>
                                    <figure class="highlight" style="display: none;">
                                        <pre style='background:#FBFBFB'>
ESAPI.init(function(status, payload) {
    if(status) {
        // Init complete
    }
    else {
        // Init failed
        console.log("Payload > error_code:",payload.error_code);
        console.log("Payload > error_message:",payload.error_message);
    }
});
                                        </pre>
                                    </figure>
                                </li>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l2 level1 lfo1;tab-stops:list 36.0pt;background:#FBFBFB'>
                                    <span style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>
                                        ESAPI.Client
                                    </span>
                                </li>
                            </ul>

                            <ul type=disc>
                                <ul type=circle>
                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt: auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'>
                                        <span style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family: "Times New Roman"'>
                                            <a href="#client.call">ESAPI.Client.call</a>
      - вызов <a href="#methods">методов API</a> с
      автоматическим расчетом подписи
                                        </span>
                                    </li>
                                </ul>
                            </ul>

                            <ul type=disc>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo1;tab-stops:list 36.0pt;background:#FBFBFB'><span
                                            style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>ESAPI.Util</span></li>
                            </ul>

                            <ul type=disc>
                                <ul type=circle>
                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'>
                                        <span style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family: "Times New Roman"'>
                                            <a href="#getRequestParameters">ESAPI.Util.getRequestParameters</a>
                                            - получение параметров при обращении к приложению
                                        </span>
                                    </li>
                                </ul>
                            </ul>

                            <ul type=disc>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo1;tab-stops:list 36.0pt;background:#FBFBFB'><span
                                            style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>ESAPI.UI</span></li>
                            </ul>

                            <ul type=disc>
                                <ul type=circle>
                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'><span
                                                style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'><a href="#ui.getPageInfo">ESAPI.UI.getPageInfo</a>
      - информация о странице (высота, ширина, позиция прокрутки, позиция
      iframe приложения)</span></li>
                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'><span
                                                style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'><a href="#ui.scrollToTop">ESAPI.UI.scrollToTop</a>
      - прокручивает страницу к началу</span></li>
                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'><span
                                                style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'><a href="#ui.setWindowSize">ESAPI.UI.setWindowSize</a>
      - изменение размера контейнера приложения</span></li>

                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'><span
                                                style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'><a href="#ui.showPayment">ESAPI.UI.showPayment</a>
      - диалог на покупку игровой валюты или игровых предметов</span></li>

                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'><span
                                                style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'><a
                                                    href="#ui.showPermissions">ESAPI.UI.showPermissions</a>
      - диалог на запрос прав (например, на изменение статуса пользователя)</span></li>
                                    <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l2 level2 lfo1;tab-stops:list 72.0pt;background:#FBFBFB'><span
                                                style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'><a
                                                    href="#ui.showPortalPayment">ESAPI.UI.showPortalPayment</a>
      - диалог на покупку Etoken (внутренней валюты)</span></li>

                                </ul>
                            </ul>

                            <p style='background:#FBFBFB'><span style='font-size:10.5pt;font-family:"Arial",sans-serif;
color:#333333'>Подключение библиотеки:</span></p>

                            <figure class="highlight"><pre style='background:#FBFBFB'><span class=nt2><span
                                                style='color:#333333'>&lt;script </span></span><span class=na2><span
                                                style='color:#333333'>type=</span></span><span class=s4><span style='color:
#333333'>&quot;text/javascript&quot;</span></span><code><span style='color:
#333333'> </span></code><span class=na2><span style='color:#333333'>src=</span></span><span
                                            class=s4><span
                                                style='color:#333333'>&quot;//sand.esvoe.com/js/api_client.js&quot;</span></span><code><span
                                                style='color:#333333'> </span></code><span class=na2><span
                                                style='color:#333333'>defer=</span></span><span
                                            class=s4><span style='color:#333333'>&quot;defer&quot;</span></span><span
                                            class=nt2><span style='color:#333333'>&gt;&lt;/script&gt;</span></span><span
                                            style='color:#333333'></span></pre>
                            </figure>


                            <p style='background:#FBFBFB'><span style='font-size:10.5pt;font-family:"Arial",sans-serif;
color:#333333'>После каждого перехода внутри iframe, необходимо повторно
производить инициализацию методом <a href="#init">ESAPI.init</a>,
а также передавать следующие параметры:</span></p>

                            <ul type=disc>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l1 level1 lfo2;tab-stops:list 36.0pt;background:#FBFBFB'><span
                                            style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>api_server</span></li>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l1 level1 lfo2;tab-stops:list 36.0pt;background:#FBFBFB'><span
                                            style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>api_channel</span></li>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l1 level1 lfo2;tab-stops:list 36.0pt;background:#FBFBFB'><span
                                            style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>web_server</span></li>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l1 level1 lfo2;tab-stops:list 36.0pt;background:#FBFBFB'><span
                                            style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>api_session</span></li>
                            </ul>

                            <p style='background:#FBFBFB'><strong><span style='font-size:10.5pt;font-family:
"Arial",sans-serif;color:#333333'>API_callback</span></strong><span
                                        style='font-size:10.5pt;font-family:"Arial",sans-serif;color:#333333'></span>
                            </p>

                            <p style='background:#FBFBFB'><span style='font-size:10.5pt;font-family:"Arial",sans-serif;
color:#333333'>Методы из группы ESAPI.UI не требуют обязательной передачи callback функции.
После выполнения метода будет вызвана функция назначенная через ESAPI.UI.defaultCallbackHandler, которую может
реализовать разработчик. Функция должна иметь сигнатуру:</span></p>

                            <figure class="highlight"><pre style='background:#FBFBFB'><span class=kd2><span
                                                style='color:#333333'>function</span></span><code><span
                                                style='color:#333333'> </span></code><span
                                            class=nx><span
                                                style='font-family:"Courier New";color:#333333'>API_callback</span></span><span
                                            class=p><span
                                                style='font-family:"Courier New";color:#333333'>(</span></span><span
                                            class=nx><span style='font-family:"Courier New";color:#333333'>method</span></span><span
                                            class=p><span
                                                style='font-family:"Courier New";color:#333333'>,</span></span><code><span
                                                style='color:#333333'> </span></code><span class=nx><span style='font-family:
"Courier New";color:#333333'>status</span></span><span class=p><span
                                                style='font-family:"Courier New";color:#333333'>,</span></span><code><span
                                                style='color:#333333'> </span></code><span class=nx><span style='font-family:
"Courier New";color:#333333'>payload</span></span><span class=p><span
                                                style='font-family:"Courier New";color:#333333'>);</span></span><span
                                            style='color:#333333'></span></pre>
                            </figure>

                            <p style='background:#FBFBFB'><span style='font-size:10.5pt;font-family:"Arial",sans-serif;
color:#333333'>Здесь:</span></p>

                            <ul type=disc>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;tab-stops:list 36.0pt;background:#FBFBFB'>
                                    <span
                                            style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>
                                        method - название вызванного метода;
                                    </span>
                                </li>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;tab-stops:list 36.0pt;background:#FBFBFB'>
                                    <span style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family: "Times New Roman"'>
                                        status - результат выполнения (true в случае успеха,
     false в случае, если пользователь отменил действие, или действие невозможно выполнить);
                                    </span>
                                </li>
                                <li class=MsoNormal style='color:#333333;mso-margin-top-alt:auto;mso-margin-bottom-alt: auto;mso-list:l0 level1 lfo3;tab-stops:list 36.0pt;background:#FBFBFB'>
                                    <span style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>
                                        payload - дополнительная информация, например, для
     getPageInfo() – это объект содержащий данные о странице.
                                    </span>
                                </li>
                            </ul>


                            <!-- end content -->

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">...</div>
                <div role="tabpanel" class="tab-pane" id="messages">...</div>
                <div role="tabpanel" class="tab-pane" id="settings">...</div>
            </div>
        </div>
    </div>
</div>
