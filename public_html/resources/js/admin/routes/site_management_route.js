import VueRouter from 'vue-router';

import RouterViewApp from '../view_components/RouterViewApp.vue';
import NestedRouterViewApp from '../view_components/NestedRouterViewApp.vue';
const dashboard = resolve => require(['../views/Dashboard'], resolve);

const ListView=resolve=>{
    require.ensure(['../views/ListView.vue'],()=>{
        resolve(require('../views/ListView.vue'))
    })
};
const FormView=resolve=>{
    require.ensure(['../views/FormView.vue'],()=>{
        resolve(require('../views/FormView.vue'))
    })
};
const ShowView=resolve=>{
    require.ensure(['../views/ShowView.vue'],()=>{
        resolve(require('../views/ShowView.vue'))
    })
};
const ResourceView = resolve => {
    require.ensure(['../views/ResourceView.vue'], () => {
        resolve(require('../views/ResourceView.vue'))
    })
};
const SingleView = resolve => {
    require.ensure(['../views/SingleView.vue'], () => {
        resolve(require('../views/SingleView.vue'))
    })
};
const UpdateSettingFormView=resolve=>{
    require.ensure(['../views/settings/FormView.vue'],()=>{
        resolve(require('../views/settings/FormView.vue'))
    })
};
const RoleFormView=resolve=>{
    require.ensure(['../views/roles/FormView.vue'],()=>{
        resolve(require('../views/roles/FormView.vue'))
    })
};
const MenuFormView=resolve=>{
    require.ensure(['../views/menus/FormView.vue'],()=>{
        resolve(require('../views/menus/FormView.vue'))
    })
};

export default new VueRouter ({
    routes:[
        {
            component: SingleView,
            path: '/profile',
            meta: {resource: 'profile',action: 'show'},
        },
        {
            component: RouterViewApp,
            path: '/users',
            meta: { resource: 'users' },
            children:[
                {
                    component: ResourceView,
                    path: '/',
                    name: 'users-resource-view',
                },
                {
                    component: ListView,
                    path: 'list-view',
                    name: 'users-list-view',
                    meta: { action: 'listView' },
                },
                {
                    component: FormView,
                    path: 'create',
                    name: 'users-create',
                    meta: { action: 'create' },
                },
                {
                    component: FormView,
                    path: ':id/edit',
                    name: 'users-edit',
                    meta: { action: 'edit' },
                },
                {
                    component: ShowView,
                    path: ':id',
                    name: 'users-show',
                },

            ]
        },
        {
            component: RouterViewApp,
            path: '/settings',
            meta: { resource: 'settings' },
            children:[
                {
                    component: ResourceView,
                    path: '/',
                    name: 'settings-resource-view',
                },
                {
                    component: UpdateSettingFormView,
                    path: 'update_all_settings',
                    name: 'update_all_settings',
                    meta: { action: 'updateAllSettings' },
                },

            ]
        },
        {
            component: RouterViewApp,
            path: '/roles',
            meta: { resource: 'roles' },
            children:[
                {
                    component: ResourceView,
                    path: '/',
                    name: 'roles-resource-view',
                },
                {
                    component: ListView,
                    path: 'list-view',
                    name: 'roles-list-view',
                    meta: { action: 'listView' },
                },
                {
                    component: RoleFormView,
                    path: 'create',
                    name: 'roles-create',
                    meta: { action: 'create' },
                },
                {
                    component: RoleFormView,
                    path: ':id/edit',
                    name: 'roles-edit',
                    meta: { action: 'edit' },
                },
                {
                    component: ShowView,
                    path: ':id',
                    name: 'roles-show',
                },

            ]
        },
        {
            component: NestedRouterViewApp,
            path: '/menus',
            meta: { base_resource: 'menus' },
            children:[
                {
                    component: ResourceView,
                    path: '/',
                    name: 'base_menus-resource-view',
                },
                {
                    component: RouterViewApp,
                    path: 'menus',
                    meta: { resource: 'menus' },
                    children:[
                        {
                            component: ResourceView,
                            path: '/',
                            name: 'menus-resource-view',
                        },
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'menus-list-view',
                            meta: { action: 'listView'},
                        },
                        {
                            component: MenuFormView,
                            path: 'create',
                            name: 'menus-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: MenuFormView,
                            path: ':id/edit',
                            name: 'menus-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'menus-show',
                        },

                    ]
                },
                {
                    component: RouterViewApp,
                    path: 'menu_items',
                    meta: { resource: 'menu_items' },
                    children:[
                        {
                            component: ResourceView,
                            path: '/',
                            name: 'menu_items-resource-view',
                        },
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'menu_items-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'menu_items-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'menu_items-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'menu_items-show',
                        },

                    ]
                },
            ]
        },
    ]
});