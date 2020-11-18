<table class="table">
    <thead>
    <tr>
        <th scope="col">姓名</th>
        <th scope="col">联系电话</th>
        <th scope="col">电子邮箱</th>
        <th scope="col">职位</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($value,true) as $item)
        <tr>
            <td>{{$item['name']}}</td>
            <td>{{$item['phone']}}</td>
            <td>{{$item['email']}}</td>
            <td>{{$item['title']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
