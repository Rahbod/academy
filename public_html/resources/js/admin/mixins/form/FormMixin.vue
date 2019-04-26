<script>
    import {mapGetters,mapActions,mapMutations} from 'vuex';

    export default {
        computed: {
            ... mapGetters('form', ['loading' ,'info', 'action', 'model', 'updating','options']),
            ... mapGetters(['resource','main_url','route_name']),
        },
        methods: {
            ...mapMutations('form', ['setEl', 'resetForm','setErrors']),
            ...mapActions('form', ['sendFormRequest','getFormData']),
            ...mapActions(['collapseCard', 'fullScreen', 'sendRequest']),
            refreshInputData() {
                this.resetForm();
                this.getFormData(this.$route.params.id);
            },
            cancelAction() {
                if (this.hasAction('listView')) {
                    this.$router.push({name: this.route_name + '-list-view'});
                } else {
                    this.$router.push('/');
                }
            },
            submitForm($event) {
                this.sendFormRequest($event)
                    .then((response) => {
                        if (this.hasAction('listView')) {
                            this.$router.push({name: this.route_name + '-list-view'});
                        }
                    })
                    .catch((error) => {

                    })
            },
        },
        mounted() {
            this.setEl(this.$el);
        }

    }
</script>