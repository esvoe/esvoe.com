<div class="block-what-comment" style="padding-left: 0">
  <div class="form-group">
    {{--<textarea data-emojiable="true" class="form-control" placeholder="Коментувати"></textarea>--}}
    <form action="#" class="comment-form">
        <input type="text" data-emojiable="true" class="form-control save-edit-comment" placeholder="Коментувати" data-comment-id="{{ $comment->id }}" name="edit_post_comment" value="{{ $comment->description }}" />
    </form>

    <div class="own-blocks-add" data-block-add-new="people" style="display: none;">
                                        <span>
                                            <img src="{!! Theme::asset()->url('images/_new/what-new-people.png') !!}" alt="icon-what-new">
                                        </span>
      <input type="text" class="form-control" placeholder="З ким ви?">
    </div>
    <div class="own-blocks-add" data-block-add-new="place" style="display: none;">
                                        <span>
                                            <img src="{!! Theme::asset()->url('images/_new/what-new-marker.png') !!}" alt="icon-what-new">
                                        </span>
      <input type="text" class="form-control" placeholder="Де ви?">
    </div>
    <div class="own-blocks-add" data-block-add-new="youtube" style="display: none;">
                                        <span>
                                            <img src="{!! Theme::asset()->url('images/_new/what-new-youtube.png') !!}" alt="icon-what-new">
                                        </span>
      <input type="text" class="form-control" placeholder="Що ви дивитесь?">
    </div>
    <div class="own-blocks-add" data-block-add-new="photo" style="display: none;">
                                        <span>
                                            <img src="{!! Theme::asset()->url('images/_new/what-new-photo.png') !!}" alt="icon-what-new">
                                        </span>
      <input type="file" class="form-control hidden file" onchange="previewFile()">
      <div class="wrap-upload-what">
        <img src="" alt="">
      </div>
    </div>
    {{--<div class="own-blocks-add smile-block-add" data-block-add-new="smile" style="display: none;">
      <ul class="nav nav-pills smiley-list">
        <li class="active"><a href="#emoticons1" data-toggle="pill" class="header-text"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
        <li><a href="#people" data-toggle="pill" class="header-text"><i class="fa fa-user" aria-hidden="true"></i></a></li>
        <li><a href="#nature" data-toggle="pill" class="header-text"><i class="fa fa-tree" aria-hidden="true"></i></a></li>
        <li><a href="#objects" data-toggle="pill" class="header-text"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
        <li><a href="#places" data-toggle="pill" class="header-text"><i class="fa fa-car" aria-hidden="true"></i></a></li>
        <li><a href="#symbols" data-toggle="pill" class="header-text"><i class="fa fa-keyboard-o" aria-hidden="true"></i></a></li>
      </ul>
      <div class="tab-content smiley-pics-content">
        <div id="emoticons1" class="tab-pane fade in active">
          <span class="smiley-post" data-smiley-id=":)">:)</span>
          <span class="smiley-post" data-smiley-id=":-)">:-)</span>
          <span class="smiley-post" data-smiley-id=":o">:o</span>
          <span class="smiley-post" data-smiley-id=":-o">:-o</span>
          <span class="smiley-post" data-smiley-id=":O">:O</span>
          <span class="smiley-post" data-smiley-id=":-O">:-O</span>
          <span class="smiley-post" data-smiley-id=":]">:]</span>
          <span class="smiley-post" data-smiley-id=":-]">:-]</span>
          <span class="smiley-post" data-smiley-id=";]">;]</span>
          <span class="smiley-post" data-smiley-id=";-]">;-]</span>
          <span class="smiley-post" data-smiley-id=":D">:D</span>
          <span class="smiley-post" data-smiley-id=":-D">:-D</span>
          <span class="smiley-post" data-smiley-id=";D">;D</span>
          <span class="smiley-post" data-smiley-id=";-D">;-D</span>
          <span class="smiley-post" data-smiley-id=":P">:P</span>
          <span class="smiley-post" data-smiley-id=":-P">:-P</span>
          <span class="smiley-post" data-smiley-id=":p">:p</span>
          <span class="smiley-post" data-smiley-id=":-p">:-p</span>
          <span class="smiley-post" data-smiley-id=":[">:[</span>
          <span class="smiley-post" data-smiley-id=":-[">:-[</span>
          <span class="smiley-post" data-smiley-id=":@">:@</span>
          <span class="smiley-post" data-smiley-id=":-@">:-@</span>
          <span class="smiley-post" data-smiley-id=":(">:(</span>
          <span class="smiley-post" data-smiley-id=":-(">:-(</span>
          <span class="smiley-post" data-smiley-id=":'(">:'(</span>
          <span class="smiley-post" data-smiley-id=":'-(">:'-(</span>
          <span class="smiley-post" data-smiley-id=":*">:*</span>
          <span class="smiley-post" data-smiley-id=":-*">:-*</span>
          <span class="smiley-post" data-smiley-id=";)">;)</span>
          <span class="smiley-post" data-smiley-id=";-)">;-)</span>
          <span class="smiley-post" data-smiley-id=":/">:/</span>
          <span class="smiley-post" data-smiley-id=":-/">:-/</span>
          <span class="smiley-post" data-smiley-id=":s">:s</span>
          <span class="smiley-post" data-smiley-id=":-s">:-s</span>
          <span class="smiley-post" data-smiley-id=":S">:S</span>
          <span class="smiley-post" data-smiley-id=":-S">:-S</span>
          <span class="smiley-post" data-smiley-id=":|">:|</span>
          <span class="smiley-post" data-smiley-id=":-|">:-|</span>
          <span class="smiley-post" data-smiley-id=":$">:$</span>
          <span class="smiley-post" data-smiley-id=":-$">:-$</span>
          <span class="smiley-post" data-smiley-id=":-x">:-x</span>
          <span class="smiley-post" data-smiley-id=":-X">:-X</span>
        </div>
        <div id="people" class="tab-pane fade">
          <span class="smiley-post" data-smiley-id=":walking:">:walking:</span>
          <span class="smiley-post" data-smiley-id=":runner:">:runner:</span>
          <span class="smiley-post" data-smiley-id=":running:">:running:</span>
          <span class="smiley-post" data-smiley-id=":couple:">:couple:</span>
          <span class="smiley-post" data-smiley-id=":family:">:family:</span>
          <span class="smiley-post" data-smiley-id=":two_men_holding_hands:">:two_men_holding_hands:</span>
          <span class="smiley-post" data-smiley-id=":two_women_holding_hands:">:two_women_holding_hands:</span>
          <span class="smiley-post" data-smiley-id=":dancer:">:dancer:</span>
          <span class="smiley-post" data-smiley-id=":dancers:">:dancers:</span>
          <span class="smiley-post" data-smiley-id=":ok_woman:">:ok_woman:</span>
          <span class="smiley-post" data-smiley-id=":no_good:">:no_good:</span>
          <span class="smiley-post" data-smiley-id=":information_desk_person:">:information_desk_person:</span>
          <span class="smiley-post" data-smiley-id=":raised_hand:">:raised_hand:</span>
          <span class="smiley-post" data-smiley-id=":bride_with_veil:">:bride_with_veil:</span>
          <span class="smiley-post" data-smiley-id=":person_with_pouting_face:">:person_with_pouting_face:</span>
          <span class="smiley-post" data-smiley-id=":person_frowning:">:person_frowning:</span>
          <span class="smiley-post" data-smiley-id=":bow:">:bow:</span>
          <span class="smiley-post" data-smiley-id=":couplekiss:">:couplekiss:</span>
          <span class="smiley-post" data-smiley-id=":couple_with_heart:">:couple_with_heart:</span>
          <span class="smiley-post" data-smiley-id=":massage:">:massage:</span>
          <span class="smiley-post" data-smiley-id=":haircut:">:haircut:</span>
          <span class="smiley-post" data-smiley-id=":nail_care:">:nail_care:</span>
          <span class="smiley-post" data-smiley-id=":boy:">:boy:</span>
          <span class="smiley-post" data-smiley-id=":girl:">:girl:</span>
          <span class="smiley-post" data-smiley-id=":woman:">:woman:</span>
          <span class="smiley-post" data-smiley-id=":man:">:man:</span>
          <span class="smiley-post" data-smiley-id=":baby:">:baby:</span>
          <span class="smiley-post" data-smiley-id=":older_woman:">:older_woman:</span>
          <span class="smiley-post" data-smiley-id=":older_man:">:older_man:</span>
          <span class="smiley-post" data-smiley-id=":person_with_blond_hair:">:person_with_blond_hair:</span>
          <span class="smiley-post" data-smiley-id=":man_with_gua_pi_mao:">:man_with_gua_pi_mao:</span>
          <span class="smiley-post" data-smiley-id=":man_with_turban:">:man_with_turban:</span>
          <span class="smiley-post" data-smiley-id=":construction_worker:">:construction_worker:</span>
          <span class="smiley-post" data-smiley-id=":cop:">:cop:</span>
          <span class="smiley-post" data-smiley-id=":angel:">:angel:</span>
          <span class="smiley-post" data-smiley-id=":princess:">:princess:</span>
          <span class="smiley-post" data-smiley-id=":smiley_cat:">:smiley_cat:</span>
          <span class="smiley-post" data-smiley-id=":smile_cat:">:smile_cat:</span>
          <span class="smiley-post" data-smiley-id=":heart_eyes_cat:">:heart_eyes_cat:</span>
          <span class="smiley-post" data-smiley-id=":kissing_cat:">:kissing_cat:</span>
          <span class="smiley-post" data-smiley-id=":smirk_cat:">:smirk_cat:</span>
          <span class="smiley-post" data-smiley-id=":scream_cat:">:scream_cat:</span>
          <span class="smiley-post" data-smiley-id=":crying_cat_face:">:crying_cat_face:</span>
          <span class="smiley-post" data-smiley-id=":joy_cat:">:joy_cat:</span>
          <span class="smiley-post" data-smiley-id=":pouting_cat:">:pouting_cat:</span>
          <span class="smiley-post" data-smiley-id=":japanese_ogre:">:japanese_ogre:</span>
          <span class="smiley-post" data-smiley-id=":japanese_goblin:">:japanese_goblin:</span>
          <span class="smiley-post" data-smiley-id=":see_no_evil:">:see_no_evil:</span>
          <span class="smiley-post" data-smiley-id=":hear_no_evil:">:hear_no_evil:</span>
          <span class="smiley-post" data-smiley-id=":speak_no_evil:">:speak_no_evil:</span>
          <span class="smiley-post" data-smiley-id=":guardsman:">:guardsman:</span>
          <span class="smiley-post" data-smiley-id=":skull:">:skull:</span>
          <span class="smiley-post" data-smiley-id=":feet:">:feet:</span>
          <span class="smiley-post" data-smiley-id=":lips:">:lips:</span>
          <span class="smiley-post" data-smiley-id=":kiss:">:kiss:</span>
          <span class="smiley-post" data-smiley-id=":droplet:">:droplet:</span>
          <span class="smiley-post" data-smiley-id=":ear:">:ear:</span>
          <span class="smiley-post" data-smiley-id=":eyes:">:eyes:</span>
          <span class="smiley-post" data-smiley-id=":nose:">:nose:</span>
          <span class="smiley-post" data-smiley-id=":tongue:">:tongue:</span>
          <span class="smiley-post" data-smiley-id=":love_letter:">:love_letter:</span>
          <span class="smiley-post" data-smiley-id=":bust_in_silhouette:">:bust_in_silhouette:</span>
          <span class="smiley-post" data-smiley-id=":busts_in_silhouette:">:busts_in_silhouette:</span>
          <span class="smiley-post" data-smiley-id=":speech_balloon:">:speech_balloon:</span>
          <span class="smiley-post" data-smiley-id=":thought_balloon:">:thought_balloon:</span>
          <span class="smiley-post" data-smiley-id=":feelsgood:">:feelsgood:</span>
          <span class="smiley-post" data-smiley-id=":finnadie:">:finnadie:</span>
          <span class="smiley-post" data-smiley-id=":goberserk:">:goberserk:</span>
          <span class="smiley-post" data-smiley-id=":godmode:">:godmode:</span>
          <span class="smiley-post" data-smiley-id=":hurtrealbad:">:hurtrealbad:</span>
          <span class="smiley-post" data-smiley-id=":rage1:">:rage1:</span>
          <span class="smiley-post" data-smiley-id=":rage2:">:rage2:</span>
          <span class="smiley-post" data-smiley-id=":rage3:">:rage3:</span>
          <span class="smiley-post" data-smiley-id=":rage4:">:rage4:</span>
          <span class="smiley-post" data-smiley-id=":suspect:">:suspect:</span>
          <span class="smiley-post" data-smiley-id=":trollface:">:trollface:</span>
        </div>
      </div>
    </div>--}}
    <div class="comment-new-add">
      {{--<span data-add-new="people" class="add-what-people"><img src="{!! Theme::asset()->url('images/_new/what-new-people.png') !!}" alt="icon-what-new"></span>--}}
      <span data-add-new="photo" class="add-what-photo"><img src="{!! Theme::asset()->url('images/_new/what-new-photo.png') !!}" alt="icon-what-new"></span>
      {{--<span data-add-new="place" class="add-what-place"><img src="{!! Theme::asset()->url('images/_new/what-new-marker.png') !!}" alt="icon-what-new"></span>--}}
      <span data-add-new="youtube" class="add-what-youtube"><img src="{!! Theme::asset()->url('images/_new/what-new-youtube.png') !!}" alt="icon-what-new"></span>
      <span data-add-new="smile" class="add-what-smile"><img src="{!! Theme::asset()->url('images/_new/what-new-smile.png') !!}" alt="icon-what-new"></span>
    </div>
  </div>
</div>