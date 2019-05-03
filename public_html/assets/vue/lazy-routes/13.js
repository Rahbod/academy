webpackJsonp([13],{

/***/ 122:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(359)
/* template */
var __vue_template__ = __webpack_require__(365)
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
Component.options.__file = "resources/js/admin/view_components/forms/basic_form/inputs/ImageInput.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-cc4e9d10", Component.options)
  } else {
    hotAPI.reload("data-v-cc4e9d10", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 359:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_picture_input__ = __webpack_require__(360);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_picture_input___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue_picture_input__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__mixins_InputMixin_vue__ = __webpack_require__(110);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__mixins_InputMixin_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__mixins_InputMixin_vue__);
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
    mixins: [__WEBPACK_IMPORTED_MODULE_1__mixins_InputMixin_vue___default.a],
    components: { 'picture-input': __WEBPACK_IMPORTED_MODULE_0_vue_picture_input___default.a },
    methods: {
        onChange: function onChange(image) {
            //                console.log('New picture selected!');
            if (image) {
                //                    console.log('Picture loaded.');
                this.$emit('change', image);
            } else {
                console.log('FileReader API not supported: use the <form>, Luke!');
            }
        }
    }
});

/***/ }),

/***/ 360:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(361)
}
var normalizeComponent = __webpack_require__(1)
/* script */
var __vue_script__ = __webpack_require__(363)
/* template */
var __vue_template__ = __webpack_require__(364)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-431cb064"
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
Component.options.__file = "node_modules/vue-picture-input/PictureInput.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-431cb064", Component.options)
  } else {
    hotAPI.reload("data-v-431cb064", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 361:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(362);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("17f8b268", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../css-loader/index.js!../vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-431cb064\",\"scoped\":true,\"hasInlineConfig\":true}!../vue-loader/lib/selector.js?type=styles&index=0!./PictureInput.vue", function() {
     var newContent = require("!!../css-loader/index.js!../vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-431cb064\",\"scoped\":true,\"hasInlineConfig\":true}!../vue-loader/lib/selector.js?type=styles&index=0!./PictureInput.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 362:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(11)(false);
// imports


// module
exports.push([module.i, "\n.picture-input[data-v-431cb064] {\n  width: 100%;\n  margin: 0 auto;\n  text-align: center;\n}\n.preview-container[data-v-431cb064] {\n  width: 100%;\n  box-sizing: border-box;\n  margin: 0 auto;\n  cursor: pointer;\n  overflow: hidden;\n}\n.picture-preview[data-v-431cb064] {\n  width: 100%;\n  height: 100%;\n  position: relative;\n  z-index: 10001;\n  box-sizing: border-box;\n  background-color: rgba(200,200,200,.25);\n}\n.picture-preview.dragging-over[data-v-431cb064] {\n  filter: brightness(0.5);\n}\n.picture-inner[data-v-431cb064] {\n  position: relative;\n  z-index: 10002;\n  pointer-events: none;\n  box-sizing: border-box;\n  margin: 1em auto;\n  padding: 0.5em;\n  border: .3em dashed rgba(66,66,66,.15);\n  border-radius: 8px;\n  width: calc(100% - 2.5em);\n  height: calc(100% - 2.5em);\n  display: table;\n}\n.picture-inner .picture-inner-text[data-v-431cb064] {\n  display: table-cell;\n  vertical-align: middle;\n  text-align: center;\n  font-size: 2em;\n  line-height: 1.5;\n}\nbutton[data-v-431cb064] {\n  margin: 1em .25em;\n  cursor: pointer;\n}\ninput[type=file][data-v-431cb064] {\n  display: none;\n}\n", ""]);

// exports


/***/ }),

/***/ 363:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

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
  name: 'picture-input',
  props: {
    width: {
      type: [String, Number],
      default: Number.MAX_SAFE_INTEGER
    },
    height: {
      type: [String, Number],
      default: Number.MAX_SAFE_INTEGER
    },
    margin: {
      type: [String, Number],
      default: 0
    },
    accept: {
      type: String,
      default: 'image/*'
    },
    size: {
      type: [String, Number],
      default: Number.MAX_SAFE_INTEGER
    },
    name: {
      type: String,
      default: null
    },
    id: {
      type: [String, Number],
      default: null
    },
    buttonClass: {
      type: String,
      default: 'btn btn-primary button'
    },
    removeButtonClass: {
      type: String,
      default: 'btn btn-secondary button secondary'
    },
    aspectButtonClass: {
      type: String,
      default: 'btn btn-secondary button secondary'
    },
    prefill: {
      type: [String, File],
      default: ''
    },
    prefillOptions: {
      type: Object,
      default: function _default() {
        return {};
      }
    },
    crop: {
      type: Boolean,
      default: true
    },
    radius: {
      type: [String, Number],
      default: 0
    },
    removable: {
      type: Boolean,
      default: false
    },
    hideChangeButton: {
      type: Boolean,
      default: false
    },
    autoToggleAspectRatio: {
      type: Boolean,
      default: false
    },
    toggleAspectRatio: {
      type: Boolean,
      default: false
    },
    changeOnClick: {
      type: Boolean,
      default: true
    },
    plain: {
      type: Boolean,
      default: false
    },
    zIndex: {
      type: Number,
      default: 10000
    },
    alertOnError: {
      type: Boolean,
      default: true
    },
    customStrings: {
      type: Object,
      default: function _default() {
        return {};
      }
    }
  },
  watch: {
    prefill: function prefill() {
      if (this.prefill) {
        this.preloadImage(this.prefill, this.prefillOptions);
      } else {
        this.removeImage();
      }
    }
  },
  data: function data() {
    return {
      imageSelected: false,
      previewHeight: 0,
      previewWidth: 0,
      draggingOver: false,
      canvasWidth: 0,
      canvasHeight: 0,
      strings: {
        upload: '<p>Your device does not support file uploading.</p>',
        drag: 'Drag an image or <br>click here to select a file',
        tap: 'Tap here to select a photo <br>from your gallery',
        change: 'Change Photo',
        aspect: 'Landscape/Portrait',
        remove: 'Remove Photo',
        select: 'Select a Photo',
        selected: '<p>Photo successfully selected!</p>',
        fileSize: 'The file size exceeds the limit',
        fileType: 'This file type is not supported.'
      }
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.updateStrings();
    if (this.prefill) {
      this.preloadImage(this.prefill, this.prefillOptions);
    }

    this.$nextTick(function () {
      window.addEventListener('resize', _this.onResize);
      _this.onResize();
    });
    if (this.supportsPreview) {
      this.pixelRatio = Math.round(window.devicePixelRatio || window.screen.deviceXDPI / window.screen.logicalXDPI);
      var canvas = this.$refs.previewCanvas;
      if (canvas.getContext) {
        this.context = canvas.getContext('2d');
        this.context.scale(this.pixelRatio, this.pixelRatio);
      }
    }
    if (this.accept !== 'image/*') {
      this.fileTypes = this.accept.split(',');
      this.fileTypes = this.fileTypes.map(function (s) {
        return s.trim();
      });
    }

    this.canvasWidth = this.width;
    this.canvasHeight = this.height;

    this.$on('error', this.onError);
  },
  beforeDestroy: function beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
    this.$off('error', this.onError);
  },

  methods: {
    updateStrings: function updateStrings() {
      for (var s in this.customStrings) {
        if (s in this.strings && typeof this.customStrings[s] === 'string') {
          this.strings[s] = this.customStrings[s];
        }
      }
    },
    onClick: function onClick() {
      if (!this.imageSelected) {
        this.selectImage();
        return;
      }

      if (this.changeOnClick) {
        this.selectImage();
      }

      this.$emit('click');
    },
    onResize: function onResize() {
      this.resizeCanvas();

      if (this.imageObject) {
        this.drawImage(this.imageObject);
      }
    },
    onDragStart: function onDragStart() {
      if (!this.supportsDragAndDrop) {
        return;
      }
      this.draggingOver = true;
    },
    onDragStop: function onDragStop() {
      if (!this.supportsDragAndDrop) {
        return;
      }
      this.draggingOver = false;
    },
    onFileDrop: function onFileDrop(e) {
      this.onDragStop();
      this.onFileChange(e);
    },
    onFileChange: function onFileChange(e, prefill) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) {
        return;
      }
      if (files[0].size <= 0 || files[0].size > this.size * 1024 * 1024) {
        this.$emit('error', {
          type: 'fileSize',
          fileSize: files[0].size,
          fileType: files[0].type,
          fileName: files[0].name,
          message: this.strings.fileSize + ' (' + this.size + 'MB)'
        });
        return;
      }
      if (files[0].name === this.fileName && files[0].size === this.fileSize && this.fileModified === files[0].lastModified) {
        return;
      }

      this.file = files[0];
      this.fileName = files[0].name;
      this.fileSize = files[0].size;
      this.fileModified = files[0].lastModified;
      this.fileType = files[0].type;

      if (this.accept === 'image/*') {
        if (files[0].type.substr(0, 6) !== 'image/') {
          return;
        }
      } else {
        if (this.fileTypes.indexOf(files[0].type) === -1) {
          this.$emit('error', {
            type: 'fileType',
            fileSize: files[0].size,
            fileType: files[0].type,
            fileName: files[0].name,
            message: this.strings.fileType
          });
          return;
        }
      }
      this.imageSelected = true;
      this.image = '';
      if (this.supportsPreview) {
        this.loadImage(files[0], prefill || false);
      } else {
        if (prefill) {
          this.$emit('prefill');
        } else {
          this.$emit('change', this.image);
        }
      }
    },
    onError: function onError(error) {
      if (this.alertOnError) {
        alert(error.message);
      }
    },
    loadImage: function loadImage(file, prefill) {
      var _this2 = this;

      this.getEXIFOrientation(file, function (orientation) {
        _this2.setOrientation(orientation);
        var reader = new FileReader();
        reader.onload = function (e) {
          _this2.image = e.target.result;
          if (prefill) {
            _this2.$emit('prefill');
          } else {
            _this2.$emit('change', _this2.image);
          }
          _this2.imageObject = new Image();
          _this2.imageObject.onload = function () {
            if (_this2.autoToggleAspectRatio) {
              var canvasOrientation = _this2.getOrientation(_this2.canvasWidth, _this2.canvasHeight);
              var imageOrientation = _this2.getOrientation(_this2.imageObject.width, _this2.imageObject.height);
              if (canvasOrientation !== imageOrientation) {
                _this2.rotateCanvas();
              }
            }
            _this2.drawImage(_this2.imageObject);
          };
          _this2.imageObject.src = _this2.image;
        };
        reader.readAsDataURL(file);
      });
    },
    drawImage: function drawImage(image) {
      this.imageWidth = image.width;
      this.imageHeight = image.height;
      this.imageRatio = image.width / image.height;
      var offsetX = 0;
      var offsetY = 0;
      var scaledWidth = this.previewWidth;
      var scaledHeight = this.previewHeight;
      var previewRatio = this.previewWidth / this.previewHeight;
      if (this.crop) {
        if (this.imageRatio >= previewRatio) {
          scaledWidth = scaledHeight * this.imageRatio;
          offsetX = (this.previewWidth - scaledWidth) / 2;
        } else {
          scaledHeight = scaledWidth / this.imageRatio;
          offsetY = (this.previewHeight - scaledHeight) / 2;
        }
      } else {
        if (this.imageRatio >= previewRatio) {
          scaledHeight = scaledWidth / this.imageRatio;
          offsetY = (this.previewHeight - scaledHeight) / 2;
        } else {
          scaledWidth = scaledHeight * this.imageRatio;
          offsetX = (this.previewWidth - scaledWidth) / 2;
        }
      }
      var canvas = this.$refs.previewCanvas;
      canvas.style.background = 'none';
      canvas.width = this.previewWidth * this.pixelRatio;
      canvas.height = this.previewHeight * this.pixelRatio;
      this.context.setTransform(1, 0, 0, 1, 0, 0);
      this.context.clearRect(0, 0, canvas.width, canvas.height);
      if (this.rotate) {
        this.context.translate(offsetX * this.pixelRatio, offsetY * this.pixelRatio);
        this.context.translate(scaledWidth / 2 * this.pixelRatio, scaledHeight / 2 * this.pixelRatio);
        this.context.rotate(this.rotate);
        offsetX = -scaledWidth / 2;
        offsetY = -scaledHeight / 2;
      }
      this.context.drawImage(image, offsetX * this.pixelRatio, offsetY * this.pixelRatio, scaledWidth * this.pixelRatio, scaledHeight * this.pixelRatio);
    },
    selectImage: function selectImage() {
      this.$refs.fileInput.click();
    },
    removeImage: function removeImage() {
      this.$refs.fileInput.value = '';
      this.$refs.fileInput.type = '';
      this.$refs.fileInput.type = 'file';
      this.fileName = '';
      this.fileType = '';
      this.fileSize = 0;
      this.fileModified = 0;
      this.imageSelected = false;
      this.image = '';
      this.file = null;
      this.imageObject = null;
      this.$refs.previewCanvas.style.backgroundColor = 'rgba(200,200,200,.25)';
      this.$refs.previewCanvas.width = this.previewWidth * this.pixelRatio;
      this.$emit('remove');
    },
    rotateImage: function rotateImage() {
      this.rotateCanvas();

      if (this.imageObject) {
        this.drawImage(this.imageObject);
      }

      var newOrientation = this.getOrientation(this.canvasWidth, this.canvasHeight);
      this.$emit('aspectratiochange', newOrientation);
    },
    resizeCanvas: function resizeCanvas() {
      var previewRatio = this.canvasWidth / this.canvasHeight;
      var newWidth = this.$refs.container.clientWidth;
      if (!this.toggleAspectRatio && newWidth === this.containerWidth) {
        return;
      }
      this.containerWidth = newWidth;
      this.previewWidth = Math.min(this.containerWidth - this.margin * 2, this.canvasWidth);
      this.previewHeight = this.previewWidth / previewRatio;
    },
    getOrientation: function getOrientation(width, height) {
      var orientation = 'square';

      if (width > height) {
        orientation = 'landscape';
      } else if (width < height) {
        orientation = 'portrait';
      }

      return orientation;
    },
    switchCanvasOrientation: function switchCanvasOrientation() {
      var canvasWidth = this.canvasWidth;
      var canvasHeight = this.canvasHeight;

      this.canvasWidth = canvasHeight;
      this.canvasHeight = canvasWidth;
    },
    rotateCanvas: function rotateCanvas() {
      this.switchCanvasOrientation();
      this.resizeCanvas();
    },
    setOrientation: function setOrientation(orientation) {
      this.rotate = false;
      if (orientation === 8) {
        this.rotate = -Math.PI / 2;
      } else if (orientation === 6) {
        this.rotate = Math.PI / 2;
      } else if (orientation === 3) {
        this.rotate = -Math.PI;
      }
    },
    getEXIFOrientation: function getEXIFOrientation(file, callback) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var view = new DataView(e.target.result);
        if (view.getUint16(0, false) !== 0xFFD8) {
          return callback(-2);
        }
        var length = view.byteLength;
        var offset = 2;
        while (offset < length) {
          var marker = view.getUint16(offset, false);
          offset += 2;
          if (marker === 0xFFE1) {
            if (view.getUint32(offset += 2, false) !== 0x45786966) {
              return callback(-1);
            }
            var little = view.getUint16(offset += 6, false) === 0x4949;
            offset += view.getUint32(offset + 4, little);
            var tags = view.getUint16(offset, little);
            offset += 2;
            for (var i = 0; i < tags; i++) {
              if (view.getUint16(offset + i * 12, little) === 0x0112) {
                return callback(view.getUint16(offset + i * 12 + 8, little));
              }
            }
          } else if ((marker & 0xFF00) !== 0xFF00) {
            break;
          } else {
            offset += view.getUint16(offset, false);
          }
        }
        return callback(-1);
      };
      reader.readAsArrayBuffer(file.slice(0, 65536));
    },
    preloadImage: function preloadImage(source, options) {
      var _this4 = this;

      // ie 11 support
      var File = window.File;
      try {
        new File([], ''); // eslint-disable-line
      } catch (e) {
        File = function (_Blob) {
          _inherits(File, _Blob);

          function File(chunks, filename) {
            var opts = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

            _classCallCheck(this, File);

            var _this3 = _possibleConstructorReturn(this, (File.__proto__ || Object.getPrototypeOf(File)).call(this, chunks, opts));

            _this3.lastModifiedDate = new Date();
            _this3.lastModified = +_this3.lastModifiedDate;
            _this3.name = filename;
            return _this3;
          }

          return File;
        }(Blob);
      }
      options = Object.assign({}, options);
      if ((typeof source === 'undefined' ? 'undefined' : _typeof(source)) === 'object') {
        this.imageSelected = true;
        this.image = '';
        if (this.supportsPreview) {
          this.loadImage(source, true);
        } else {
          this.$emit('prefill');
        }
        return;
      }
      var headers = new Headers();
      headers.append('Accept', 'image/*');
      fetch(source, {
        method: 'GET',
        mode: 'cors',
        headers: headers
      }).then(function (response) {
        return response.blob();
      }).then(function (imageBlob) {
        var e = { target: { files: [] } };
        var fileName = options.fileName || source.split('/').slice(-1)[0];
        var mediaType = options.mediaType || 'image/' + (options.fileType || fileName.split('.').slice(-1)[0]);
        mediaType = mediaType.replace('jpg', 'jpeg');
        e.target.files[0] = new File([imageBlob], fileName, { type: mediaType });
        _this4.onFileChange(e, true);
      }).catch(function (err) {
        _this4.$emit('error', {
          type: 'failedPrefill',
          message: 'Failed loading prefill image: ' + err
        });
      });
    }
  },
  computed: {
    supportsUpload: function supportsUpload() {
      if (navigator.userAgent.match(/(Android (1.0|1.1|1.5|1.6|2.0|2.1))|(Windows Phone (OS 7|8.0))|(XBLWP)|(ZuneWP)|(w(eb)?OSBrowser)|(webOS)|(Kindle\/(1.0|2.0|2.5|3.0))/)) {
        return false;
      }
      var el = document.createElement('input');
      el.type = 'file';
      return !el.disabled;
    },
    supportsPreview: function supportsPreview() {
      return window.FileReader && !!window.CanvasRenderingContext2D;
    },
    supportsDragAndDrop: function supportsDragAndDrop() {
      var div = document.createElement('div');
      return ('draggable' in div || 'ondragstart' in div && 'ondrop' in div) && !('ontouchstart' in window || navigator.msMaxTouchPoints);
    },
    computedClasses: function computedClasses() {
      var classObject = {};
      classObject['dragging-over'] = this.draggingOver;
      return classObject;
    },
    fontSize: function fontSize() {
      return Math.min(0.04 * this.previewWidth, 21) + 'px';
    }
  }
});

