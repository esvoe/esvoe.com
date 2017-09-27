<?php

namespace App\Http\Controllers;

use Barryvdh\TranslationManager\Controller;

use Teepluss\Theme\Facades\Theme;
use App\Setting;

use Barryvdh\TranslationManager\Models\Translation;
use Illuminate\Support\Collection;

class TranslationController extends Controller
{
    public function hello()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/translations')->render();

       // return 'blabla';
    }

    public function getView($group = null)
    {
        return $this->getIndex($group);
    }

    public function getIndex($group = null)
    {
        $locales = $this->loadLocales();
        $groups = Translation::groupBy('group');
        $excludedGroups = $this->manager->getConfig('exclude_groups');
        if($excludedGroups){
            $groups->whereNotIn('group', $excludedGroups);
        }

        $groups = $groups->select('group')->get()->pluck('group', 'group');
        if ($groups instanceof Collection) {
            $groups = $groups->all();
        }
        $groups = [''=>'Choose a group'] + $groups;
        $numChanged = Translation::where('group', $group)->where('status', Translation::STATUS_CHANGED)->count();


        $allTranslations = Translation::where('group', $group)->orderBy('key', 'asc')->get();
        $numTranslations = count($allTranslations);
        $translations = [];
        foreach($allTranslations as $translation){
            $translations[$translation->key][$translation->locale] = $translation;
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/translations', compact(
            'translations','locales','groups','group',
            'numTranslations','numChanged','editUrl','deleteEnabled'))->render();
    }

}
