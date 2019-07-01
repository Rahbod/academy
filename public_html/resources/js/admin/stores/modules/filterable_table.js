import axios from 'axios';
import i18next from 'i18next';


export const filterable_table = {
    namespaced: true,
    state: {
        el: null,
        list_view_url:'',
        table_actions:{
            edit:{
                active_class:"icon-pencil7 text-primary-600",
                inactive_class:"icon-pencil7 text-slate-400",
            },
            destroy:{
                active_class:"text-danger-600 icon-trash",
                inactive_class:"text-slate-600 icon-trash",
            },
            show:{
                active_class:"text-teal-600 icon-file-eye",
                inactive_class:"text-slate-400 icon-file-eye",
            },
            active:{
                active_class:"text-info-600 icon-checkmark-circle2",
                inactive_class:"text-slate-400 icon-checkmark-circle2",
            },
            print:{
                active_class:"text-violet-600 icon-printer2",
                inactive_class:"text-slate-400 icon-printer2",
            },
            receipt:{
                active_class:"text-pink-600 icon-mail-read",
                inactive_class:"text-slate-400 icon-mail-read",
            },
        },
        fields: [],
        loading: true,
        updating: true,
        updating_filter_candidate_id: null,
        show_filters: false,
        appliedFilters: [],
        filterCandidates: [],
        selectIDs: [],
        query: {
            order_column: 'id',
            order_direction: 'desc',
            filter_match: 'and',
            links_count: 5,
            limit: 25,
            page: 1
        },
        collection: {
            data: [],
            pagination: {}
        },
        availableOperators: [
            {name: 'equal_to', parent: ['numeric', 'string', 'date', 'select'], component: 'single'},
            {name: 'not_equal_to', parent: ['numeric', 'string', 'date', 'select'], component: 'single'},

            {name: 'less_than', parent: ['numeric', 'date'], component: 'single'},
            {name: 'greater_than', parent: ['numeric', 'date'], component: 'single'},

            {name: 'between', parent: ['numeric', 'date'], component: 'double'},
            {name: 'not_between', parent: ['numeric', 'date'], component: 'double'},

            {name: 'contains', parent: ['string'], component: 'single'},
            {name: 'starts_with', parent: ['string'], component: 'single'},
            {name: 'ends_with', parent: ['string'], component: 'single'},

            {name: 'equal_to_count', parent: ['counter'], component: 'single'},
            {name: 'not_equal_to_count', parent: ['counter'], component: 'single'},

            {name: 'less_than_count', parent: ['counter'], component: 'single'},
            {name: 'greater_than_count', parent: ['counter'], component: 'single'},
        ]
    },
    getters: {
        list_view_url(state){
            return state.list_view_url;
        },
        table_actions(state){
          return state.table_actions;
        },
        updating_filter_candidate_id(state) {
            return state.updating_filter_candidate_id;
        },
        updating(state) {
            return state.updating;
        },
        fields(state) {
            return state.fields;
        },
        table_fields(state, rootState) {
            let fields = [];
            if (state.fields !== undefined && Array.isArray(state.fields)) {
                state.fields.forEach((field) => {
                    let is_main = (field.name === rootState.resource);
                    if (field.items !== undefined && (is_main || field.show_in_table === true)) {
                        field.items.forEach(item => {
                            if (item.show_in_table === true) {
                                let info = {name: item.name, orderable: item.orderable};
                                if (item.table_class !== undefined) {
                                    info.table_class = item.table_class;
                                }
                                if (item.table_style !== undefined) {
                                    info.table_style = item.table_style;
                                }
                                if (item.direction !== undefined) {
                                    info.direction = item.direction;
                                }
                                fields.push(info);
                            }
                        })
                    }
                });
            }

            return fields;
        },
        loading(state) {
            return state.loading
        },
        show_filters(state) {
            return state.show_filters
        },
        filterCandidates(state) {
            return state.filterCandidates
        },
        appliedFilters(state) {
            return state.appliedFilters
        },
        selectIDs(state) {
            return state.selectIDs
        },
        query(state) {
            return state.query
        },
        collection(state) {
            return state.collection
        },
        availableOperators(state) {
            return state.availableOperators;
        },
        getFilters(state) {
            const f = {};
            state.appliedFilters.forEach((filter, i) => {
                if (filter.column && filter.operator.name) {
                    f[`f[${i}][column]`] = filter.column;
                    f[`f[${i}][operator]`] = filter.operator.name;
                    f[`f[${i}][query_1]`] = filter.query_1;
                    f[`f[${i}][query_2]`] = filter.query_2;
                }

            });
            return f;
        },
    },
    mutations: {
        setEl(state, el) {
            state.el = el;
        },
        setListViewUrl(state,url){
          state.list_view_url=url;
        },
        setLoading(state, loading) {
            state.loading = loading;
        },
        toggleShowFilters(state) {
            state.show_filters = !state.show_filters;
        },
        setFields(state, fields) {
            state.fields = fields;
        },
        setUpdatingFilterCandidateId(state, index) {
            state.updating_filter_candidate_id = index;
        },
        toggleUpdating(state) {
            state.updating = !state.updating;
        },
        setFilterCandidate(state, payload) {
            state.filterCandidates[payload.index] = payload.data;
        },
        resetFilterCandidate(state, index) {
            state.filterCandidates[index] = {
                column: '',
                field: null,
                operator: '',
                query_1: null,
                query_2: null,
                options: {}
            };
        },
        setQuery(state, query) {
            state.query = query;
        },
        setSelectIDs(state, ids) {
            state.selectIDs = ids;
        },
        resetState(state) {
            state.loading = true;
            state.updating_filter_candidate_id= null;
            state.show_filters= false;
            state.appliedFilters.splice(0);
            state.filterCandidates.splice(0);
            state.query = {
                order_column: 'id',
                order_direction: 'desc',
                filter_match: 'and',
                limit: 25,
                links_count: 2,
                page: 1
            };
            state.selectIDs = [];
            state.collection = {
                data: [],
                pagination: {}
            }
        },
        addFilter(state) {
            state.filterCandidates.push({
                column: '',
                field: null,
                operator: '',
                query_1: null,
                query_2: null,
                options: {}
            });
        },
        removeFilter(state, index) {
            state.filterCandidates.splice(index, 1);
        },
        setAppliedFilters(state, filters) {
            state.appliedFilters = filters;
        },
        setCollection(state, data) {
            state.collection.data = data.data;
            state.collection.pagination.current_page = data.current_page;
            state.collection.pagination.last_page = data.last_page;
            state.collection.pagination.next_page_url = data.next_page_url;
            state.collection.pagination.prev_page_url = data.prev_page_url;
            state.collection.pagination.to = data.to;
            state.collection.pagination.from = data.from;
            state.collection.pagination.total = data.total;

        },
        setValue(state,payload){
            let column=state.collection.data[payload.column_index];
            if(column !== undefined && column[payload.key] !== undefined){
                Vue.set(state.collection.data[payload.column_index],payload.key,payload.value)
            }
            else {
                console.log('column or key is not defined!');
            }
        }
    },
    actions: {
        setFields(context, fields) {
            context.commit('setFields', []);

            let resource = context.rootGetters.resource;
            let temp_fields = [];
            if (fields !== undefined && Array.isArray(fields)) {
                fields.forEach((field) => {

                    let temp_field = {};
                    temp_field.show_in_table=true;
                    let prefix = '';
                    if (field.name !== resource) {
                        prefix = field.name + '.';
                        if (field.show_in_table !== true){
                            temp_field.show_in_table=false;
                        }
                    }

                    temp_field.name = field.name;
                    temp_field.items = [];

                    if (field.items !== undefined && Array.isArray(field.items)) {
                        field.items.forEach((item) => {
                            if (item.searchable !== false) {

                                let temp_item = {};
                                temp_item.name = prefix + item.name;
                                temp_item.type = item.type;
                                temp_item.orderable = item.orderable;
                                temp_item.searchable = item.searchable;
                                temp_item.show_in_table = item.show_in_table;

                                if (item.table_class !== undefined) {
                                    temp_item.table_class = item.table_class;
                                }
                                if (item.table_style !== undefined) {
                                    temp_item.table_style = item.table_style;
                                }
                                if (item.direction !== undefined) {
                                    temp_item.direction = item.direction;
                                }
                                if (item.options !== undefined && Array.isArray(item.options)) {
                                    let options = [];
                                    item.options.forEach(option => {
                                        options.push({id: option.id, text: i18next.t('values.' + option.text)})
                                    });
                                    temp_item.options = options;
                                }else if(item.type === 'select') {
                                    temp_item.type = 'string';
                                }

                                temp_field.items.push(temp_item);
                            }
                        })
                    }
                    temp_fields.push(temp_field);
                })
            }
            context.commit('setFields', temp_fields);
        },
        selectColumn(context, payload) {
            let index = payload.index;
            let currentFilterCandidate = context.getters.filterCandidates[index];


            if (currentFilterCandidate !== undefined && currentFilterCandidate.column !== payload.name) {

                let filterCandidate = {};
                filterCandidate.operator = '';
                filterCandidate.query_1 = null;
                filterCandidate.query_2 = null;


                let availableOperators = context.state.availableOperators;
                let selected_field = null;

                context.state.fields.forEach((group) => {
                    group.items.forEach(field => {
                        if (field.name === payload.name) {
                            selected_field = {name: field.name, type: field.type};
                            if (field.options !== undefined) {
                                selected_field.options = field.options;
                            }

                        }
                    })
                });

                if (selected_field !== null) {
                    switch (selected_field.type) {
                        case 'numeric':
                            filterCandidate.operator = availableOperators[4];
                            break;
                        case 'string':
                            filterCandidate.operator = availableOperators[6];
                            break;
                        case 'date':
                            filterCandidate.operator = availableOperators[4];
                            break;
                        case 'select':
                            filterCandidate.operator = availableOperators[0];
                            break;
                    }
                }

                filterCandidate.field = selected_field;
                filterCandidate.column = payload.name;

                context.dispatch('setFilterCandidate', {index: index, data: filterCandidate});

            }
            else {
                console.log('filter is not valid!');
            }


        },
        selectOperator(context, payload) {
            let index = payload.index;
            let operator_name = payload.name;
            let currentFilterCandidate = context.getters.filterCandidates[index];
            let availableOperators = context.state.availableOperators;

            let selected_operator = '';
            availableOperators.forEach((operator) => {
                if (operator.name === operator_name) {
                    selected_operator = operator;

                }
            });

            let filterCandidate = {};
            filterCandidate.column = currentFilterCandidate.column;
            filterCandidate.field = currentFilterCandidate.field;
            filterCandidate.operator = selected_operator;
            filterCandidate.query_1 = null;
            filterCandidate.query_2 = null;

            context.dispatch('setFilterCandidate', {index: index, data: filterCandidate});


        },
        setFilterCandidate(context, payload) {
            context.commit('setUpdatingFilterCandidateId', payload.index);
            setTimeout(() => {
                context.commit('setFilterCandidate', {index: payload.index, data: payload.data});
                context.commit('setUpdatingFilterCandidateId', null);
                context.commit('toggleUpdating');
            }, 1)
        },
        resetFilter(context) {
            context.state.appliedFilters.splice(0);
            context.state.filterCandidates.splice(0);
            context.state.query.page = 1;

            context.dispatch('fetch');

            setTimeout(() => {
                context.commit('addFilter');
                context.commit('toggleUpdating');
            }, 1);

        },
        applyFilter(context) {
            let filters = JSON.parse(JSON.stringify(context.state.filterCandidates));
            context.commit('setAppliedFilters', filters);
            context.state.query.page = 1;
            context.dispatch('fetch');
        },
        applyChange(context) {
            context.commit('setLoading', true);
            const filters = context.getters.getFilters;
            const params = {
                ...filters,
                ...context.getters.query
            };

            // let routes = context.rootGetters.resource_routes;
            // let url = routes.list_view.url;
            let url = context.getters.list_view_url;

            context.dispatch('setViewLoading', {el: context.state.el, status: true}, {root: true});

            axios.get(url, {params})
                .then((response) => {
                    context.commit('setCollection', response.data);
                    context.state.query.page = response.data.current_page;
                    context.commit('toggleUpdating');
                })
                .catch((error) => {
                    context.dispatch('checkAuth', error, {root:true});
                    console.log(error);
                })
                .finally(() => {
                    context.commit('setLoading', false);
                    context.commit('setSelectIDs', []);
                    context.dispatch('initInputStyle');
                    context.dispatch('setViewLoading', {el: context.state.el, status: false}, {root: true});
                })
        },
        fetch(context) {
            context.dispatch('applyChange');
        },
        toggleTableSelectIDs(context, value) {
            if (value === false) {
                context.commit('setSelectIDs', []);
            }
            else {
                let selectIDs = [];
                context.state.collection.data.forEach(function (item) {
                    selectIDs.push(item.id);
                });
                context.commit('setSelectIDs', selectIDs);
            }
            context.dispatch('initInputStyle');
            context.commit('toggleUpdating');

        },
        initInputStyle(context) {
            setTimeout(function () {
                $('.form-check-input-styled-info').uniform({
                    wrapperClass: 'border-info-600 text-info-800'
                });
            }, 1)
        },
        deleteRecords(context, IDs) {
            context.dispatch('setViewLoading', {el: context.state.el, status: true}, {root: true});
            context.commit('setLoading', true);

            let routes = context.rootGetters.resource_routes;
            let url = routes.delete.url;
            let ids = IDs.join(',');
            url = url.replace(':id', ids);
            let data = {
                '_method': routes.delete.method
            };


            axios.post(url, data)
                .then(function (res) {
                    if (res.data.message !== undefined) {
                        context.dispatch('showMessage', {type: 'success', message: res.data.message}, {root: true})
                    }
                    context.dispatch('fetch');
                })
                .catch(function (error) {
                    context.dispatch('checkAuth', error, {root:true});
                    if (error.response.data.message !== undefined) {
                        context.dispatch('showMessage', {
                            type: 'error',
                            message: error.response.data.message
                        }, {root: true})
                    }

                })
                .finally(() => {
                    context.dispatch('setViewLoading', {el: context.state.el, status: false}, {root: true});
                    context.commit('setLoading', false);
                })
        }
    }
};