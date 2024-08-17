@extends('mater');
@section('title')
    <h1>danh sách sản phẩm</h1>
@endsection
@section('content')
    <a href="{{ route('product.create') }}">thêm mới</a>
    <table class="table table-hover">
        <tr>
            <td>name</td>
            <td>description</td>
            <td>price</td>
            <td>danh mục</td>
            <td>tag</td>
            <td>ảnh sp</td>
            <td>chức năng</td>
        </tr>
        @foreach ($data as $item)
            {{-- @dd($item->Tag) --}}
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->Category->name }}</td>
                <td>
                    @foreach ($item->Tag as $item1)
                        {!! $item1->name . '<br>' !!}
                    @endforeach
                </td>
                <td>
                    <ul>
                       @foreach ($item->Galleries as $item2)
                       {{-- @dd($item2) --}}
                           <li><img style="width: 100px" src="{{$item2->image_path}}" alt=""></li>
                       @endforeach
                    </ul>
                </td>
                <td><a href="{{ route('product.edit', $item->id) }}">edit</a>
                    <form action="{{ route('product.destroy', $item->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit">xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        {{$data->links()}}
    </table>
@endsection
