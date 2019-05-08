<?php
echo '<?php';
use App\SpNamespace;
$namespaces = SpNamespace::with(['departments.resource_groups.resources.paths' => function ($query) {
    $query->with(['action' => function ($query2) {
        return $query2->select(['name', 'id','need_allow']);
    }])->orderBy('order');
}])->get();

?>



@foreach($namespaces as $namespace)
    Route::group(['namespace'=>'Controllers\{{$namespace->name}}','prefix'=>'{lang}'],function(){
    @foreach($namespace->departments as $department)
        <?php
        $options = [];
        $options_string = "";
        $guard = ($department->name === 'profile')?'web':$department->name;
        if ($department->prefix) $options['prefix'] = "'".$department->prefix."'";
        $basic_middleware="auth:".$guard."','set_department:".$department->name."' ,'user_info','lang','remove_additional_params";
        if ($department->middleware) {
            $department_middleware=str_replace(",", "','", $department->middleware);
            $options['middleware'] = "['" . $department_middleware. "' ,'".$basic_middleware."']";
        }
        else{
            $options['middleware'] = "['".$basic_middleware."']";
        }
        if (count($options) > 0) {
            $options_string = "[";
            $counter=1;
            foreach ($options as $key=>$option)
            {
                $options_string .="'".$key."'=>".$option;
                if($counter < count($options))
                {
                    $options_string .=",";
                }
                $counter++;
            }
            $options_string .= "]";
        }
        ?>

        Route::group({!! $options_string !!},function(){

        @foreach($department->resource_groups as $resourceGroup)
            <?php
            $option=($resourceGroup->namespace)?"['namespace'=>'".$resourceGroup->namespace."']":"";
            //                $option = "['namespace'=>'".$namespaces."']";
            ?>

            @if($option !== "")
                Route::group({!! $option !!},function(){
            @endif
            @foreach($resourceGroup->resources as $resource)

                @foreach($resource->paths as $path)
                    @if($path->action->need_allow == 1)
                        Route::{{$path->method}}('/{{$path->slug}}', ['uses' =>'{{$resource->name}}{{'Controller@'}}{{$path->action->name}}','as' =>'{{$department->prefix.'.'.$path->name}}'])->middleware('acl:{{$path->action_id}}');
                    @else
                        Route::{{$path->method}}('/{{$path->slug}}', ['uses' =>'{{$resource->name}}{{'Controller@'}}{{$path->action->name}}','as' =>'{{$department->prefix.'.'.$path->name}}']);
                    @endif
                @endforeach
            @endforeach
            @if($option !== "")
                });
            @endif
        @endforeach
        });

    @endforeach

    });
@endforeach


Route::group(['namespace'=>'Controllers\Auth'],function(){
Route::group(['prefix'=>'{lang}/{department}','middleware'=>['set_department','lang']],function(){
Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login_form');
Route::post('login', 'AdminLoginController@login')->name('admin.login');
Route::post('logout', 'AdminLoginController@logout')->name('admin.logout');
});
});
Route::get('{lang}/access_denied', function ($lang){
return view('appnegar::access_denied');
})->name('access_denied')->middleware('lang');