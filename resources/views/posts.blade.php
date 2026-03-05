<x-layout :title="$title">
    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-6">
        <form class="mb-8 flex items-center max-w-sm mx-auto space-x-2">
            @if (request("category"))
                <input type="hidden" name="category" value="{{ request("category") }}" />
            @endif

            @if (request("author"))
                <input type="hidden" name="author" value="{{ request("author") }}" />
            @endif

            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <input
                    type="text"
                    id="simple-search"
                    name="search"
                    class="px-3 py-2.5 bg-white border border-gray-200 shadow-md rounded-base ps-3 text-heading text-sm focus:ring-brand focus:border-brand block w-full placeholder:text-body"
                    placeholder="Search article title..."
                    autofocus
                    autofill="off"
                />
            </div>
            <button
                type="submit"
                class="inline-flex items-center justify-center shrink-0 text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-10 h-10 focus:outline-none"
            >
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                    />
                </svg>
                <span class="sr-only">Icon description</span>
            </button>
        </form>

        {{-- Pagination --}}
        {{ $posts->links() }}

        <div class="mt-4 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article
                    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
                >
                    <div class="flex justify-between items-center mb-5 text-gray-500">
                        <span
                            class="{{ $post->category->color }} text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800"
                        >
                            <a href="/posts?category={{ $post->category->slug }}" class="hover:cursor-pointer">
                                {{ $post->category->name }}
                            </a>
                        </span>
                        <span class="text-sm">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="/posts/{{ $post->slug }}" class="hover:cursor-pointer">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="mb-3 font-light text-gray-500 dark:text-gray-400">
                        {{ Str::of($post->body)->stripTags()->limit(100) }}
                    </p>
                    <div class="mt-5 flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img
                                class="w-7 h-7 rounded-full"
                                src="{{ $post->author->avatar ? asset("storage/" . $post->author->avatar) : asset("img/default.jpg") }}"
                                alt="{{ $post->author->name }}"
                            />
                            <span class="text-sm font-medium dark:text-white">
                                <a
                                    href="/posts?author={{ $post->author->username }}"
                                    class="hover:cursor-pointer hover:underline"
                                >
                                    {{ $post->author->name }}
                                </a>
                            </span>
                        </div>
                        <a
                            href="/posts/{{ $post->slug }}"
                            class="inline-flex items-center font-medium text-sm text-primary-600 dark:text-primary-500 hover:underline"
                        >
                            Read more
                            <svg
                                class="ml-2 w-4 h-4"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="md:col-span-2 lg:col-span-3 mx-auto w-full flex flex-col gap-2 justify-center items-center">
                    <p class="font-semibold text-xl">Article not found!</p>
                    <a href="/posts" class="text-blue-500">&laquo; Back to all posts.</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
