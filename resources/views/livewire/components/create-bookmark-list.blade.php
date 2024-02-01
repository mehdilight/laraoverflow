<div>
  <div x-data x-init="$refs.name.focus()" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center">
    <form
      class="relative p-4 w-full max-w-md max-h-full"
      wire:submit="store"
      @click.outside="$wire.closeModal"
      @keydown.esc.window="$wire.closeModal"
    >
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow">
        <!-- Modal header -->
        <header class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
          <h3 class="text-xl font-semibold text-gray-900">
            New List
          </h3>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" wire:click="closeModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </header>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <label for="list_name" class="label">
            Name
          </label>
          <input type="text" class="input" id="list_name" wire:model="name" x-ref="name">
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b space-x-4">
          <button type="submit" class="btn btn-primary">
            Create
          </button>
          <button wire:click="closeModal" type="button" class="btn btn-primary-outlined">
            Cancel
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40 backdrop-blur-md" wire:click="closeModal"></div>
</div>
