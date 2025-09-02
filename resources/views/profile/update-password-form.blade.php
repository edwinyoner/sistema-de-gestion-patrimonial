<div>
    <x-form-section submit="updatePassword">
        <x-slot name="title">
            {{ __('Update Password') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>

        <x-slot name="form">
            <div>
                <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                <input id="current_password" type="password" class="form-control mt-1" wire:model="state.current_password" autocomplete="current-password" />
                <div class="text-danger mt-2" x-show="errors.current_password">
                    @error('current_password') {{ $message }} @enderror
                </div>
            </div>

            <div>
                <label for="password" class="form-label">{{ __('New Password') }}</label>
                <input id="password" type="password" class="form-control mt-1" wire:model="state.password" autocomplete="new-password" />
                <div class="text-danger mt-2" x-show="errors.password">
                    @error('password') {{ $message }} @enderror
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" class="form-control mt-1" wire:model="state.password_confirmation" autocomplete="new-password" />
                <div class="text-danger mt-2" x-show="errors.password_confirmation">
                    @error('password_confirmation') {{ $message }} @enderror
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="text-success me-3" x-show="saved">
                {{ __('Saved.') }}
            </div>

            <button class="btn btn-primary">
                {{ __('Save') }}
            </button>
        </x-slot>
    </x-form-section>
</div>