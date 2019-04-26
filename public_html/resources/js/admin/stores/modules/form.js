import i18next from 'i18next';
import Vue from "vue";


export const form = {
    namespaced: true,
    state: {
        el: null,
        loading: true,
        updating: true,
        action: 'create',
        errors: {},
        model: {},
        info: {},
        options: {}
    },
    getters: {
        loading(state) {
            return state.loading
        },
        updating(state) {
            return state.updating;
        },
        action(state) {
            return state.action
        },
        errors(state) {
            return state.errors
        },
        model(state) {
            return state.model
        },
        info(state) {
            return state.info
        },
        options(state) {
            return state.options
        },
    },
    mutations: {
        setEl(state, el) {
            state.el = el
        },
        setLoading(state, loading) {
            state.loading = loading
        },
        toggleUpdating(state) {
            state.updating = !state.updating;
        },
        updateForm(state, data) {

            function guid() {
                return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
                    (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16))
            };

            state.errors = {};
            let model = data.model;
            if (model !== undefined && model !== null) {
                Object.keys(model).forEach((key) => {
                    if (Array.isArray(model[key])) {
                        model[key].forEach((item) => {
                            if (item.id !== undefined) {
                                item.guid = guid();
                            }
                            if (Array.isArray(item)) {
                                item.forEach((sub_item) => {
                                    if (sub_item.id !== undefined) {
                                        sub_item.guid = guid();
                                    }
                                })
                            }
                        });

                    }
                });
            }


            state.model = model;
            if (data.info !== undefined) {
                state.info = data.info;
            }
            state.options = data.options;
            state.action = data.action;
        },
        resetForm(state) {
            state.errors = {};
            state.model = {};
            // state.info = {};
            state.options = {};
        },
        setErrors(state, errors) {
            state.errors = errors;
        },
        setInfo(state, info) {
            state.info = info;
        },
        setAction(state, action) {
            state.action = action;
        },
        deleteError(state, error_name) {
            delete state.errors[error_name];
        },
        setValueAtModel: (state, payload) => {
            let index = payload.index;
            let prefix = payload.prefix;
            let key = payload.key;
            let value = payload.value;
            if (index !== null && prefix !== null && index !== undefined && prefix !== undefined) {
                if (prefix.indexOf(".") !== -1) {
                    let array_prefix = prefix.split(".");
                    if (array_prefix.length === 3) {
                        Vue.set(state.model[array_prefix[0]][array_prefix[1]][array_prefix[2]][index], key, value);
                    }
                    else if (array_prefix.length === 2) {
                        state.model[array_prefix[0]][array_prefix[1]][key].push(value)
                    }
                } else {
                    Vue.set(state.model[prefix][index], key, value);
                }

            } else if (index !== null && index !== undefined) {
                state.model[key].push(value);
            }
            else if (prefix !== null && prefix !== undefined) {

                Vue.set(state.model[prefix], key, value);

            } else {
                Vue.set(state.model, key, value);
            }
        },
        deleteRecord(state, paylaod) {
            let deleteIndex = paylaod.deleteIndex;
            let item_name = paylaod.item_name;
            let prefix = paylaod.prefix;
            if (prefix !== undefined) {
                if (prefix.indexOf(".") !== -1) {
                    let array_prefix = prefix.split(".");
                    if (array_prefix.length === 2) {
                        Vue.delete(state.model[array_prefix[0]][array_prefix[1]][item_name], deleteIndex);
                    }
                }
                else if (Array.isArray(state.model[prefix][item_name])) {
                    Vue.delete(state.model[prefix][item_name], deleteIndex);
                }
            }
            else if (Array.isArray(state.model[item_name])) {
                Vue.delete(state.model[item_name], deleteIndex);
            }
        },
        setModel(state, model) {
            state.model = model;
        },
        setInfo(state, info) {
            state.info = info;
        },
        removeError(state, key) {
            delete state.errors[key];
        },
        updateOptions(state, payload) {
            Vue.set(state.options, payload.key, payload.value);
        },
        deleteOption(state, key) {
            delete state.options[key];
        }
    },
    actions: {
        setInfo(context, fields) {
            context.commit('setInfo', []);
            let resource = context.rootGetters.resource;
            if(resource === 'profile'){
                resource ='users';
            }
            let info = {};
            info.items = [];
            if (fields !== undefined && Array.isArray(fields)) {
                fields.forEach((field) => {
                    if (field.items !== undefined && Array.isArray(field.items)) {
                        if (field.name === resource) {
                            field.items.forEach((item, index) => {
                                if (item.show_in_form === undefined || item.show_in_form === true) {
                                    let temp_item = {};
                                    temp_item.name = item.name;
                                    temp_item.type = item.input_type;
                                    temp_item.required = false;

                                    if (item.label !== undefined) {
                                        temp_item.label = item.label;
                                    }
                                    if (item.required !== undefined) {
                                        temp_item.required = item.required;
                                    }
                                    if (item.direction !== undefined) {
                                        temp_item.direction = item.direction;
                                    }

                                    if (item.input_class !== undefined) {
                                        temp_item.input_class = item.input_class;
                                    }
                                    if (item.input_style !== undefined) {
                                        temp_item.input_style = item.input_style;
                                    }
                                    if (item.input_icon !== undefined) {
                                        temp_item.input_icon = item.input_icon;
                                    }
                                    if (item.options !== undefined && Array.isArray(item.options)) {
                                        let options = [];
                                        item.options.forEach(option => {
                                            let temp_option = {id: option.id, text: option.id};
                                            if (option.text !== undefined) {
                                                temp_option['text'] = i18next.t('values.' + option.text);
                                            }
                                            options.push(temp_option)
                                        });
                                        temp_item.options = options;
                                    }

                                    info[index] = temp_item;
                                }
                            })
                        }
                        else if (field.show_in_form === true) {

                            let sub_info = {};
                            sub_info.name = field.name;
                            sub_info.table = field.table;
                            sub_info.info = [];
                            field.items.forEach(item => {
                                if (item.show_in_form === undefined || item.show_in_form === true) {
                                    let temp_item = {};
                                    temp_item.name = item.name;
                                    temp_item.type = item.input_type;
                                    temp_item.required = false;

                                    if (item.required !== undefined) {
                                        temp_item.required = item.required;
                                    }
                                    if (item.direction !== undefined) {
                                        temp_item.direction = item.direction;
                                    }

                                    if (item.input_class !== undefined) {
                                        temp_item.input_class = item.input_class;
                                    }
                                    if (item.input_style !== undefined) {
                                        temp_item.input_style = item.input_style;
                                    }
                                    if (item.input_icon !== undefined) {
                                        temp_item.input_icon = item.input_icon;
                                    }

                                    if (item.options !== undefined && Array.isArray(item.options)) {
                                        let options = [];
                                        item.options.forEach(option => {
                                            let temp_option = {id: option.id, text: option.id};
                                            if (option.text !== undefined) {
                                                temp_option['text'] = i18next.t('values.' + option.text);
                                            }
                                            options.push(temp_option)
                                        });
                                        temp_item.options = options;
                                    }

                                    sub_info.info.push(temp_item);
                                }
                            });

                            info.items.push(sub_info)
                        }
                    }

                })
            }
            context.commit('setInfo', info);
            // console.log(info);
        },
        getFormData(context, id) {
            context.commit('setLoading', true);
            let type = context.state.action;
            let routes = context.rootGetters.resource_routes;
            let url = null;
            switch (type) {
                case 'create':
                    url = routes.create.url;
                    break;
                case 'edit':
                    url = routes.edit.url;
                    url = url.replace(":id", id);
                    break;
            }

            if (url !== null) {
                context.dispatch('sendRequest', {url: url, method: 'get', el: context.state.el}, {root: true})
                    .then(function (response) {
                        let data = response.data;
                        data.action = type;
                        context.commit('updateForm', data);
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
        sendFormRequest(context, event) {
            return new Promise((resolve, reject) => {
                let el = event.target;
                let form_data = new FormData(el);
                let method = null;
                let action = context.state.action;
                let routes = context.rootGetters.resource_routes;
                let id = context.getters.model.id;
                let url = null;
                switch (action) {
                    case 'create':
                        url = routes.store.url;
                        method = routes.store.method;
                        break;
                    case 'edit':
                        url = routes.update.url;
                        url = url.replace(":id", id);
                        method = routes.update.method;
                        break;
                }

                form_data.append('_method', method);

                if (url !== null && url !== undefined) {
                    context.dispatch('sendRequest', {url: url, data: form_data, el: context.state.el}, {root: true})
                        .then(response => {
                            resolve(response);
                        })
                        .catch(error => {
                            if (error.response !== undefined && error.response.status === 422) {
                                if (error.response.data.errors !== undefined) {
                                    let errors = error.response.data.errors;
                                    context.commit('setErrors', errors);
                                }
                            }
                            reject(error);
                        })
                }
                else {
                    reject({'message': 'url is not defined!'})
                }
            });


        },

        createNewItem(context, payload) {
            return new Promise((resolve, reject) => {
                function guid() {
                    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
                        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16))
                }

                if (context.getters.info.items[payload.item_index] !== undefined) {
                    let info = context.getters.info.items[payload.item_index].info;
                    let new_item = {};
                    new_item.guid = guid();

                    info.forEach(function (item) {
                        if (item.name == 'id') {
                            new_item[item.name] = 0
                        }
                        else {
                            new_item[item.name] = ''
                        }

                    });
                    // console.log(new_item);
                    resolve(new_item);
                } else {
                    reject('info not found')
                }
            })
        },

        addRecord(context, payload) {
            context.dispatch('createNewItem', payload)
                .then(new_item => {
                    let item_name = payload.item_name;
                    let info = context.getters.info.items[payload.item_index].info;
                    let model = context.getters.model;
                    if (Array.isArray(model[item_name])) {
                        let items = model[item_name];
                        info.forEach(function (item) {
                            if (item.name === 'order') {
                                new_item[item.name] = items.length + 1;
                            }

                        });
                        let payload = {
                            index: items.length,
                            prefix: null,
                            key: item_name,
                            value: new_item
                        };
                        context.commit('setValueAtModel', payload);
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            // function guid() {
            //     return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
            //         (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16))
            // };
            //
            // let item_name = payload.item_name;
            //
            // let info = context.getters.info.items[payload.item_index].info;
            // let model = context.getters.model;
            // if (Array.isArray(model[item_name])) {
            //     let new_item = {};
            //     let items = model[item_name];
            //     new_item.guid = guid();
            //     info.forEach(function (item) {
            //         if (item.name == 'id') {
            //             new_item[item.name] = 0
            //         }
            //         else if (item.name == 'order') {
            //             new_item[item.name] = items.length + 1;
            //         }
            //         else {
            //             new_item[item.name] = ''
            //         }
            //
            //     });
            //     let payload = {
            //         index: items.length,
            //         prefix: null,
            //         key: item_name,
            //         value: new_item
            //     };
            //     context.commit('setValueAtModel', payload);
            // }


        },
        deleteRecord(context, paylaod) {
            let deleteIndex = paylaod.deleteIndex;
            let item_name = paylaod.item_name;
            let items = context.getters.model[item_name];
            if (Array.isArray(items)) {
                let delete_item = items[deleteIndex];
                if (items.length > 1 && delete_item.order !== undefined) {
                    items.forEach(function (item, index) {
                        if (item.order > delete_item.order) {
                            let paylaod = {
                                index: index,
                                prefix: item_name,
                                key: 'order',
                                value: item.order - 1
                            };
                            context.commit('setValueAtModel', paylaod);
                        }
                    });
                }
                context.commit('deleteRecord', paylaod);
            }

        },
        setValueAtModel(context, payload) {
            context.dispatch('updateOptions', payload);
            context.commit('setValueAtModel', payload);
        },

        updateOptions(context, payload) {
            let key = payload.key;
            let value = payload.value;
            let key_name = context.rootGetters.resource + '-' + key;
            if (value !== undefined) {
                switch (key_name) {
                    case 'actions-department_id':
                        context.dispatch('changeActionDepartmentId', payload);
                        break;
                }
                switch (key_name) {
                    case 'resources-department_id':
                        context.dispatch('changeResourceDepartmentId', payload);
                        break;
                }
                switch (key_name) {
                    case 'resources-resource_group_id':
                        context.dispatch('changeResourceResourceGroupId', payload);
                        break;
                }
                switch (key_name) {
                    case 'paths-department_id':
                        context.dispatch('changePathDepartmentId', payload);
                        break;
                }
                switch (key_name) {
                    case 'pages-template_id':
                        context.dispatch('changePageTemplateId', payload);
                        break;
                }
                switch (key_name) {
                    case 'pages-master_page_id':
                        context.dispatch('changePageMasterPageId', payload);
                        break;
                }
                switch (key_name) {
                    case 'pages-frame_id':
                        context.dispatch('changePageFrameId', payload);
                        break;
                }
                switch (key_name) {
                    case 'pages-resource':
                        context.dispatch('changePageResource', payload);
                        break;
                }
                switch (key_name) {
                    case 'pages-relations':
                        context.dispatch('changePageRelations', payload);
                        break;
                }
                switch (key_name) {
                    case 'cities-country_id':
                        context.dispatch('changeCityCountryId', payload);
                        break;
                }
            }

        },
        //resources actions
        changeActionDepartmentId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_department';
            let data = {};
            data[payload.key] = payload.value;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.commit('updateOptions', {key: 'resource_id', value: response.data});
                    // context.commit('setValueAtModel',{key:'resource_id',value:null,index:null,prefix:null});
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        changeResourceDepartmentId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_department';
            let data = {};
            data[payload.key] = payload.value;
            data['resource_id'] = context.getters.model.id;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.commit('updateOptions', {key: 'parent_id', value: response.data.resources});
                    context.commit('updateOptions', {key: 'resource_group_id', value: response.data.resource_groups});
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        changeResourceResourceGroupId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_resource_group';
            let data = {};
            data[payload.key] = payload.value;
            data['resource_id'] = context.getters.model.id;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.commit('updateOptions', {key: 'parent_id', value: response.data.resources});
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        changePathDepartmentId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_department';
            let data = {};
            data[payload.key] = payload.value;
            data['resource_id'] = context.getters.model.id;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.commit('updateOptions', {key: 'action_id', value: response.data});
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        changePageTemplateId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_template';
            let data = {};
            data[payload.key] = payload.value;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.commit('updateOptions', {key: 'master_page_id', value: response.data.master_pages});
                    context.commit('updateOptions', {key: 'frame_id', value: response.data.frames});
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        changePageMasterPageId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_master_page';
            let data = {};
            data[payload.key] = payload.value;
            data.page_id = context.getters.model.id;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.dispatch('setValueAtModel', {key: 'sections', value: response.data.sections});
                    let options = response.data.options;
                    if (options !== undefined && !Array.isArray(options)) {
                        Object.keys(options).forEach(key => {
                            context.commit('updateOptions', {key: key, value: options[key]});
                        });
                    }
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        changePageFrameId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_frame';
            let data = {};
            data[payload.key] = payload.value;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.commit('updateOptions', {
                        key: payload.prefix + '.' + payload.index + '.action_id',
                        value: response.data
                    });
                })
                .catch(error => {
                    // console.log(error);
                })
        },
        changePageResource(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_resource';
            let data = {};
            data[payload.key] = payload.value;

            if (data[payload.key] !== null && data[payload.key] !== '') {
                context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                    .then(response => {
                        context.commit('updateOptions', {
                            key: payload.prefix + '.' + payload.index + '.relations',
                            value: response.data.relations
                        });

                        if (Array.isArray(response.data.fields)) {

                            context.commit('updateOptions', {
                                key: payload.prefix + '.' + payload.index + '.fields',
                                value: response.data.fields
                            });

                            let sort_items = [];
                            response.data.fields.forEach((field) => {

                                if (field.indexOf('.') === -1) {
                                    sort_items.push(field);
                                }
                            });
                            context.commit('updateOptions', {
                                key: payload.prefix + '.' + payload.index + '.order_by',
                                value: sort_items
                            });
                        } else {
                            context.commit('updateOptions', {
                                key: payload.prefix + '.' + payload.index + '.order_by',
                                value: []
                            });
                            context.commit('updateOptions', {
                                key: payload.prefix + '.' + payload.index + '.fields',
                                value: []
                            });
                        }

                    })
                    .catch(error => {
                        console.log(error);
                    })
            } else {
                context.commit('updateOptions', {key: payload.prefix + '.' + payload.index + '.relations', value: []});
                context.commit('updateOptions', {key: payload.prefix + '.' + payload.index + '.fields', value: []});
                context.commit('updateOptions', {key: payload.prefix + '.' + payload.index + '.order_by', value: []});
            }

        },
        changePageRelations(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_relations';
            let data = {};

            let array_prefix = payload.prefix.split(".");
            if (array_prefix.length === 3) {
                let resource = context.getters.model[array_prefix[0]][array_prefix[1]][array_prefix[2]][payload.index].resource;
                data['resource'] = resource;
            }
            data[payload.key] = payload.value;
            if (data.resource) {
                context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                    .then(response => {
                        context.commit('updateOptions', {
                            key: payload.prefix + '.' + payload.index + '.fields',
                            value: response.data
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
            else {
                context.commit('updateOptions', {key: payload.prefix + '.' + payload.index + '.fields', value: []});
            }

        },
        changeCityCountryId(context, payload) {
            let url = context.rootGetters.main_url + '/' + context.rootGetters.resource + '/change_country';
            let data = {};
            data[payload.key] = payload.value;
            context.dispatch('sendRequest', {url: url, data: data}, {root: true})
                .then(response => {
                    context.commit('updateOptions', {
                        key: 'state_id',
                        value: response.data
                    });
                })
                .catch(error => {
                    console.log(error);
                })
        }

    }
};