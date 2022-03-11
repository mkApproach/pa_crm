@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                   
                        <table width="100%">
                            <td style="text-align: left;">顧客　詳細　編集</td>
                            <td style="text-align: right;">
                            <input type="button" onclick="location.href='./customers'" value="一覧へ">
                            &nbsp;
                            <input type="button" onclick="location.href='./home'" value="ホーム">
                            </td>
                        </table>
                    </div>
                    <form action="/customers/{{ $customer->id }}" method="POST">
                    
                        @csrf
                        @method('PUT')
                        <p>氏名：<input type="text" name="name" value="{{ $customer->name }}"></p>
                        <p>店舗番号：<input type="text" name="shop_id" value="{{ $customer->shop_id }}"></p>
                        <p style="font-size: 0.75em">1 東京本店, 2 名古屋支店, 3 大阪支店</p>
                        <p>郵便番号：<input type="text" name="postal" value="{{ $customer->postal }}"></p>
                        <p>住所：<input type="text" name="address" value="{{ $customer->address }}"></p>
                        <p>メール：<input type="text" name="email" value="{{ $customer->email }}"></p>
                        <p>生年月日：<input type="text" name="birthdate" value="{{ $customer->birthdate }}"></p>
                        <p>電話番号：<input type="text" name="phone" value="{{ $customer->phone }}"></p>
                        <p>クレーマーフラグ：<input type="text" name="kramer_flag" value="{{ $customer->kramer_flag }}"></p>
                        <p style="font-size: 0.75em">0 問題ない顧客, 1 クレーマー顧客</p>
                        <p style="text-align: center"><button class="btn btn-primary" type="submit">　　更　新　　</button></p>
                    </form>

                    {{-- エラーを表示--}}
                    @if( $errors->any() )
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
