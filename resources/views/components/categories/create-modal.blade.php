@push("styles")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css" />
@endpush

<div
    id="createCategoryModal"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full bg-gray-100/50 shadow-xl"
>
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Category</h3>
                <button
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="createCategoryModal"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route("category.store") }}" method="POST">
                @csrf
                <div class="flex mb-4 justify-between">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            class="@error("name")
                                bg-danger-soft
                                border
                                border-danger-subtle
                                text-fg-danger-strong
                                text-sm
                                rounded-md
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
                                rounded-md
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
                            placeholder="Type category name"
                            value="{{ old("name") }}"
                        />
                        @error("name")
                            <p class="mt-2.5 text-sm text-fg-danger-strong">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Color
                        </label>
                        <input
                            type="text"
                            name="color"
                            id="color"
                            class="@error("color")
                                bg-danger-soft
                                border
                                border-danger-subtle
                                text-fg-danger-strong
                                text-sm
                                rounded-md
                                focus:ring-danger
                                focus:border-danger
                                block
                                w-full
                                px-3
                                py-2.5
                                shadow-xs
                                placeholder:text-fg-danger-strong
                            @else
                                bg-gray-50
                                border
                                border-gray-300
                                text-gray-900
                                text-sm
                                rounded-md
                                block
                                w-full
                                p-2.5
                                dark:bg-gray-700
                                dark:border-gray-600
                                dark:placeholder-gray-400
                                dark:text-white
                            @enderror"
                            placeholder="Pick a color (HEX)"
                            value="{{ old("color") }}"
                            data-coloris
                        />
                        @error("color")
                            <p class="mt-2.5 text-sm text-fg-danger-strong">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <button
                    type="submit"
                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                >
                    <svg
                        class="mr-1 -ml-1 w-6 h-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    Add category
                </button>
            </form>
        </div>
    </div>
</div>

@push("scripts")
    <script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                const modalElement = document.getElementById('createCategoryModal');

                const modal = new Modal(modalElement);
                modal.show();
            @endif
        });
    </script>
@endpush
