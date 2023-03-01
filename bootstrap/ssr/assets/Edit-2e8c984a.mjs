import { a as Avatar, A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { useForm } from "@inertiajs/vue3";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import OverlayEventBus from "primevue/overlayeventbus";
import Portal from "primevue/portal";
import { ZIndexUtils, DomHandler, ConnectedOverlayScrollHandler } from "primevue/utils";
import { useSSRContext, resolveComponent, mergeProps, withCtx, createVNode, Transition, openBlock, createBlock, createCommentVNode, resolveDirective, createTextVNode, toDisplayString } from "vue";
import { ssrRenderAttrs, ssrRenderClass, ssrRenderAttr, ssrIncludeBooleanAttr, ssrRenderComponent, ssrRenderList, ssrInterpolate, ssrRenderSlot, ssrGetDirectiveProps } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import Button from "primevue/button";
import Message from "primevue/message";
import ProgressBar from "primevue/progressbar";
import Ripple from "primevue/ripple";
import Badge from "primevue/badge";
import { P as PrimevueInputtext } from "./InputText-d441a729.mjs";
import PrimevueTooltip from "primevue/tooltip/tooltip.cjs.js";
import { P as PrimevueCard } from "./Card-fe8810d1.mjs";
import "date-fns";
import "primevue/confirmationeventbus";
import "primevue/dialog";
const ColorPicker_vue_vue_type_style_index_0_lang = "";
const _sfc_main$4 = {
  name: "ColorPicker",
  emits: ["update:modelValue", "change", "show", "hide"],
  props: {
    modelValue: {
      type: null,
      default: null
    },
    defaultColor: {
      type: null,
      default: "ff0000"
    },
    inline: {
      type: Boolean,
      default: false
    },
    format: {
      type: String,
      default: "hex"
    },
    disabled: {
      type: Boolean,
      default: false
    },
    tabindex: {
      type: String,
      default: null
    },
    autoZIndex: {
      type: Boolean,
      default: true
    },
    baseZIndex: {
      type: Number,
      default: 0
    },
    appendTo: {
      type: String,
      default: "body"
    },
    panelClass: null
  },
  data() {
    return {
      overlayVisible: false
    };
  },
  hsbValue: null,
  outsideClickListener: null,
  documentMouseMoveListener: null,
  documentMouseUpListener: null,
  scrollHandler: null,
  resizeListener: null,
  hueDragging: null,
  colorDragging: null,
  selfUpdate: null,
  picker: null,
  colorSelector: null,
  colorHandle: null,
  hueView: null,
  hueHandle: null,
  watch: {
    modelValue: {
      immediate: true,
      handler(newValue) {
        this.hsbValue = this.toHSB(newValue);
        if (this.selfUpdate)
          this.selfUpdate = false;
        else
          this.updateUI();
      }
    }
  },
  beforeUnmount() {
    this.unbindOutsideClickListener();
    this.unbindDragListeners();
    this.unbindResizeListener();
    if (this.scrollHandler) {
      this.scrollHandler.destroy();
      this.scrollHandler = null;
    }
    if (this.picker && this.autoZIndex) {
      ZIndexUtils.clear(this.picker);
    }
    this.clearRefs();
  },
  mounted() {
    this.updateUI();
  },
  methods: {
    pickColor(event) {
      let rect = this.colorSelector.getBoundingClientRect();
      let top = rect.top + (window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0);
      let left = rect.left + document.body.scrollLeft;
      let saturation = Math.floor(100 * Math.max(0, Math.min(150, (event.pageX || event.changedTouches[0].pageX) - left)) / 150);
      let brightness = Math.floor(100 * (150 - Math.max(0, Math.min(150, (event.pageY || event.changedTouches[0].pageY) - top))) / 150);
      this.hsbValue = this.validateHSB({
        h: this.hsbValue.h,
        s: saturation,
        b: brightness
      });
      this.selfUpdate = true;
      this.updateColorHandle();
      this.updateInput();
      this.updateModel();
      this.$emit("change", { event, value: this.modelValue });
    },
    pickHue(event) {
      let top = this.hueView.getBoundingClientRect().top + (window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0);
      this.hsbValue = this.validateHSB({
        h: Math.floor(360 * (150 - Math.max(0, Math.min(150, (event.pageY || event.changedTouches[0].pageY) - top))) / 150),
        s: 100,
        b: 100
      });
      this.selfUpdate = true;
      this.updateColorSelector();
      this.updateHue();
      this.updateModel();
      this.updateInput();
      this.$emit("change", { event, value: this.modelValue });
    },
    updateModel() {
      switch (this.format) {
        case "hex":
          this.$emit("update:modelValue", this.HSBtoHEX(this.hsbValue));
          break;
        case "rgb":
          this.$emit("update:modelValue", this.HSBtoRGB(this.hsbValue));
          break;
        case "hsb":
          this.$emit("update:modelValue", this.hsbValue);
          break;
      }
    },
    updateColorSelector() {
      if (this.colorSelector) {
        let hsbValue = this.validateHSB({
          h: this.hsbValue.h,
          s: 100,
          b: 100
        });
        this.colorSelector.style.backgroundColor = "#" + this.HSBtoHEX(hsbValue);
      }
    },
    updateColorHandle() {
      if (this.colorHandle) {
        this.colorHandle.style.left = Math.floor(150 * this.hsbValue.s / 100) + "px";
        this.colorHandle.style.top = Math.floor(150 * (100 - this.hsbValue.b) / 100) + "px";
      }
    },
    updateHue() {
      if (this.hueHandle) {
        this.hueHandle.style.top = Math.floor(150 - 150 * this.hsbValue.h / 360) + "px";
      }
    },
    updateInput() {
      if (this.$refs.input) {
        this.$refs.input.style.backgroundColor = "#" + this.HSBtoHEX(this.hsbValue);
      }
    },
    updateUI() {
      this.updateHue();
      this.updateColorHandle();
      this.updateInput();
      this.updateColorSelector();
    },
    validateHSB(hsb) {
      return {
        h: Math.min(360, Math.max(0, hsb.h)),
        s: Math.min(100, Math.max(0, hsb.s)),
        b: Math.min(100, Math.max(0, hsb.b))
      };
    },
    validateRGB(rgb) {
      return {
        r: Math.min(255, Math.max(0, rgb.r)),
        g: Math.min(255, Math.max(0, rgb.g)),
        b: Math.min(255, Math.max(0, rgb.b))
      };
    },
    validateHEX(hex) {
      var len = 6 - hex.length;
      if (len > 0) {
        var o = [];
        for (var i = 0; i < len; i++) {
          o.push("0");
        }
        o.push(hex);
        hex = o.join("");
      }
      return hex;
    },
    HEXtoRGB(hex) {
      let hexValue = parseInt(hex.indexOf("#") > -1 ? hex.substring(1) : hex, 16);
      return { r: hexValue >> 16, g: (hexValue & 65280) >> 8, b: hexValue & 255 };
    },
    HEXtoHSB(hex) {
      return this.RGBtoHSB(this.HEXtoRGB(hex));
    },
    RGBtoHSB(rgb) {
      var hsb = {
        h: 0,
        s: 0,
        b: 0
      };
      var min = Math.min(rgb.r, rgb.g, rgb.b);
      var max = Math.max(rgb.r, rgb.g, rgb.b);
      var delta = max - min;
      hsb.b = max;
      hsb.s = max !== 0 ? 255 * delta / max : 0;
      if (hsb.s !== 0) {
        if (rgb.r === max) {
          hsb.h = (rgb.g - rgb.b) / delta;
        } else if (rgb.g === max) {
          hsb.h = 2 + (rgb.b - rgb.r) / delta;
        } else {
          hsb.h = 4 + (rgb.r - rgb.g) / delta;
        }
      } else {
        hsb.h = -1;
      }
      hsb.h *= 60;
      if (hsb.h < 0) {
        hsb.h += 360;
      }
      hsb.s *= 100 / 255;
      hsb.b *= 100 / 255;
      return hsb;
    },
    HSBtoRGB(hsb) {
      var rgb = {
        r: null,
        g: null,
        b: null
      };
      var h = Math.round(hsb.h);
      var s = Math.round(hsb.s * 255 / 100);
      var v = Math.round(hsb.b * 255 / 100);
      if (s === 0) {
        rgb = {
          r: v,
          g: v,
          b: v
        };
      } else {
        var t1 = v;
        var t2 = (255 - s) * v / 255;
        var t3 = (t1 - t2) * (h % 60) / 60;
        if (h === 360)
          h = 0;
        if (h < 60) {
          rgb.r = t1;
          rgb.b = t2;
          rgb.g = t2 + t3;
        } else if (h < 120) {
          rgb.g = t1;
          rgb.b = t2;
          rgb.r = t1 - t3;
        } else if (h < 180) {
          rgb.g = t1;
          rgb.r = t2;
          rgb.b = t2 + t3;
        } else if (h < 240) {
          rgb.b = t1;
          rgb.r = t2;
          rgb.g = t1 - t3;
        } else if (h < 300) {
          rgb.b = t1;
          rgb.g = t2;
          rgb.r = t2 + t3;
        } else if (h < 360) {
          rgb.r = t1;
          rgb.g = t2;
          rgb.b = t1 - t3;
        } else {
          rgb.r = 0;
          rgb.g = 0;
          rgb.b = 0;
        }
      }
      return { r: Math.round(rgb.r), g: Math.round(rgb.g), b: Math.round(rgb.b) };
    },
    RGBtoHEX(rgb) {
      var hex = [rgb.r.toString(16), rgb.g.toString(16), rgb.b.toString(16)];
      for (var key in hex) {
        if (hex[key].length === 1) {
          hex[key] = "0" + hex[key];
        }
      }
      return hex.join("");
    },
    HSBtoHEX(hsb) {
      return this.RGBtoHEX(this.HSBtoRGB(hsb));
    },
    toHSB(value) {
      let hsb;
      if (value) {
        switch (this.format) {
          case "hex":
            hsb = this.HEXtoHSB(value);
            break;
          case "rgb":
            hsb = this.RGBtoHSB(value);
            break;
          case "hsb":
            hsb = value;
            break;
        }
      } else {
        hsb = this.HEXtoHSB(this.defaultColor);
      }
      return hsb;
    },
    onOverlayEnter(el) {
      this.updateUI();
      this.alignOverlay();
      this.bindOutsideClickListener();
      this.bindScrollListener();
      this.bindResizeListener();
      if (this.autoZIndex) {
        ZIndexUtils.set("overlay", el, this.$primevue.config.zIndex.overlay);
      }
      this.$emit("show");
    },
    onOverlayLeave() {
      this.unbindOutsideClickListener();
      this.unbindScrollListener();
      this.unbindResizeListener();
      this.clearRefs();
      this.$emit("hide");
    },
    onOverlayAfterLeave(el) {
      if (this.autoZIndex) {
        ZIndexUtils.clear(el);
      }
    },
    alignOverlay() {
      if (this.appendTo === "self")
        DomHandler.relativePosition(this.picker, this.$refs.input);
      else
        DomHandler.absolutePosition(this.picker, this.$refs.input);
    },
    onInputClick() {
      if (this.disabled) {
        return;
      }
      this.overlayVisible = !this.overlayVisible;
    },
    onInputKeydown(event) {
      switch (event.code) {
        case "Space":
          this.overlayVisible = !this.overlayVisible;
          event.preventDefault();
          break;
        case "Escape":
        case "Tab":
          this.overlayVisible = false;
          break;
      }
    },
    onColorMousedown(event) {
      if (this.disabled) {
        return;
      }
      this.bindDragListeners();
      this.onColorDragStart(event);
    },
    onColorDragStart(event) {
      if (this.disabled) {
        return;
      }
      this.colorDragging = true;
      this.pickColor(event);
      DomHandler.addClass(this.$el, "p-colorpicker-dragging");
      event.preventDefault();
    },
    onDrag(event) {
      if (this.colorDragging) {
        this.pickColor(event);
        event.preventDefault();
      }
      if (this.hueDragging) {
        this.pickHue(event);
        event.preventDefault();
      }
    },
    onDragEnd() {
      this.colorDragging = false;
      this.hueDragging = false;
      DomHandler.removeClass(this.$el, "p-colorpicker-dragging");
      this.unbindDragListeners();
    },
    onHueMousedown(event) {
      if (this.disabled) {
        return;
      }
      this.bindDragListeners();
      this.onHueDragStart(event);
    },
    onHueDragStart(event) {
      if (this.disabled) {
        return;
      }
      this.hueDragging = true;
      this.pickHue(event);
      DomHandler.addClass(this.$el, "p-colorpicker-dragging");
    },
    isInputClicked(event) {
      return this.$refs.input && this.$refs.input.isSameNode(event.target);
    },
    bindDragListeners() {
      this.bindDocumentMouseMoveListener();
      this.bindDocumentMouseUpListener();
    },
    unbindDragListeners() {
      this.unbindDocumentMouseMoveListener();
      this.unbindDocumentMouseUpListener();
    },
    bindOutsideClickListener() {
      if (!this.outsideClickListener) {
        this.outsideClickListener = (event) => {
          if (this.overlayVisible && this.picker && !this.picker.contains(event.target) && !this.isInputClicked(event)) {
            this.overlayVisible = false;
          }
        };
        document.addEventListener("click", this.outsideClickListener);
      }
    },
    unbindOutsideClickListener() {
      if (this.outsideClickListener) {
        document.removeEventListener("click", this.outsideClickListener);
        this.outsideClickListener = null;
      }
    },
    bindScrollListener() {
      if (!this.scrollHandler) {
        this.scrollHandler = new ConnectedOverlayScrollHandler(this.$refs.container, () => {
          if (this.overlayVisible) {
            this.overlayVisible = false;
          }
        });
      }
      this.scrollHandler.bindScrollListener();
    },
    unbindScrollListener() {
      if (this.scrollHandler) {
        this.scrollHandler.unbindScrollListener();
      }
    },
    bindResizeListener() {
      if (!this.resizeListener) {
        this.resizeListener = () => {
          if (this.overlayVisible && !DomHandler.isTouchDevice()) {
            this.overlayVisible = false;
          }
        };
        window.addEventListener("resize", this.resizeListener);
      }
    },
    unbindResizeListener() {
      if (this.resizeListener) {
        window.removeEventListener("resize", this.resizeListener);
        this.resizeListener = null;
      }
    },
    bindDocumentMouseMoveListener() {
      if (!this.documentMouseMoveListener) {
        this.documentMouseMoveListener = this.onDrag.bind(this);
        document.addEventListener("mousemove", this.documentMouseMoveListener);
      }
    },
    unbindDocumentMouseMoveListener() {
      if (this.documentMouseMoveListener) {
        document.removeEventListener("mousemove", this.documentMouseMoveListener);
        this.documentMouseMoveListener = null;
      }
    },
    bindDocumentMouseUpListener() {
      if (!this.documentMouseUpListener) {
        this.documentMouseUpListener = this.onDragEnd.bind(this);
        document.addEventListener("mouseup", this.documentMouseUpListener);
      }
    },
    unbindDocumentMouseUpListener() {
      if (this.documentMouseUpListener) {
        document.removeEventListener("mouseup", this.documentMouseUpListener);
        this.documentMouseUpListener = null;
      }
    },
    pickerRef(el) {
      this.picker = el;
    },
    colorSelectorRef(el) {
      this.colorSelector = el;
    },
    colorHandleRef(el) {
      this.colorHandle = el;
    },
    hueViewRef(el) {
      this.hueView = el;
    },
    hueHandleRef(el) {
      this.hueHandle = el;
    },
    clearRefs() {
      this.picker = null;
      this.colorSelector = null;
      this.colorHandle = null;
      this.hueView = null;
      this.hueHandle = null;
    },
    onOverlayClick(event) {
      OverlayEventBus.emit("overlay-click", {
        originalEvent: event,
        target: this.$el
      });
    }
  },
  computed: {
    containerClass() {
      return ["p-colorpicker p-component", { "p-colorpicker-overlay": !this.inline }];
    },
    inputClass() {
      return ["p-colorpicker-preview p-inputtext", { "p-disabled": this.disabled }];
    },
    pickerClass() {
      return [
        "p-colorpicker-panel",
        this.panelClass,
        {
          "p-colorpicker-overlay-panel": !this.inline,
          "p-disabled": this.disabled,
          "p-input-filled": this.$primevue.config.inputStyle === "filled",
          "p-ripple-disabled": this.$primevue.config.ripple === false
        }
      ];
    }
  },
  components: {
    Portal
  }
};
function _sfc_ssrRender$4(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Portal = resolveComponent("Portal");
  _push(`<div${ssrRenderAttrs(mergeProps({
    ref: "container",
    class: $options.containerClass
  }, _attrs))}>`);
  if (!$props.inline) {
    _push(`<input type="text" class="${ssrRenderClass($options.inputClass)}" readonly="readonly"${ssrRenderAttr("tabindex", $props.tabindex)}${ssrIncludeBooleanAttr($props.disabled) ? " disabled" : ""}>`);
  } else {
    _push(`<!---->`);
  }
  _push(ssrRenderComponent(_component_Portal, {
    appendTo: $props.appendTo,
    disabled: $props.inline
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(``);
        if ($props.inline ? true : $data.overlayVisible) {
          _push2(`<div class="${ssrRenderClass($options.pickerClass)}"${_scopeId}><div class="p-colorpicker-content"${_scopeId}><div class="p-colorpicker-color-selector"${_scopeId}><div class="p-colorpicker-color"${_scopeId}><div class="p-colorpicker-color-handle"${_scopeId}></div></div></div><div class="p-colorpicker-hue"${_scopeId}><div class="p-colorpicker-hue-handle"${_scopeId}></div></div></div></div>`);
        } else {
          _push2(`<!---->`);
        }
      } else {
        return [
          createVNode(Transition, {
            name: "p-connected-overlay",
            onEnter: $options.onOverlayEnter,
            onLeave: $options.onOverlayLeave,
            onAfterLeave: $options.onOverlayAfterLeave
          }, {
            default: withCtx(() => [
              ($props.inline ? true : $data.overlayVisible) ? (openBlock(), createBlock("div", {
                key: 0,
                ref: $options.pickerRef,
                class: $options.pickerClass,
                onClick: $options.onOverlayClick
              }, [
                createVNode("div", { class: "p-colorpicker-content" }, [
                  createVNode("div", {
                    ref: $options.colorSelectorRef,
                    class: "p-colorpicker-color-selector",
                    onMousedown: ($event) => $options.onColorMousedown($event),
                    onTouchstart: ($event) => $options.onColorDragStart($event),
                    onTouchmove: ($event) => $options.onDrag($event),
                    onTouchend: ($event) => $options.onDragEnd()
                  }, [
                    createVNode("div", { class: "p-colorpicker-color" }, [
                      createVNode("div", {
                        ref: $options.colorHandleRef,
                        class: "p-colorpicker-color-handle"
                      }, null, 512)
                    ])
                  ], 40, ["onMousedown", "onTouchstart", "onTouchmove", "onTouchend"]),
                  createVNode("div", {
                    ref: $options.hueViewRef,
                    class: "p-colorpicker-hue",
                    onMousedown: ($event) => $options.onHueMousedown($event),
                    onTouchstart: ($event) => $options.onHueDragStart($event),
                    onTouchmove: ($event) => $options.onDrag($event),
                    onTouchend: ($event) => $options.onDragEnd()
                  }, [
                    createVNode("div", {
                      ref: $options.hueHandleRef,
                      class: "p-colorpicker-hue-handle"
                    }, null, 512)
                  ], 40, ["onMousedown", "onTouchstart", "onTouchmove", "onTouchend"])
                ])
              ], 10, ["onClick"])) : createCommentVNode("", true)
            ]),
            _: 1
          }, 8, ["onEnter", "onLeave", "onAfterLeave"])
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div>`);
}
const _sfc_setup$4 = _sfc_main$4.setup;
_sfc_main$4.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/colorpicker/ColorPicker.vue");
  return _sfc_setup$4 ? _sfc_setup$4(props, ctx) : void 0;
};
const PrimevueColorpicker = /* @__PURE__ */ _export_sfc(_sfc_main$4, [["ssrRender", _sfc_ssrRender$4]]);
const _sfc_main$3 = {
  emits: ["remove"],
  props: {
    files: {
      type: Array,
      default: () => []
    },
    badgeSeverity: {
      type: String,
      default: "warning"
    },
    badgeValue: {
      type: String,
      default: null
    },
    previewWidth: {
      type: Number,
      default: 50
    }
  },
  methods: {
    formatSize(bytes) {
      if (bytes === 0) {
        return "0 B";
      }
      let k = 1e3, dm = 3, sizes = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
    }
  },
  components: {
    FileUploadButton: Button,
    FileUploadBadge: Badge
  }
};
function _sfc_ssrRender$3(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_FileUploadBadge = resolveComponent("FileUploadBadge");
  const _component_FileUploadButton = resolveComponent("FileUploadButton");
  _push(`<!--[-->`);
  ssrRenderList($props.files, (file, index) => {
    _push(`<div class="p-fileupload-file"><img role="presentation" class="p-fileupload-file-thumbnail"${ssrRenderAttr("alt", file.name)}${ssrRenderAttr("src", file.objectURL)}${ssrRenderAttr("width", $props.previewWidth)}><div class="p-fileupload-file-details"><div class="p-fileupload-file-name">${ssrInterpolate(file.name)}</div><span class="p-fileupload-file-size">${ssrInterpolate($options.formatSize(file.size))}</span>`);
    _push(ssrRenderComponent(_component_FileUploadBadge, {
      value: $props.badgeValue,
      class: "p-fileupload-file-badge",
      severity: $props.badgeSeverity
    }, null, _parent));
    _push(`</div><div class="p-fileupload-file-actions">`);
    _push(ssrRenderComponent(_component_FileUploadButton, {
      icon: "pi pi-times",
      onClick: ($event) => _ctx.$emit("remove", index),
      class: "p-fileupload-file-remove p-button-text p-button-danger p-button-rounded"
    }, null, _parent));
    _push(`</div></div>`);
  });
  _push(`<!--]-->`);
}
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/fileupload/FileContent.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const FileContent = /* @__PURE__ */ _export_sfc(_sfc_main$3, [["ssrRender", _sfc_ssrRender$3]]);
const FileUpload_vue_vue_type_style_index_0_lang = "";
const _sfc_main$2 = {
  name: "FileUpload",
  emits: ["select", "uploader", "before-upload", "progress", "upload", "error", "before-send", "clear", "remove", "remove-uploaded-file"],
  props: {
    name: {
      type: String,
      default: null
    },
    url: {
      type: String,
      default: null
    },
    mode: {
      type: String,
      default: "advanced"
    },
    multiple: {
      type: Boolean,
      default: false
    },
    accept: {
      type: String,
      default: null
    },
    disabled: {
      type: Boolean,
      default: false
    },
    auto: {
      type: Boolean,
      default: false
    },
    maxFileSize: {
      type: Number,
      default: null
    },
    invalidFileSizeMessage: {
      type: String,
      default: "{0}: Invalid file size, file size should be smaller than {1}."
    },
    invalidFileTypeMessage: {
      type: String,
      default: "{0}: Invalid file type, allowed file types: {1}."
    },
    fileLimit: {
      type: Number,
      default: null
    },
    invalidFileLimitMessage: {
      type: String,
      default: "Maximum number of files exceeded, limit is {0} at most."
    },
    withCredentials: {
      type: Boolean,
      default: false
    },
    previewWidth: {
      type: Number,
      default: 50
    },
    chooseLabel: {
      type: String,
      default: null
    },
    uploadLabel: {
      type: String,
      default: null
    },
    cancelLabel: {
      type: String,
      default: null
    },
    customUpload: {
      type: Boolean,
      default: false
    },
    showUploadButton: {
      type: Boolean,
      default: true
    },
    showCancelButton: {
      type: Boolean,
      default: true
    },
    chooseIcon: {
      type: String,
      default: "pi pi-plus"
    },
    uploadIcon: {
      type: String,
      default: "pi pi-upload"
    },
    cancelIcon: {
      type: String,
      default: "pi pi-times"
    },
    style: null,
    class: null
  },
  duplicateIEEvent: false,
  data() {
    return {
      uploadedFileCount: 0,
      files: [],
      messages: [],
      focused: false,
      progress: null,
      uploadedFiles: []
    };
  },
  methods: {
    onFileSelect(event) {
      if (event.type !== "drop" && this.isIE11() && this.duplicateIEEvent) {
        this.duplicateIEEvent = false;
        return;
      }
      this.messages = [];
      this.files = this.files || [];
      let files = event.dataTransfer ? event.dataTransfer.files : event.target.files;
      for (let file of files) {
        if (!this.isFileSelected(file)) {
          if (this.validate(file)) {
            if (this.isImage(file)) {
              file.objectURL = window.URL.createObjectURL(file);
            }
            this.files.push(file);
          }
        }
      }
      this.$emit("select", { originalEvent: event, files: this.files });
      if (this.fileLimit) {
        this.checkFileLimit();
      }
      if (this.auto && this.hasFiles && !this.isFileLimitExceeded()) {
        this.upload();
      }
      if (event.type !== "drop" && this.isIE11()) {
        this.clearIEInput();
      } else {
        this.clearInputElement();
      }
    },
    choose() {
      this.$refs.fileInput.click();
    },
    upload() {
      if (this.customUpload) {
        if (this.fileLimit) {
          this.uploadedFileCount += this.files.length;
        }
        this.$emit("uploader", { files: this.files });
        this.clear();
      } else {
        let xhr = new XMLHttpRequest();
        let formData = new FormData();
        this.$emit("before-upload", {
          xhr,
          formData
        });
        for (let file of this.files) {
          formData.append(this.name, file, file.name);
        }
        xhr.upload.addEventListener("progress", (event) => {
          if (event.lengthComputable) {
            this.progress = Math.round(event.loaded * 100 / event.total);
          }
          this.$emit("progress", {
            originalEvent: event,
            progress: this.progress
          });
        });
        xhr.onreadystatechange = () => {
          if (xhr.readyState === 4) {
            this.progress = 0;
            if (xhr.status >= 200 && xhr.status < 300) {
              if (this.fileLimit) {
                this.uploadedFileCount += this.files.length;
              }
              this.$emit("upload", {
                xhr,
                files: this.files
              });
            } else {
              this.$emit("error", {
                xhr,
                files: this.files
              });
            }
            this.uploadedFiles.push(...this.files);
            this.clear();
          }
        };
        xhr.open("POST", this.url, true);
        this.$emit("before-send", {
          xhr,
          formData
        });
        xhr.withCredentials = this.withCredentials;
        xhr.send(formData);
      }
    },
    clear() {
      this.files = [];
      this.messages = null;
      this.$emit("clear");
      if (this.isAdvanced) {
        this.clearInputElement();
      }
    },
    onFocus() {
      this.focused = true;
    },
    onBlur() {
      this.focused = false;
    },
    isFileSelected(file) {
      if (this.files && this.files.length) {
        for (let sFile of this.files) {
          if (sFile.name + sFile.type + sFile.size === file.name + file.type + file.size)
            return true;
        }
      }
      return false;
    },
    isIE11() {
      return !!window["MSInputMethodContext"] && !!document["documentMode"];
    },
    validate(file) {
      if (this.accept && !this.isFileTypeValid(file)) {
        this.messages.push(this.invalidFileTypeMessage.replace("{0}", file.name).replace("{1}", this.accept));
        return false;
      }
      if (this.maxFileSize && file.size > this.maxFileSize) {
        this.messages.push(this.invalidFileSizeMessage.replace("{0}", file.name).replace("{1}", this.formatSize(this.maxFileSize)));
        return false;
      }
      return true;
    },
    isFileTypeValid(file) {
      let acceptableTypes = this.accept.split(",").map((type) => type.trim());
      for (let type of acceptableTypes) {
        let acceptable = this.isWildcard(type) ? this.getTypeClass(file.type) === this.getTypeClass(type) : file.type == type || this.getFileExtension(file).toLowerCase() === type.toLowerCase();
        if (acceptable) {
          return true;
        }
      }
      return false;
    },
    getTypeClass(fileType) {
      return fileType.substring(0, fileType.indexOf("/"));
    },
    isWildcard(fileType) {
      return fileType.indexOf("*") !== -1;
    },
    getFileExtension(file) {
      return "." + file.name.split(".").pop();
    },
    isImage(file) {
      return /^image\//.test(file.type);
    },
    onDragEnter(event) {
      if (!this.disabled) {
        event.stopPropagation();
        event.preventDefault();
      }
    },
    onDragOver(event) {
      if (!this.disabled) {
        DomHandler.addClass(this.$refs.content, "p-fileupload-highlight");
        event.stopPropagation();
        event.preventDefault();
      }
    },
    onDragLeave() {
      if (!this.disabled) {
        DomHandler.removeClass(this.$refs.content, "p-fileupload-highlight");
      }
    },
    onDrop(event) {
      if (!this.disabled) {
        DomHandler.removeClass(this.$refs.content, "p-fileupload-highlight");
        event.stopPropagation();
        event.preventDefault();
        const files = event.dataTransfer ? event.dataTransfer.files : event.target.files;
        const allowDrop = this.multiple || files && files.length === 1;
        if (allowDrop) {
          this.onFileSelect(event);
        }
      }
    },
    onBasicUploaderClick() {
      if (this.hasFiles)
        this.upload();
      else
        this.$refs.fileInput.click();
    },
    remove(index) {
      this.clearInputElement();
      let removedFile = this.files.splice(index, 1)[0];
      this.files = [...this.files];
      this.$emit("remove", {
        file: removedFile,
        files: this.files
      });
    },
    removeUploadedFile(index) {
      let removedFile = this.uploadedFiles.splice(index, 1)[0];
      this.uploadedFiles = [...this.uploadedFiles];
      this.$emit("remove-uploaded-file", {
        file: removedFile,
        files: this.uploadedFiles
      });
    },
    clearInputElement() {
      this.$refs.fileInput.value = "";
    },
    clearIEInput() {
      if (this.$refs.fileInput) {
        this.duplicateIEEvent = true;
        this.$refs.fileInput.value = "";
      }
    },
    formatSize(bytes) {
      if (bytes === 0) {
        return "0 B";
      }
      let k = 1e3, dm = 3, sizes = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
    },
    isFileLimitExceeded() {
      if (this.fileLimit && this.fileLimit <= this.files.length + this.uploadedFileCount && this.focused) {
        this.focused = false;
      }
      return this.fileLimit && this.fileLimit < this.files.length + this.uploadedFileCount;
    },
    checkFileLimit() {
      if (this.isFileLimitExceeded()) {
        this.messages.push(this.invalidFileLimitMessage.replace("{0}", this.fileLimit.toString()));
      }
    },
    onMessageClose() {
      this.messages = null;
    }
  },
  computed: {
    isAdvanced() {
      return this.mode === "advanced";
    },
    isBasic() {
      return this.mode === "basic";
    },
    advancedChooseButtonClass() {
      return [
        "p-button p-component p-fileupload-choose",
        this.class,
        {
          "p-disabled": this.disabled,
          "p-focus": this.focused
        }
      ];
    },
    basicChooseButtonClass() {
      return [
        "p-button p-component p-fileupload-choose",
        this.class,
        {
          "p-fileupload-choose-selected": this.hasFiles,
          "p-disabled": this.disabled,
          "p-focus": this.focused
        }
      ];
    },
    advancedChooseIconClass() {
      return ["p-button-icon p-button-icon-left pi-fw", this.chooseIcon];
    },
    basicChooseButtonIconClass() {
      return ["p-button-icon p-button-icon-left", !this.hasFiles || this.auto ? this.uploadIcon : this.chooseIcon];
    },
    basicChooseButtonLabel() {
      return this.auto ? this.chooseButtonLabel : this.hasFiles ? this.files.map((f) => f.name).join(", ") : this.chooseButtonLabel;
    },
    hasFiles() {
      return this.files && this.files.length > 0;
    },
    hasUploadedFiles() {
      return this.uploadedFiles && this.uploadedFiles.length > 0;
    },
    chooseDisabled() {
      return this.disabled || this.fileLimit && this.fileLimit <= this.files.length + this.uploadedFileCount;
    },
    uploadDisabled() {
      return this.disabled || !this.hasFiles || this.fileLimit && this.fileLimit < this.files.length;
    },
    cancelDisabled() {
      return this.disabled || !this.hasFiles;
    },
    chooseButtonLabel() {
      return this.chooseLabel || this.$primevue.config.locale.choose;
    },
    uploadButtonLabel() {
      return this.uploadLabel || this.$primevue.config.locale.upload;
    },
    cancelButtonLabel() {
      return this.cancelLabel || this.$primevue.config.locale.cancel;
    },
    completedLabel() {
      return this.$primevue.config.locale.completed;
    },
    pendingLabel() {
      return this.$primevue.config.locale.pending;
    }
  },
  components: {
    FileUploadButton: Button,
    FileUploadProgressBar: ProgressBar,
    FileUploadMessage: Message,
    FileContent
  },
  directives: {
    ripple: Ripple
  }
};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_FileUploadButton = resolveComponent("FileUploadButton");
  const _component_FileUploadProgressBar = resolveComponent("FileUploadProgressBar");
  const _component_FileUploadMessage = resolveComponent("FileUploadMessage");
  const _component_FileContent = resolveComponent("FileContent");
  const _directive_ripple = resolveDirective("ripple");
  if ($options.isAdvanced) {
    _push(`<div${ssrRenderAttrs(mergeProps({ class: "p-fileupload p-fileupload-advanced p-component" }, _attrs))}><input type="file"${ssrIncludeBooleanAttr($props.multiple) ? " multiple" : ""}${ssrRenderAttr("accept", $props.accept)}${ssrIncludeBooleanAttr($options.chooseDisabled) ? " disabled" : ""}><div class="p-fileupload-buttonbar">`);
    ssrRenderSlot(_ctx.$slots, "header", {
      files: $data.files,
      uploadedFiles: $data.uploadedFiles,
      chooseCallback: $options.choose,
      uploadCallback: $options.upload,
      clearCallback: $options.clear
    }, () => {
      _push(`<span${ssrRenderAttrs(mergeProps({
        class: $options.advancedChooseButtonClass,
        style: $props.style,
        tabindex: "0"
      }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}><span class="${ssrRenderClass($options.advancedChooseIconClass)}"></span><span class="p-button-label">${ssrInterpolate($options.chooseButtonLabel)}</span></span>`);
      if ($props.showUploadButton) {
        _push(ssrRenderComponent(_component_FileUploadButton, {
          label: $options.uploadButtonLabel,
          icon: $props.uploadIcon,
          onClick: $options.upload,
          disabled: $options.uploadDisabled
        }, null, _parent));
      } else {
        _push(`<!---->`);
      }
      if ($props.showCancelButton) {
        _push(ssrRenderComponent(_component_FileUploadButton, {
          label: $options.cancelButtonLabel,
          icon: $props.cancelIcon,
          onClick: $options.clear,
          disabled: $options.cancelDisabled
        }, null, _parent));
      } else {
        _push(`<!---->`);
      }
    }, _push, _parent);
    _push(`</div><div class="p-fileupload-content">`);
    ssrRenderSlot(_ctx.$slots, "content", {
      files: $data.files,
      uploadedFiles: $data.uploadedFiles,
      removeUploadedFileCallback: $options.removeUploadedFile,
      removeFileCallback: $options.remove,
      progress: $data.progress,
      messages: $data.messages
    }, () => {
      if ($options.hasFiles) {
        _push(ssrRenderComponent(_component_FileUploadProgressBar, {
          value: $data.progress,
          showValue: false
        }, null, _parent));
      } else {
        _push(`<!---->`);
      }
      _push(`<!--[-->`);
      ssrRenderList($data.messages, (msg) => {
        _push(ssrRenderComponent(_component_FileUploadMessage, {
          key: msg,
          severity: "error",
          onClose: $options.onMessageClose
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(`${ssrInterpolate(msg)}`);
            } else {
              return [
                createTextVNode(toDisplayString(msg), 1)
              ];
            }
          }),
          _: 2
        }, _parent));
      });
      _push(`<!--]-->`);
      if ($options.hasFiles) {
        _push(ssrRenderComponent(_component_FileContent, {
          files: $data.files,
          onRemove: $options.remove,
          badgeValue: $options.pendingLabel,
          previewWidth: $props.previewWidth
        }, null, _parent));
      } else {
        _push(`<!---->`);
      }
      _push(ssrRenderComponent(_component_FileContent, {
        files: $data.uploadedFiles,
        onRemove: $options.removeUploadedFile,
        badgeValue: $options.completedLabel,
        badgeSeverity: "success",
        previewWidth: $props.previewWidth
      }, null, _parent));
    }, _push, _parent);
    if (_ctx.$slots.empty && !$options.hasFiles && !$options.hasUploadedFiles) {
      _push(`<div class="p-fileupload-empty">`);
      ssrRenderSlot(_ctx.$slots, "empty", {}, null, _push, _parent);
      _push(`</div>`);
    } else {
      _push(`<!---->`);
    }
    _push(`</div></div>`);
  } else if ($options.isBasic) {
    _push(`<div${ssrRenderAttrs(mergeProps({ class: "p-fileupload p-fileupload-basic p-component" }, _attrs))}><!--[-->`);
    ssrRenderList($data.messages, (msg) => {
      _push(ssrRenderComponent(_component_FileUploadMessage, {
        key: msg,
        severity: "error",
        onClose: $options.onMessageClose
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`${ssrInterpolate(msg)}`);
          } else {
            return [
              createTextVNode(toDisplayString(msg), 1)
            ];
          }
        }),
        _: 2
      }, _parent));
    });
    _push(`<!--]--><span${ssrRenderAttrs(mergeProps({
      class: $options.basicChooseButtonClass,
      style: $props.style,
      tabindex: "0"
    }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}><span class="${ssrRenderClass($options.basicChooseButtonIconClass)}"></span><span class="p-button-label">${ssrInterpolate($options.basicChooseButtonLabel)}</span>`);
    if (!$options.hasFiles) {
      _push(`<input type="file"${ssrRenderAttr("accept", $props.accept)}${ssrIncludeBooleanAttr($props.disabled) ? " disabled" : ""}${ssrIncludeBooleanAttr($props.multiple) ? " multiple" : ""}>`);
    } else {
      _push(`<!---->`);
    }
    _push(`</span></div>`);
  } else {
    _push(`<!---->`);
  }
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/fileupload/FileUpload.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const PrimevueFileupload = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$2]]);
const _sfc_main$1 = {
  components: {
    Avatar,
    PrimevueButton,
    PrimevueColorpicker,
    PrimevueFileupload,
    PrimevueInputtext
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  inject: ["i18n"],
  props: {
    avatar: {
      type: Object,
      required: true
    }
  },
  data: () => ({
    changed: false,
    color: null,
    file: null,
    model: null
  }),
  created() {
    this.reset();
  },
  methods: {
    destroy() {
      const method = this.avatar.actions.delete.method;
      const uri = this.avatar.actions.delete.uri;
      this.$inertia[method](uri, { onSuccess: () => this.reset() });
    },
    preview() {
      this.model.color = `#${this.color}`;
      this.changed = true;
    },
    reset() {
      this.model = { ...this.avatar };
      this.color = this.model.color.replace("#", "");
      this.changed = false;
      delete this.model.actions;
    },
    update() {
      const method = this.avatar.actions.update.method;
      const uri = this.avatar.actions.update.uri;
      this.$inertia[method](uri, { color: this.color }, { onSuccess: () => this.reset() });
    },
    upload(payload) {
      this.file = payload.files[0];
      const form = useForm({
        image: this.file
      });
      const method = this.avatar.actions.upload.method;
      const uri = this.avatar.actions.upload.uri;
      form[method](uri, { onSuccess: () => this.reset() });
    }
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_avatar = resolveComponent("avatar");
  const _component_primevue_button = resolveComponent("primevue-button");
  const _component_primevue_colorpicker = resolveComponent("primevue-colorpicker");
  const _component_primevue_inputtext = resolveComponent("primevue-inputtext");
  const _component_primevue_fileupload = resolveComponent("primevue-fileupload");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "avatar-editor flex align-items-center my-1" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_avatar, {
    avatar: _ctx.model,
    size: "xl"
  }, null, _parent));
  if ($props.avatar.file) {
    _push(`<div class="flex align-items-center mx-3">`);
    _push(ssrRenderComponent(_component_primevue_button, mergeProps({
      class: "p-button-xs p-button-danger mr-2",
      icon: "pi pi-times",
      onClick: $options.destroy
    }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("Remove this avatar"), void 0, { top: true })), null, _parent));
    _push(` ${ssrInterpolate($props.avatar.file.name)}</div>`);
  } else {
    _push(`<div class="flex flex-column justify-content-center mx-3"><div class="flex align-items-center my-2">`);
    _push(ssrRenderComponent(_component_primevue_colorpicker, {
      modelValue: _ctx.color,
      "onUpdate:modelValue": ($event) => _ctx.color = $event
    }, null, _parent));
    _push(ssrRenderComponent(_component_primevue_inputtext, {
      class: "p-inputtext-sm",
      modelValue: _ctx.color,
      "onUpdate:modelValue": ($event) => _ctx.color = $event
    }, null, _parent));
    if (!_ctx.changed) {
      _push(ssrRenderComponent(_component_primevue_button, mergeProps({
        class: "p-button-sm ml-2",
        icon: "pi pi-eye",
        disabled: `#${_ctx.color}` === _ctx.model.color,
        onClick: $options.preview
      }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("Preview this color"), void 0, { top: true })), null, _parent));
    } else {
      _push(`<!---->`);
    }
    if (_ctx.changed) {
      _push(ssrRenderComponent(_component_primevue_button, mergeProps({
        class: "p-button-sm p-button-danger ml-1",
        icon: "pi pi-times",
        onClick: $options.reset
      }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("I don't like it!"), void 0, { top: true })), null, _parent));
    } else {
      _push(`<!---->`);
    }
    if (_ctx.changed) {
      _push(ssrRenderComponent(_component_primevue_button, mergeProps({
        class: "p-button-sm p-button-success ml-1",
        icon: "pi pi-check",
        onClick: $options.update
      }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("I like it!"), void 0, { top: true })), null, _parent));
    } else {
      _push(`<!---->`);
    }
    _push(`</div><div class="flex align-items-center my-2">`);
    _push(ssrRenderComponent(_component_primevue_fileupload, {
      class: "p-button-primary p-button-icon-only",
      accept: "image/*",
      mode: "basic",
      name: "files[]",
      icon: "pi pi-plus",
      "custom-upload": true,
      onSelect: $options.upload
    }, null, _parent));
    _push(`<label class="text-sm mx-2">${ssrInterpolate($options.i18n("Upload an avatar image"))} <br> (max: 256x256 pixels) </label></div></div>`);
  }
  _push(`</div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/ui/avatars/AvatarEditor.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const AvatarEditor = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  layout: App,
  components: {
    AvatarEditor,
    PageHeader,
    PrimevueCard
  },
  inject: ["i18n"],
  props: {
    user: {
      type: Object,
      required: true
    },
    avatar: {
      type: Object,
      required: true
    }
  },
  computed: {
    title() {
      return this.user.is_myself ? "Update My Avatar" : "Update Avatar";
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_primevue_card = resolveComponent("primevue-card");
  const _component_avatar_editor = resolveComponent("avatar-editor");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content main" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, {
    "back-button": "",
    title: $options.title
  }, null, _parent));
  _push(`<section class="auto-margin container max-width-lg">`);
  _push(ssrRenderComponent(_component_primevue_card, { class: "mb-3" }, {
    header: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<header class="header"${_scopeId}><h3 class="auto-margin max-width-sm"${_scopeId}>${ssrInterpolate($options.i18n("Select a color or upload an image for this avatar."))}</h3></header>`);
      } else {
        return [
          createVNode("header", { class: "header" }, [
            createVNode("h3", { class: "auto-margin max-width-sm" }, toDisplayString($options.i18n("Select a color or upload an image for this avatar.")), 1)
          ])
        ];
      }
    }),
    content: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_avatar_editor, {
          avatar: $props.avatar,
          class: "auto-margin width-sm"
        }, null, _parent2, _scopeId));
      } else {
        return [
          createVNode(_component_avatar_editor, {
            avatar: $props.avatar,
            class: "auto-margin width-sm"
          }, null, 8, ["avatar"])
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</section></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/users/avatar/Edit.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Edit = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Edit as default
};
