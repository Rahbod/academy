import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

import {form} from "./modules/form";
import {filterable_table} from "./modules/filterable_table";
import {show} from "./modules/show";

export default new Vuex.Store({
    state: {
        el: null,
        loading: true,
        lang: 'fa',
        direction: 'rtl',
        base_url: '',
        action: null,
        resource: null,
        base_resource: null,
        use_base_resource: false,
        department: '',
        user: {},
        actions: {},
        menu_items: [],
    },
    getters: {
        loading(state) {
            return state.loading;
        },
        el(state) {
            return state.el;
        },
        direction(state) {
            return state.direction;
        },
        lang(state) {
            return state.lang;
        },
        action(state) {
            return state.action;
        },
        department(state) {
            return state.department;
        },
        resource(state) {
            return state.resource;
        },
        base_resource(state) {
            return state.base_resource;
        },
        use_base_resource(state) {
            return state.use_base_resource;
        },
        route_name(state){
            let route_name=state.resource;
            if(state.use_base_resource !== false && state.base_resource !== null){
                route_name=state.base_resource+'-'+state.resource;
            }
            return route_name;
        },
        user(state) {
            return state.user;
        },
        menu_items(state) {
            return state.menu_items;
        },
        flat_menu_items(state){
            let menu_items={};
            state.menu_items.forEach((menu_item)=>{
                menu_items['/'+menu_item.url]=menu_item.display_name;
                if(menu_item.children !== undefined){
                    menu_item.children.forEach((menu_item)=>{
                        menu_items['/'+menu_item.url]=menu_item.display_name;
                        if(menu_item.children !== undefined){
                            menu_item.children.forEach((menu_item)=>{
                                menu_items['/'+menu_item.url]=menu_item.display_name;
                            })
                        }
                    })
                }
            });

            return menu_items;
        },
        base_url(state) {
            return state.base_url;
        },
        main_url(state) {
            let main_url = state.base_url + '/' + state.lang + '/' + state.department;
            if (state.base_resource !== null && state.use_base_resource === true) {
                main_url += '/' + state.base_resource;
            }
            main_url += '/' + state.resource;
            return main_url;
            // return state.base_url + '/' + state.lang + '/' + state.department;
        },
        base_resource_url(state) {
            let url= state.base_url + '/' + state.lang + '/' + state.department;
            if (state.base_resource !== null && state.use_base_resource === true) {
                url += '/' + state.base_resource;
            }
            url += '/' + state.resource;
            return url;
        },
        resource_routes(state) {
            let main_url = state.base_url + '/' + state.lang + '/' + state.department;
            if (state.base_resource !== null && state.use_base_resource === true) {
                main_url += '/' + state.base_resource;
            }
            main_url += '/' + state.resource;
            return {
                index: {
                    url: main_url + '/',
                    method: 'GET'
                },
                list_view: {
                    url: main_url + '/list-view',
                    method: 'GET'
                },
                create: {
                    url: main_url + '/create',
                    method: 'GET'
                },
                store: {
                    url: main_url,
                    method: 'POST'
                },
                show: {
                    url: main_url + '/:id',
                    method: 'GET',
                    params: 'id'
                },
                edit: {
                    url: main_url + '/:id/edit',
                    method: 'GET',
                    params: 'id'
                },
                update: {
                    url: main_url + '/:id',
                    method: 'PUT',
                    params: 'id'
                },
                delete: {
                    url: main_url + '/:id',
                    method: 'DELETE',
                    params: 'id'
                },
            }
        },
        actions(state) {
            return state.actions;
        },
    },
    mutations: {
        setLoading(state, loading) {
            state.loading = loading;
        },
        setEl(state, el) {
            state.el = el;
        },
        setLang(state, lang) {
            state.lang = lang;
        },
        setDirection(state, direction) {
            state.direction = direction;
        },
        setBaseUrl(state, url) {
            state.base_url = url;
        },
        setDepartment(state, department) {
            state.department = department;
        },
        setAction(state, action) {
            state.action = action;
        },
        setResource(state, resource) {
            state.resource = resource;
        },
        setBaseResource(state, base_resource) {
            state.base_resource = base_resource;
        },
        setUseBaseResource(state, use_base_resource) {
            state.use_base_resource = use_base_resource;
        },
        setAuthUser(state, user) {
            state.user = user;
        },
        setMenuItems(state, menu_items) {
            state.menu_items = menu_items;
        },
        setActions(state, actions) {
            state.actions = actions;
        }
    },
    actions: {
        getResourceInfo(context) {
            let resource_routes = context.getters.resource_routes;
            // console.log(resource_routes);
            let url = resource_routes.index.url;
            context.commit('setActions', {});

            return new Promise((resolve, reject) => {
                context.dispatch('sendRequest',{url,method:'get',el:context.state.el})
                    .then(response => {
                        if (response.data.actions !== undefined) {
                            context.commit('setActions', response.data.actions);
                        }
                        let fields = [];
                        if (response.data.fields !== undefined) {
                            fields = response.data.fields;
                        }
                        context.dispatch('filterable_table/setFields', fields);
                        context.dispatch('form/setInfo', fields);
                        context.dispatch('show/setInfo', fields);
                        resolve(response);
                    })
                    .catch(error => {

                        reject(error);
                    })
            });

        },

        checkAuth(context, error) {
            if (error.response !== undefined && error.response.status == 401) {
                let redirect = window.location.origin + window.location.pathname;
                window.location = redirect;
            }
        },

        sendRequest(context, payload) {
            if (payload.method === undefined) {
                payload.method = 'post';
            }
            let el='.content';
            if(payload.el !== undefined){
                el=payload.el;
                delete payload.el
            }
            return new Promise((resolve, reject) => {
                if (payload.url !== null && payload.url !== undefined) {
                    context.dispatch('setViewLoading', {el: el, status: true});
                    // axios.post(url, data)
                    axios(payload)
                        .then(function (response) {
                            if (response.data.message !== undefined) {
                                context.dispatch('showMessage', {
                                    type: 'success',
                                    message: response.data.message
                                })
                            }
                            resolve(response);
                        })
                        .catch(function (error) {
                            context.dispatch('checkAuth', error);

                            if (error.response.data.message !== undefined) {
                                context.dispatch('showMessage', {
                                    type: 'error',
                                    message: error.response.data.message
                                })
                            }
                            reject(error);
                        })
                        .finally(() => {
                            context.dispatch('setViewLoading', {el: el, status: false});
                        })
                }
                else {
                    reject({'message': 'url is not defined!'})
                }
            });
        },

        //view
        setViewLoading(context, payload) {
            let el = payload.el;
            let status = payload.status;
            if(el===null){
                el='body'
            }
            if (status) {
                $(el).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            }
            else {
                $(el).unblock();
            }

        },
        collapseCard(context, el) {
            var $target = $(el),
                slidingSpeed = 150;

            $target.parents('.card').toggleClass('card-collapsed');
            $target.toggleClass('rotate-180');
            $target.closest('.card').children('.card-header').nextAll().slideToggle(slidingSpeed);
        },
        fullScreen(context, el) {
            var $target = $(el),
                cardFullscreen = $target.closest('.card'),
                overflowHiddenClass = 'overflow-hidden',
                collapsedClass = 'collapsed-in-fullscreen',
                fullscreenAttr = 'data-fullscreen';

            // Toggle classes on card
            cardFullscreen.toggleClass('fixed-top h-100 rounded-0');

            // Configure
            if (!cardFullscreen.hasClass('fixed-top')) {
                $target.removeAttr(fullscreenAttr);
                cardFullscreen.children('.' + collapsedClass).removeClass('show');
                $('body').removeClass(overflowHiddenClass);
                $target.siblings('[data-action=move], [data-action=remove], [data-action=collapse]').removeClass('d-none');
            }
            else {
                $target.attr(fullscreenAttr, 'active');
                cardFullscreen.removeAttr('style').children('.collapse:not(.show)').addClass('show ' + collapsedClass);
                $('body').addClass(overflowHiddenClass);
                $target.siblings('[data-action=move], [data-action=remove], [data-action=collapse]').addClass('d-none');
            }
        },
        showMessage(context, payload) {
            let icon = 'icon-checkmark3';
            if (payload.type === 'error') {
                icon = 'icon-blocked';
            }
            var stack_top_left = {"dir1": "down", "dir2": "right", "push": "top"};
            new PNotify({
                text: payload.message,
                delay: 3000,
                icon: icon,
                type: payload.type,
                addclass: 'stack-top-right',
                stack: stack_top_left
            });
        },
    },
    modules: {
        form: form,
        filterable_table: filterable_table,
        show:show
    }

});