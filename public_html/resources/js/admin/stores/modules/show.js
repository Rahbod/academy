
import i18next from 'i18next';
import Vue from "vue";


export const show = {
    namespaced: true,
    state: {
        id:null,
        el: "#modal-view",
        loading: true,
        model: {},
        info: [],
    },
    getters: {
        loading(state) {
            return state.loading
        },
        model(state) {
            return state.model
        },
        info(state) {
            return state.info
        }
    },
    mutations: {
        setEl(state, el) {
            state.el = el
        },
        setId(state, id) {
            state.id = id
        },
        setLoading(state, loading) {
            state.loading = loading
        },
        setModel(state, model) {
            state.model = model;
        },
        setInfo(state, info) {
            state.info = info;
        },
        reset(state){
            state.id=null;
            state.loading=true;
            state.model={};
        }
    },
    actions: {
        setInfo(context, fields) {
            context.commit('setInfo', []);
            let resource = context.rootGetters.resource;
            let department=context.rootGetters.department;
            if(resource === 'courses' && department === 'profile'){
                resource = 'user_classes'
            }
            let info = {};
            info.items = [];
            if (fields !== undefined && Array.isArray(fields)) {
                fields.forEach((field) => {
                    if (field.items !== undefined && Array.isArray(field.items)) {
                        if (field.name === resource) {
                            field.items.forEach((item, index) => {
                                    let temp_item = {};
                                    temp_item.name = item.name;
                                    temp_item.type = item.input_type;

                                    if (item.label !== undefined) {
                                        temp_item.label = item.label;
                                    }
                                    if (item.direction !== undefined) {
                                        temp_item.direction = item.direction;
                                    }

                                    info[index] = temp_item;
                            })
                        }
                        else  {

                            let sub_info = {};
                            sub_info.name = field.name;
                            sub_info.table = field.table;
                            sub_info.info = [];
                            field.items.forEach(item => {
                                    let temp_item = {};
                                    temp_item.name = item.name;
                                    temp_item.type = item.input_type;

                                    if (item.direction !== undefined) {
                                        temp_item.direction = item.direction;
                                    }

                                    sub_info.info.push(temp_item);
                            });

                            info.items.push(sub_info)
                        }
                    }

                })
            }
            context.commit('setInfo', info);
            // console.log(info);
        },
        getViewData(context, id) {
            context.commit('reset');
            let routes = context.rootGetters.resource_routes;
            let url = routes.show.url;
            url = url.replace(":id", id);

            if (url !== null) {
               context.dispatch('sendRequest',{url:url,method:'get',el:context.state.el},{root:true})
                    .then(function (response) {
                        let data = response.data;
                        if(data.model !== undefined){
                            context.commit('setModel',data.model);
                        }
                        if(data.info !== undefined){
                            context.commit('setInfo',data.info);
                        }
                    })
                    .catch(function (error) {
                        if (error.response !== undefined && error.response.status === 404) {
                            context.dispatch('showMessage', {
                                type: 'error',
                                message: 'not found model!'
                            })
                        }
                    })
                   .finally(() => {
                           context.commit('setLoading', false);
                       });
            }
            else {
                console.log('action is not valid!')
            }

        },
    }
};