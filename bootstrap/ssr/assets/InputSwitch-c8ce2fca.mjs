import { useSSRContext, mergeProps } from "vue";
import { ssrRenderAttrs } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
const InputSwitch_vue_vue_type_style_index_0_lang = "";
const _sfc_main = {
  name: "InputSwitch",
  emits: ["click", "update:modelValue", "change", "input", "focus", "blur"],
  props: {
    modelValue: {
      type: null,
      default: false
    },
    trueValue: {
      type: null,
      default: true
    },
    falseValue: {
      type: null,
      default: false
    },
    disabled: {
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
      focused: false
    };
  },
  methods: {
    onClick(event) {
      if (!this.disabled) {
        const newValue = this.checked ? this.falseValue : this.trueValue;
        this.$emit("click", event);
        this.$emit("update:modelValue", newValue);
        this.$emit("change", event);
        this.$emit("input", newValue);
        this.$refs.input.focus();
      }
      event.preventDefault();
    },
    onFocus(event) {
      this.focused = true;
      this.$emit("focus", event);
    },
    onBlur(event) {
      this.focused = false;
      this.$emit("blur", event);
    }
  },
  computed: {
    containerClass() {
      return [
        "p-inputswitch p-component",
        {
          "p-inputswitch-checked": this.checked,
          "p-disabled": this.disabled,
          "p-focus": this.focused
        }
      ];
    },
    checked() {
      return this.modelValue === this.trueValue;
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<div${ssrRenderAttrs(mergeProps({ class: $options.containerClass }, _attrs))}><div class="p-hidden-accessible"><input${ssrRenderAttrs(mergeProps({
    ref: "input",
    id: $props.inputId,
    type: "checkbox",
    role: "switch",
    class: $props.inputClass,
    style: $props.inputStyle,
    checked: $options.checked,
    disabled: $props.disabled,
    "aria-checked": $options.checked,
    "aria-labelledby": _ctx.ariaLabelledby,
    "aria-label": _ctx.ariaLabel
  }, $props.inputProps))}></div><span class="p-inputswitch-slider"></span></div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/inputswitch/InputSwitch.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PrimevueSwitch = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PrimevueSwitch as P
};
