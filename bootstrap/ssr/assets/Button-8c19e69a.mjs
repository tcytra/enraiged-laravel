import Ripple from "primevue/ripple";
import { resolveDirective, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrGetDirectiveProps, ssrRenderSlot, ssrRenderClass, ssrInterpolate } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
const _sfc_main = {
  name: "Button",
  props: {
    label: {
      type: String,
      default: null
    },
    icon: {
      type: String,
      default: null
    },
    iconPos: {
      type: String,
      default: "left"
    },
    iconClass: {
      type: String,
      default: null
    },
    badge: {
      type: String,
      default: null
    },
    badgeClass: {
      type: String,
      default: null
    },
    loading: {
      type: Boolean,
      default: false
    },
    loadingIcon: {
      type: String,
      default: "pi pi-spinner pi-spin"
    }
  },
  computed: {
    buttonClass() {
      return {
        "p-button p-component": true,
        "p-button-icon-only": this.icon && !this.label,
        "p-button-vertical": (this.iconPos === "top" || this.iconPos === "bottom") && this.label,
        "p-disabled": this.$attrs.disabled || this.loading,
        "p-button-loading": this.loading,
        "p-button-loading-label-only": this.loading && !this.icon && this.label
      };
    },
    iconStyleClass() {
      return [
        this.loading ? "p-button-loading-icon " + this.loadingIcon : this.icon,
        "p-button-icon",
        this.iconClass,
        {
          "p-button-icon-left": this.iconPos === "left" && this.label,
          "p-button-icon-right": this.iconPos === "right" && this.label,
          "p-button-icon-top": this.iconPos === "top" && this.label,
          "p-button-icon-bottom": this.iconPos === "bottom" && this.label
        }
      ];
    },
    badgeStyleClass() {
      return [
        "p-badge p-component",
        this.badgeClass,
        {
          "p-badge-no-gutter": this.badge && String(this.badge).length === 1
        }
      ];
    },
    disabled() {
      return this.$attrs.disabled || this.loading;
    },
    defaultAriaLabel() {
      return this.label ? this.label + (this.badge ? " " + this.badge : "") : this.$attrs["aria-label"];
    }
  },
  directives: {
    ripple: Ripple
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _directive_ripple = resolveDirective("ripple");
  _push(`<button${ssrRenderAttrs(mergeProps({
    class: $options.buttonClass,
    type: "button",
    "aria-label": $options.defaultAriaLabel,
    disabled: $options.disabled
  }, _attrs, ssrGetDirectiveProps(_ctx, _directive_ripple)))}>`);
  ssrRenderSlot(_ctx.$slots, "default", {}, () => {
    if ($props.loading && !$props.icon) {
      _push(`<span class="${ssrRenderClass($options.iconStyleClass)}"></span>`);
    } else {
      _push(`<!---->`);
    }
    if ($props.icon) {
      _push(`<span class="${ssrRenderClass($options.iconStyleClass)}"></span>`);
    } else {
      _push(`<!---->`);
    }
    _push(`<span class="p-button-label">${ssrInterpolate($props.label || " ")}</span>`);
    if ($props.badge) {
      _push(`<span class="${ssrRenderClass($options.badgeStyleClass)}">${ssrInterpolate($props.badge)}</span>`);
    } else {
      _push(`<!---->`);
    }
  }, _push, _parent);
  _push(`</button>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/button/Button.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PrimevueButton = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PrimevueButton as P
};
