import { _ as _sfc_main$1 } from "./FormField-dafe0416.mjs";
import { P as PrimevueInputtext } from "./InputText-d441a729.mjs";
import PrimevueTooltip from "primevue/tooltip/tooltip.cjs.js";
import { resolveComponent, resolveDirective, mergeProps, withCtx, openBlock, createBlock, createCommentVNode, withDirectives, createVNode, toDisplayString, vShow, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderClass, ssrRenderStyle, ssrRenderAttr, ssrInterpolate, ssrRenderAttrs, ssrGetDirectiveProps } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
const _sfc_main = {
  inheritAttrs: false,
  components: {
    HeadlessFormField: _sfc_main$1,
    PrimevueInputText: PrimevueInputtext
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  props: {
    creating: {
      type: Boolean,
      default: false
    },
    field: {
      type: Object,
      required: true
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
    show: {
      type: Boolean,
      default: true
    },
    updating: {
      type: Boolean,
      default: false
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_headless_form_field = resolveComponent("headless-form-field");
  const _component_primevue_input_text = resolveComponent("primevue-input-text");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(ssrRenderComponent(_component_headless_form_field, mergeProps(_ctx.$props, _attrs), {
    default: withCtx(({ dirty, disabled, error, label, placeholder, update }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        if ($props.field.before) {
          _push2(`<div class="${ssrRenderClass($props.field.before)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`<div style="${ssrRenderStyle($props.show ? null : { display: "none" })}" class="${ssrRenderClass([[_ctx.$attrs.class, $props.field.class, $props.labels], "control field text"])}"${_scopeId}>`);
        if (label) {
          _push2(`<label class="label"${ssrRenderAttr("for", $props.id)}${_scopeId}>${ssrInterpolate(label)}</label>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(ssrRenderComponent(_component_primevue_input_text, {
          class: ["w-full", {
            "is-creating": dirty && $props.creating,
            "is-updating": dirty && $props.updating,
            "p-inputtext-lg": $props.isLarge,
            "p-inputtext-sm": $props.isSmall,
            "p-invalid": error
          }],
          type: "text",
          ref: "field",
          focus: "",
          modelValue: $props.form[$props.id],
          "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
            update();
            _ctx.$emit("update:modelValue", $event);
          }],
          disabled,
          id: $props.id,
          placeholder
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
          withDirectives(createVNode("div", {
            class: ["control field text", [_ctx.$attrs.class, $props.field.class, $props.labels]]
          }, [
            label ? (openBlock(), createBlock("label", {
              key: 0,
              class: "label",
              for: $props.id
            }, toDisplayString(label), 9, ["for"])) : createCommentVNode("", true),
            createVNode(_component_primevue_input_text, {
              class: ["w-full", {
                "is-creating": dirty && $props.creating,
                "is-updating": dirty && $props.updating,
                "p-inputtext-lg": $props.isLarge,
                "p-inputtext-sm": $props.isSmall,
                "p-invalid": error
              }],
              type: "text",
              ref: "field",
              focus: "",
              modelValue: $props.form[$props.id],
              "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
                update();
                _ctx.$emit("update:modelValue", $event);
              }],
              disabled,
              id: $props.id,
              placeholder
            }, null, 8, ["modelValue", "onUpdate:modelValue", "class", "disabled", "id", "placeholder", "type"]),
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
          ], 2), [
            [vShow, $props.show]
          ]),
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/fields/TextField.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const TextField = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  TextField as T
};
