<div class="max-w-4xl relative p-4 bg-white rounded-lg dark:bg-gray-800 sm:p-5">
    <form action="{{ route("dashboard.update", $post) }}" method="POST">
        @csrf
        @method("PATCH")
        <div class="mb-4">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input
                type="text"
                name="title"
                id="danger"
                class="@error("title")
                    bg-danger-soft
                    border
                    border-danger-subtle
                    text-fg-danger-strong
                    text-sm
                    rounded-base
                    focus:ring-danger
                    focus:border-danger
                    block
                    w-full
                    px-3
                    py-2.5
                    shadow-xs
                    placeholder:text-fg-danger-strong
                @else
                    border
                    border-gray-300
                    text-gray-900
                    text-sm
                    rounded-lg
                    block
                    w-full
                    p-2.5
                    focus:ring-primary-600
                    focus:border-primary-600
                    dark:bg-gray-700
                    dark:border-gray-600
                    dark:placeholder-gray-400
                    dark:text-white
                    dark:focus:ring-primary-500
                    dark:focus:border-primary-500
                @enderror"
                placeholder="Type post title"
                autofocus
                value="{{ old("title") ?? $post->title }}"
            />
            @error("title")
                <p class="mt-2.5 text-sm text-fg-danger-strong">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select
                id="category"
                name="category_id"
                class="@error("category_id")
                    bg-danger-soft
                    border
                    border-danger-subtle
                    text-fg-danger-strong
                    text-sm
                    rounded-base
                    focus:ring-danger
                    focus:border-danger
                    block
                    w-full
                    px-3
                    py-2.5
                    shadow-xs
                    placeholder:text-fg-danger-strong
                @else
                    border
                    border-gray-300
                    text-gray-900
                    text-sm
                    rounded-lg
                    block
                    w-full
                    p-2.5
                    focus:ring-primary-600
                    focus:border-primary-600
                    dark:bg-gray-700
                    dark:border-gray-600
                    dark:placeholder-gray-400
                    dark:text-white
                    dark:focus:ring-primary-500
                    dark:focus:border-primary-500
                @enderror"
            >
                <option selected="" value="">Select post category</option>
                @foreach (App\Models\Category::all() as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected((old("category_id") ?? $post->category->id) == $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error("category_id")
                <p class="mt-2.5 text-sm text-fg-danger-strong">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
            <textarea
                id="body"
                name="body"
                rows="4"
                class="@error("body")
                    bg-danger-soft
                    border
                    border-danger-subtle
                    text-fg-danger-strong
                    text-sm
                    rounded-base
                    focus:ring-danger
                    focus:border-danger
                    block
                    w-full
                    px-3
                    py-2.5
                    shadow-xs
                    placeholder:text-fg-danger-strong
                @else
                    border
                    border-gray-300
                    text-gray-900
                    text-sm
                    rounded-lg
                    block
                    w-full
                    p-2.5
                    focus:ring-primary-600
                    focus:border-primary-600
                    dark:bg-gray-700
                    dark:border-gray-600
                    dark:placeholder-gray-400
                    dark:text-white
                    dark:focus:ring-primary-500
                    dark:focus:border-primary-500
                @enderror"
                placeholder="Write post body here"
            >
{{ old("body") ?? $post->body }}</textarea
            >
            @error("body")
                <p class="mt-2.5 text-sm text-fg-danger-strong">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route("dashboard.index") }}">
                <span class="text-sm text-red-500 hover:underline">&laquo; Back to all posts</span>
            </a>
            <button
                type="submit"
                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            >
                {{--
                    <svg
                    class="mr-1 -ml-1 w-6 h-6"
                    fill="currentColor"
                    viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                    fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"
                    />
                    </svg>
                --}}
                <svg
                    class="mr-2 -ml-1 size-4"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 16 18"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"
                    />
                </svg>
                Update post
            </button>
        </div>
    </form>
</div>
