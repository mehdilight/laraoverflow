<div
  x-data="{
   isFocus: false, isOpen: false, tags: [], searchTerm: '', selectedTags: [], selectedOptionIndex: 1,
   async fetchResults() {
    const response = await $fetch(`{{ route('tags.index') }}?q=${this.searchTerm}`);
    this.tags = response.json;
    this.selectedOptionIndex = 1;
   },
   close() {
    this.isOpen = false;
   },
   open() {
    this.isOpen = !this.isOpen;
   },
   select(tag) {
    this.$refs.searchInput.focus();
    this.searchTerm = '';

    if (!this.tagAlreadySelected(tag)) {
      this.selectedTags.push(tag);
    };
   },
   tagAlreadySelected(tag) {
    return this.selectedTags.find(selectedTag => tag.id === selectedTag.id)
   },
   selectByCurrentIndex() {
    let tag = this.tags.find((tag, index) => index === this.selectedOptionIndex - 1);
    if (!tag) return;

    if (this.tagAlreadySelected(tag)) return;

    this.select(tag);
   }
  }"
  class="relative"
  @click.outside="close"
>
  <template x-for="selectedTag in selectedTags">
    <input type="hidden" name="tags[]" :value="selectedTag.id">
  </template>
  <div
    class="bg-white px-3 h-[38px] text-sm border overflow-hidden border-solid border-gray-300 rounded focus:outline-none w-full flex flex-wrap items-center gap-2"
    :class="{'ring ring-violet-200 border-gray-300': isFocus }"
  >
    <template x-for="selectedTag in selectedTags">
      <div x-text="selectedTag.option" class="text-xs bg-violet-100 text-violet-900 px-2 text-white rounded">
      </div>
    </template>
    <input
      class="p-0 flex-grow border-transparent focus:ring-0 focus:border-transparent text-sm focus:outline-none focus:border-none"
      type="text"
      id="tags"
      x-ref="searchInput"
      @input.debounce.500ms="fetchResults"
      x-model="searchTerm"
      @focus.prevent.stop="isOpen= true ; isFocus = true"
      @blur="isFocus = false"
      autocomplete="off"
      @keyup.down="if(selectedOptionIndex + 1 > 3) {return} selectedOptionIndex = selectedOptionIndex + 1"
      @keyup.up="if(selectedOptionIndex - 1 === 0) {return} selectedOptionIndex = selectedOptionIndex - 1"
      @keyup.left.prevent.stop="if(selectedOptionIndex + 1 > 3) {return} selectedOptionIndex = selectedOptionIndex + 1"
      @keyup.right.prevent.stop="if(selectedOptionIndex - 1 === 0) {return} selectedOptionIndex = selectedOptionIndex - 1"
      @keydown.enter.prevent="selectByCurrentIndex"
    >
  </div>
  <div
    x-show="isOpen"
    role="listbox"
    class="z-90 absolute w-full bg-white top-[39px] border border-solid border-gray-200 rounded"
    style="display: none"
  >
    <template x-for="(tag, index) in tags">
      <div
        role="option"
        class="text-sm px-3 py-3 cursor-pointer"
        :class="{
          'bg-violet-100': selectedOptionIndex === index + 1
        }"
        tabindex="0"
        x-text="tag.option"
        @click="select(tag)"
      >
      </div>
    </template>
    <div
      x-show="tags.length === 0"
      class="text-sm text-gray-500 px-3 py-3"
      tabindex="0"
    >
      No choice to choose from.
    </div>
  </div>
</div>

