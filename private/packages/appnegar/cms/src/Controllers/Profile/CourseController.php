<?php
namespace Appnegar\Cms\Controllers\Profile;

use App\Tag;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\AdminComment;
use Appnegar\Cms\Traits\AdminFileManager;
use Appnegar\Cms\Traits\AdminSettingTrait;

class CourseController extends AdminController{
//    use AdminComment;
//    use AdminFileManager;
//    use AdminSettingTrait;

    public function __construct(){
        $this->resource='Course';
    }

}