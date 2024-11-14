<x-app-layout>
    <div class="row justify-content-center ml-0 mr-0 h-100">
        <div class="card w-100">
            <div class="card-header">画像追加</div>
            <div class="card-body">
                <form method='POST' action="{{ route('photos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">画像登録：</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <x-primary-button type='submit' class="mt-4">保存</x-primary-button>
                </form>
            </div>
        </div>
        @foreach ($photos as $photo)
            <div class="col-md-3 mb-2 mt-2">
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="upload image" width="80px">
            </div>
        @endforeach
    </div>
</x-app-layout>
