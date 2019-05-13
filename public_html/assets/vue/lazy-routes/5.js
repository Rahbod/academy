webpackJsonp([5],{

/***/ 112:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(115)
/* template */
var __vue_template__ = null
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
Component.options.__file = "resources/js/admin/mixins/GlobalMixin.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-286d00bf", Component.options)
  } else {
    hotAPI.reload("data-v-286d00bf", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 115:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(3);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };


/* harmony default export */ __webpack_exports__["default"] = ({

    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["c" /* mapGetters */])(['actions'])),
    methods: {
        hasAction: function hasAction(action_name, resource_name) {
            if (resource_name === undefined) {
                if (this.actions[action_name] === 1) {
                    return true;
                }
                return false;
            } else {

                if (this.actions[resource_name] !== undefined && this.actions[resource_name][action_name] === 1) {
                    return true;
                }
                return false;
            }
        }
    },
    mounted: function mounted() {},
    destroyed: function destroyed() {}
});

/***/ }),

/***/ 292:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__view_components_ShowContent_vue__ = __webpack_require__(293);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__view_components_ShowContent_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__view_components_ShowContent_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vuex__ = __webpack_require__(3);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
    components: { modal_content: __WEBPACK_IMPORTED_MODULE_0__view_components_ShowContent_vue___default.a },
    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_1_vuex__["c" /* mapGetters */])('show', ['model', 'info', 'loading'])),
    methods: {
        closeModal: function closeModal() {
            $('#close-modal').trigger('click');
        }
    }
});

/***/ }),

/***/ 293:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(294)
/* template */
var __vue_template__ = __webpack_require__(295)
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
Component.options.__file = "resources/js/admin/view_components/ShowContent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4848d02f", Component.options)
  } else {
    hotAPI.reload("data-v-4848d02f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 294:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__mixins_GlobalMixin_vue__ = __webpack_require__(112);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__mixins_GlobalMixin_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__mixins_GlobalMixin_vue__);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
    mixins: [__WEBPACK_IMPORTED_MODULE_1__mixins_GlobalMixin_vue___default.a],
    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["c" /* mapGetters */])('show', ['model', 'info']), Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["c" /* mapGetters */])(['resource', 'route_name', 'actions'])),
    methods: {
        closeModal: function closeModal() {
            this.$emit('closeModal');
        },
        showEditForm: function showEditForm() {
            this.$emit('closeModal');
            var vm = this;
            setTimeout(function () {
                vm.$router.push({ name: vm.route_name + '-edit', params: { id: vm.model.id } });
            });
        }
    }
});

/***/ }),

