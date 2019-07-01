<?php

namespace Appnegar\Cms\Traits;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait AdminCrudActions
{
    use AdminUpdateOrder;

    protected function getModelName($resource = null)
    {
        if ($resource == null) {
            $resource = $this->resource;
        }
        return "App\\" . $resource;
    }


    protected function setRequest($request, $model)
    {
        if (!$request['lang']) {
            $request['lang'] = session('lang');
        }

        return $request;
    }

    protected function setModel($model)
    {
//        if (isset($model->author_id)) {
//            $model->author_id = $model->author->name;
//        }
//        if (isset($model->user_id)) {
//            $model->user_id = $model->user->name;
//        }
        return $model;
    }

    protected function getOrderScopes()
    {
        return null;
    }

    protected function validationRules($request, $id = null)
    {
        return [];
    }

    /**
     * @param array $data
     * @return array
     * @internal param null $model
     */
    protected function getFormData($data)
    {
        return [
            'model' => $data,
            'options' => [],
        ];
    }

    protected function getOrderConditions($request)
    {
        $order_scopes = $this->getOrderScopes();

        if (is_array($order_scopes)) {
            $order_conditions = [];
            foreach ($order_scopes as $order_scope) {
                $order_conditions[$order_scope] = $request[$order_scope];
            }
            return $order_conditions;
        }
        return null;
    }


    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $data = $this->getInputData();
            return response()
                ->json($this->getFormData($data));
        } elseif ($request->isMethod('post')) {
            $this->validate($request, $this->validationRules($request));
            $model = app($this->getModelName());
            $request = $this->setRequest($request, $model);
            return $this->transaction($request, $model, 'create');
        }
        return response()->json([
            'message' => 'method not allow'
        ], 442);
    }

    /**
     * Show the form for editing the specified resource or Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $data = $this->getInputData($id);
            return response()
                ->json($this->getFormData($data));
        } elseif ($request->isMethod('put')) {
            $this->validate($request, $this->validationRules($request, $id));

            $model = $this->getModel($id);
            $request = $this->setRequest($request, $model);
            return $this->transaction($request, $model, 'edit');
        }
        return response()->json([
            'message' => 'method not allow'
        ], 442);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);
        $related_relations = $this->getRelatedRelations();
        return $this->deleteModels($this->resource, $related_relations, $ids, true, false, $this->getOrderScopes());

    }

    protected function getRelatedRelations($model = null)
    {
        if ($model == null) {
            $model_name = $this->getModelName();
            $model = app($model_name);
        }
        $related_relations = [];
        $relationships = $model->relationships();
        foreach ($relationships as $key => $relationship) {
            if (in_array($relationship['type'], ['HasOne', 'HasMany','MorphMany','MorphOne'])) {
                $related_relations[] = $key;
            }
        }

        return $related_relations;
    }

    protected function getModel($id)
    {
        $model_name = $this->getModelName();
        return $model_name::findOrFail($id);
    }

    protected function getInputData($id = null)
    {
        $model_name = $this->getModelName();
        if ($id == null) {
            $data = [];
        } else {
            $data = $this->getModel($id);
        }


        $model_table = $model_name::getTableName();
        $fields = $model_name::getFields();

        foreach ($fields as $field) {
            if ($field['name'] === $model_table || !isset($field['show_in_form']) || $field['show_in_form'] != true) {
                if ($field['name'] === $model_table && $id == null) {
                    $data = array_merge($data, $this->setDefaultValues($field['items']));
                }
                continue;
            }
            if($field['show_in_form'] == true){

                $relation_info = app($model_name)->getRelationInfo($field['name']);
                if ($id != null) {
                    $data->load($relation_info['name']);
                    continue;
                }
                if ($relation_info['relation_type'] == 'HasMany') {
                    $data[$relation_info['name']] = [];
                }
                if ($relation_info['relation_type'] == 'MorphMany') {
                    $data[$relation_info['name']] = [];
                }
                if ($relation_info['relation_type'] == 'HasOne') {
                    $data[$relation_info['name']] = $this->setDefaultValues($field['items']);
                }
                if ($relation_info['relation_type'] == 'MorphOne') {
                    $data[$relation_info['name']] = $this->setDefaultValues($field['items']);
                }
            }

        }

        if ($id !== null) {
            return $this->setModel($data);
        }

        return $data;

    }

    private function setDefaultValues($items)
    {
        $data = [];
        foreach ($items as $item) {
            switch ($item['name']) {
                case 'id':
                    $data[$item['name']] = 0;
                    break;
                case 'order':
                    $data[$item['name']] = 1;
                    break;
                case 'status':
                case 'is_news':
                case 'verified':
                    $data[$item['name']] = 1;
                    break;
                case 'has_content':
                    $data[$item['name']] = 0;
                    break;
                case 'lang':
                    $data[$item['name']] = session('lang');
                    break;

            }
        }
        return $data;
    }

    /**
     * @param Request $request
     * @param Model $model
     * @param string $action
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @internal param null $order_conditions
     */
    protected function transaction($request, $model, $action)
    {
        try {
            $status = \DB::transaction(function () use ($request, $model, $action) {
                $order_conditions = $this->getOrderConditions($request);
                return $this->saveModel($model, $request, $action, $order_conditions);
            });
            $message = null;
            if (isset($status['message']) and $status['message'] !== "") {
                $message = $status['message'];
            }
            if (isset($status['status'])) {
                $status = $status['status'];
            }
            return $this->getResponseMessage($status, $this->resource, $action, $message);
        } catch (\Exception $e) {
//            return response(['errors' => $e->getMessage(), 'message' => 'error!'], 500);
            throw $e;
        }

    }

    protected function saveModel($model, $request, $action, $order_conditions = null, $fields = null)
    {
        if ($fields == null) {
            $model_name = 'App\\' . $this->resource;
            $fields = $model_name::getFieldsName();
        }
        $relations = [];
        $related_models = [];
        $message = '';
        $new_order = null;

        if ($order_conditions !== null) {
            $new_order = $this->updateOrder($model, $request['order'], $order_conditions);
        }
        foreach ($fields as $key => $value) {
            if (isset($value['is_relation']) && $value['is_relation'] === true) {
                unset($value['is_relation']);
                $relations[$key] = $value;

            } else if ($key !== 'id' && $key !== 'password_confirmation') {
                if (isset($value['is_related_field']) && $value['is_related_field'] === true) {
                    $model_key = str_plural(str_replace_last('_id', '', $key));
                    if ($model_key === 'tags') {
                        $tag_ids = [];
                        if (isset($request[$key])) {
                            foreach ($request[$key] as $tag) {
                                if (is_numeric($tag)) {
                                    $tag_ids[] = $tag;
                                } else {
                                    $tag_model = \App\Tag::firstOrCreate(['name' => trim($tag)]);
                                    $tag_ids[] = $tag_model->id;
                                }
                            }
                        }

                        $related_models[$model_key] = $tag_ids;
                    } else {
                        $related_models[$model_key] = $request[$key];
                    }
                }
                elseif (in_array($value['type'], ['image', 'file'])) {

                    $delete_file_status = ($request[$key . '_src'] === null);
                    $file_name = null;

                    if (isset($request[$key])) {
                        $config_name = $this->getResourceName(class_basename($model), true);
                        if (isset($this->config[$config_name][$key])) {
                            $config = $this->config[$config_name][$key];

                            if ($value['type'] === 'image') {
                                $file_status = $this->saveImage($request[$key], $config);
                            } else {
                                $file_status = $this->saveFile($request[$key], $config);
                            }
                            if ($file_status['status'] === false) {
                                $errors = implode(', ', $file_status['data']);
                                throw new \Exception($errors);
                            }
                            $file_name = $file_status['data'];
                            $delete_file_status = true;

                        } else {
                            $message .= "تنظیماتی جهت ذخیره فایل {$key} پیدا نشد";
                        }
                    }
                    if ($delete_file_status) {
                        $this->deleteFile($model->$key);
                        $model->$key = $file_name;
                    }
                }
                else {
                    switch ($key) {
                        case 'order':
                            if ($order_conditions !== null) {
                                $model->$key = $new_order;
                            } elseif (isset($request[$key]) && $request[$key] !== null) {
                                $model->$key = $request[$key];
                            }


                            break;
                        case 'password':
                            if (isset($request[$key]) && $request[$key] !== null) {
                                $model->$key = bcrypt($request[$key]);
                            }
                            break;
                        case 'user_id':
                        case 'author_id':
                        if ($request['id'] == 0) {
//                            dd($request['author_id']);
                            $session_key = 'user_info';
                            if (session('department') !== 'profile') {
                                $session_key = 'user_info_' . session('department');
                            }
                            $user=session($session_key);
                           $model->$key = $user['id'];
                        }
                        break;
                        case 'is_admin':
                        case 'access_level':
                        case 'featured':
                        case 'status':
                        case 'view_count':
                        case 'show_count':
                            if (isset($request[$key]) && $request[$key] !== null ) {
                                $model->$key = $request[$key];
                            } else if ($model->$key === null) {
                                $model->$key = 0;
                            }
                            break;
                        default:
                            if (isset($request[$key])) {
                                $model->$key = $request[$key];
                            } else {
                                $model->$key = null;
                            }

                            break;
                    }

                }


            }
        }
//        dd($request->all(),$fields,$model->toArray());
        $status = $model->save();


        foreach ($related_models as $key => $value) {
            $model->$key()->sync($value);
        }

        foreach ($relations as $relation_name => $relation_fields) {
            $relation_info = $model->getRelationInfo($relation_name);
            $sub_class_name = $relation_info['related_model_name'];

            switch ($relation_info['relation_type']) {
                case 'HasMany':
                case 'MorphMany': {

                    $delete_items = $model->$relation_name()->get()->pluck('id')->toArray();
                    if (isset($request[$relation_name])) {
                        foreach ($request[$relation_name] as $sub_request) {
                            $this->saveSubModel($model, $sub_request, $relation_name, $relation_fields, $action, $delete_items);
                        }
                    }
                    if (count($delete_items) > 0) {
                        $related_relations = $this->getRelatedRelations(app($sub_class_name));
                        $delete_status = $this->deleteModels(class_basename($sub_class_name), $related_relations, $delete_items, false, true, []);
                        $message .= $delete_status['message'];
                    }

                    break;
                }
                case 'HasOne':
                case 'MorphOne':
                    {
                    $sub_request = $request[$relation_name];
                    $this->saveSubModel($model, $sub_request, $relation_name, $relation_fields, $action);
                    break;
                }
            }

        }

        return ['status' => $status, 'message' => $message];
    }

    private function saveSubModel($model, $sub_request, $relation_name, $fields, $action, &$delete_items = null)
    {
        $relation_info = $model->getRelationInfo($relation_name);
        $local_key = explode('.', $relation_info['local_key'])[1];
        $foreign_key = explode('.', $relation_info['foreign_key'])[1];
        $sub_class_name = $relation_info['related_model_name'];
        $order_conditions = null;
//        if (array_key_exists('order', $fields)) {
//            $order_conditions = [$foreign_key => $model->$local_key];
//        }


        if ($sub_request['id'] == 0) {
            $sub_model = new $sub_class_name();
        } elseif ($action == 'edit') {
            $sub_model = $sub_class_name::findOrFail($sub_request['id']);
            if ($delete_items !== null && in_array($sub_model->id, $delete_items)) {
                $key = array_search($sub_model->id, $delete_items);
                unset($delete_items[$key]);
            }
        } else {
            return;
        }
//        $sub_request[$foreign_key] = $model->$local_key;
//        $fields[$foreign_key] = [
//            "is_related_field" => false,
//            'type' => 'hidden'
//        ];

        $sub_model->$foreign_key=$model->$local_key;
        if (in_array($relation_info['relation_type'],['MorphMany','MorphOne'])) {
            list($table,$morph_type)=explode('.',$relation_info['morph_type']);
            $sub_model->$morph_type=get_class($model);
        }

        $this->saveModel($sub_model, $sub_request, $action, $order_conditions, $fields);

    }

    public function deleteModels($resource, $relations = [], $ids, $json_response = false, $delete_available = false, $order_scopes = null)
    {
        try {
            $message = "";
            \DB::transaction(function () use ($resource, $relations, $ids, $json_response, $delete_available, $order_scopes, &$message) {
                $ids = (array)$ids;
                $model_name = '\App\\' . $resource;

                $files = [];
                $main_fields = $model_name::mainFields();
                foreach ($main_fields['items'] as $item) {
                    if (in_array($item['input_type'], ['image', 'file'])) {
                        $files[] = $item['name'];
                    }
                }


                $status = true;
                if (count($relations) > 0 || $order_scopes !== null || count($files) > 0) {
                    foreach ($ids as $id) {
                        $query = $model_name::query();
                        foreach ($relations as $relation) {
                            $query->withCount($relation);
                        }
                        $model = $query->findOrFail($id);

                        $delete_status = true;
                        $delete_message = "";
                        foreach ($relations as $index => $relation) {
                            $relation_count = $relation . '_count';
                            if ($model->$relation_count > 0) {
                                $delete_status = false;
                                if ($index > 0) {
                                    $delete_message .= '<br>';
                                }
                                $delete_message .= trans('main.messages.has_related_model', [
                                    'resource' => trans('main.resources.' . $this->getResourceName($resource, true)),
                                    'id' => $model->id,
                                    'count' => $model->$relation_count,
                                    'relation' => trans($this->getResourceName($resource) . '.items.' . $relation . '.main_name')
                                ]);
                            }
                        }
                        if ($delete_status == false) {
                            $message .= "<p>" . $delete_message . "</p>";
                            $status = false;
                            continue;
                        }
                        if ($order_scopes !== null && $model->order !== null) {
                            $this->decrementOrder($model, $order_scopes);
                        }
                        if (count($files) > 0) {
                            foreach ($files as $file) {
                                $this->deleteFile($model->$file);
                            }
                        }
                        $model->delete();
                    }
                } else {
                    $status = $model_name::destroy($ids);
                }

                if (!$status and !$delete_available) {
                    throw new \Exception($message);
                }

            });


            return $this->getResponseMessage(true, $resource, 'delete', $message, $json_response);

        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            return $this->getResponseMessage(false, $resource, 'delete', $message, $json_response);
        }


    }
}