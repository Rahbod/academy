<div class="" style="margin:100px auto;">
    <div style="margin:0;padding:0;background-color:#fff;width: 100%;">
        <table style="text-align: center;border-collapse: collapse;border-spacing: 0;max-width: 600px;">
            <tr>
                <td style="padding: 20px 0 20px 0;text-align: center;background: #14222c;">
                    <a href="{{url(session('lang'). '/')}}" title="{{$siteName}}" style="color: #fff;">
                        {{--<img src=""--}}
                        {{--style="width: 190px!important;height: 50px!important;"--}}
                        {{--alt="{{$siteName}}">--}}
                        {{$siteName}}
                    </a>
                </td>
            </tr>
            <tr>
                <td style="padding: 30px 30px 10px 30px;background: #fff;">
                    <h1>{{$greeting}}</h1>
                    <p style="font-size: 15px;">
                        {{$introLines}}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 30px 45px 30px;text-align: center;background: #fff;">
                    <a style="-webkit-border-radius: 30px;-moz-border-radius: 30px;border-radius: 30px;
                    padding: 10px 35px;font-size: 25px;color: #fff;
                background-color:#2cbad8;border: 3px solid #91d4e2;" href="{{url($actionUrl)}}"
                       title="{{$activation}}">
                        {{$activation}}
                    </a>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;padding: 0 0 0 0;background: #fff;">
                    <div style="padding: 5px 30px 20px 30px;margin: 0 45px 0 45px; border-top: 1px solid #b5b5b5;">
                        <a style="font-size: 10px; padding: 5px 0 0 0;color: #dbdbdb;" href="{{url(session('lang').'/')}}"
                           title="{{$siteName}}">
                            {{$siteName}}
                        </a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
