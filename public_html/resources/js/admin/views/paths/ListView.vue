<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Style combinations</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>


        <div id="DataTables_Table_4_wrapper" class="dataTables_wrapper no-footer">
            <div class="datatable-header">
                <div style="font-weight: bold">
                    مطابقت داده ها با
                    <label>
                        <select2
                                :user_options="[{id:'all',text:'تمام'},{id:'any',text:'یکی از '}]"
                                :tags="false"
                                :width="'8rem'"
                                :value="'all'"
                                :search="false"
                                :multiple="false"
                                :allowClear="false"
                                :direction="$store.getters.direction">
                        </select2>
                    </label>
                    موارد زیر :‌
                </div>

                <div class="dataTables_filter">
                    <label>
                        <label>
                            <select2
                                    :user_options="[{id:'id',text:'id'},{id:'name',text:'name'},{id:'family',text:'family'}]"
                                    :tags="false"
                                    :width="'12.5rem'"
                                    :placeholder="'یک فیلد را انتخاب کنید'"
                                    :multiple="false"
                                    :allowClear="false"
                                    :direction="$store.getters.direction">
                            </select2>
                        </label>
                        <label>
                            <select2
                                    :user_options="[{id:'equal_to',text:'مساوی با'},{id:'not_equal_to',text:'نامساوی با'},{id:'contains',text:'شامل'}]"
                                    :tags="false"
                                    :width="'12.5rem'"
                                    :placeholder="'عملیات'"
                                    :multiple="false"
                                    :allowClear="false"
                                    :direction="$store.getters.direction">
                            </select2>
                        </label>
                        <label>
                            <input type="text" :placeholder="'عبارت جستجو ...'">
                        </label>
                        <label>
                            <input type="text" :placeholder="'عبارت جستجو ...'">
                        </label>
                        <label>
                            <button type="button"
                                    class="btn btn-outline bg-danger-400 text-danger-800 btn-icon rounded-round ml-2"><i
                                    class="icon-cancel-square"></i></button>
                        </label>
                    </label>

                </div>
                <div class="dataTables_filter">
                    <label>
                        <label>
                            <select2
                                    :user_options="[{id:'id',text:'id'},{id:'name',text:'name'},{id:'family',text:'family'}]"
                                    :tags="false"
                                    :width="'12.5rem'"
                                    :placeholder="'یک فیلد را انتخاب کنید'"
                                    :multiple="false"
                                    :allowClear="false"
                                    :direction="$store.getters.direction">
                            </select2>
                        </label>
                        <label>
                            <select2
                                    :user_options="[{id:'equal_to',text:'مساوی با'},{id:'not_equal_to',text:'نامساوی با'},{id:'contains',text:'شامل'}]"
                                    :tags="false"
                                    :width="'12.5rem'"
                                    :placeholder="'عملیات'"
                                    :multiple="false"
                                    :allowClear="false"
                                    :direction="$store.getters.direction">
                            </select2>
                        </label>
                        <label>
                            <input type="text" :placeholder="'عبارت جستجو ...'" class="two_column">
                        </label>
                        <label>
                            <button type="button"
                                    class="btn btn-outline bg-danger-400 text-danger-800 btn-icon rounded-round ml-2"><i
                                    class="icon-cancel-square"></i></button>
                        </label>
                    </label>

                </div>
                <div class="dataTables_filter" :style="{'float': direction}">
                    <label>
                        <button type="button"
                                class="btn btn-outline bg-primary-400 text-primary-400 border-primary-400"><i
                                class="icon-plus2"></i> افزودن
                        </button>
                    </label>
                    <label>
                        <button type="button" class="btn btn-outline bg-indigo-400 text-indigo-400 border-indigo-400"><i
                                class="icon-undo2"></i> بازنشانی
                        </button>
                    </label>
                    <label>
                        <button type="button"
                                class="btn btn-outline bg-success-400 text-success-400 border-success-400"><i
                                class="icon-checkmark4"></i> اعمال فیلتر
                        </button>
                    </label>
                </div>

                <div class="dataTables_length">
                    <label>
                        <span>Show:</span>
                        <select2
                                :user_options="[10,25,50,100]"
                                :tags="false"
                                :width="'5rem'"
                                :value="10"
                                :multiple="false"
                                :allowClear="false"
                                :search="false"
                                :direction="$store.getters.direction">
                        </select2>
                    </label>
                </div>
            </div>
            <div class="datatable-scroll">
                <table class="table datatable-basic table-bordered table-hover dataTable no-footer">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1"
                            aria-sort="ascending" aria-label="First Name: activate to sort column descending">First Name
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                            aria-label="Last Name: activate to sort column ascending">Last Name
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                            aria-label="Job Title: activate to sort column ascending">Job Title
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                            aria-label="DOB: activate to sort column ascending">DOB
                        </th>
                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                            aria-label="Status: activate to sort column ascending">Status
                        </th>
                        <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Actions"
                            style="width: 100px;">Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>


                    <tr role="row">
                        <td class="sorting_1">Aura</td>
                        <td>Hard</td>
                        <td>Business Services Sales Representative</td>
                        <td>19 Apr 1969</td>
                        <td><span class="badge badge-danger">Suspended</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Chantal</td>
                        <td><a href="#">Nailor</a></td>
                        <td>Technical Services Librarian</td>
                        <td>10 Jan 1980</td>
                        <td><span class="badge badge-secondary">Inactive</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Cicely</td>
                        <td>Sigler</td>
                        <td><a href="#">Senior Research Officer</a></td>
                        <td>15 Mar 1960</td>
                        <td><span class="badge badge-info">Pending</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Coy</td>
                        <td>Wollard</td>
                        <td>Customer Service Operator</td>
                        <td>12 Oct 1982</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Delma</td>
                        <td>Bonds</td>
                        <td>Lead Brand Manager</td>
                        <td>21 Dec 1968</td>
                        <td><span class="badge badge-info">Pending</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Jackelyn</td>
                        <td>Weible</td>
                        <td><a href="#">Airline Transport Pilot</a></td>
                        <td>3 Oct 1981</td>
                        <td><span class="badge badge-secondary">Inactive</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Kennedy</td>
                        <td>Haley</td>
                        <td>Senior Marketing Designer</td>
                        <td>18 Dec 1960</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Lizzee</td>
                        <td><a href="#">Goodlow</a></td>
                        <td>Technical Services Librarian</td>
                        <td>1 Nov 1961</td>
                        <td><span class="badge badge-danger">Suspended</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Marth</td>
                        <td><a href="#">Enright</a></td>
                        <td>Traffic Court Referee</td>
                        <td>22 Jun 1972</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr role="row">
                        <td class="sorting_1">Maxine</td>
                        <td><a href="#">Woldt</a></td>
                        <td><a href="#">Business Services Sales Representative</a></td>
                        <td>17 Oct 1987</td>
                        <td><span class="badge badge-info">Pending</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>
                                            Export to .pdf</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="datatable-footer">
                <div class="dataTables_info" id="DataTables_Table_4_info" role="status" aria-live="polite">
                    Showing 1 to 10 of 15 entries
                </div>
                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_4_paginate"><a
                        class="paginate_button previous disabled" data-dt-idx="0"
                        tabindex="0" id="DataTables_Table_4_previous">→</a><span><a class="paginate_button current"
                                                                                    data-dt-idx="1" tabindex="0">1</a><a
                        class="paginate_button " data-dt-idx="2"
                        tabindex="0">2</a></span><a class="paginate_button next"
                                                    data-dt-idx="3" tabindex="0" id="DataTables_Table_4_next">←</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import select2 from '../../components/Select2.vue';

    import {mapGetters} from 'vuex'

    export default {
        components: {select2},
        computed: {
            direction() {
                let direction = this.$store.getters.direction;
                if (direction === 'rtl') {
                    return 'right'
                }
                return 'left';
            }

        }
    }
</script>

<style>

    @media only screen and (min-width: 1212px) {
        .dataTables_filter input.two_column{
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
</style>