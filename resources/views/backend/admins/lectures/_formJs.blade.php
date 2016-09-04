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
 * Filename->_formJs.blade.php
 * Project->lexue
 * Description->script needed before submitting the form
 *
 * Created by DM on 16/9/4 下午1:15.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
-->
<script type="text/javascript">
    $(function() {
        $('#datetime-picker').datetimepicker();
    });

    /*
    new Vue({
        el: '#teacher-form',
        data: {
            teachingSince: ''
        },
        computed: {
            yearsOfTeaching() {
                var teachingSince = this.teachingSince;

                if (! teachingSince || ! teachingSince.match(/\d{4}/)) {
                    return '输入年份';
                }

                return (moment().year() - teachingSince) + '年';
            }
        },
        methods: {
            moment() {
                return moment();
            }
        }
    })
    */
</script>