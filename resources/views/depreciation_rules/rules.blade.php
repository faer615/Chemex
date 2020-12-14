<table class="table">
    <thead>
    <tr>
        <th scope="col">年份</th>
        <th scope="col">比率</th>
    </tr>
    </thead>
    <tbody>
    @foreach($value as $item)
        <tr>
            <td>{{$item['year']}}</td>
            <td>{{$item['ratio']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
