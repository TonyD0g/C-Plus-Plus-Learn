@extends($_viewFrame)

@section('pageTitleMain')工具箱@endsection
@section('pageKeywords')工具箱@endsection
@section('pageDescription')工具箱@endsection

@section('headAppend')
    @parent
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_2057031_h4m5ydsjcqc.css" />
@endsection

@section('bodyAppend')
    @parent
    <script src="@asset('asset/vendor/vue.js')"></script>
    <script src="@asset('asset/vendor/element-ui/index.js')"></script>
    <script>
        window._data = {
            memberUser:{
                id: {!! json_encode(\Module\Member\Auth\MemberUser::id()) !!},
                nickname: {!! json_encode(\Module\Member\Auth\MemberUser::get('nickname')) !!},
                avatar: {!! json_encode(\Module\Member\Auth\MemberUser::get('avatar')) !!}
            }
        };
    </script>
    <script src="@asset('vendor/Tools/entry/tools.js')"></script>
@endsection

@section('body')
    <div id="app"></div>
@endsection
