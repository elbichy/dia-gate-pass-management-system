@extends('layout.print')

@section('content')
    
    <table>
        <thead>
            <tr>
                <h5 class="center" style="margin-bottom:10px;">Screened guests today (Gate)</h5>
            </tr>
            <tr>
                <th>Personnel</th>
                <th>Guest</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="requestsApprovalHistory">
            @foreach($data['allVisitors'] as $visitors)
                @foreach($visitors->visitors as $visitor)
                    @if($visitor->status > 0)
                        <tr>
                            <td>{{$visitors->firstname.' '.$visitors->lastname}}</td>
                            <td>{{$visitor->firstname.' '.$visitor->lastname}}</td>
                            <td>
                                @if($visitor->status == 1)
                                    <span class="orange-text">Cleared @ Gate</span>
                                @elseif($visitor->status == 2)
                                    <span class="green-text">Cleared!</span>
                                @elseif($visitor->status == 3)
                                    <span class="red-text">Declined</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection