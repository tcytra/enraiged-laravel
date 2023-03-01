import { a as Avatar, A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueCard } from "./Card-fe8810d1.mjs";
import { resolveComponent, withCtx, createVNode, toDisplayString, openBlock, createBlock, useSSRContext, mergeProps } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrRenderAttrs } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import { P as PageMessages } from "./PageMessages-191884bf.mjs";
import "date-fns";
import "@inertiajs/vue3";
import "./Button-8c19e69a.mjs";
import "primevue/ripple";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
const _sfc_main$1 = {
  components: {
    Avatar,
    PrimevueCard
  },
  inject: ["i18n"],
  props: {
    user: {
      type: Object,
      required: true
    }
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_card = resolveComponent("primevue-card");
  const _component_avatar = resolveComponent("avatar");
  _push(ssrRenderComponent(_component_primevue_card, _attrs, {
    content: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<div class="user-summary"${_scopeId}>`);
        _push2(ssrRenderComponent(_component_avatar, {
          action: "/my/avatar",
          class: "width-96",
          size: "xl",
          avatar: $props.user.avatar,
          editable: $props.user.is_myself
        }, null, _parent2, _scopeId));
        _push2(`<div class="descriptions flex-grow-1"${_scopeId}><div class="description-lists"${_scopeId}><dl${_scopeId}><dt${_scopeId}>${ssrInterpolate($options.i18n("Profile Name"))}:</dt><dd${_scopeId}>${ssrInterpolate($props.user.profile.name)}</dd></dl><dl${_scopeId}><dt${_scopeId}>${ssrInterpolate($options.i18n("Email Address"))}:</dt><dd${_scopeId}>${ssrInterpolate($props.user.email)}</dd></dl></div><div class="description-lists"${_scopeId}><dl${_scopeId}><dt${_scopeId}>${ssrInterpolate($options.i18n("Profile Created"))}:</dt><dd${_scopeId}>${ssrInterpolate($props.user.created.date)} ${ssrInterpolate($props.user.created.time)}</dd></dl><dl${_scopeId}><dt${_scopeId}>${ssrInterpolate($options.i18n("Last Updated"))}:</dt>`);
        if ($props.user.created.timestamp === $props.user.updated.timestamp) {
          _push2(`<dd${_scopeId}><em class="empty"${_scopeId}>-</em></dd>`);
        } else {
          _push2(`<dd${_scopeId}>${ssrInterpolate($props.user.updated.date)} ${ssrInterpolate($props.user.updated.time)}</dd>`);
        }
        _push2(`</dl></div></div></div>`);
      } else {
        return [
          createVNode("div", { class: "user-summary" }, [
            createVNode(_component_avatar, {
              action: "/my/avatar",
              class: "width-96",
              size: "xl",
              avatar: $props.user.avatar,
              editable: $props.user.is_myself
            }, null, 8, ["avatar", "editable"]),
            createVNode("div", { class: "descriptions flex-grow-1" }, [
              createVNode("div", { class: "description-lists" }, [
                createVNode("dl", null, [
                  createVNode("dt", null, toDisplayString($options.i18n("Profile Name")) + ":", 1),
                  createVNode("dd", null, toDisplayString($props.user.profile.name), 1)
                ]),
                createVNode("dl", null, [
                  createVNode("dt", null, toDisplayString($options.i18n("Email Address")) + ":", 1),
                  createVNode("dd", null, toDisplayString($props.user.email), 1)
                ])
              ]),
              createVNode("div", { class: "description-lists" }, [
                createVNode("dl", null, [
                  createVNode("dt", null, toDisplayString($options.i18n("Profile Created")) + ":", 1),
                  createVNode("dd", null, toDisplayString($props.user.created.date) + " " + toDisplayString($props.user.created.time), 1)
                ]),
                createVNode("dl", null, [
                  createVNode("dt", null, toDisplayString($options.i18n("Last Updated")) + ":", 1),
                  $props.user.created.timestamp === $props.user.updated.timestamp ? (openBlock(), createBlock("dd", { key: 0 }, [
                    createVNode("em", { class: "empty" }, "-")
                  ])) : (openBlock(), createBlock("dd", { key: 1 }, toDisplayString($props.user.updated.date) + " " + toDisplayString($props.user.updated.time), 1))
                ])
              ])
            ])
          ])
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/users/cards/UserSummary.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const UserSummary = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PageMessages,
    PrimevueCard,
    UserSummary
  },
  inject: ["i18n"],
  props: {
    messages: {
      type: Array,
      default: []
    },
    user: {
      type: Object,
      required: true
    }
  },
  computed: {
    heading() {
      return this.user.is_myself ? "My Profile" : `${this.i18n("User")}: ${this.user.profile.name}`;
    },
    title() {
      return this.user.is_myself ? this.heading : "User Dashboard";
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_page_messages = resolveComponent("page-messages");
  const _component_user_summary = resolveComponent("user-summary");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content main" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, {
    "back-button": "",
    actions: $props.user.actions,
    heading: $options.heading,
    title: $options.title
  }, null, _parent));
  _push(`<section class="auto-margin container max-width-xl w-full"><div class="grid">`);
  _push(ssrRenderComponent(_component_page_messages, {
    class: "col-12",
    messages: $props.messages,
    onDismiss: ($event) => $props.messages.splice($event, 1)
  }, null, _parent));
  _push(`<div class="col-12">`);
  _push(ssrRenderComponent(_component_user_summary, { user: $props.user }, null, _parent));
  _push(`</div></div></section></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/users/Show.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Show = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Show as default
};
