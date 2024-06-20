<nav x-data="{ open: false }" class=" border-b  fixed mx-auto w-full z-50 bg-cyan-700 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/laptop-logo-png-1.png') }}" alt="laptop-icon" class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('HOME') }}
                    </x-nav-link>
                    @if (Auth::check() && Auth::user()->user_type =='admin')
                        <x-nav-link :href="route('admin_laptop.index')" :active="request()->routeIs('admin_laptop.index')">
                            {{ __('LAPTOP') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin_user.index')" :active="request()->routeIs('admin_user.index')">
                            {{ __('USER') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin_order.index')" :active="request()->routeIs('admin_order.index')">
                            {{ __('ORDER') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('laptops.index')" :active="request()->routeIs('laptops.index')">
                            {{ __('LAPTOP') }}
                        </x-nav-link>
                        <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                            {{ __('CONTACT') }}
                        </x-nav-link>
                        <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                            {{ __('ABOUT') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
          
                <form method="GET" action="{{ Auth::check() && Auth::user()->user_type =='admin' ? route('admin_laptop.search') : route('laptop.search') }}" class="flex p-2  w-96   ">
                    <input type="text" name="keyword" class="w-full px-4 py-3 rounded-l-full border border-gray-300 focus:outline-none focus:border-cyan-500" placeholder="Search..." required>

                    <button type="submit" class="px-4 py-3 bg-white text-cyan-700 rounded-r-full  focus:outline-none">
                        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                    </button>
                </form>
            
            
            <!-- Settings Dropdown -->
            <div class="sm:hidden flex items-center ms-6"> 
                @if (Auth::check() && Auth::user()->user_type == 'user')
                <a href="{{ route('cart.index') }}" class="relative inline-block p-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart h-6 w-6 text-gray-500">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h8.63a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    @if(Auth::user()->cartItems->count() > 0)
                    <span class="absolute top-0 right-0 rounded-full bg-cyan-400  hover:bg-cyan-600 text-white px-2 text-md font-bold font-weight-bold">{{ Auth::user()->cartItems->count() }}</span>
                    @endif
                </a>
                @endif 
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="">   
                    @if (Auth::check() && Auth::user()->user_type == 'user')
                    <a href="{{ route('cart.index') }}" class="relative inline-block p-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart h-6 w-6 text-white">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h8.63a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        @if(Auth::user()->cartItems->count() > 0)
                        <span class="absolute top-0 right-0 rounded-full bg-cyan-400  hover:bg-cyan-600 text-white px-2 text-md font-bold font-weight-bold">{{ Auth::user()->cartItems->count() }}</span>
                        @endif
                    </a>
                    @endif
                </div>
                @if (Auth::check())
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{  Auth::user()->name }}</div>
                            
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::check())
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                                {{ __('Order') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endif
                    </x-slot>
                </x-dropdown>
                @else
                <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block color-cyan-400 hover:color-cyan-600" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart h-6 w-6 text-white">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h8.63a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                  </button>
                  
                  <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                      <div class="relative p-4 w-full max-w-2xl max-h-full">
                        
                          <div class="relative bg-white rounded-lg shadow p-3">
                            <div class="flex">
                                <h3 class="text-xl font-semibold text-gray-900 ">
                                    Hello, please login !
                                 </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                           
                             <hr/>
                              <div class="flex items-center justify-between my-3 rounded-t ">
                                  <a href={{ route('login') }} class= "px-5 py-2 text-white bg-cyan-400 hover:bg-cyan-600 rounded-lg text-center text-sm w-full mx-1">
                                    LOGIN
                                  </a>
                                  <a href={{ route('register') }} class= "px-5 py-2 text-cyan-400 bg-white border border-1 border-cyan-400 hover:border-cyan-600 rounded-lg text-center text-sm w-full mx-1">
                                    REGISTER
                                  </a>
                              </div>
                              <hr/>
                             
                          </div>
                      </div>
                  </div>
                @endif
               
            </div>
            
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('HOME') }}
            </x-responsive-nav-link>
            @if (Auth::check() && Auth::user()->user_type =='admin')
                <x-responsive-nav-link :href="route('admin_laptop.index')" :active="request()->routeIs('admin_laptop.index')">
                    {{ __('LAPTOP') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin_user.index')" :active="request()->routeIs('admin_user.index')">
                    {{ __('USER') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin_order.index')" :active="request()->routeIs('admin_order.index')">
                    {{ __('ORDER') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('laptops.index')" :active="request()->routeIs('laptops.index')">
                    {{ __('LAPTOP') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                    {{ __('CONTACT') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                    {{ __('ABOUT') }}
                </x-responsive-nav-link>
            @endif
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::check() ? Auth::user()->name : '' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::check() ? Auth::user()->email : '' }}</div>
            </div>
            <div class="mt-3 space-y-1">
                @if (Auth::check())
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                        {{ __('ORDER') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        </div>
    </div>
    
</nav>

