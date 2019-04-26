<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    .es_answer_main{
        width:685px;
    }
    .es_answer_top{
        width:685px;
        height:43px;
        background-image:url(http://www.mohaqeq.org/fa/images/estefta-answer/top.jpg);
    }
    .es_answer_center{
        width:685px;
        display:table;
        background-image:url(http://www.mohaqeq.org/fa/images/estefta-answer/center.jpg);
    }
    .es_answer_down{
        width:685px;
        height:38px;
        background-image:url(http://www.mohaqeq.org/fa/images/estefta-answer/down.jpg);
    }
    .es_answer_q{
        font-family:Tahoma, Geneva, sans-serif;
        font-size:10pt;
        font-weight:normal;
        margin-left:10px;
        margin-right:10px;
        text-align:justify;
        direction:rtl;
        color:#600;
        line-height:150%;
    }
    .es_answer_a{
        font-family:Tahoma, Geneva, sans-serif;
        font-size:10pt;
        font-weight:bold;
        margin-left:10px;
        margin-right:10px;
        text-align:justify;
        direction:rtl;
        color:#030;
        line-height:150%;
    }
    .es_answer_b{
        font-family:Tahoma, Geneva, sans-serif;
        font-size:10pt;
        font-weight:normal;
        margin-left:10px;
        margin-right:10px;
        text-align:center;
        direction:rtl;
        color:black;
        line-height:150%;
    }
    .es_answer_c{
        font-family:Tahoma, Geneva, sans-serif;
        font-size:10pt;
        font-weight:normal;
        margin-left:10px;
        margin-right:10px;
        text-align:justify;
        direction:rtl;
        color:black;
        line-height:150%;
    }
    .es_answer_d{
        font-family:Tahoma, Geneva, sans-serif;
        font-size:10pt;
        font-weight:normal;
        margin-left:10px;
        margin-right:10px;
        text-align:right;
        direction:rtl;
        color:black;
        line-height:150%;
    }
</style>
<div class="es_answer_main">
    <div style="width:685px;height:43px;background-image:url(http://www.mohaqeq.org/fa/images/estefta-answer/top.jpg);"></div>
    <div class="es_answer_center">
        <div class="es_answer_b">بسم الله الرحمن الرحیم</div>
        <br>
        <div class="es_answer_c">با سلام و تشکر از مکاتبه ی شما {{$question->responder->name}} به سؤال شما به صورت زیر پاسخ گفته است:</div>

        <div class="es_answer_a">{!! nl2br($question->answer) !!}</div>
        <br>

        <div class="es_answer_d">همیشه در پناه خداوند مؤید باشید:</div>

        <p>
        <div class="es_answer_q">{!! nl2br($question->text) !!}</div>

    </div>
    <div  style="width:685px;height:38px;background-image:url(http://www.mohaqeq.org/fa/images/estefta-answer/down.jpg);" ></div>
</div>
