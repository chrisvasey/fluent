<div>
<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <div class="w-full">
      <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Fluent Editor</h3>
        <div class="mt-4">
            <div class="mb-2">
                <label for="default" class="block text-sm font-medium text-gray-700">Default</label>
                <div class="mt-1">
                  <input type="text" name="default" id="default" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">
                </div>
            </div>
            <div class="mb-2">
                <label for="en" class="block text-sm font-medium text-gray-700">English</label>
                <div class="mt-1">
                  <input type="text" name="en" id="en" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">
                </div>
            </div>
            <div class="mb-2">
                <label for="fr" class="block text-sm font-medium text-gray-700">French</label>
                <div class="mt-1">
                  <input type="text" name="fr" id="fr" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">
                </div>
            </div>
            <div class="mb-2">
                <label for="gr" class="block text-sm font-medium text-gray-700">German</label>
                <div class="mt-1">
                  <input type="text" name="gr" id="gr" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>
  <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
    <button wire:click="$emit('closeModal')" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
    <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
</div>
</div>
