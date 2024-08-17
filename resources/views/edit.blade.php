@extends('mater')
@section('title')
    <h1>cập nhật</h1>
@endsection
@section('content')
    <form action="{{ route('product.update', $data->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PUT')
        <div class="mt-3">
            <label for="">nam</label>
            <input value="{{ $data->name }}" type="text" class="form form-control" name="name">
        </div>
        <div class="mt-3">
            <label for="">description</label>
            <input value="{{ $data->description }}" type="text" class="form form-control" name="description">
        </div>
        <div class="mt-3">
            <label for="">price</label>
            <input value="{{ $data->price }}" type="number" class="form form-control" name="price">
        </div>
        <div class="mt-3">
            <label for="">danh mục</label>
            <select name="dm" class="form form-control" id="">
                @foreach ($ct as $item)
                    <option @selected($data->Category->id == $item->category_id) value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="">Tag</label>
            <select name="tag[]" multiple class="form form-control" id="">
                @foreach ($tag as $id => $item)
                    {{-- @dd($item) --}}

                    <option @foreach ($data->Tag as $item1) @selected($id == $item1->id) @endforeach
                        value="{{ $id }}">
                        {{ $item }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="">gallery</label>

            @foreach ($data->Galleries as  $item)
            {{-- @dd($item) --}}
                <input type="file" name="gallery[{{$item->id}}]" class="form form-control">
                <img src="{{Storage::url($item->image_path)}}" style="width: 100px" alt="">
            @endforeach
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-success">cập nhật</button>
        </div>
    </form>
@endsection
