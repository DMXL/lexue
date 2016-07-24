<!--
 *
 *
 *   ______                        _____           __
 *  /_  __/__  ____ _____ ___     / ___/__  ______/ /___
 *   / / / _ \/ __ `/ __ `__ \    \__ \/ / / / __  / __ \
 *  / / /  __/ /_/ / / / / / /   ___/ / /_/ / /_/ / /_/ /
 * /_/  \___/\__,_/_/ /_/ /_/   /____/\__,_/\__,_/\____/
 *
 *
 *
 * Filename->alert.blade.php
 * Project->lexue
 * Description->This is the alert snippet.
 *
 * Created by DM on 16/7/23 上午10:11.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
@if (session()->has('flash_notification.message'))
    <script>
        var flashMsg = {!! json_encode(session('flash_notification')) !!};
        var flashType = flashMsg.level;

        switch(flashType) {
            case 'info':
                flashType = 'success';
                break;
            case 'danger':
                flashType = 'error';
                break;
        }

        $.toptip(flashMsg.message, flashType);
    </script>
@endif