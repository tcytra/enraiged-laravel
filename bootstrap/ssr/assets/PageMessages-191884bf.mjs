import { b as PrimevueMessage } from "./PageHeader-f063c111.mjs";
import { resolveComponent, mergeProps, withCtx, createTextVNode, toDisplayString, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderList, ssrRenderComponent, ssrInterpolate } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
const _sfc_main = {
  components: {
    PrimevueMessage
  },
  props: {
    class: {
      type: String,
      default: null
    },
    messages: {
      type: Array,
      default: []
    }
  },
  methods: {
    closable(message) {
      return typeof message.closable !== "undefined" ? message.closable : true;
    },
    severity(message) {
      return typeof message.severity !== "undefined" ? message.severity : "info";
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_message = resolveComponent("primevue-message");
  if ($props.messages.length) {
    _push(`<div${ssrRenderAttrs(mergeProps({
      class: ["help-messages", $props.class]
    }, _attrs))}><!--[-->`);
    ssrRenderList($props.messages, (message, index) => {
      _push(ssrRenderComponent(_component_primevue_message, {
        class: "m-0 mb-3",
        closable: $options.closable(message),
        severity: $options.severity(message),
        key: index,
        onClose: ($event) => _ctx.$emit("dismiss", index)
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`${ssrInterpolate(message.body)}`);
          } else {
            return [
              createTextVNode(toDisplayString(message.body), 1)
            ];
          }
        }),
        _: 2
      }, _parent));
    });
    _push(`<!--]--></div>`);
  } else {
    _push(`<!---->`);
  }
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/ui/pages/PageMessages.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PageMessages = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PageMessages as P
};
