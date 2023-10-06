<div class="side-bar">
        <ul>
            <li>
                <a href="{{ route('user.dashboard') }}">Profile</a>
            </li>
            <li>
                <a href="{{ route('user.listings') }}">My Listings

                </a>
            </li>
            <li>
                <a href="{{ route('user.settings') }}">Settings</a>
            </li>
        </ul>
</div>

<form class="d-none" method="POST" id="logout" action="{{ route('logout') }}">
 @csrf
</form>
