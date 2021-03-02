 // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('d8303a00155017e1a802', {
          cluster: 'eu'
        });