/***/ 295:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("table", { staticClass: "table table-bordered table-hover" }, [
      _c("thead", { staticClass: "thead-dark" }, [
        _c("tr", [
          _c(
            "th",
            {
              staticStyle: { "text-align": "center" },
              attrs: { colspan: "2" }
            },
            [
              _c("b", {
                domProps: {
                  textContent: _vm._s(_vm.$t(_vm.resource + ":title"))
                }
              })
            ]
          )
        ])
      ]),
      _vm._v(" "),
      _c(
        "tbody",
        [
          _vm._l(_vm.info, function(model_info, key) {
            return key !== "items" && _vm.model[model_info.name] !== undefined
              ? _c("tr", [
                  _c("th", { staticStyle: { "text-align": "center" } }, [
                    _c("b", {
                      domProps: {
                        textContent: _vm._s(
                          _vm.$t(_vm.resource + ":items." + model_info.name)
                        )
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _c("td", {
                    domProps: { innerHTML: _vm._s(_vm.model[model_info.name]) }
                  })
                ])
              : _vm._e()
          }),
          _vm._v(" "),
          _vm._l(_vm.info.items, function(relation) {
            return _vm.info.items !== undefined &&
              _vm.model[relation.name] !== undefined
              ? [
                  !Array.isArray(_vm.model[relation.name])
                    ? _vm._l(relation.info, function(model_info, key) {
                        return _vm.model[relation.name][model_info.name] !==
                          undefined
                          ? _c("tr", [
                              _c(
                                "th",
                                { staticStyle: { "text-align": "center" } },
                                [
                                  _c("b", {
                                    domProps: {
                                      textContent: _vm._s(
                                        _vm.$t(
                                          _vm.resource +
                                            ":items." +
                                            relation.name +
                                            "." +
                                            model_info.name
                                        )
                                      )
                                    }
                                  })
                                ]
                              ),
                              _vm._v(" "),
                              _c("td", {
                                domProps: {
                                  innerHTML: _vm._s(
                                    _vm.model[relation.name][model_info.name]
                                  )
                                }
                              })
                            ])
                          : _vm._e()
                      })
                    : _vm._e(),
                  _vm._v(" "),
                  Array.isArray(_vm.model[relation.name])
                    ? [
                        relation.name === "attachments"
                          ? [
                              _c(
                                "th",
                                { staticStyle: { "text-align": "center" } },
                                [
                                  _c("b", {
                                    domProps: {
                                      textContent: _vm._s(
                                        _vm.$t(
                                          _vm.resource +
                                            ":relations." +
                                            relation.name
                                        )
                                      )
                                    }
                                  })
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "td",
                                _vm._l(_vm.model[relation.name], function(
                                  attachment
                                ) {
                                  return _c(
                                    "a",
                                    { attrs: { href: attachment.source } },
                                    [
                                      _vm._v(
                                        " " + _vm._s(attachment.title) + " "
                                      )
                                    ]
                                  )
                                })
                              )
                            ]
                          : _vm._e()
                      ]
                    : _vm._e()
                ]
              : _vm._e()
          })
        ],
        2
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "mt-1" }, [
      _c("div", { staticClass: "text-center" }, [
        _vm.hasAction("edit")
          ? _c(
              "button",
              {
                staticClass: "btn btn bg-teal-400",
                attrs: { type: "button" },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    return _vm.showEditForm($event)
                  }
                }
              },
              [
                _vm._v(_vm._s(_vm.$t("actions.edit"))),
                _c("i", { staticClass: "icon-undo2 ml-2" })
              ]
            )
          : _vm._e(),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-danger",
            attrs: { type: "button" },
            on: {
              click: function($event) {
                _vm.closeModal()
              }
            }
          },
          [
            _vm._v(_vm._s(_vm.$t("actions.cancel")) + " "),
            _c("i", { staticClass: "icon-cross2 ml-2" })
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4848d02f", module.exports)
  }
}

/***/ }),

/***/ 296:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("button", {
      staticStyle: { display: "none" },
      attrs: {
        id: "open-modal-view",
        "data-toggle": "modal",
        "data-target": "#modal-view"
      }
    }),
    _vm._v(" "),
    _c("div", { staticClass: "modal fade", attrs: { id: "modal-view" } }, [
      _c("div", { staticClass: "modal-dialog modal-lg" }, [
        _c("div", { staticClass: "modal-content" }, [
          _c("div", { staticClass: "modal-header" }, [
            _c(
              "button",
              {
                staticClass: "close",
                attrs: {
                  type: "button",
                  id: "close-modal",
                  "data-dismiss": "modal"
                },
                on: { click: function($event) {} }
              },
              [_vm._v("×\n                    ")]
            )
          ]),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "modal-body px-5",
              staticStyle: { "min-height": "500px" },
              attrs: { id: "modal_view_body" }
            },
            [
              !_vm.loading
                ? _c("modal_content", { on: { closeModal: _vm.closeModal } })
                : _vm._e()
            ],
            1
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-ea8a2ebe", module.exports)
  }
}

/***/ }),

/***/ 93:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(292)
/* template */
var __vue_template__ = __webpack_require__(296)
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
Component.options.__file = "resources/js/admin/views/ShowView.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-ea8a2ebe", Component.options)
  } else {
    hotAPI.reload("data-v-ea8a2ebe", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});