<x-app-layout>
    <div class="row justify-content-center ml-0 mr-0 h-100">
        <div class="card w-100">
            <h1 class="">画像追加</h1>
            <div class="card-body">
                <form method='POST' action="{{ route('photos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">画像登録：</label>
                        <input type="file" name="image" id="image" accept="image/*" required>
                    </div>
                    <x-primary-button type='submit' id='submit-button' class="mt-4">保存</x-primary-button>
                </form>
            </div>
        </div>
        @foreach ($photos as $photo)
            <div class="col-md-3 mb-2 mt-2">
                <span class="text-gray-500">{{ $photo->user->name }}</span>
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="upload image" width="120px">
                @if (auth()->user()->id === $photo->user_id)
                    <form method="POST" action="{{ route('photos.destroy', $photo) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this photo?') ">削除</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>

@vite('resources/js/photoForm.js')