/***/ }),

/***/ 364:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "container",
      staticClass: "picture-input",
      attrs: { id: "picture-input" }
    },
    [
      !_vm.supportsUpload
        ? _c("div", { domProps: { innerHTML: _vm._s(_vm.strings.upload) } })
        : _vm.supportsPreview
        ? _c("div", [
            _c(
              "div",
              {
                staticClass: "preview-container",
                style: {
                  maxWidth: _vm.previewWidth + "px",
                  height: _vm.previewHeight + "px",
                  borderRadius: _vm.radius + "%"
                }
              },
              [
                _c("canvas", {
                  ref: "previewCanvas",
                  staticClass: "picture-preview",
                  class: _vm.computedClasses,
                  style: {
                    height: _vm.previewHeight + "px",
                    zIndex: _vm.zIndex + 1
                  },
                  on: {
                    drag: function($event) {
                      $event.stopPropagation()
                      $event.preventDefault()
                    },
                    dragover: function($event) {
                      $event.stopPropagation()
                      $event.preventDefault()
                    },
                    dragstart: function($event) {
                      $event.stopPropagation()
                      $event.preventDefault()
                      return _vm.onDragStart($event)
                    },
                    dragenter: function($event) {
                      $event.stopPropagation()
                      $event.preventDefault()
                      return _vm.onDragStart($event)
                    },
                    dragend: function($event) {
                      $event.stopPropagation()
                      $event.preventDefault()
                      return _vm.onDragStop($event)
                    },
                    dragleave: function($event) {
                      $event.stopPropagation()
                      $event.preventDefault()
                      return _vm.onDragStop($event)
                    },
                    drop: function($event) {
                      $event.stopPropagation()
                      $event.preventDefault()
                      return _vm.onFileDrop($event)
                    },
                    click: function($event) {
                      $event.preventDefault()
                      return _vm.onClick($event)
                    }
                  }
                }),
                _vm._v(" "),
                !_vm.imageSelected && !_vm.plain
                  ? _c(
                      "div",
                      {
                        staticClass: "picture-inner",
                        style: {
                          top: -_vm.previewHeight + "px",
                          marginBottom: -_vm.previewHeight + "px",
                          fontSize: _vm.fontSize,
                          borderRadius: _vm.radius + "%",
                          zIndex: _vm.zIndex + 2
                        }
                      },
                      [
                        _vm.supportsDragAndDrop
                          ? _c("span", {
                              staticClass: "picture-inner-text",
                              domProps: { innerHTML: _vm._s(_vm.strings.drag) }
                            })
                          : _c("span", {
                              staticClass: "picture-inner-text",
                              domProps: { innerHTML: _vm._s(_vm.strings.tap) }
                            })
                      ]
                    )
                  : _vm._e()
              ]
            ),
            _vm._v(" "),
            _vm.imageSelected && !_vm.hideChangeButton
              ? _c(
                  "button",
                  {
                    class: _vm.buttonClass,
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        return _vm.selectImage($event)
                      }
                    }
                  },
                  [_vm._v(_vm._s(_vm.strings.change))]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.imageSelected && _vm.removable
              ? _c(
                  "button",
                  {
                    class: _vm.removeButtonClass,
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        return _vm.removeImage($event)
                      }
                    }
                  },
                  [_vm._v(_vm._s(_vm.strings.remove))]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.imageSelected &&
            _vm.toggleAspectRatio &&
            _vm.width !== _vm.height
              ? _c(
                  "button",
                  {
                    class: _vm.aspectButtonClass,
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        return _vm.rotateImage($event)
                      }
                    }
                  },
                  [_vm._v(_vm._s(_vm.strings.aspect))]
                )
              : _vm._e()
          ])
        : _c("div", [
            !_vm.imageSelected
              ? _c(
                  "button",
                  {
                    class: _vm.buttonClass,
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        return _vm.selectImage($event)
                      }
                    }
                  },
                  [_vm._v(_vm._s(_vm.strings.select))]
                )
              : _c("div", [
                  _c("div", {
                    domProps: { innerHTML: _vm._s(_vm.strings.selected) }
                  }),
                  _vm._v(" "),
                  !_vm.hideChangeButton
                    ? _c(
                        "button",
                        {
                          class: _vm.buttonClass,
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              return _vm.selectImage($event)
                            }
                          }
                        },
                        [_vm._v(_vm._s(_vm.strings.change))]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.removable
                    ? _c(
                        "button",
                        {
                          class: _vm.removeButtonClass,
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              return _vm.removeImage($event)
                            }
                          }
                        },
                        [_vm._v(_vm._s(_vm.strings.remove))]
                      )
                    : _vm._e()
                ])
          ]),
      _vm._v(" "),
      _c("input", {
        ref: "fileInput",
        attrs: { type: "file", name: _vm.name, id: _vm.id, accept: _vm.accept },
        on: { change: _vm.onFileChange }
      })
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-431cb064", module.exports)
  }
}

