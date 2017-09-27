<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('timelines', function (Blueprint $table) {
            $table->foreign('avatar_id')->references('id')->on('media')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('timelines', function (Blueprint $table) {
            $table->foreign('cover_id')->references('id')->on('media')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('affiliate_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('user_settings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('page_user', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('page_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('page_user', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('categories')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('group_user', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('group_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('group_user', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('followers', function (Blueprint $table) {
            $table->foreign('follower_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('followers', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_follows', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_follows', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_media', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_media', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_shares', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_shares', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('comments')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('notified_by')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('announcement_user', function (Blueprint $table) {
            $table->foreign('announcement_id')->references('id')->on('announcements')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('announcement_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_reports', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('post_reports', function (Blueprint $table) {
            $table->foreign('reporter_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('page_likes', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('page_likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('timeline_reports', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('timeline_reports', function (Blueprint $table) {
            $table->foreign('reporter_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_timeline_id_foreign');
        });
        Schema::table('timelines', function (Blueprint $table) {
            $table->dropForeign('timelines_avatar_id_foreign');
        });
        Schema::table('timelines', function (Blueprint $table) {
            $table->dropForeign('timelines_cover_id_foreign');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_affiliate_id_foreign');
        });
        Schema::table('user_settings', function (Blueprint $table) {
            $table->dropForeign('user_settings_user_id_foreign');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_timeline_id_foreign');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_category_id_foreign');
        });
        Schema::table('page_user', function (Blueprint $table) {
            $table->dropForeign('page_user_page_id_foreign');
        });
        Schema::table('page_user', function (Blueprint $table) {
            $table->dropForeign('page_user_user_id_foreign');
        });
        Schema::table('page_user', function (Blueprint $table) {
            $table->dropForeign('page_user_role_id_foreign');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parent_id_foreign');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign('groups_timeline_id_foreign');
        });
        Schema::table('group_user', function (Blueprint $table) {
            $table->dropForeign('group_user_group_id_foreign');
        });
        Schema::table('group_user', function (Blueprint $table) {
            $table->dropForeign('group_user_user_id_foreign');
        });
        Schema::table('group_user', function (Blueprint $table) {
            $table->dropForeign('group_user_role_id_foreign');
        });
        Schema::table('followers', function (Blueprint $table) {
            $table->dropForeign('followers_follower_id_foreign');
        });
        Schema::table('followers', function (Blueprint $table) {
            $table->dropForeign('followers_leader_id_foreign');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_timeline_id_foreign');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->dropForeign('post_likes_post_id_foreign');
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->dropForeign('post_likes_user_id_foreign');
        });
        Schema::table('post_follows', function (Blueprint $table) {
            $table->dropForeign('post_follows_post_id_foreign');
        });
        Schema::table('post_follows', function (Blueprint $table) {
            $table->dropForeign('post_follows_user_id_foreign');
        });
        Schema::table('post_media', function (Blueprint $table) {
            $table->dropForeign('post_media_post_id_foreign');
        });
        Schema::table('post_media', function (Blueprint $table) {
            $table->dropForeign('post_media_media_id_foreign');
        });
        Schema::table('post_shares', function (Blueprint $table) {
            $table->dropForeign('post_shares_post_id_foreign');
        });
        Schema::table('post_shares', function (Blueprint $table) {
            $table->dropForeign('post_shares_user_id_foreign');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_post_id_foreign');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_parent_id_foreign');
        });
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->dropForeign('comment_likes_user_id_foreign');
        });
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->dropForeign('comment_likes_comment_id_foreign');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_post_id_foreign');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_timeline_id_foreign');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_user_id_foreign');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_notified_by_foreign');
        });
        Schema::table('announcement_user', function (Blueprint $table) {
            $table->dropForeign('announcement_user_announcement_id_foreign');
        });
        Schema::table('announcement_user', function (Blueprint $table) {
            $table->dropForeign('announcement_user_user_id_foreign');
        });
        Schema::table('post_reports', function (Blueprint $table) {
            $table->dropForeign('post_reports_post_id_foreign');
        });
        Schema::table('post_reports', function (Blueprint $table) {
            $table->dropForeign('post_reports_reporter_id_foreign');
        });
        Schema::table('page_likes', function (Blueprint $table) {
            $table->dropForeign('page_likes_page_id_foreign');
        });
        Schema::table('page_likes', function (Blueprint $table) {
            $table->dropForeign('page_likes_user_id_foreign');
        });
        Schema::table('timeline_reports', function (Blueprint $table) {
            $table->dropForeign('timeline_reports_timeline_id_foreign');
        });
        Schema::table('timeline_reports', function (Blueprint $table) {
            $table->dropForeign('timeline_reports_reporter_id_foreign');
        });
    }
}
