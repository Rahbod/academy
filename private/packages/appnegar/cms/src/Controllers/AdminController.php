<?php

namespace Appnegar\Cms\Controllers;


use App\Department;
use App\Http\Controllers\Controller;
use Appnegar\Cms\Traits\AdminCrudActions;
use Appnegar\Cms\Traits\AdminFileEditor;
use Appnegar\Cms\Traits\AdminFilterData;
use Appnegar\Cms\Traits\Dataviewer;


class AdminController extends Controller
{
    use Dataviewer;
    use AdminFilterData;
    use AdminFileEditor;
    use AdminCrudActions;

    protected $resource;
    protected $department;
    protected $config;

    public function index()
    {
        $actions = getActions(session('department'), $this->resource);
        $lang_resource = $this->getTrans();
        $model_name = '\\App\\' . $this->resource;
        $fields = $model_name::getFields();
        return ['actions' => $actions, 'lang_resource' => $lang_resource, 'fields' => $fields];
    }

    protected function getTrans($resource = null)
    {
        if ($resource == null) {
            $resource = $this->resource;
        }
        $resource_name = $this->getResourceName($resource);
        $lang_resource = trans($resource_name);
        if ($lang_resource == $resource_name) {
            $lang_resource = [];
        } else {
            $model_name = '\\App\\' . $resource;
            $fields = $model_name::getFields();

            foreach ($fields as $field) {
                if ($field['name'] !== $resource_name && $field['table']) {
                    $sub_lang_resource = trans($field['table']);
                    if ($sub_lang_resource !== $field['table']) {
                        $sub_items = [];
                        $relation_trans_name = $resource_name . ".relations." . $field['name'];
                        $sub_items['main_name'] = trans($relation_trans_name);

                        if ($sub_items['main_name'] !== $relation_trans_name) {
                            foreach ($sub_lang_resource['items'] as $key => $value) {
                                if ($key !== 'main_name' and !is_array($value)) {

                                    if (session('lang') == 'fa') {
                                        $sub_items[$key] = $value . " " . $sub_items['main_name'];
                                    } else {
                                        $sub_items[$key] = $sub_items['main_name'] . " - " . $value;
                                    }
                                }
                            }
                            $lang_resource['items'][$field['name']] = $sub_items;
                        } else {
                            $lang_resource['items'][$field['name']] = $sub_lang_resource['items'];
                        }

                    }
                }
            }
        }

        return $lang_resource;
    }

    public function listView()
    {
        $models = $this->getData();
        $this->filterModels($models);

        return $models;
    }

    public function show($id)
    {
        $model_name = "App\\" . $this->resource;
        $model = $model_name::findOrFail($id);

        return response()->json(['model' => $model]);
    }

    public function getActions()
    {
        $actions = getActions(session('department'), $this->resource);
        return response()
            ->json([
                'actions' => $actions
            ]);
    }


    protected function getResourceName($resource, $singular = false)
    {
        $resource_name = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $resource)), '_');
        if ($singular == false) {
            $resource_name = str_plural($resource_name);
        }
        return $resource_name;
    }

    protected function setDepartment()
    {
        if ($this->department == null) {
            $this->department = Department::where('name', session('department'))->first();
        }
    }


    protected function getResponseMessage($status, $resource, $action, $message = null, $json_response = true)
    {
        $default_massage = $this->getMessage($status, $resource, $action);
        if ($message !== null) {
            $message = "<p>" . $default_massage . "</p>" . $message;
        } else {
            $message = $default_massage;
        }
        $status_code = $status ? 200 : 442;
        if ($json_response) {
            return response()->json([
                'message' => $message
            ], $status_code);
        }

        return ['message' => $message, 'status' => $status];
    }

    protected function getMessage($status, $resource, $action)
    {
        $resource_name = $this->getResourceName($resource);
        $resource = __($resource_name . '.title');
        $action = __('main.actions.' . strtolower($action));
        if ($status) {
            $message = __('main.messages.action_success', ['resource' => $resource, 'action' => $action]);

        } else {
            $message = __('main.messages.action_error', ['resource' => $resource, 'action' => $action]);
        }
        return $message;
    }

    /**
     * @param array $not_in_ids
     * @param null|string $resource
     * @param array|null $types
     * @return array
     */
    protected function getCategories(array $not_in_ids = [], string $resource = null, array $types=null)
    {
        if ($resource === null) {
            $resource = $this->resource;
        }
        $model_name = "App\\" . $resource;

        $query = $model_name::whereNotIn('id', $not_in_ids)->where('lang', session('lang'));
        if ($types !== null) {
            $query->where(function ($query) use ($types) {
                foreach ($types as $index => $type) {
                    if ($index == 0) {
                        $query->where('type', $type);
                    } else {
                        $query->orWhere('type', $type);
                    }
                }
            });

        }
        $nodes = $query->get()->toTree();
        $array = [];
        $traverse = function ($nodes, $prefix = '-', &$array) use (&$traverse) {
            foreach ($nodes as $nodes) {
                $array[] = ['id' => $nodes->id, 'text' => $prefix . ' ' . $nodes->name];

                $traverse($nodes->children, $prefix . '- ', $array);
            }
        };

        $traverse($nodes, '- ', $array);
        return $array;
    }

}