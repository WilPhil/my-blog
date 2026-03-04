<x-layout :title="$title">
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article
                class="mx-auto w-full max-w-5xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert"
            >
                <a href="/posts" class="text-sm no-underline hover:underline">&laquo; Back to all posts.</a>
                <header class="my-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img
                                class="mr-4 w-16 h-16 rounded-full"
                                src="{{ $post->author->avatar ? asset("storage/" . $post->author->avatar) : asset("img/default.jpg") }}"
                                alt="{{ $post->author->name }}"
                            />
                            <div>
                                <a
                                    href="/posts?author={{ $post->author->username }}"
                                    rel="author"
                                    class="block text-xl font-bold text-gray-900 dark:text-white"
                                >
                                    {{ $post->author->name }}
                                </a>
                                <span
                                    class="block shrink-0 {{ $post->category->color }} text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 my-1 rounded dark:bg-primary-200 dark:text-primary-800"
                                >
                                    <a href="/posts?category={{ $post->category->slug }}" class="hover:cursor-pointer">
                                        {{ $post->category->name }}
                                    </a>
                                </span>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white"
                    >
                        {{ $post->title }}
                    </h1>
                </header>
                <p>
                    {{ $post->body }}
                </p>
            </article>
        </div>
    </main>
</x-layout>