/***/ }),

/***/ 365:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "form-group",
      class: [_vm.index == null ? "row" : "form-group-float"]
    },
    [
      _c("label", {
        staticClass: "cursor-pointer",
        class: _vm.label_class(),
        attrs: { for: _vm.getId(_vm.info.name) },
        domProps: { textContent: _vm._s(_vm.lable) }
      }),
      _vm._v(" "),
      _c("input", {
        attrs: { type: "hidden", name: _vm.getName(_vm.info.name + "_src") },
        domProps: { value: _vm.input_value }
      }),
      _vm._v(" "),
      _c(
        "div",
        { class: [_vm.index == null ? "col-sm-12" : ""] },
        [
          _c("picture-input", {
            ref: "pictureInput",
            attrs: {
              width: "600",
              height: "600",
              margin: "16",
              accept: "image/jpeg,image/png",
              size: "10",
              buttonClass: "btn btn-primary",
              removeButtonClass: "btn btn-danger",
              zIndex: 100,
              name: _vm.getName(_vm.info.name),
              id: _vm.getId(_vm.info.name),
              prefill: _vm.input_value,
              removable: true,
              customStrings: {
                upload: "<h1>Bummer!</h1>",
                change: "تغییر تصویر",
                remove: "حذف تصویر",
                drag:
                  "تصویر خود را اینجا بکشید یا  <br>جهت انتخاب تصویر کلید کنید"
              }
            },
            on: {
              remove: function($event) {
                _vm.input_value = null
              },
              change: _vm.onChange
            }
          }),
          _vm._v(" "),
          _vm._l(_vm.errors[_vm.getErrorName(_vm.info.name)], function(error) {
            return _vm.hasError()
              ? _c("span", { staticClass: "form-text text-danger" }, [
                  _vm._v(_vm._s(error))
                ])
              : _vm._e()
          })
        ],
        2
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-cc4e9d10", module.exports)
  }
}

/***/ })

});