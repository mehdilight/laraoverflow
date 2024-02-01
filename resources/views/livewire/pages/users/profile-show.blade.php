<x-blocks.users.user-dashboard
  :user="$user"
  currentTab="profile"
>
  <main>
    <header class="mb-3">
      <h2 class="text-lg font-semibold">
        Profile
      </h2>
      <p class="text-sm text-gray-700">
        Update your profile and personal details here
      </p>
    </header>
    <form wire:submit="save">
      <div class="grid grid-cols-3 gap-2">
        <div>
          <label for="full_name" class="label">Full name</label>
          <input type="text" class="input" name="full_name" id="full_name" wire:model="name">
        </div>
        <div>
          <label for="username" class="label">Username</label>
          <input type="text" class="input" name="username" id="username" wire:model="username">
        </div>
        <div>
          <label for="job_title" class="label">Job title</label>
          <input type="text" class="input" name="job_title" id="job_title" wire:model="job_title">
        </div>
        <div>
          <label for="location" class="label">Location</label>
          <input type="text" class="input" name="email" id="location" wire:model="location">
        </div>
        <div>
          <label for="interests" class="label">Interests</label>
          <input type="text" class="input" name="interests" id="interests">
        </div>
        <div>
          <label for="website" class="label">Your website</label>
          <input type="text" class="input" name="website" id="website" wire:model="website_url">
        </div>
        <div class="col-span-3">
          <label for="bio" class="label">About me</label>
          <textarea name="bio" id="bio" class="input resize-none" wire:model="bio"></textarea>
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
