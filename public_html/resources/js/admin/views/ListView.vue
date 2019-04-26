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
        components: {data_viewer,content_view},
        computed: {
            ...mapGetters('filterable_table', ['filterCandidates']),
        },
        methods: {
            ... mapMutations('form', ['setInfo']),
            ...mapMutations('filterable_table', ['setEl', 'addFilter', 'resetState']),
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
            initView() {
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