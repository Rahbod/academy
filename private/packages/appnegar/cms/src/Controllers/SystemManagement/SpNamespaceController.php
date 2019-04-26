<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Department;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;
use App\SpNameSpace;

class SpNamespaceController extends AdminController
{

    public function __construct()
    {
        $this->resource = 'SpNamespace';
    }
    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'name' => 'required|unique:sp_namespaces,name',
            'display_name' => 'required|unique:sp_namespaces,display_name',
        ];
        if ($id !== null) {
            $rules['name'] .= ',' . $id;
            $rules['display_name'] .= ',' . $id;
        }
        if ($request->departments) {
            foreach ($request->departments as $index => $department) {
                $rules['departments.' . $index . '.id'] = 'required|numeric';
                $rules['departments.' . $index . '.name'] = 'required|unique:departments,name';
                $rules['departments.' . $index . '.display_name'] = 'required|unique:departments,display_name';
                if ($department['id'] != 0) {
                    $rules['departments.' . $index . '.id'] .= '|exists:departments,id';
                    $rules['departments.' . $index . '.name'] .= ',' . $department['id'];
                    $rules['departments.' . $index . '.display_name'] .= ',' . $department['id'];
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
            'options' => [],
            'image_path' => [],
        ];
    }


}