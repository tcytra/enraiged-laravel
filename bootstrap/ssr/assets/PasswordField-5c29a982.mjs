import { _ as _sfc_main$2 } from "./FormField-dafe0416.mjs";
import InputText from "primevue/inputtext";
import OverlayEventBus from "primevue/overlayeventbus";
import Portal from "primevue/portal";
import { ZIndexUtils, DomHandler, ConnectedOverlayScrollHandler, UniqueComponentId } from "primevue/utils";
import { useSSRContext, resolveComponent, mergeProps, withCtx, createVNode, Transition, openBlock, createBlock, renderSlot, toDisplayString, createCommentVNode, resolveDirective, withDirectives } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderClass, ssrInterpolate, ssrRenderSlot, ssrRenderStyle, ssrRenderAttr, ssrGetDirectiveProps } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import PrimevueTooltip from "primevue/tooltip/tooltip.cjs.js";
const Password_vue_vue_type_style_index_0_lang = "";
const _sfc_main$1 = {
  name: "Password",
  emits: ["update:modelValue", "change", "focus", "blur", "invalid"],
  props: {
    modelValue: String,
    promptLabel: {
      type: String,
      default: null
    },
    mediumRegex: {
      type: String,
      default: "^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})"
      // eslint-disable-line
    },
    strongRegex: {
      type: String,
      default: "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})"
      // eslint-disable-line
    },
    weakLabel: {
      type: String,
      default: null
    },
    mediumLabel: {
      type: String,
      default: null
    },
    strongLabel: {
      type: String,
      default: null
    },
    feedback: {
      type: Boolean,
      default: true
    },
    appendTo: {
      type: String,
      default: "body"
    },
    toggleMask: {
      type: Boolean,
      default: false
    },
    hideIcon: {
      type: String,
      default: "pi pi-eye-slash"
    },
    showIcon: {
      type: String,
      default: "pi pi-eye"
    },
    disabled: {
      type: Boolean,
      default: false
    },
    placeholder: {
      type: String,
      default: null
    },
    required: {
      type: Boolean,
      default: false
    },
    inputId: {
      type: String,
      default: null
    },
    inputClass: {
      type: String,
      default: null
    },
    inputStyle: {
      type: null,
      default: null
    },
    inputProps: {
      type: null,
      default: null
    },
    panelId: {
      type: String,
      default: null
    },
    panelClass: {
      type: String,
      default: null
    },
    panelStyle: {
      type: null,
      default: null
    },
    panelProps: {
      type: null,
      default: null
    },
    "aria-labelledby": {
      type: String,
      default: null
    },
    "aria-label": {
      type: String,
      default: null
    }
  },
  data() {
    return {
      overlayVisible: false,
      meter: null,
      infoText: null,
      focused: false,
      unmasked: false
    };
  },
  mediumCheckRegExp: null,
  strongCheckRegExp: null,
  resizeListener: null,
  scrollHandler: null,
  overlay: null,
  mounted() {
    this.infoText = this.promptText;
    this.mediumCheckRegExp = new RegExp(this.mediumRegex);
    this.strongCheckRegExp = new RegExp(this.strongRegex);
  },
  beforeUnmount() {
    this.unbindResizeListener();
    if (this.scrollHandler) {
      this.scrollHandler.destroy();
      this.scrollHandler = null;
    }
    if (this.overlay) {
      ZIndexUtils.clear(this.overlay);
      this.overlay = null;
    }
  },
  methods: {
    onOverlayEnter(el) {
      ZIndexUtils.set("overlay", el, this.$primevue.config.zIndex.overlay);
      this.alignOverlay();
      this.bindScrollListener();
      this.bindResizeListener();
    },
    onOverlayLeave() {
      this.unbindScrollListener();
      this.unbindResizeListener();
      this.overlay = null;
    },
    onOverlayAfterLeave(el) {
      ZIndexUtils.clear(el);
    },
    alignOverlay() {
      if (this.appendTo === "self") {
        DomHandler.relativePosition(this.overlay, this.$refs.input.$el);
      } else {
        this.overlay.style.minWidth = DomHandler.getOuterWidth(this.$refs.input.$el) + "px";
        DomHandler.absolutePosition(this.overlay, this.$refs.input.$el);
      }
    },
    testStrength(str) {
      let level = 0;
      if (this.strongCheckRegExp.test(str))
        level = 3;
      else if (this.mediumCheckRegExp.test(str))
        level = 2;
      else if (str.length)
        level = 1;
      return level;
    },
    onInput(event) {
      this.$emit("update:modelValue", event.target.value);
    },
    onFocus(event) {
      this.focused = true;
      if (this.feedback) {
        this.setPasswordMeter(this.modelValue);
        this.overlayVisible = true;
      }
      this.$emit("focus", event);
    },
    onBlur(event) {
      this.focused = false;
      if (this.feedback) {
        this.overlayVisible = false;
      }
      this.$emit("blur", event);
    },
    onKeyUp(event) {
      if (this.feedback) {
        const value = event.target.value;
        const { meter, label } = this.checkPasswordStrength(value);
        this.meter = meter;
        this.infoText = label;
        if (event.code === "Escape") {
          this.overlayVisible && (this.overlayVisible = false);
          return;
        }
        if (!this.overlayVisible) {
          this.overlayVisible = true;
        }
      }
    },
    setPasswordMeter() {
      if (!this.modelValue)
        return;
      const { meter, label } = this.checkPasswordStrength(this.modelValue);
      this.meter = meter;
      this.infoText = label;
      if (!this.overlayVisible) {
        this.overlayVisible = true;
      }
    },
    checkPasswordStrength(value) {
      let label = null;
      let meter = null;
      switch (this.testStrength(value)) {
        case 1:
          label = this.weakText;
          meter = {
            strength: "weak",
            width: "33.33%"
          };
          break;
        case 2:
          label = this.mediumText;
          meter = {
            strength: "medium",
            width: "66.66%"
          };
          break;
        case 3:
          label = this.strongText;
          meter = {
            strength: "strong",
            width: "100%"
          };
          break;
        default:
          label = this.promptText;
          meter = null;
          break;
      }
      return { label, meter };
    },
    onInvalid(event) {
      this.$emit("invalid", event);
    },
    bindScrollListener() {
      if (!this.scrollHandler) {
        this.scrollHandler = new ConnectedOverlayScrollHandler(this.$refs.input.$el, () => {
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
    overlayRef(el) {
      this.overlay = el;
    },
    onMaskToggle() {
      this.unmasked = !this.unmasked;
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
      return [
        "p-password p-component p-inputwrapper",
        {
          "p-inputwrapper-filled": this.filled,
          "p-inputwrapper-focus": this.focused,
          "p-input-icon-right": this.toggleMask
        }
      ];
    },
    inputFieldClass() {
      return [
        "p-password-input",
        this.inputClass,
        {
          "p-disabled": this.disabled
        }
      ];
    },
    panelStyleClass() {
      return [
        "p-password-panel p-component",
        this.panelClass,
        {
          "p-input-filled": this.$primevue.config.inputStyle === "filled",
          "p-ripple-disabled": this.$primevue.config.ripple === false
        }
      ];
    },
    toggleIconClass() {
      return this.unmasked ? this.hideIcon : this.showIcon;
    },
    strengthClass() {
      return `p-password-strength ${this.meter ? this.meter.strength : ""}`;
    },
    inputType() {
      return this.unmasked ? "text" : "password";
    },
    filled() {
      return this.modelValue != null && this.modelValue.toString().length > 0;
    },
    weakText() {
      return this.weakLabel || this.$primevue.config.locale.weak;
    },
    mediumText() {
      return this.mediumLabel || this.$primevue.config.locale.medium;
    },
    strongText() {
      return this.strongLabel || this.$primevue.config.locale.strong;
    },
    promptText() {
      return this.promptLabel || this.$primevue.config.locale.passwordPrompt;
    },
    panelUniqueId() {
      return UniqueComponentId() + "_panel";
    }
  },
  components: {
    PInputText: InputText,
    Portal
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_PInputText = resolveComponent("PInputText");
  const _component_Portal = resolveComponent("Portal");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: $options.containerClass }, _attrs))}>`);
  _push(ssrRenderComponent(_component_PInputText, mergeProps({
    ref: "input",
    id: $props.inputId,
    type: $options.inputType,
    class: $options.inputFieldClass,
    style: $props.inputStyle,
    value: $props.modelValue,
    "aria-labelledby": _ctx.ariaLabelledby,
    "aria-label": _ctx.ariaLabel,
    "aria-controls": $props.panelProps && $props.panelProps.id || $props.panelId || $options.panelUniqueId,
    "aria-expanded": $data.overlayVisible,
    "aria-haspopup": true,
    placeholder: $props.placeholder,
    required: $props.required,
    onInput: $options.onInput,
    onFocus: $options.onFocus,
    onBlur: $options.onBlur,
    onKeyup: $options.onKeyUp,
    onInvalid: $options.onInvalid
  }, $props.inputProps), null, _parent));
  if ($props.toggleMask) {
    _push(`<i class="${ssrRenderClass($options.toggleIconClass)}"></i>`);
  } else {
    _push(`<!---->`);
  }
  _push(`<span class="p-hidden-accessible" aria-live="polite">${ssrInterpolate($data.infoText)}</span>`);
  _push(ssrRenderComponent(_component_Portal, { appendTo: $props.appendTo }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(``);
        if ($data.overlayVisible) {
          _push2(`<div${ssrRenderAttrs(mergeProps({
            ref: $options.overlayRef,
            id: $props.panelId || $options.panelUniqueId,
            class: $options.panelStyleClass,
            style: $props.panelStyle
          }, $props.panelProps))}${_scopeId}>`);
          ssrRenderSlot(_ctx.$slots, "header", {}, null, _push2, _parent2, _scopeId);
          ssrRenderSlot(_ctx.$slots, "content", {}, () => {
            _push2(`<div class="p-password-meter"${_scopeId}><div class="${ssrRenderClass($options.strengthClass)}" style="${ssrRenderStyle({ width: $data.meter ? $data.meter.width : "" })}"${_scopeId}></div></div><div class="p-password-info"${_scopeId}>${ssrInterpolate($data.infoText)}</div>`);
          }, _push2, _parent2, _scopeId);
          ssrRenderSlot(_ctx.$slots, "footer", {}, null, _push2, _parent2, _scopeId);
          _push2(`</div>`);
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
              $data.overlayVisible ? (openBlock(), createBlock("div", mergeProps({
                key: 0,
                ref: $options.overlayRef,
                id: $props.panelId || $options.panelUniqueId,
                class: $options.panelStyleClass,
                style: $props.panelStyle,
                onClick: $options.onOverlayClick
              }, $props.panelProps), [
                renderSlot(_ctx.$slots, "header"),
                renderSlot(_ctx.$slots, "content", {}, () => [
                  createVNode("div", { class: "p-password-meter" }, [
                    createVNode("div", {
                      class: $options.strengthClass,
                      style: { width: $data.meter ? $data.meter.width : "" }
                    }, null, 6)
                  ]),
                  createVNode("div", { class: "p-password-info" }, toDisplayString($data.infoText), 1)
                ]),
                renderSlot(_ctx.$slots, "footer")
              ], 16, ["id", "onClick"])) : createCommentVNode("", true)
            ]),
            _: 3
          }, 8, ["onEnter", "onLeave", "onAfterLeave"])
        ];
      }
    }),
    _: 3
  }, _parent));
  _push(`</div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/password/Password.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const PrimevuePassword = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  inheritAttrs: false,
  components: {
    HeadlessFormField: _sfc_main$2,
    PrimevuePassword
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  props: {
    field: {
      type: Object,
      required: true
    },
    confirm: {
      type: Boolean,
      default: false
    },
    feedback: {
      type: Boolean,
      default: false
    },
    focus: {
      type: Boolean,
      default: false
    },
    form: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    },
    isLarge: {
      type: Boolean,
      default: false
    },
    isSmall: {
      type: Boolean,
      default: false
    },
    labels: {
      type: String,
      default: null
    },
    unmask: {
      type: Boolean,
      default: false
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_headless_form_field = resolveComponent("headless-form-field");
  const _component_primevue_password = resolveComponent("primevue-password");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(ssrRenderComponent(_component_headless_form_field, mergeProps(_ctx.$props, _attrs), {
    default: withCtx(({ disabled, error, label, placeholder, update }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        if ($props.field.before) {
          _push2(`<div class="${ssrRenderClass($props.field.before)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`<div class="${ssrRenderClass([[_ctx.$attrs.class, $props.field.class, { confirm: $props.confirm }, $props.labels], "control field text"])}"${_scopeId}>`);
        if (label) {
          _push2(`<label class="label"${ssrRenderAttr("for", $props.id)}${_scopeId}>${ssrInterpolate(label)}</label>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(ssrRenderComponent(_component_primevue_password, {
          class: ["w-full", {
            "p-inputtext-lg": $props.isLarge,
            "p-inputtext-sm": $props.isSmall,
            "p-invalid": error
          }],
          ref: "field",
          focus: "",
          modelValue: $props.form[$props.id],
          "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
            update();
            _ctx.$emit("update:modelValue", $event);
          }],
          disabled,
          feedback: $props.field.feedback || $props.feedback,
          id: $props.id,
          placeholder: $props.field.placeholder || placeholder,
          "toggle-mask": $props.field.unmask || $props.unmask
        }, null, _parent2, _scopeId));
        if (error) {
          _push2(`<div class="error p-error"${_scopeId}><i${ssrRenderAttrs(mergeProps({ class: "pi pi-exclamation-circle" }, ssrGetDirectiveProps(_ctx, _directive_tooltip, error, void 0, { top: true })))}${_scopeId}></i><span class="message"${_scopeId}>${ssrInterpolate(error)}</span></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`</div>`);
        if ($props.field.after) {
          _push2(`<div class="${ssrRenderClass($props.field.after)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
      } else {
        return [
          $props.field.before ? (openBlock(), createBlock("div", {
            key: 0,
            class: $props.field.before
          }, null, 2)) : createCommentVNode("", true),
          createVNode("div", {
            class: ["control field text", [_ctx.$attrs.class, $props.field.class, { confirm: $props.confirm }, $props.labels]]
          }, [
            label ? (openBlock(), createBlock("label", {
              key: 0,
              class: "label",
              for: $props.id
            }, toDisplayString(label), 9, ["for"])) : createCommentVNode("", true),
            createVNode(_component_primevue_password, {
              class: ["w-full", {
                "p-inputtext-lg": $props.isLarge,
                "p-inputtext-sm": $props.isSmall,
                "p-invalid": error
              }],
              ref: "field",
              focus: "",
              modelValue: $props.form[$props.id],
              "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
                update();
                _ctx.$emit("update:modelValue", $event);
              }],
              disabled,
              feedback: $props.field.feedback || $props.feedback,
              id: $props.id,
              placeholder: $props.field.placeholder || placeholder,
              "toggle-mask": $props.field.unmask || $props.unmask
            }, null, 8, ["modelValue", "onUpdate:modelValue", "class", "disabled", "feedback", "id", "placeholder", "toggle-mask"]),
            error ? (openBlock(), createBlock("div", {
              key: 1,
              class: "error p-error"
            }, [
              withDirectives(createVNode("i", { class: "pi pi-exclamation-circle" }, null, 512), [
                [
                  _directive_tooltip,
                  error,
                  void 0,
                  { top: true }
                ]
              ]),
              createVNode("span", { class: "message" }, toDisplayString(error), 1)
            ])) : createCommentVNode("", true)
          ], 2),
          $props.field.after ? (openBlock(), createBlock("div", {
            key: 1,
            class: $props.field.after
          }, null, 2)) : createCommentVNode("", true)
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/fields/PasswordField.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PasswordField = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PasswordField as P
};
