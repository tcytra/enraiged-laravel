import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueCard } from "./Card-fe8810d1.mjs";
import { resolveComponent, mergeProps, withCtx, createVNode, toDisplayString, createTextVNode, openBlock, createBlock, createCommentVNode, useSSRContext } from "vue";
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
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PrimevueCard
  },
  inject: ["clientSize", "clientWidth", "i18n", "isMobile", "isTablet", "meta", "user"]
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_primevue_card = resolveComponent("primevue-card");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content flex-column main flex" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, {
    fixed: "",
    title: $options.i18n("Dashboard")
  }, null, _parent));
  _push(`<section class="align-self-center container max-width-xl w-full">`);
  _push(ssrRenderComponent(_component_primevue_card, { class: "mb-3 shadow-1" }, {
    header: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<header class="header"${_scopeId}><h3${_scopeId}>${ssrInterpolate($options.i18n("This is your dashboard."))}</h3></header>`);
      } else {
        return [
          createVNode("header", { class: "header" }, [
            createVNode("h3", null, toDisplayString($options.i18n("This is your dashboard.")), 1)
          ])
        ];
      }
    }),
    content: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<p class="mb-3"${_scopeId}>${ssrInterpolate($options.user.profile.name)}</p><p class="mb-3"${_scopeId}> clientSize: ${ssrInterpolate($options.clientSize.toUpperCase())} clientWidth: ${ssrInterpolate($options.clientWidth)}px `);
        if ($options.isMobile || $options.isTablet) {
          _push2(`<em${_scopeId}> (${ssrInterpolate($options.isMobile ? "mobile" : "")}${ssrInterpolate($options.isTablet ? "tablet" : "")} width) </em>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`</p><p class="mb-1"${_scopeId}>${ssrInterpolate($options.meta.app_version)}</p>`);
      } else {
        return [
          createVNode("p", { class: "mb-3" }, toDisplayString($options.user.profile.name), 1),
          createVNode("p", { class: "mb-3" }, [
            createTextVNode(" clientSize: " + toDisplayString($options.clientSize.toUpperCase()) + " clientWidth: " + toDisplayString($options.clientWidth) + "px ", 1),
            $options.isMobile || $options.isTablet ? (openBlock(), createBlock("em", { key: 0 }, " (" + toDisplayString($options.isMobile ? "mobile" : "") + toDisplayString($options.isTablet ? "tablet" : "") + " width) ", 1)) : createCommentVNode("", true)
          ]),
          createVNode("p", { class: "mb-1" }, toDisplayString($options.meta.app_version), 1)
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/Dashboard.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Dashboard = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Dashboard as default
};
