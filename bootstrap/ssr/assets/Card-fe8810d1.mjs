import { mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderSlot } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
const Card_vue_vue_type_style_index_0_lang = "";
const _sfc_main = {
  name: "Card"
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "p-card p-component" }, _attrs))}>`);
  if (_ctx.$slots.header) {
    _push(`<div class="p-card-header">`);
    ssrRenderSlot(_ctx.$slots, "header", {}, null, _push, _parent);
    _push(`</div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`<div class="p-card-body">`);
  if (_ctx.$slots.title) {
    _push(`<div class="p-card-title">`);
    ssrRenderSlot(_ctx.$slots, "title", {}, null, _push, _parent);
    _push(`</div>`);
  } else {
    _push(`<!---->`);
  }
  if (_ctx.$slots.subtitle) {
    _push(`<div class="p-card-subtitle">`);
    ssrRenderSlot(_ctx.$slots, "subtitle", {}, null, _push, _parent);
    _push(`</div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`<div class="p-card-content">`);
  ssrRenderSlot(_ctx.$slots, "content", {}, null, _push, _parent);
  _push(`</div>`);
  if (_ctx.$slots.footer) {
    _push(`<div class="p-card-footer">`);
    ssrRenderSlot(_ctx.$slots, "footer", {}, null, _push, _parent);
    _push(`</div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`</div></div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/card/Card.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PrimevueCard = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PrimevueCard as P
};
