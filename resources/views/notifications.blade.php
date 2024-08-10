<x-app-layout>
    @php

        $notifications = auth()->user()->unreadNotifications;
    @endphp
    <ul>
        @foreach (auth()->user()->unreadNotifications as $notification)
            <li>
                <a href="{{ $notification->data['url'] }}">
                    {{ $notification->data['message'] }} - {{ $notification->created_at->diffForHumans() }}
                </a>
            </li>
        @endforeach
    </ul>

</x-app-layout>
