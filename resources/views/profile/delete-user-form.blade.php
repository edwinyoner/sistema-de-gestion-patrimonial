<div>
    <x-action-section>
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Permanently delete your account.') }}
        </x-slot>

        <x-slot name="content">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </div>

            <div class="mt-5">
                <button wire:click="confirmUserDeletion" wire:loading.attr="disabled" class="btn btn-danger">
                    {{ __('Delete Account') }}
                </button>
            </div>

            <!-- Delete User Confirmation Modal -->
            <x-dialog-modal wire:model.live="confirmingUserDeletion">
                <x-slot name="title">
                    {{ __('Delete Account') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                    <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                        <input type="password" class="form-control"
                               autocomplete="current-password"
                               placeholder="{{ __('Password') }}"
                               x-ref="password"
                               wire:model="password"
                               wire:keydown.enter="deleteUser" />

                        <div class="text-danger mt-2" x-show="errors.password">
                            @error('password') {{ $message }} @enderror
                        </div>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled" class="btn btn-secondary">
                        {{ __('Cancel') }}
                    </button>

                    <button wire:click="deleteUser" wire:loading.attr="disabled" class="btn btn-danger ms-3">
                        {{ __('Delete Account') }}
                    </button>
                </x-slot>
            </x-dialog-modal>
        </x-slot>
    </x-action-section>
</div>