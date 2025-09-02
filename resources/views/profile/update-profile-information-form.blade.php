<div>
    <x-form-section submit="updateProfileInformation">
        <x-slot name="title">
            {{ __('Profile Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
        </x-slot>

        <x-slot name="form">
            <div class="row">
                <div class="col-md-6">
                    <!-- Profile Photo -->
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div x-data="{photoName: null, photoPreview: null}">
                            <label for="photo" class="form-label">{{ __('Photo') }}</label>
                            <br>
                            <!-- Profile Photo File Input -->
                            <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo" x-on:change="
                                                   photoName = $refs.photo.files[0].name;
                                                   const reader = new FileReader();
                                                   reader.onload = (e) => {
                                                       photoPreview = e.target.result;
                                                   };
                                                   reader.readAsDataURL($refs.photo.files[0]);
                                               " />

                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="! photoPreview">
                                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                    class="rounded-circle" style="height: 100px; width: 100px; object-fit: cover;">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="photoPreview" style="display: none;">
                                <span class="rounded-circle d-inline-block"
                                    style="width: 100px; height: 100px; background-size: cover; background-repeat: no-repeat; background-position: center;"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
                            </div>

                            <x-adminlte-button type="button" label="{{ __('Select A New Photo') }}" theme="primary"
                                icon="fas fa-upload" class="mt-2 me-2" x-on:click.prevent="$refs.photo.click()" />

                            @if ($this->user->profile_photo_path)
                                <button type="button" class="btn btn-danger mt-2" wire:click="deleteProfilePhoto">
                                    {{ __('Remove Photo') }}
                                </button>
                            @endif

                            <div class="text-danger mt-2" x-show="$wire.errors.photo">
                                @error('photo') {{ $message }} @enderror
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control mt-1" wire:model="state.name" required
                            autocomplete="name" />
                        <div class="text-danger mt-2" x-show="$wire.errors.name"> <!-- Cambiado a $wire.errors.name -->
                            @error('name') {{ $message }} @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control mt-1" wire:model="state.email" required
                            autocomplete="username" />
                        <div class="text-danger mt-2" x-show="$wire.errors.email">
                            @error('email') {{ $message }} @enderror
                        </div>

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !$this->user->hasVerifiedEmail())
                            <p class="text-sm mt-2 text-dark">
                                {{ __('Your email address is unverified.') }}

                                <button type="button" class="link text-dark hover:text-primary btn-warning"
                                    wire:click.prevent="sendEmailVerification">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if ($this->verificationLinkSent)
                                <p class="mt-2 text-sm text-success">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="d-flex justify-content-center">
                <button wire:loading.attr="disabled" wire:target="photo" class="btn btn-success">
                    {{ __('Save') }}
                </button>
            </div>
        </x-slot>
    </x-form-section>
</div>