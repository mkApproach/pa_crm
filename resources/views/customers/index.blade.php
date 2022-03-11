@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                    <table width="100%">
                    <td style="text-align: left;">顧客 一覧　画面</td>
                    <td style="text-align: right;"><input type="button" onclick="location.href='./home'" value="ホーム"></td>
                    </table>
                    
                    </div>
                    <table width="100%" border="1">
                        <thead>
                        <tr style="background-color: lightgray">
                            <td>氏名</td>
                            <td>店舗</td>
                            <td>郵便番号</td>
                            <td>住所</td>
                            <td><div style="text-align: center;">編集</div></td>
                            <td><div style="text-align: center;">削除</div></td>
                        </tr>
                        </thead>
                        @foreach($customers as $customer)
                            <tr>
                                <td>
                                    <a href="./customers/{{ $customer->id }}">
                                        {{ $customer->name }}
                                    </a>
                                </td>
                                <td>{{ $customer->shop->name }}</td>
                                <td>{{ $customer->postal }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <form method="post" action="/customers/{{ $customer->id }}/edit">
                                        @csrf
                                        @method('get')
                                        <div style="text-align: center;">
                                            <input type="submit" value="編集">
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="/customers/{{ $customer->id }}" onsubmit="return beforeSubmit()">
                                        @csrf
                                        @method('delete')
                                        <div style="text-align: center;">
                                            <input type="submit" value="削除" >
                                        </div>
                                    </form>
                                    <script>
                                        function beforeSubmit() {
                                            if(window.confirm('CustomerLogも一緒に削除します\n\n本当に削除してよろしいでしょうか？')) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                        }
                                    </script>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    {{--  pagenation link -------------------------------------------------------------------------------       --}}
                    <table width="100%">
                        <tr>
                            {!! $customers->links() !!}
                        </tr>
                    </table>
                    {{--  End of pagenation link -------------------------------------------------------------------------       --}}

                </div>
            </div>
        </div>
    </div>
@endsection
