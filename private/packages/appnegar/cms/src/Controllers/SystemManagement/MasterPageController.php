<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;

use App\MasterPage;
use App\Template;
use App\Section;

class MasterPageController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'MasterPage';
    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'template_id' => 'required|exists:templates,id',
            'name' => ['required', Rule::unique('master_pages', 'name')->where(function ($query) use ($request, $id) {
                $query->where('template_id', $request->template_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            })],
            'display_name' => ['required', Rule::unique('master_pages', 'display_name')->where(function ($query) use ($request, $id) {
                $query->where('template_id', $request->template_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            })],
        ];

        if ($request->sections) {
            foreach ($request->sections as $index => $section) {

                $rules['sections.' . $index . '.name'] = ['required'];
                if ($id !== null) {
                    $rules['sections.' . $index . '.name'][] = Rule::unique('sections', 'name')->where(function ($query) use ($section, $id) {
                        $query->where('master_page_id', $id);
                        if ($section['id'] != 0) {
                            $query->where('id', '<>', $section['id']);
                        }
                    });
                }

                $rules['sections.' . $index . '.display_name'] = ['required'];
                if ($id !== null) {
                    $rules['sections.' . $index . '.display_name'][] = Rule::unique('sections', 'display_name')->where(function ($query) use ($section, $id) {
                        $query->where('master_page_id', $id);
                        if ($section['id'] != 0) {
                            $query->where('id', '<>', $section['id']);
                        }
                    });
                }

            }
        }
        return $rules;
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
                'template_id' => Template::orderBy('id')->get(['id', 'display_name  AS text'])],
            'image_path' => [],
            'name' => 'master_page',

        ];
    }

}