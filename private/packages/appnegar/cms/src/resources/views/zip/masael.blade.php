<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$book->name}}</title>
</head>
<style>
    /* CSS Document */

    .Matn {
        font-family: arial,Tahoma, sans-serif, "Times New Roman";
        font-size: 16pt;
        font-weight:bold;
        line-height: 1.5em;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        color:#006;
    }

    body {
        background:#CCC;
        margin-left:10%;
        margin-right:10%;
        line-height:2em;
        font-size: 14pt;
        text-align:justify;
        text-decoration:none;
        margin-top: 20px;
        direction:rtl;
        color: #039;
        border:2px;
        border-style:groove;
        border-color:#063;
        padding:5px;
    }
    p{
        text-align:justify;
    }
    a {
        font-family: Times New Roman, Times, serif;
        font-size: 12pt;
        color:#039;
    }
    .hadith {
        font-family: Tahoma, sans-serif, "Times New Roman";
        font-size: 12pt;
        font-style: none;
        line-height: 1.5em;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        color: #0c6;
    }




    .tarjome {
        font-family: Tahoma, sans-serif, "Times New Roman";
        font-size: 12pt;
        font-style: italic;
        line-height: 1.5em;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        color:#90F;
    }



    .question {
        font-family: Tahoma, sans-serif, "Times New Roman";
        font-size: 12pt;
        font-style: none;
        line-height: 1.5em;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        color:#300;
    }


    .answer {
        font-family: Tahoma, sans-serif, "Times New Roman";
        font-size: 12pt;
        font-style: italic;
        line-height: 1.5em;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        color:#060;
    }


    .subtitle {
        font-family: arial,Tahoma, sans-serif, "Times New Roman";
        font-size: 16pt;
        font-style:normal;
        line-height: 1.5em;
        font-weight:bold;
        font-variant: normal;
        text-transform: none;
        color:#006;
    }

    .center {
        margin-left: 5pt;
        font-size: 12pt;
        text-align:center;
        text-decoration:none;
        margin-top: 5px;
        margin-right: 5px;
        color: #039;
    }

    .left {
        margin-left: 5pt;
        font-size: 12pt;
        text-align:left;
        text-decoration:none;
        margin-top: 5px;
        margin-right: 5px;
        color: #039;
    }

</style>
<body>
<a name="top"></a>
<p align="right" dir="rtl"><b>{{$book->name}}</b></p>
<p align="right" dir="rtl">{!! nl2br($book->description) !!}</p>

@foreach($book->concordances as $concordance)
    <a href="#{{$concordance->id}}"><p align="right" dir="rtl"><b>{{$concordance->title}}</b></p></a>
@endforeach
@foreach($book->concordances as $concordance)
    <a href="#{{$concordance->id}}"><p align="right" dir="rtl"><b>{{$concordance->title}}</b></p></a>
    <p align="right" dir="rtl">
        <a name="{{$concordance->id}}" href="#top">▲</a>
        <b>{{$concordance->title}}</b>
    </p>
    <div align="right" dir="rtl">{!! $concordance->text !!}
        <div>
            <p align="right" dir="rtl">{!! $concordance->feuilleton !!}</p>
        </div>
    </div>
@endforeach

</body>
</html>