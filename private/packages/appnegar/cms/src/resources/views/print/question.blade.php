
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://www.mohaqeq.org/fa//templates/default/css/question.css"  rel="stylesheet" type="text/css">

<div class="print_row1">
    <div class="print_row_right">
        {{__('questions.items.pursuit_code')}} : <span style="direction: ltr;text-align: left; display: inline-block">{{$model->pursuit_code}}</span>
    </div>
    <div class="print_row_left">
        {{__('questions.items.sender_name')}} : {{$model->sender_name}}
    </div>
</div>

<div class="print_row1">
    <div class="print_row_right">
        {{__('questions.items.sender_email')}} : {{$model->sender_email}}
    </div>
    <div class="print_row_left">
        {{__('questions.items.sender_country')}} : {{$model->sender_country}}
    </div>


</div>

<div class="print_row_title">
    {{__('questions.items.text')}}:
</div>
<div class="print_row">
    {!! nl2br($model->text) !!}
</div>
<div class="print_row_title">
    {{__('questions.items.answer')}}:
</div>
<div class="print_row">
    {!! nl2br($model->answer) !!}
</div>
<span style=" page-break-after:always">&nbsp;</span>
