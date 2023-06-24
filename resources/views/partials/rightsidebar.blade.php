<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Configuracion de usuario;</h5>

        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="shrink-0 mr-3">
                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
            </div>
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-20 w-20 object-cover">

        @endif

        <ul class="text-right mr-5 list-unstyled" style="left: 0px; right: inherit;">
            <li class="my-0 ">
                <a href="{{ route('profile.show') }}" class="">Mi perfil</a>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>

        </ul>
    </div>
</aside>
