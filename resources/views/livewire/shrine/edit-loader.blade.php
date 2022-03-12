<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed inset-0 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="absolute inset-0 overflow-hidden">
        <!-- Background overlay, show/hide based on slide-over state. -->
        <div class="absolute inset-0" aria-hidden="true"></div>

        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
            <!--
          Slide-over panel, show/hide based on slide-over state.

          Entering: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-full"
            To: "translate-x-0"
          Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-0"
            To: "translate-x-full"
        -->
            <div class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Team</h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button"
                                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close panel</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-200">
                        <div class="px-6">
                            <nav class="-mb-px flex space-x-6">
                                <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                <a href="#"
                                    class="border-indigo-500 text-indigo-600 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">All</a>

                                <a href="#"
                                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">Online</a>

                                <a href="#"
                                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">Offline</a>
                            </nav>
                        </div>
                    </div>
                    <ul role="list" class="flex-1 divide-y divide-gray-200 overflow-y-auto">
                        <li>
                            <div class="group relative flex items-center py-6 px-5">
                                <a href="#" class="-m-1 block flex-1 p-1">
                                    <div class="absolute inset-0 group-hover:bg-gray-50" aria-hidden="true"></div>
                                    <div class="relative flex min-w-0 flex-1 items-center">
                                        <span class="relative inline-block flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                alt="">
                                            <!-- Online: "bg-green-400", Offline: "bg-gray-300" -->
                                            <span
                                                class="bg-green-400 absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white"
                                                aria-hidden="true"></span>
                                        </span>
                                        <div class="ml-4 truncate">
                                            <p class="truncate text-sm font-medium text-gray-900">Leslie Alexander</p>
                                            <p class="truncate text-sm text-gray-500">@lesliealexander</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="relative ml-2 inline-block flex-shrink-0 text-left">
                                    <button type="button"
                                        class="group relative inline-flex h-8 w-8 items-center justify-center rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open options menu</span>
                                        <span class="flex h-full w-full items-center justify-center rounded-full">
                                            <!-- Heroicon name: solid/dots-vertical -->
                                            <svg class="h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </span>
                                    </button>

                                    <!--
                      Dropdown panel, show/hide based on dropdown state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                                    <div class="absolute top-0 right-9 z-10 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                                        tabindex="-1">
                                        <div class="py-1" role="none">
                                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                                tabindex="-1" id="options-menu-0-item-0">View profile</a>
                                            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                                tabindex="-1" id="options-menu-0-item-1">Send message</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- More people... -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
