/**
 * Created by lis on 15/9/17.
 */

$(function () {
    token = $('meta[name="csrf_token"]').attr('content');
    function takeListInvite() {
        $.post(urlTakeInvite, {'_token':token}, function(data){
            $( "#friendInviteList" ).html( data );
        } );
        setTimeout(takeListInvite, 30000);//tmp - only after click on icon
    }
    setTimeout(takeListInvite, 300);


    $('body').on('click','.hypothetically-friend',function(e){
        e.preventDefault();
        follow_btn = $(this).closest('.js-follow-links');
        userId = $(this).attr('rel');
        if ($(this).hasClass('follow') === true) {
            console.log('Request url: reqUrlUserADD '+userId);
            $.ajax({
                method: 'POST',
                url: reqUrlUserAdd,
                data: {user_id: userId, _token: token}
            }).done(function(response) {
                console.log("ajax request done:", response);
                if (response.result === "true") {
                    follow_btn.find('.follow').parent().addClass('hidden');
                    follow_btn.find('.unfollow').parent().removeClass('hidden');
                    follow_btn.find('.unfollow').closest('.holder').slideToggle();
                }
            });
        } else {
            console.log('Request url: reqUrlUserCancel '+userId);
            $.ajax({
                method: 'POST',
                url: reqUrlUserCancel,
                data: {user_id: userId, _token: token}
            }).done(function(response) {
                console.log("ajax request done:", response);
                if (response.result === "true") {
                    follow_btn.find('.follow').parent().removeClass('hidden');
                    follow_btn.find('.unfollow').parent().addClass('hidden');
                }
            });
        }

    });
});

var reqUrlUserFriendAccept = '/friend/ajax/invite/accept',
    reqUrlUserFriendReject = '/friend/ajax/invite/reject',
    urlTakeInvite = '/friend/ajax/listInvites',
    reqUrlUserAdd = '/friend/ajax/add';
    reqUrlUserCancel = '/friend/ajax/invite/cancel';

function acceptFriend(userId) {
    console.log('Request url: reqUrlUserFriendAccept '+userId);
    $("#inviteElement"+userId).hide();
    $("#inviteElementOnForm"+userId).hide();
    userRequest = $.ajax({
        method: 'POST',
        url: reqUrlUserFriendAccept,
        data: {
            user_id: userId,
            _token: token
        }
    }).done(function(response) {
        console.log("ajax request done:", response);
        if (response.result === "true") {
//                $btnYourFriend.show();
        } else {
//                $btnFriendAccept.removeClass('wait');
        }
    });
}

function rejectFriend(userId) {
    console.log('Request url: reqUrlUserFriendReject '+userId);
    $("#inviteElement"+userId).hide();
    $("#inviteElementOnForm"+userId).hide();
    userRequest = $.ajax({
        method: 'POST',
        url: reqUrlUserFriendReject,
        data: {
            user_id: userId,
            _token: token
        }
    }).done(function(response) {
        console.log("ajax request done:", response);
        if (response.result === "true") {
//                $btnYourFriend.show();
        } else {
//                $btnFriendAccept.removeClass('wait');
        }
    });
}

function addFriend(userId) {
    console.log('Request url: reqUrlUserAdd '+userId);
    $("#inviteElement"+userId).hide();
    $("#inviteElementOnForm"+userId).hide();
    userRequest = $.ajax({
        method: 'POST',
        url: reqUrlUserAdd,
        data: {
            user_id: userId,
            _token: token
        }
    }).done(function(response) {
        console.log("ajax request done:", response);
        if (response.result === "true") {
            // $("#invite"+userId).hide();
        } else {
            // $btnAddToFriend.removeClass('wait');
        }
    });
}

function cancelFriend(userId) {
    console.log('Request url: reqUrlUserCancel '+userId);
    $("#inviteElement"+userId).hide();
    $("#inviteElementOnForm"+userId).hide();
    userRequest = $.ajax({
        method: 'POST',
        url: reqUrlUserCancel,
        data: {
            user_id: userId,
            _token: token
        }
    }).done(function(response) {
        console.log("ajax request done:", response);
        if (response.result === "true") {
            // $("#invite"+userId).hide();
        } else {
            // $btnAddToFriend.removeClass('wait');
        }
    });
}