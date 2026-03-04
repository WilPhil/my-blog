@push("filePondStyle")
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
@endpush

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __("Profile Information") }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route("verification.send") }}">
        @csrf
    </form>

    <form method="post" action="{{ route("profile.update") }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method("patch")

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input
                id="username"
                name="username"
                type="text"
                class="mt-1 block w-full"
                :value="old('username', $user->username)"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __("Your email address is unverified.") }}

                        <button
                            form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            {{ __("Click here to re-send the verification email.") }}
                        </button>
                    </p>

                    @if (session("status") === "verification-link-sent")
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __("A new verification link has been sent to your email address.") }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Upload avatar --}}
        <div>
            <label class="block mb-2.5 text-sm font-medium text-heading" for="avatar">Upload avatar</label>
            <input
                {{--
    class="@error("avatar")
    bg-danger-soft border border-danger-subtle text-fg-danger-strong text-sm rounded-base focus:ring-danger focus:border-danger
    block
    w-full
    px-3
    shadow-xs
    placeholder:text-fg-danger-strong
    @else
    cursor-pointer
    bg-neutral-secondary-medium
    border
    border-default-medium
    text-gray-800
    text-sm
    rounded-base
    focus:ring-brand
    focus:border-brand
    block
    w-full
    shadow-xs
    placeholder:text-body
    @enderror"
--}}
                id="avatar"
                name="avatar"
                type="file"
                accept="image/jpeg, image/png, image/jpg"
            />
            @error("avatar")
                <p class="mt-2.5 text-sm text-fg-danger-strong">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <img
                class="size-32 rounded-base"
                src="{{ $user->avatar ? asset("storage/" . $user->avatar) : asset("img/default.jpg") }}"
                alt="{{ $user->name }}"
                id="avatar-preview"
            />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __("Save") }}</x-primary-button>

            @if (session("status") === "profile-updated")
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => (show = false), 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __("Saved.") }}
                </p>
            @endif
        </div>
    </form>
</section>

@push("filePondScript")
    <script>
        const input = document.getElementById('avatar');
        const previewPhoto = () => {
            const file = input.files;
            if (file) {
                const fileReader = new FileReader();
                const preview = document.getElementById('avatar-preview');
                fileReader.onload = function (event) {
                    preview.setAttribute('src', event.target.result);
                };
                fileReader.readAsDataURL(file[0]);
            }
        };
        input.addEventListener('change', previewPhoto);
    </script>

    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        // Register the plugin
        FilePond.registerPlugin(FilePondPluginImageTransform);
        FilePond.registerPlugin(FilePondPluginImageResize);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginFileValidateSize);

        // Get a reference to the file input element with avatar id
        const inputElement = document.querySelector('#avatar');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            // Image Type & Size Validation
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
            maxFileSize: '5MB',

            // Image resize & transform
            imageResizeTargetWidth: '600',
            imageResizeMode: 'contain',
            imageResizeUpscale: false,

            // Server endpoint
            server: {
                url: '/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            },
        });
    </script>
@endpush
