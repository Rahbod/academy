webpackJsonp([3],{

/***/ 26:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(367)
/* template */
var __vue_template__ = __webpack_require__(402)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/admin/views/SingleView.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7067412c", Component.options)
  } else {
    hotAPI.reload("data-v-7067412c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 367:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__mixins_RouterViewMixin_vue__ = __webpack_require__(25);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__mixins_RouterViewMixin_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__mixins_RouterViewMixin_vue__);
//
//
//
//

var ListView = function ListView(resolve) {
    __webpack_require__.e/* require.ensure */(0/* duplicate */).then((function () {
        resolve(__webpack_require__(21));
    }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};
var FormView = function FormView(resolve) {
    __webpack_require__.e/* require.ensure */(1/* duplicate */).then((function () {
        resolve(__webpack_require__(22));
    }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};
var FileManagerView = function FileManagerView(resolve) {
    __webpack_require__.e/* require.ensure */(6/* duplicate */).then((function () {
        resolve(__webpack_require__(95));
    }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};
var UpdateSettingFormView = function UpdateSettingFormView(resolve) {
    __webpack_require__.e/* require.ensure */(5/* duplicate */).then((function () {
        resolve(__webpack_require__(96));
    }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};
var Profile = function Profile(resolve) {
    __webpack_require__.e/* require.ensure */(11).then((function () {
        resolve(__webpack_require__(293));
    }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};
var Dashboard = function Dashboard(resolve) {
    __webpack_require__.e/* require.ensure */(2/* duplicate */).then((function () {
        resolve(__webpack_require__(93));
    }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
};


/* harmony default export */ __webpack_exports__["default"] = ({
    mixins: [__WEBPACK_IMPORTED_MODULE_0__mixins_RouterViewMixin_vue___default.a],
    components: { ListView: ListView, FormView: FormView, FileManagerView: FileManagerView, UpdateSettingFormView: UpdateSettingFormView, Profile: Profile, Dashboard: Dashboard },
    computed: {
        getComponent: function getComponent() {
            var component = null;
            switch (this.action) {
                case 'create':
                case 'edit':
                    component = 'FormView';
                    break;
                case 'listView':
                    component = 'ListView';
                    break;
                case 'showFileManager':
                    component = 'FileManagerView';
                    break;
                case 'updateSettings':
                    component = 'UpdateSettingFormView';
                    break;
                case 'show':
                    switch (this.resource) {
                        case 'profile':
                            component = 'Profile';
                            break;
                        case 'dashboard':
                            component = 'Dashboard';
                            break;
                    }
                    break;
            }
            return component;
        }
    }
});

/***/ }),

/***/ 402:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.getComponent !== null
    ? _c(_vm.getComponent, { tag: "component" })
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7067412c", module.exports)
  }
}

/***/ })

});