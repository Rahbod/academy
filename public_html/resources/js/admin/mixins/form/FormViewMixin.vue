<script>
    import {mapActions, mapMutations} from 'vuex'

    export default {
        methods: {
            ...mapMutations('filterable_table', ['resetState']),
            ... mapMutations('form', ['setEl','setLoading','setAction', 'resetForm','setInfo']),
            ...mapActions('form', ['getFormData']),
            getResource(route) {
                let routes = route.matched;
                let resource = null;
                routes.forEach(route => {
                    if (route.meta.resource !== undefined) {
                        resource = route.meta.resource;
                    }
                });
                return resource;
            },
            initView(){
                this.setEl(this.$el);
                this.setAction(this.$route.meta.action);
                this.resetForm();
                this.getFormData(this.$route.params.id);
            }
        },
        watch: {
            '$route'(to, from) {
                this.initView();
            }
        },
        created(){
            this.resetForm();
        },
        mounted(){
            this.initView();
        },
//        beforeRouteEnter(to, from, next) {
//            next(vm => {
//                vm.initView();
//            });
//        },
        beforeRouteLeave (to, from, next) {
            this.setLoading(true);
            if (this.getResource(to) !== this.getResource(from)) {
                this.resetState();
                this.setInfo({});
            }
            next();
        }

    }
</script>