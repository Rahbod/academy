<template>
    <div class="dataTables_paginate paging_simple_numbers" v-if="conf.last_page>1">
        <a class="paginate_button previous" id="DataTables_Table_0_previous" :class="{disabled:is_first}"
           @click.prevent=" get_prev_page()">→</a>
        <span>
             <a class="paginate_button" v-show="start>1" @click.prevent="getPage(1)">1</a>
            <a class="paginate_button disabled" v-show="start>1"> ... </a>
            <a class="paginate_button " v-for="item in loop_items" :class="{current:is_current(item)}"
               @click.prevent="getPage(item)">{{item}}</a>
             <a class="paginate_button disabled" v-show="end<conf.last_page-1"> ... </a>
            <a class="paginate_button" v-show="end<conf.last_page" @click.prevent="getPage(conf.last_page)"> {{conf.last_page}} </a>
        </span>
        <a class="paginate_button next" :class="{disabled:is_last}" @click.prevent="get_next_page()">←</a>
    </div>
</template>

<script>
    import {mapGetters,mapMutations,mapActions} from 'vuex'

    export default {
        computed: {
                ...mapGetters('filterable_table',['collection','query']),
                conf() {
                    return this.collection.pagination;
                },
                is_first() {
                    if (this.conf.current_page == 1) {
                        return true;
                    }
                    else {
                        return false;
                    }
                },
                is_last() {
                    if (this.conf.current_page == this.conf.last_page) {
                        return true;
                    }
                    else {
                        return false;
                    }
                },
                start() {
                    if ((this.conf.current_page - this.query.links_count) > 0) {
                        return this.conf.current_page - this.query.links_count;
                    }
                    else {
                        return 1;
                    }
                },
                end() {
                    var current = parseInt(this.query.page);
                    var link_count = parseInt(this.query.links_count);
                    var last_page = parseInt(this.conf.last_page);
                    if ((current + link_count) < last_page) {
                        return current + link_count;
                    }
                    else {
                        return last_page;
                    }
                },
                loop_items() {
                    var l = [];
                    for (var i = this.start; i <= this.end; i++) {
                        l.push(i);
                    }
                    return l;
                }
            },
        methods: {
            ...mapMutations('filterable_table',['setQuery']),
            ...mapActions('filterable_table',['fetch']),
            is_current(item) {
                if (this.query.page == item) {
                    return true;
                }
                else {
                    return false;
                }
            },
            getPage(page) {
                if (!this.is_current(page)) {
                    let query=this.query;
                    query.page=page;
                    this.setQuery(query);
                    this.fetch();
                }
            },
            get_next_page() {
                if (this.conf.next_page_url) {
                    this.getPage(parseInt(this.query.page) + 1)
                }
            },
            get_prev_page() {
                if (this.conf.prev_page_url) {
                    this.getPage(parseInt(this.query.page) - 1)
                }
            },

        },
        mounted() {

        }
    }
</script>