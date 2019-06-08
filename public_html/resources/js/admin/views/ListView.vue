<template>
    <div>
        <data_viewer></data_viewer>

        <content_view></content_view>
    </div>

</template>

<script>
    import data_viewer from '../view_components/data_viewer/DataViewer.vue';
    import content_view from '../views/ShowView.vue';


    import {mapMutations, mapActions, mapGetters} from 'vuex';

    export default {
        components: {data_viewer, content_view},
        computed: {
            ...mapGetters('filterable_table', ['filterCandidates']),
            ...mapGetters(['main_url']),
            list_view_route() {
                let route='list-view';
                let action=this.getRouteAction();
                switch (action) {
                    case 'listView':
                        route='list-view';
                        break;
                    case 'unverifiedRequests':
                        route='unverified_requests';
                        break;
                    case 'myClassrooms':
                        route='my_classrooms';
                        break;
                    case 'rejectedRequests':
                        route='rejected_requests';
                        break;
                    case 'awaitingPaymentRequests':
                        route='awaiting_payment_requests';
                        break;
                    case 'paidRequests':
                        route='paid_requests';
                        break;
                    case 'translatedRequests':
                        route='translated_requests';
                        break;
                    default:
                        route='list-view';
                        break;
                }
                return this.main_url + '/'+route
            }
        },
        methods: {
            ...mapMutations('form', ['setInfo']),
            ...mapMutations('filterable_table', ['setEl', 'addFilter', 'resetState','setListViewUrl']),
            ...mapActions('filterable_table', ['fetch']),

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
            getRouteAction() {
                let routes = this.$route.matched;
                let action = null;
                routes.forEach(route => {
                    if (route.meta.action !== undefined) {
                        action = route.meta.action;
                    }
                });
                return action;
            },
            initView() {
                this.setListViewUrl(this.list_view_route);
                this.fetch();
                if (this.filterCandidates.length === 0) {
                    this.addFilter();
                }
            }
        },
        watch: {
            '$route'(to, from) {
                this.initView();
            }
        },
        mounted() {
            this.setEl(this.$el);
            this.initView();
        },
        beforeRouteLeave(to, from, next) {
            if (this.getResource(to) !== this.getResource(from)) {
                this.resetState();
                this.setInfo({});
            }
            next();
        },
    }
</script>

<style>

</style>