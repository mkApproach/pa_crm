@extends('customer_search')

@section('detail')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                
                @if(!empty($customers))
                    <div class="card">
                        <div class="card-header">
                            <p>検索結果</p>
                            <ul>
                                @foreach($search_criterias as $criteria)
                                    <li>{{$criteria}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach($customers as $customer)
                                    <li>
                                        <a href="/customers/{{$customer['id']}}">{{ $customer['name'] }}</a>
                                    </li>
                                @endforeach
                                
                            </ul>
                            {{--  pagenation link -------------------------------------------------------------------------------       --}}
                                <form action="/customer_search_detail" method="GET">
                                @csrf
                            <table width="100%">
                                    <tr>
                                    
                                        {{ $customers->appends(request()->query())->links() }}
                                     {{--
                                        {!! $customers->links() !!} 
                                        --}}
                                    </tr>
                                </table>
                                </form>
                                {{--  End of pagenation link -------------------------------------------------------------------------       --}}

                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection
