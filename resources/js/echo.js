import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: '127.0.0.1',
    wsPort: 9000,
    wssPort: 9000,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
});
