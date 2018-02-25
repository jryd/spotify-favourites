<nav class="flex items-center justify-between flex-wrap bg-neon-green px-6" id="nav">
    <div class="flex items-center flex-no-shrink text-white mr-6">
        <span class="font-semibold text-xl tracking-tight">Spotify Favourites</span>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="/favourites" :class="active == '/favourites' ? 'border-b-2 border-neon-green-lightest text-neon-green-lightest' : 'text-neon-green-lighter'" class="block mt-4 lg:inline-block lg:mt-0 hover:text-neon-green-lightest mr-4 no-underline py-6">
                Favourites
            </a>

            <a href="#responsive-header" :class="active == '/recommendations' ? 'border-b-2 border-neon-green-lightest text-neon-green-lightest' : 'text-neon-green-lighter'" class="block mt-4 lg:inline-block lg:mt-0 hover:text-neon-green-lightest mr-4 no-underline py-6">
                Recommendations
            </a>

            <a href="#responsive-header" :class="active == '/dashboard' ? 'border-b-2 border-neon-green-lightest text-neon-green-lightest' : 'text-neon-green-lighter'" class="block mt-4 lg:inline-block lg:mt-0 hover:text-neon-green-lightest no-underline py-6">
                Dashboard
            </a>
        </div>
    </div>
</nav>