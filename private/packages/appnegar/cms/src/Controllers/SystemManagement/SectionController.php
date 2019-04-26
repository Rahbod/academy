<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;

use App\MasterPage;
use App\Section;

class SectionController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Section';
    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        return [
            'master_page_id' => 'required|exists:master_pages,id',
            'name' => ['required', Rule::unique('sections')->where(function ($query) use ($request, $id) {
                $query->where('master_page_id', $request->master_page_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }

            })],
            'display_name' => ['required', Rule::unique('sections')->where(function ($query) use ($request, $id) {
                $query->where('master_page_id', $request->master_page_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            })]
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getFormData($data)
    {
        return [
            'model' => $data,
            'options' => [
                'master_page_id' => MasterPage::orderBy('id')->get(['id', 'display_name  AS text'])],
            'image_path' => [],
            'name' => 'section',

        ];
    }

}