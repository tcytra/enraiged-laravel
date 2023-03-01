import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueCard } from "./Card-fe8810d1.mjs";
import { V as VueForm } from "./VueForm-c5643d66.mjs";
import { resolveComponent, mergeProps, withCtx, createVNode, toDisplayString, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrInterpolate } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "date-fns";
import "@inertiajs/vue3";
import "./Button-8c19e69a.mjs";
import "primevue/ripple";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "./FormField-dafe0416.mjs";
import "primevue/overlayeventbus";
import "primevue/portal";
import "primevue/utils";
import "./Dropdown-1272b7b2.mjs";
import "primevue/api";
import "primevue/virtualscroller";
import "./PasswordField-5c29a982.mjs";
import "primevue/inputtext";
import "./SwitchField-cfe5ecaa.mjs";
import "./InputSwitch-c8ce2fca.mjs";
import "./TextField-9739c1e8.mjs";
import "./InputText-d441a729.mjs";
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PrimevueCard,
    VueForm
  },
  inject: ["i18n"],
  props: {
    page: {
      type: Object,
      required: true
    },
    template: {
      type: Object,
      required: true
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_primevue_card = resolveComponent("primevue-card");
  const _component_vue_form = resolveComponent("vue-form");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content main" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, {
    "back-button": "",
    heading: $props.page.heading,
    title: $props.page.title
  }, null, _parent));
  _push(`<section class="auto-margin container max-width-lg">`);
  _push(ssrRenderComponent(_component_primevue_card, null, {
    header: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<header class="header"${_scopeId}><h3 class="auto-margin max-width-md"${_scopeId}>${ssrInterpolate($options.i18n("Please provide the following information to create a new user."))}</h3></header>`);
      } else {
        return [
          createVNode("header", { class: "header" }, [
            createVNode("h3", { class: "auto-margin max-width-md" }, toDisplayString($options.i18n("Please provide the following information to create a new user.")), 1)
          ])
        ];
      }
    }),
    content: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<div class="auto-margin container max-width-md"${_scopeId}>`);
        _push2(ssrRenderComponent(_component_vue_form, {
          template: $props.template,
          creating: ""
        }, null, _parent2, _scopeId));
        _push2(`</div>`);
      } else {
        return [
          createVNode("div", { class: "auto-margin container max-width-md" }, [
            createVNode(_component_vue_form, {
              template: $props.template,
              creating: ""
            }, null, 8, ["template"])
          ])
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/users/Create.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Create = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Create as default
};
