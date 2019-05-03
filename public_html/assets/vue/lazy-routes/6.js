webpackJsonp([6],{

/***/ 409:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(3);
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



/* harmony default export */ __webpack_exports__["default"] = ({
    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["c" /* mapGetters */])(['loading', 'resource', 'base_resource', 'action', 'menu_items', 'flat_menu_items']), {
        current_menu: function current_menu() {
            var _this = this;

            var current_menu = {};
            this.menu_items.forEach(function (menu_item) {
                if (_this.$route.path === '/' + menu_item.url) {
                    current_menu = menu_item;
                }
                if (menu_item.children !== undefined) {
                    menu_item.children.forEach(function (menu_item) {
                        if (_this.$route.path === '/' + menu_item.url) {
                            current_menu = menu_item;
                        }
                        if (menu_item.children !== undefined) {
                            menu_item.children.forEach(function (menu_item) {
                                if (_this.$route.path === '/' + menu_item.url) {
                                    current_menu = menu_item;
                                }
                            });
                        }
                    });
                }
            });

            return current_menu;
        }
    }),
    mounted: function mounted() {
        console.log(this.$route.path);
    }
});

/***/ }),

/***/ 410:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "card" }, [
    _c("div", { staticClass: "card-header header-elements-inline" }, [
      _vm.current_menu.display_name !== undefined
        ? _c("h5", {
            staticClass: "card-title",
            domProps: { textContent: _vm._s(_vm.current_menu.display_name) }
          })
        : _vm._e(),
      _vm._v(" "),
      _vm._m(0)
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card-body" }, [
      _c(
        "div",
        { staticClass: "row" },
        _vm._l(_vm.current_menu.children, function(menu_item) {
          return _c("div", { staticClass: "col-lg-4" }, [
            _c("div", { staticClass: "card" }, [
              _c(
                "div",
                { staticClass: "card-body text-center" },
                [
                  _c("i", {
                    staticClass:
                      " icon-2x text-blue border-blue border-3 rounded-round p-3 mb-3 mt-1",
                    class: [
                      menu_item.icon !== null ? menu_item.icon : "icon-lifebuoy"
                    ]
                  }),
                  _vm._v(" "),
                  _c("h5", {
                    staticClass: "card-title",
                    domProps: { textContent: _vm._s(menu_item.display_name) }
                  }),
                  _vm._v(" "),
                  _c(
                    "router-link",
                    {
                      staticClass: "btn bg-blue",
                      attrs: { to: "/" + menu_item.url, tag: "button" }
                    },
                    [_vm._v(" " + _vm._s(_vm.$t("actions.show")))]
                  )
                ],
                1
              )
            ])
          ])
        })
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "header-elements" }, [
      _c("div", { staticClass: "list-icons" }, [
        _c("a", {
          staticClass: "list-icons-item",
          attrs: { "data-action": "collapse" }
        }),
        _vm._v(" "),
        _c("a", {
          staticClass: "list-icons-item",
          attrs: { "data-action": "fullscreen" }
        }),
        _vm._v(" "),
        _c("a", {
          staticClass: "list-icons-item",
          attrs: { "data-action": "remove" }
        })
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-52e4159c", module.exports)
  }
}

/***/ }),

/***/ 94:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(409)
/* template */
var __vue_template__ = __webpack_require__(410)
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
Component.options.__file = "resources/js/admin/views/ResourceView.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-52e4159c", Component.options)
  } else {
    hotAPI.reload("data-v-52e4159c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});