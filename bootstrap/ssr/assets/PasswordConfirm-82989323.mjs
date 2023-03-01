import { useForm } from "@inertiajs/vue3";
import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import Ripple from "primevue/ripple";
import { UniqueComponentId } from "primevue/utils";
import { resolveDirective, mergeProps, useSSRContext, resolveComponent, withCtx, createVNode, withModifiers, createTextVNode, toDisplayString } from "vue";
import { ssrRenderAttrs, ssrRenderSlot, ssrRenderAttr, ssrInterpolate, ssrGetDirectiveProps, ssrRenderClass, ssrRenderStyle, ssrRenderComponent } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import { P as PasswordField } from "./PasswordField-5c29a982.mjs";
import "date-fns";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "./FormField-dafe0416.mjs";
import "primevue/inputtext";
import "primevue/overlayeventbus";
import "primevue/portal";
const Panel_vue_vue_type_style_index_0_lang = "";
const _sfc_main$1 = {
  name: "Panel",
  emits: ["update:collapsed", "toggle"],
  props: {
    header: String,
    toggleable: Boolean,
    collapsed: Boolean,
    toggleButtonProps: {
      type: null,
      default: null
    }
  },
  data() {
    return {
      d_collapsed: this.collapsed
    };
  },
  watch: {
    collapsed(newValue) {
      this.d_collapsed = newValue;
    }
  },
  methods: {
    toggle(event) {
      this.d_collapsed = !this.d_collapsed;
      this.$emit("update:collapsed", this.d_collapsed);
      this.$emit("toggle", {
        originalEvent: event,
        value: this.d_collapsed
      });
    },
    onKeyDown(event) {
      if (event.code === "Enter" || event.code === "Space") {
        this.toggle(event);
        event.preventDefault();
      }
    }
  },
  computed: {
    ariaId() {
      return UniqueComponentId();
    },
    containerClass() {
      return ["p-panel p-component", { "p-panel-toggleable": this.toggleable }];
    },
    buttonAriaLabel() {
      return this.toggleButtonProps && this.toggleButtonProps["aria-label"] ? this.toggleButtonProps["aria-label"] : this.header;
    }
  },
  directives: {
    ripple: Ripple
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _directive_ripple = resolveDirective("ripple");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: $options.containerClass }, _attrs))}><div class="p-panel-header">`);
  ssrRenderSlot(_ctx.$slots, "header", {}, () => {
    if ($props.header) {
      _push(`<span${ssrRenderAttr("id", $options.ariaId + "_header")} class="p-panel-title">${ssrInterpolate($props.header)}</span>`);
    } else {
      _push(`<!---->`);
    }
  }, _push, _parent);
  _push(`<div class="p-panel-icons">`);
  ssrRenderSlot(_ctx.$slots, "icons", {}, null, _push, _parent);
  if ($props.toggleable) {
    _push(`<button${ssrRenderAttrs(mergeProps({
      id: $options.ariaId + "_header",
      type: "button",
      role: "button",
      class: "p-panel-header-icon p-panel-toggler p-link",
      "aria-label": $options.buttonAriaLabel,
      "aria-controls": $options.ariaId + "_content",
      "aria-expanded": !$data.d_collapsed
    }, $props.toggleButtonProps, ssrGetDirectiveProps(_ctx, _directive_ripple)))}><span class="${ssrRenderClass({ "pi pi-minus": !$data.d_collapsed, "pi pi-plus": $data.d_collapsed })}"></span></button>`);
  } else {
    _push(`<!---->`);
  }
  _push(`</div></div><div style="${ssrRenderStyle(!$data.d_collapsed ? null : { display: "none" })}"${ssrRenderAttr("id", $options.ariaId + "_content")} class="p-toggleable-content" role="region"${ssrRenderAttr("aria-labelledby", $options.ariaId + "_header")}><div class="p-panel-content">`);
  ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
  _push(`</div></div></div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/panel/Panel.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const PrimevuePanel = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const PasswordConfirm_vue_vue_type_style_index_0_lang = "";
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PrimevueButton,
    PrimevuePanel,
    VuePasswordField: PasswordField
  },
  inject: ["i18n"],
  props: {
    form: Object
  },
  setup(props) {
    const form = useForm(props.form.fields);
    function submit() {
      form.post(props.form.uri);
    }
    function update(field) {
      form.clearErrors(field.id);
      form[field.id] = field.value;
    }
    return { form, submit, update };
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_primevue_panel = resolveComponent("primevue-panel");
  const _component_vue_password_field = resolveComponent("vue-password-field");
  const _component_primevue_button = resolveComponent("primevue-button");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "main content" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, { title: "Confirm Password" }, null, _parent));
  _push(`<div class="container p-3 flex align-items-center justify-content-center">`);
  _push(ssrRenderComponent(_component_primevue_panel, {
    class: "col-12 md:col-10 lg:col-8 confirm password",
    header: $options.i18n("Confirm Password")
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<form class="form relative"${_scopeId}><aside class="aside mb-5 text"${_scopeId}><strong${_scopeId}>${ssrInterpolate($options.i18n("This action is secure."))} <br${_scopeId}> ${ssrInterpolate($options.i18n("Please confirm your user password to proceed."))}</strong></aside><div class="center-x-small column container fields mb-5"${_scopeId}>`);
        _push2(ssrRenderComponent(_component_vue_password_field, {
          class: "horizontal m-0",
          id: "password",
          focus: "",
          "toggle-mask": "",
          field: { placeholder: "Password", required: true },
          form: $setup.form
        }, null, _parent2, _scopeId));
        _push2(`</div><div class="button center-x-small column container mb-3"${_scopeId}><div class="button control"${_scopeId}>`);
        _push2(ssrRenderComponent(_component_primevue_button, {
          class: "p-button-secondary",
          label: $options.i18n("Please confirm"),
          onClick: $setup.submit
        }, null, _parent2, _scopeId));
        _push2(`</div></div></form>`);
      } else {
        return [
          createVNode("form", {
            class: "form relative",
            onSubmit: withModifiers($setup.submit, ["prevent"])
          }, [
            createVNode("aside", { class: "aside mb-5 text" }, [
              createVNode("strong", null, [
                createTextVNode(toDisplayString($options.i18n("This action is secure.")) + " ", 1),
                createVNode("br"),
                createTextVNode(" " + toDisplayString($options.i18n("Please confirm your user password to proceed.")), 1)
              ])
            ]),
            createVNode("div", { class: "center-x-small column container fields mb-5" }, [
              createVNode(_component_vue_password_field, {
                class: "horizontal m-0",
                id: "password",
                focus: "",
                "toggle-mask": "",
                field: { placeholder: "Password", required: true },
                form: $setup.form
              }, null, 8, ["form"])
            ]),
            createVNode("div", { class: "button center-x-small column container mb-3" }, [
              createVNode("div", { class: "button control" }, [
                createVNode(_component_primevue_button, {
                  class: "p-button-secondary",
                  label: $options.i18n("Please confirm"),
                  onClick: $setup.submit
                }, null, 8, ["label", "onClick"])
              ])
            ])
          ], 40, ["onSubmit"])
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/auth/PasswordConfirm.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PasswordConfirm = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PasswordConfirm as default
};
