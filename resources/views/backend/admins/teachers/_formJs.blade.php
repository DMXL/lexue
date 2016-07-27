<script type="text/javascript">
    $(function() {
        $("#teacher-labels").selectize({
            create: true
        });
    });

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
</script>