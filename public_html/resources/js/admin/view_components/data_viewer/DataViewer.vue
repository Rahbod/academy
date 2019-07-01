<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title" v-text="$t(resource + ':table_title')"></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse" @click.prevent="collapseCard($event.target)"></a>
                    <a class="list-icons-item" data-action="reload" @click.prevent="fetch"></a>
                    <a class="list-icons-item" data-action="fullscreen" @click.prevent="fullScreen($event.target)"></a>
                    <a class="list-icons-item" data-action="remove" @click.prevent="$router.push('/')"></a>
                </div>
            </div>
        </div>


        <div class="dataTables_wrapper no-footer">
            <div class="datatable-header">
                <template v-if="show_filters">
                    <div>
                        <span style="font-weight: bold"> {{$t('table.filter_match')}} </span>
                        <label>
                            <select2
                                    :user_options="[{id:'and',text:$t('values.all')},{id:'or',text:$t('values.any')}]"
                                    :tags="false"
                                    :width="'6rem'"
                                    :value="query.filter_match"
                                    :search="false"
                                    :multiple="false"
                                    :allowClear="false"
                                    :direction="$store.getters.direction"
                                    @input="updateQuery('filter_match',$event)"
                            >
                            </select2>
                        </label>‌
                    </div>

                    <div class="dataTables_filter" v-for="(filterCandidate,index) in filterCandidates"
                         v-if="show_filters">
                        <label>
                            <label>
                                <select2
                                        :user_options="select_fields"
                                        :id="'filterCandidate-'+index+'-'+filterCandidate.column"
                                        :name="'filterCandidate-'+index+'-'+filterCandidate.column"
                                        :key="'filterCandidate-'+index+'-'+filterCandidate.column"
                                        :tags="false"
                                        :width="'12.5rem'"
                                        :placeholder="$t('messages.select_item')"
                                        :value="filterCandidate.column"
                                        :search="false"
                                        :multiple="false"
                                        :allowClear="true"
                                        :direction="$store.getters.direction"
                                        @input="selectColumn({index:index,name:$event})">
                                </select2>
                            </label>
                            <label v-if="filterCandidate.field && filterCandidate.operator">
                                <select2
                                        :user_options="fetchOperator(filterCandidate)"
                                        :tags="false"
                                        :width="'12.5rem'"
                                        :placeholder="'عملیات'"
                                        :value="filterCandidate.operator.name"
                                        :multiple="false"
                                        :search="false"
                                        :allowClear="false"
                                        :direction="$store.getters.direction"
                                        @input="selectOperator({index:index,name:$event})">>
                                </select2>
                            </label>
                            <template
                                    v-if="filterCandidate.field && filterCandidate.operator && updating_filter_candidate_id !== index">
                                <component :is="getComponent(filterCandidate)" :index="index"
                                           :key="'filterCandidate-input-'+index+'-'+filterCandidate.column"></component>
                            </template>
                            <label>
                                <button type="button" @click="removeFilter(index)"
                                        class="btn btn-outline bg-danger-400 text-danger-800 btn-icon rounded-round ml-2">
                                    <i
                                            class="icon-cancel-square"></i></button>
                            </label>
                        </label>

                    </div>
                    <div class="dataTables_filter" :style="{'float': direction}">
                        <label class="action-button">
                            <button type="button" @click.prevent="addFilter"
                                    class="btn btn-outline bg-primary-400 text-primary-400 border-primary-400">
                                <i class="icon-plus2"></i> {{$t('actions.add')}}
                            </button>
                        </label>
                        <label class="action-button">
                            <button type="button"
                                    class="btn btn-outline bg-indigo-400 text-indigo-400 border-indigo-400"
                                    @click="resetFilter"><i
                                    class="icon-undo2"></i> {{$t('actions.reset')}}
                            </button>
                        </label>
                        <label class="action-button">
                            <button type="button"
                                    class="btn btn-outline bg-success-400 text-success-400 border-success-400"
                                    @click="applyFilter"><i
                                    class="icon-checkmark4"></i> {{$t('actions.apply_filter')}}
                            </button>
                        </label>
                        <label class="action-button">
                            <button type="button" @click.prevent="toggleShowFilters"
                                    class="btn btn-outline bg-warning-400 text-warning-400 border-warning-400"><i
                                    class="icon-cross2"></i> {{$t('actions.close_search')}}
                            </button>
                        </label>
                        <label class="action-button">
                            <button type="button" @click.prevent="deleteTableRecords(selectIDs)"
                                    class="btn btn-outline bg-danger-400 text-danger-400 border-danger-400"><i
                                    class="icon-trash"></i> {{$t('actions.delete_selected_items')}}
                            </button>
                        </label>
                    </div>
                </template>
                <div v-else class="dataTables_filter" :style="{'float': direction}">
                    <label class="action-button">
                        <button type="button" @click.prevent="toggleShowFilters"
                                class="btn btn-outline bg-primary-400 text-primary-400 border-primary-400"><i
                                class="icon-search4"></i> {{$t('actions.advance_search')}}
                        </button>
                    </label>
                    <label class="action-button" v-if="hasAction('destroy')">
                        <button type="button" class="btn btn-outline bg-danger-400 text-danger-400 border-danger-400"
                                @click.prevent="deleteTableRecords(selectIDs)">
                            <i class="icon-trash"></i> {{$t('actions.delete_selected_items')}}
                        </button>
                    </label>
                    <label class="action-button" v-if="hasAction('create')">
                        <button type="button" class="btn btn-outline bg-success-400 text-success-400 border-success-400"
                                @click.prevent="$router.push({ name: route_name+'-create' })">
                            <i class="icon-file-plus"></i> {{$t('actions.create_new_record')}}
                        </button>
                    </label>
                </div>


                <div class="dataTables_length">
                    <label>
                        <span>{{$t('actions.show')}}:</span>
                        <select2
                                :user_options="[10,25,50,100,200,500]"
                                :tags="false"
                                :width="'5rem'"
                                :value="query.limit"
                                :multiple="false"
                                :allowClear="false"
                                :search="false"
                                @input="changeLimit($event)"
                                :direction="$store.getters.direction">
                        </select2>
                    </label>
                </div>
            </div>
            <div class="datatable-scroll" v-if="collection.data.length>0">
                <table class="table datatable-basic table-bordered table-hover dataTable no-footer table-trsponsive">
                    <thead>
                        <tr role="row">
                            <th class="text-center">
                                <input type="checkbox" class="form-check-input-styled-info" :value="true"
                                       :checked="selectIDs.length === collection.data.length" @click="checkSelect()">
                            </th>
                            <th :class="headerClass(table_field)" :style="tableStyle(table_field)"
                                v-for="table_field in table_fields"
                                @click.prevent="sort(table_field)">{{$t(resource + ':items.' + table_field.name)}}
                            </th>

                            <th class="text-center sorting_disabled" rowspan="1" colspan="1"
                                style="width: 100px;">{{$t('actions.actions')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>


                    <tr role="row" v-for="(column,column_index) in collection.data"
                        :class="{selected :selectIDs.indexOf(column.id) !== -1}">
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input-styled-info"
                                   v-model="$store.state['filterable_table'].selectIDs" @change="initInputStyle"
                                   :id="column.id" :value="column.id">

                        </td>
                        <td v-for="table_field in table_fields" v-html="column[table_field.name]"
                            :class="bodyClass(table_field)" :style="tableStyle(table_field)"></td>

                        <td class="text-center">
                            <a style="margin: 2px; cursor: pointer" @click.prevent="getAction(key,column,column_index)"
                               :class="[{'disabled':!hasAction(key)},{'inactive':inActive(column,key)}]"
                               v-for="(action,key) in available_actions"
                               :title="$t('actions.'+key)">
                                <i :class="[inActive(column,key) ? action.inactive_class : action.active_class]"></i>
                            </a>
                            <!--<div class="list-icons">-->
                            <!--<div class="dropdown">-->
                            <!--<a href="#" class="list-icons-item" data-toggle="dropdown">-->
                            <!--<i class="icon-menu9"></i>-->
                            <!--</a>-->

                            <!--<div class="dropdown-menu dropdown-menu-right">-->
                            <!--<a href="#" @click.prevent="showEditForm(column.id)"-->
                            <!--class="dropdown-item" :title="$t('actions.edit')"-->
                            <!--v-if="hasAction('edit')">-->
                            <!--<i class="icon-pencil7 text-primary-600"></i> {{$t('actions.edit')}}-->
                            <!--</a>-->
                            <!--<a href="#" class="dropdown-item " :title="$t('actions.delete')"-->
                            <!--v-if="hasAction('destroy')" @click.prevent="deleteTableRecords([column.id])">-->
                            <!--<i class="text-danger-600 icon-trash"></i> {{$t('actions.delete')}}-->
                            <!--</a>-->
                            <!--<a href="#" @click.prevent="showRecord(column.id)"-->
                            <!--class="dropdown-item" :title="$t('actions.show')"-->
                            <!--v-if="hasAction('show')">-->
                            <!--<i class="text-teal-600 icon-file-eye"></i> {{$t('actions.show')}}-->
                            <!--</a>-->
                            <!--</div>-->
                            <!--</div>-->
                            <!--</div>-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-warning alert-bordered" style="margin: 1rem"
                 v-if="collection.data.length === 0 && !loading">
                {{$t('messages.not_found_record')}}
            </div>
            <div style="display: none;">{{updating}}</div>


            <div class="datatable-footer">
                <div class="dataTables_info">
                    <span v-if="!loading && collection.data.length>0">
                        {{$t('table.report', {
                        first: collection.pagination.from,
                        last: collection.pagination.to,
                        total: collection.pagination.total
                    })}}
                    </span>

                </div>
                <pagination v-if="!loading && collection.data.length>0"></pagination>
            </div>
        </div>

    </div>
</template>

<script>
    import select2 from '../../components/Select2.vue';
    import global_mixin from '../../mixins/GlobalMixin.vue';

    import {mapState, mapGetters, mapMutations, mapActions} from 'vuex';

    import single_string from './SingleString.vue';
    import double_string from './DoubleString.vue';
    import single_date from './SingleDate.vue';
    import double_date from './DoubleDate.vue';
    import single_select from './SingleSelect.vue';
    import double_select from './DoubleSelect.vue';

    import pagination from './Pagination.vue';

    export default {
        components: {
            select2,
            single_string,
            double_string,
            single_date,
            double_date,
            single_select,
            double_select,
            pagination
        },
        mixins: [global_mixin],
        data() {
            return {
                selectAll: false
            }
        },
        computed: {
            ...mapGetters('filterable_table', ['table_actions', 'table_fields', 'fields', 'loading', 'show_filters', 'appliedFilters', 'filterCandidates', 'query', 'collection', 'availableOperators', 'updating_filter_candidate_id', 'updating', 'selectIDs']),
            ...mapGetters(['resource', 'base_resource', 'route_name', 'base_resource_url', 'actions']),
            select_fields() {
                let vm = this;
                let options = [];
                if (this.fields.length > 0) {
                    this.fields.forEach(field => {
                        let option_group = {'text': '', children: []};
                        if(field.name === vm.resource){
                            option_group.text = this.$t(vm.resource + ':title');
                        }
                        else {
                            option_group.text = this.$t(vm.resource + ':relations.' + field.name);
                        }
                        field.items.forEach(item => {
                            option_group.children.push({
                                'id': item.name,
                                'text': vm.$t(vm.resource + ':items.' + item.name)
                            })
                        });
                        options.push(option_group);
                    })
                }
                return options;
            },
            fetchOperator() {
                return (f) => {
                    let options = [];
                    this.availableOperators.forEach((operator) => {
                        if (f.field && operator.parent.includes(f.field.type)) {
                            options.push({id: operator.name, text: this.$t('table.search_operator.' + operator.name)});
                        }
                    });
                    return options;
                }
            },
            direction() {
                let direction = this.$store.getters.direction;
                if (direction === 'rtl') {
                    return 'right'
                }
                return 'left';
            },
            available_actions() {
                let available_actions = {};
                let vm = this;
                if (this.actions !== undefined) {
                    Object.keys(this.actions).forEach(function (key) {
                        if (vm.table_actions[key] !== undefined) {
                            available_actions[key] = vm.table_actions[key];
                        }
                    });
                }
                return available_actions;
            },
        },
        methods: {
            ...mapMutations('filterable_table', ['setEl', 'setQuery', 'addFilter', 'removeFilter', 'toggleShowFilters', 'setValue']),
            ...mapActions('filterable_table', ['selectColumn', 'selectOperator', 'resetFilter', 'applyFilter', 'fetch', 'toggleTableSelectIDs', 'initInputStyle', 'deleteRecords']),
            ...mapActions(['collapseCard', 'fullScreen', 'sendRequest', 'showMessage']),
            ...mapActions('show',['getViewData']),
            changeLimit(value) {
                let query = this.query;
                query.limit = value;
                query.page = 1;
                this.setQuery(query);
                this.fetch();
            },
            updateQuery(key, value) {
                let query = this.query;
                query[key] = value;
                this.setQuery(query);
            },
            getComponent(filterCandidate) {
                let component = 'single-string';
                if (filterCandidate.operator && filterCandidate.field) {
                    let type = filterCandidate.operator.component + '-' + filterCandidate.field.type;
                    switch (type) {
                        case 'single-date':
                            component = 'single_date';
                            break;
                        case 'double-date':
                            component = 'double_date';
                            break;
                        case 'single-string':
                        case 'single-numeric':
                            component = 'single_string';
                            break;
                        case 'double-string':
                        case 'double-numeric':
                            component = 'double_string';
                            break;
                        case 'single-select':
                            component = 'single_select';
                            break;
                        case 'double-select':
                            component = 'double_select';
                            break;
                    }
                }
                return component;
            },
            headerClass(table_field) {
                if (table_field.orderable) {
                    if (this.query.order_column === table_field.name) {
                        if (this.query.order_direction === 'asc') {
                            return 'sorting_asc ' + table_field.table_class;
                        }
                        else {
                            return 'sorting_desc ' + table_field.table_class;
                        }
                    }
                    return 'sorting ' + table_field.table_class;
                }
                else {
                    return table_field.table_class;
                }
            },
            bodyClass(table_field) {
                return table_field.table_class;
            },
            tableStyle(table_field) {
                let styles = {};
                if (table_field.table_style !== undefined) {
                    styles = JSON.parse(table_field.table_style);
                }
                if (table_field.direction !== undefined) {
                    styles.direction = table_field.direction
                }
                return styles;
            },
            checkSelect() {
                let selectAll = false;
                if (this.selectIDs.length < this.collection.data.length) {
                    selectAll = true;
                }
                this.toggleTableSelectIDs(selectAll);
            },
            sort(table_field) {
                if (table_field.orderable) {
                    let query = this.query;
                    if (table_field.name === query.order_column) {
                        if (query.order_direction === 'desc') {
                            query.order_direction = 'asc';
                        } else {
                            query.order_direction = 'desc';

                        }
                    } else {
                        query.order_column = table_field.name;
                        query.order_direction = 'asc';

                    }
                    this.setQuery(query);
                    this.fetch();
                }

            },
            deleteTableRecords(IDs) {
                if (IDs.length > 0) {
                    let stack_modal = {
                        "dir1": "down",
                        "dir2": "right",
                        "push": "top",
                        "modal": true,
                        "overlay_close": true
                    };
                    let notice = new PNotify({
                        title: this.$t('messages.waring'),
                        text: '<p>' + this.$t('messages.delete_confirm') + '</p>',
                        hide: false,
                        type: 'warning',
                        confirm: {
                            confirm: true,
                            buttons: [
                                {
                                    text: this.$t('actions.submit'),
                                    addClass: 'btn btn-sm btn-info'
                                },
                                {
                                    text: this.$t('actions.cancel'),
                                    addClass: 'btn btn-sm btn-danger'
                                }
                            ]
                        },
                        buttons: {
                            closer: false,
                            sticker: false
                        },
                        history: {
                            history: false
                        },
                        addclass: 'stack-modal',
                        stack: stack_modal
                    });

                    // On confirm
                    let vm = this;
                    notice.get().on('pnotify.confirm', function () {
                        vm.deleteRecords(IDs);
                    });

                }

            },

            inActive(column, action) {
                if (column[action] !== undefined && column[action] === 0) {
                    return true;
                }
                return false;
            },
            showEditForm(id) {
                this.$router.push({name: this.route_name + '-edit', params: {id: id}})
            },
            showRecord(id) {
                this.$router.push({name: this.route_name + '-show', params: {id: id}})
            },

            getAction(action_name, column, column_index) {
                if (this.hasAction(action_name)) {
                    switch (action_name) {
                        case 'edit':
                            this.showEditForm(column.id);
                            break;
                        case 'show':
                            $('#open-modal-view').trigger('click');
                            this.getViewData(column.id);
                            break;
                        case 'destroy':
                            this.deleteTableRecords([column.id]);
                            break;
                        case 'print':
                            this.setValue({column_index, key: action_name, value: 1});
                            let url = this.base_resource_url + "/" + action_name + "/" + column.id;
                            window.open(url, "", "width=800");
                            break;
                        default:
                            this.sendActionRequest(action_name, column.id, column_index);
                            break;
                    }
                }
                else {
                    this.showMessage({type: 'error', message: "شما به این عملیات دسترسی ندارید!"})
                }

            },
            sendActionRequest(action_name, id, column_index) {
                let url = this.base_resource_url + "/" + action_name;
                let data = {id};
                this.sendRequest({url, data, el: this.el})
                    .then((response) => {
                        if (response.data[action_name] !== undefined) {
                            this.setValue({column_index, key: action_name, value: response.data[action_name]})
                        }
                    })
            },
            mounted() {
                this.setEl(this.$el);
            }
        }
    }
</script>

<style>
    .disabled {
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
    }

    .inactive {
        opacity: 0.4;
        text-decoration: none;
    }

    @media only screen and (min-width: 1212px) {
        .dataTables_filter input.two_column {
            width: 25.2rem;
        }
    }

    .dataTables_filter {
        float: none;
        margin: 0;
        padding-top: 0.5rem;
    }

    .dataTables_filter > label:after {
        content: '' !important;
    }

    .action-button {
        margin-bottom: 5px !important;
    }
</style>