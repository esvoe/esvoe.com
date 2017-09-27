<?php
namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class ApplicationCategory extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //
    protected $fillable = ['title', 'description'];

    protected $table = 'app_categories';

    protected $casts = [
        'is_active' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo('App\ApplicationCategory');
    }

    private static $treeCache = null;

    public static function getTree() {

        if (self::$treeCache) return self::$treeCache;

        $elements = self::all(array('id', 'title', 'parent_id', 'order', 'level'));

        function buildBranch($elements, $parent, $level = 0) {
            $branch = array();
            $order = 0;
            foreach ($elements as $element) {
                if ($element->parent_id == $parent) {
                    $children = buildBranch($elements, $element->id, $level + 1);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $element->order = $order;
                    $element->level = $level;
                    $branch[] = $element;
                }
            }
            // sort can be used
            return $branch;
        }

        self::$treeCache = buildBranch($elements, null);

        return self::$treeCache;
    }

    public static function makeSelectList($nullTitle = null, $exclude = null) {
        $tree = self::getTree();

        if (! $exclude) $exclude = [];
        if (!is_array($exclude)) $exclude = [$exclude];

        function flattenBranch($elements, &$result = array(), $exclude) {
            foreach ($elements as $element) {
                if (in_array($element->id, $exclude)) continue;
                $result[$element->id] = str_repeat('&emsp;', $element->level) . $element->title;
                if ($element['children']) {
                    flattenBranch($element['children'], $result, $exclude);
                }
            }
            return $result;
        }

        $result = array();

        if ($nullTitle) {
            $result[null] = $nullTitle;
        }

        $result = flattenBranch($tree, $result, $exclude);

        return $result;
    }

    public static function makeSelectListGroup() {
        $tree = self::getTree();

        function placeBranch($elements, &$result = array()) {
            foreach ($elements as $element) {
                if ($element['children']) {
                    $result[$element->title] = placeBranch($element['children']);
                }
                else {
                    $result[$element->id] = $element->title;
                }
            }
            return $result;
        }

        $result = placeBranch($tree);

        return $result;
    }

    /**
     * @param $source array|\Illuminate\Http\UploadedFile|null
     * @return string|null
     */
    public function uploadImageSmall($source) {

        if ( ! $source) return null;

        $image = Image::make($source->getRealPath());

        $imageName = 'app_category_'.$this->id.'@40x40.jpg';
        $imagePath = 'apps/categories';

        $image->resize(40, 40);

        File::exists(storage_path('uploads'.DIRECTORY_SEPARATOR.$imagePath)) or File::makeDirectory(storage_path('uploads'.DIRECTORY_SEPARATOR.$imagePath),0755, true);

        $imageFilePathName = $imagePath.DIRECTORY_SEPARATOR.$imageName;

        $image->save(storage_path('uploads'.DIRECTORY_SEPARATOR.$imageFilePathName), 95);
        return $imageFilePathName;
    }

    /**
     * @param $source array|\Illuminate\Http\UploadedFile|null
     * @return string|null
     */
    public function uploadImageLarge($source) {

        if ( ! $source) return null;

        $image = Image::make($source->getRealPath());

        $imageName = 'app_category_'.$this->id.'@200x140.jpg';
        $imagePath = 'apps';

        $image->resize(200, 140);

        File::exists(storage_path('uploads'.DIRECTORY_SEPARATOR.$imagePath)) or File::makeDirectory(storage_path('uploads'.DIRECTORY_SEPARATOR.$imagePath),0755, true);

        $imageFilePathName = $imagePath.DIRECTORY_SEPARATOR.$imageName;

        $image->save(storage_path('uploads'.DIRECTORY_SEPARATOR.$imageFilePathName), 95);
        return $imageFilePathName;
    }

}
