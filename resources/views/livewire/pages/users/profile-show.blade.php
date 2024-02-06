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
    <form
      x-data="{
        photoPreview: '{{ $user->profile_photo_url }}',
        updatePhotoPreview () {
          const photo = this.$refs.photoInput.files[0];
          if (! photo) return;

          const reader = new FileReader();

          reader.onload = (e) => {
            this.photoPreview =  e.target.result;
          };
          reader.readAsDataURL(photo);
        }
      }"
      wire:submit="save"
    >
      <div class="grid md:grid-cols-3 gap-2">
        <div class="md:col-span-3">
          <div class="w-[150px] h-[150px] relative overflow-hidden rounded">
            <img
              class="block w-full h-full object-cover"
              :src="photoPreview"
              alt=""
            >
            <input
              type="file"
              name="profile_image"
              id="profile_image"
              class="hidden"
              @change="updatePhotoPreview()"
              wire:model="profileImage"
              x-ref="photoInput"
            >
            <label for="profile_image"
                   class="bg-violet-700 hover:bg-violet-800 focus:bg-violet-800 text-white text-center text-xs absolute bottom-0 left-0 w-full cursor-pointer py-2">
              Change Profile Image
            </label>
          </div>
        </div>
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
        <div class="md:col-span-3">
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
