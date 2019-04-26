<?php echo '<?php'; ?>

return [

@foreach($setting_groups as $setting_group)
    '{{$setting_group->name}}' => [
    @foreach($setting_group->settings as $setting)
        '{{$setting->name}}' =>  '{{$setting->value}}',
    @endforeach
    ],
@endforeach

'available_langs'=>['fa','en','ar'],
];
