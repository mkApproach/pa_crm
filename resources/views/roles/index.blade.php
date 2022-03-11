@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">                   
                        <table width="100%">
                        <td style="text-align: left;">役職一覧</td>
                        <td style="text-align: right;"><input type="button" onclick="location.href='./home'" value="ホーム"></td>
                        </table>     
                    </div>
                    <table width="100%" border="1">
                        <thead>
                        <tr style="background-color: lightgray">
                            <td>ID</td>
                            <td>役職コード</td>
                            <td>役職</td>
                        </tr>
                        </thead>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->memo }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection