<x-blocks.users.user-dashboard
  :user="$user"
  currentTab="password"
>
  <main>
    <header class="mb-3">
      <h2 class="text-lg font-semibold">
        Profile
      </h2>
      <p class="text-sm text-gray-700">
        Update your password here
      </p>
    </header>
    <form wire:submit="updatePassword">
      <div class="space-y-2 max-w-md">
        <div>
          <label for="current_password" class="label">Current password</label>
          <input type="password" class="input" name="current_password" id="current_password" wire:model="current_password">
        </div>
        <div>
          <label for="new_password" class="label">New password</label>
          <input type="password" class="input" name="new_password" id="new_password" wire:model="new_password">
        </div>
        <div>
          <label for="new_password_confirmation" class="label">Confirm new password</label>
          <input type="password" class="input" name="new_password_confirmation" id="new_password_confirmation" wire:model="new_password_confirmation">
        </div>
      </div>
      <div class="mt-4 flex justify-end space-x-3">
        <button class="btn btn-primary" type="submit">
          Save changes
        </button>
        <a class="btn btn-primary-outlined" href="{{route('questions.index')}}">
          Cancel
        </a>
      </div>
    </form>
  </main>
</x-blocks.users.user-dashboard>

