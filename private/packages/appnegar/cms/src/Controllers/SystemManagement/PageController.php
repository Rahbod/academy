<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Action;
use App\Frame;
use App\Module;
use App\Resource;
use App\Section;
use App\Template;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\MasterPage;
use App\Page;
use Appnegar\Cms\Controllers\AdminController;

class PageController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Page';
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $data = [
                'id' => 0, 'master_page_id' => 0, 'name' => '', 'display_name' => '', 'description' => '', 'sections' => []
            ];
            return response()
                ->json($this->getFormData($data));
        } elseif ($request->isMethod('post')) {
            $this->validate($request, $this->validationRules($request));

            $model = new Page();
            $request->merge(['modules'=>$this->formatModulesRequest($request)]);
            unset($request['sections']);
            return $this->transaction($request, $model, 'create');
        }
        return response()->json([
            'error' => 'method not allow'
        ], 442);
    }

    /**
     * Show the form for editing the specified resource or Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $model = Page::findOrFail($id);
            $template_id = MasterPage::where('id', $model->master_page_id)->select(['template_id'])->first()->template_id;
            $sections = Section::where('master_page_id', $model->master_page_id)->with(['modules' => function ($query) use ($model) {
                $query->where('page_id', $model->id)->orderBy('order');
            }])->get(['id', 'display_name','master_page_id']);
            $array_sections = $this->setSections($sections);

            $data = $model->toArray();
            $data['sections'] = $array_sections;
            $data['template_id'] = $template_id;

            return response()
                ->json($this->getFormData($data, $template_id));
        } elseif ($request->isMethod('put')) {
            $this->validate($request, $this->validationRules($request, $id));

            $model = Page::findOrFail($id);
            $request->merge(['modules'=>$this->formatModulesRequest($request)]);
            unset($request['sections']);
            return $this->transaction($request, $model, 'edit');
        }
        return response()->json([
            'error' => 'method not allow'
        ], 442);
    }

//    /**
//     * @param $id
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function destroy($id)
//    {
//        $ids = explode(',', $id);
//        return $this->deleteModels($this->resource,[],$ids);
//    }

    private function formatModulesRequest($request){
        $modules=[];
        if (isset($request['sections'])) {
            foreach ($request['sections'] as $section) {
                if (isset($section['modules'])) {
                    foreach ($section['modules'] as $module) {
                        $module['section_id']= $section['id'];
                        $this->setModuleInfo($module);

                        $modules[]=$module;
                    }

                }
            }
        }
//        dd($modules);
        return $modules;
    }

    public function changeTemplate(Request $request)
    {
        $master_pages = MasterPage::where('template_id', $request->template_id)->select(['id', 'display_name  AS text'])->get();
        $frames = Frame::where('template_id', $request->template_id)->select(['id', 'display_name  AS text'])->get();

        return ['master_pages' => $master_pages, 'frames' => $frames];
    }

    public function changeMasterPage(Request $request)
    {
        $this->validate($request,[
            'page_id'=>'required',
            'master_page_id'=>'required|exists:master_pages,id',
        ]);

        $options=[];
        $sections = Section::where('master_page_id', $request->master_page_id)->select(['id', 'display_name','master_page_id'])->get();
        if (count($sections) > 0) {
            if ($request->page_id !== 0) {
                $sections->load(['modules' => function ($query) use ($request) {
                    $query->where('page_id', $request->page_id)->orderBy('order');
                }]);
                $sections=$this->setSections($sections);
                $options=$this->getSectionsOptions($sections);
            } else {
                foreach ($sections as $section) {
                    $section->modules = [];
                }
            }
        }

        return ['sections'=>$sections,'options'=>$options];
    }

    public function changeFrame(Request $request)
    {
        $this->validate($request,[
            'frame_id'=>'required|exists:frames,id',
        ]);
        $actions = Action::whereHas('frames', function ($query) use ($request) {
            $query->where('id', $request->frame_id);
        })->select(['id', 'display_name  AS text'])->get();

        return $actions;
    }

    public function changeResource(Request $request)
    {
        $this->validate($request,[
            'resource'=>'required'
        ]);
        $model_name='\\App\\'.$request->resource;

        $relations=$model_name::getRelationsName();
//        $fields=$model_name::getSelectFields($relations);

        $fields=$model_name::getSelectFields([]);

        return ['relations'=>$relations,'fields'=>$fields];
    }

    public function changeRelations(Request $request)
    {
        $this->validate($request,[
            'resource'=>'required',
        ]);
        $model_name='\\App\\'.$request->resource;


        $fields=$model_name::getSelectFields($request->relations);

        return $fields;
    }

    /**
     * @param $module array
     * @return mixed|null
     */
    protected function setModuleInfo(&$module)
    {
        $info = [];
        if (isset($module['order_by'])){
            $info['order_by'] = $module['order_by'];
            unset($module['order_by']);
        }

        if (isset($module['order_type'])){
            $info['order_type'] = $module['order_type'];
            unset($module['order_type']);
        }

        if (isset($module['pagination'])){
            $info['pagination'] = $module['pagination'];
            unset($module['pagination']);
        }

        if (isset($module['record_count'])){
            $info['record_count'] = $module['record_count'];
             unset($module['record_count']);
        }

        if (isset($module['fields']) and count($module['fields'])>0){
            $info['fields'] = $module['fields'];
             unset($module['fields']);
        }

        if (isset($module['relations']) and count($module['relations'])>0)
        {
            $info['relations'] = $module['relations'];
             unset($module['relations']);
        }

        if (count($info) > 0) {
            $info= json_encode($info);
        }
        else{
            $info=null;
        }
        $module['info']=$info;
        return $info;
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
            'master_page_id' => [
                'required',
                Rule::exists('master_pages', 'id')->where('template_id', $request->template_id)
            ],
            'action_id' => [
                'required',
                Rule::exists('actions', 'id')->where('type', 'page_loader')
            ],
            'name' => ['required', Rule::unique('pages')->where(function ($query) use ($request, $id) {
                $query->where('master_page_id', $request->master_page_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            })],
            'display_name' => ['required', Rule::unique('pages')->where(function ($query) use ($request, $id) {
                $query->where('master_page_id', $request->master_page_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            })],
            'sections.*.id' => [
                'required',
                Rule::exists('sections', 'id')->where('master_page_id', $request->master_page_id)
            ],
            'sections.*.modules.*.id' => 'required',
            'sections.*.modules.*.frame_id' => [
                'required',
                Rule::exists('frames', 'id')->where('template_id', $request->template_id)
            ],
            'sections.*.modules.*.action_id' => [
                'required',
                Rule::exists('actions', 'id')->where('type', 'frame_loader')
            ],
            'sections.*.modules.*.order' => 'numeric:min,0',
        ];

        if (isset($request->sections)) {
            foreach ($request->sections as $index1 => $section) {
                if (isset($section['modules'])) {
                    foreach ($section['modules'] as $index2 => $module) {
                        $rules['sections.' . $index1 . '.modules.' . $index2 . '.order_type'] = 'required_with:sections.' . $index1 . '.modules.' . $index2 . '.order_by';
                        $rules['sections.' . $index1 . '.modules.' . $index2 . '.order_by'] = 'required_with:sections.' . $index1 . '.modules.' . $index2 . '.order_type';
                        $rules['sections.' . $index1 . '.modules.' . $index2 . '.record_count'] = 'required_with:sections.' . $index1 . '.modules.' . $index2 . '.pagination';
                    }
                }
            }
        }

        return $rules;
    }

    /**
     * @param array $data
     * @param $template_id
     * @return array
     */
    protected function getFormData($data, $template_id = null)
    {
        $info= [
            'model' => $data,
            'options' => [
                'master_page_id' => MasterPage::where(function ($query) use ($template_id) {
                    if ($template_id !== null) {
                        $query->where('template_id', $template_id);
                    }
                })->orderBy('id')->get(['id', 'display_name  AS text']),
                'template_id' => Template::orderBy('id')->get(['id', 'display_name  AS text']),
                'action_id' => Action::where('type', 'page_loader')->orderBy('id')->get(['id', 'display_name  AS text']),
                'resource' => Resource::whereHas('resource_group', function ($query){
                    $query->whereHas('department',function ($query){
                        $query->where('name','system_management');
                    });
                })->orderBy('id')->get(['id', 'name  AS text'])->pluck('text'),
                'frame_id' => Frame::where(function ($query) use ($template_id) {
                    if ($template_id !== null) {
                        $query->where('template_id', $template_id);
                    }
                })->orderBy('id')->get(['id', 'display_name  AS text'])
            ],
        ];

       $sections_options=$this->getSectionsOptions($data['sections']);
       $info['options']=array_merge($info['options'],$sections_options);

        return $info;
    }

    protected function setSections($sections){
        $array_sections = [];
        if ($sections) {
            foreach ($sections as $section) {
                $array_section = [];
                $array_section['id'] = $section->id;
                $array_section['master_page_id'] = $section->master_page_id;
                $array_section['display_name'] = $section->display_name;
                $array_section['name'] = $section->name;
                $array_section['modules'] = [];
                if ($section->modules) {
                    foreach ($section->modules as $module) {
                        $array_module = [];
                        $array_module['id'] = $module->id;
                        $array_module['title'] = $module->title;
                        $array_module['resource'] = $module->resource;
                        $array_module['page_id'] = $module->page_id;
                        $array_module['section_id'] = $module->section_id;
                        $array_module['frame_id'] = $module->frame_id;
                        $array_module['action_id'] = $module->action_id;
                        $array_module['order'] = $module->order;

                        if ($module->info !== null) {
                            $info = json_decode($module->info);
                            foreach ($info as $key => $value) {
                                $array_module[$key] = $value;
                            }
                        }

                        $array_section['modules'][] = $array_module;
                    }
                }
                $array_sections[] = $array_section;
            }
        }

        return $array_sections;
    }

    protected function getSectionsOptions($sections){
        $options=[];
        $frame_ids=[];
        $actions=[];
        foreach ($sections as $section_index=>$section){
            if(isset ($section['modules'])){
                foreach ($section['modules'] as $module_index=>$module){
                    $frame_id=$module['frame_id'];
                    if(!in_array($frame_id,$frame_ids)){

                        $frame_ids[]=$frame_id;
                        $action=Action::whereHas('frames',function ($query)use ($frame_id){
                            $query->where('id',$frame_id);
                        })->orderBy('id')->get(['id', 'display_name  AS text']);
                        $actions[$frame_id]=$action;
                        $options['sections.'.$section_index.'.modules.'.$module_index.'.action_id']=$action;
                    }else{
                        $options['sections.'.$section_index.'.modules.'.$module_index.'.action_id']= $actions[$frame_id];
                    }

                    if($module['resource']){
                        $model_name='\\App\\'.$module['resource'];
                        $module_relations=[];
                        if(isset($module['relations'])){
                            $module_relations=$module['relations'];
                        }

                        $relations=$model_name::getRelationsName();
                        $fields=$model_name::getSelectFields($module_relations);
                        $options['sections.'.$section_index.'.modules.'.$module_index.'.relations']=$relations;
                        $options['sections.'.$section_index.'.modules.'.$module_index.'.fields']=$fields;
                        $options['sections.'.$section_index.'.modules.'.$module_index.'.order_by']=$model_name::getSelectFields([]);
                    }
                }
            }
        }

        return $options;
    }

}