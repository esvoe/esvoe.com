<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 14.09.2017
 * Time: 12:32
 */
return array(
    'common'=> array(
        'name'=>'Name',
        'title'=>'Title',
        'description' => 'Description',
        'create' => 'Create',
        'internal_app' => 'Iframe application',
        'external_app' => 'External project',
        'settings' => 'Settings',
        'permissions' => 'Permissions',
        'save'=>'Save',
        'delete' => 'Delete',
        'applications' => 'Applications',
        'new_app' => 'New Application',
        'app_with_name' => 'Application :name',
        'required' => 'Required',
        'optional' => 'Optional',
        'unused'    => 'Unused',
        'perms' => array(
            'public_profile' => array(
                'title' => 'Public profile'
            ),
            'profile_email' => array(
                'title' => 'Profile email'
            )
        )
    ),
    'menu' => array(
        'home' => 'Developer',
        'applications' => 'Applications',
        'documents' => 'Documents',
    ),
    'application' => array(
        'labels' => array(
            'applications'=>'Applications'
        ),
        'permissions' => array(
            'labels' => array (
                'perm_unused' => 'Unused',
                'perm_required' => 'Required',
                'perm_optional' => 'Optional'
            ),
            'names' => array (
                'profile' => array (
                    'title' => 'Profile full access',
                    'desc' => 'Allow application read all fields of profile'
                )
            ),
            'pages' => array (
                'edit' => array(
                    'title' => 'Edit application `:name` permissions'
                )
            )
        )
    )
);