<table>
    <thead>
	<tr>
        <th colspan="6">
            ({{ \Carbon\Carbon::parse(now())->format('d.m.Y')}}) ျမန္မာႏုိင္ငံကူးလက္မွတ္ PJ ျပဳလုပ္မည့္အလုပ္သမားအမည္စာရင္း
        </th>
    </tr>
    <tr>
        <th>စဥ္</th>
        <th>အမည္</th>
        <th>ေမြးသကၠရာဇ္</th>
        <th>အဘအမည္</th>
        <th>မွတ္ပုံတင္အမွတ္</th>
        <th>လူမ်ဳိး/ဘာသာ</th>
    </tr>
    {{-- <tr>
            @foreach($data[0] as $key => $value)
            <th>{{ ucfirst($key) }}</th>
            @endforeach
            </tr> --}}
    </thead>
    <tbody>
        @php $i=1; @endphp
    @foreach($data as $row)
    	<tr>
            <td>{{$i++}}</td>
        @foreach ($row as $value)
    	    <td>{{ $value }}</td>
        @endforeach        
	    </tr>
    @endforeach
    </tbody>
</table>