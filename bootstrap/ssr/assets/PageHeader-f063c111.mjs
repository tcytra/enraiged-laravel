import { useSSRContext, computed, mergeProps, resolveComponent, resolveDirective, defineAsyncComponent, withCtx, createVNode, openBlock, createBlock, Fragment, renderList, Transition, renderSlot, resolveDynamicComponent, createCommentVNode, toDisplayString, createTextVNode } from "vue";
import { format } from "date-fns";
import { router, Head } from "@inertiajs/vue3";
import { ssrRenderAttrs, ssrRenderSlot, ssrInterpolate, ssrRenderClass, ssrRenderAttr, ssrRenderComponent, ssrGetDirectiveProps, ssrRenderList, ssrRenderStyle, ssrRenderVNode } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import PrimevueTooltip from "primevue/tooltip/tooltip.cjs.js";
import Button from "primevue/button";
import ConfirmationEventBus from "primevue/confirmationeventbus";
import Dialog from "primevue/dialog";
import Ripple from "primevue/ripple";
const _sfc_main$j = {
  emits: ["close:all", "close:auth", "close:menu"],
  inject: ["isMobile", "isSuccess"],
  props: {
    api: {
      type: String,
      required: true
    }
  },
  data: () => ({
    menu: null,
    meta: null,
    ready: false,
    user: null,
    authMenuOpen: false,
    mainMenuOpen: false
  }),
  computed: {
    getMenu() {
      return this.menu;
    },
    getMeta() {
      return this.meta;
    },
    getUser() {
      return this.user;
    },
    menuClass() {
      const state = {
        "auth-open": this.authMenuOpen,
        "menu-open": this.mainMenuOpen === true,
        "menu-closed": this.mainMenuOpen === false
      };
      return Object.keys(state).filter((value) => state[value] === true).join(" ");
    }
  },
  created() {
    this.mainMenuOpen = this.isMobile !== true;
    this.initState();
  },
  methods: {
    closeAll() {
      this.authMenuOpen = false;
      this.mainMenuOpen = false;
    },
    closeAuth() {
      this.authMenuOpen = false;
    },
    closeMenu() {
      this.mainMenuOpen = false;
    },
    initState() {
      this.axios.get(this.api).then((response) => this.fetched(response));
    },
    fetched(response) {
      const { status, data } = response;
      if (this.isSuccess(status)) {
        const { i18n, menu, meta, user } = data;
        let lang = meta.language;
        if (user) {
          lang = user.language;
          this.setUser(user);
        }
        this.$root.$i18n.locale = lang;
        this.$root.$i18n.setLocaleMessage(lang, i18n[lang]);
        this.setMenu(menu);
        this.setMeta(meta);
        this.ready = true;
      }
    },
    setMenu(menu) {
      if (menu) {
        Object.keys(menu).forEach((key) => {
          if (menu[key].menu) {
            let state = false;
            Object.values(menu[key].menu).every((item) => {
              if (item.route === this.$page.url) {
                state = true;
              }
            });
            menu[key].open = state;
          }
        });
      }
      this.menu = menu;
    },
    setMeta(meta) {
      this.meta = meta;
    },
    setUser(user) {
      this.user = user;
    },
    stopImpersonating() {
      this.$inertia.get("/users/impersonate/stop");
    },
    toggleAuth() {
      this.authMenuOpen = !this.authMenuOpen;
    },
    toggleMenu() {
      if (this.authMenuOpen) {
        this.authMenuOpen = false;
        this.mainMenuOpen = true;
      } else {
        this.mainMenuOpen = !this.mainMenuOpen;
      }
    }
  },
  provide() {
    return {
      closeAllPanels: this.closeAll,
      closeAuthPanel: this.closeAuth,
      closeMainPanel: this.closeMenu,
      initState: this.initState,
      menu: computed(() => this.menu),
      meta: computed(() => this.meta),
      stopImpersonating: this.stopImpersonating,
      toggleAuthPanel: this.toggleAuth,
      toggleMainPanel: this.toggleMenu,
      user: computed(() => this.user)
    };
  },
  render() {
    return this.$slots.default({
      classes: this.menuClass,
      closeAuth: this.closeAuth,
      closeMenu: this.closeMenu,
      menu: this.menu,
      ready: this.ready,
      toggleAuth: this.toggleAuth,
      toggleMenu: this.toggleMenu,
      user: this.user
    });
  },
  watch: {
    "$page.props.flash": {
      handler() {
        const flash = this.$page.props.flash;
        switch (flash.status) {
          case 205:
            this.initState();
            break;
        }
      },
      deep: true
    }
  }
};
const _sfc_setup$j = _sfc_main$j.setup;
_sfc_main$j.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/states/renderless/AppState.vue");
  return _sfc_setup$j ? _sfc_setup$j(props, ctx) : void 0;
};
const Avatar_vue_vue_type_style_index_0_lang = "";
const _sfc_main$i = {
  name: "Avatar",
  emits: ["error"],
  props: {
    label: {
      type: String,
      default: null
    },
    icon: {
      type: String,
      default: null
    },
    image: {
      type: String,
      default: null
    },
    size: {
      type: String,
      default: "normal"
    },
    shape: {
      type: String,
      default: "square"
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
  methods: {
    onError() {
      this.$emit("error");
    }
  },
  computed: {
    containerClass() {
      return [
        "p-avatar p-component",
        {
          "p-avatar-image": this.image != null,
          "p-avatar-circle": this.shape === "circle",
          "p-avatar-lg": this.size === "large",
          "p-avatar-xl": this.size === "xlarge"
        }
      ];
    },
    iconClass() {
      return ["p-avatar-icon", this.icon];
    }
  }
};
function _sfc_ssrRender$h(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<div${ssrRenderAttrs(mergeProps({
    class: $options.containerClass,
    "aria-labelledby": _ctx.ariaLabelledby,
    "aria-label": _ctx.ariaLabel
  }, _attrs))}>`);
  ssrRenderSlot(_ctx.$slots, "default", {}, () => {
    if ($props.label) {
      _push(`<span class="p-avatar-text">${ssrInterpolate($props.label)}</span>`);
    } else if ($props.icon) {
      _push(`<span class="${ssrRenderClass($options.iconClass)}"></span>`);
    } else if ($props.image) {
      _push(`<img${ssrRenderAttr("src", $props.image)}>`);
    } else {
      _push(`<!---->`);
    }
  }, _push, _parent);
  _push(`</div>`);
}
const _sfc_setup$i = _sfc_main$i.setup;
_sfc_main$i.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/avatar/Avatar.vue");
  return _sfc_setup$i ? _sfc_setup$i(props, ctx) : void 0;
};
const PrimevueAvatar = /* @__PURE__ */ _export_sfc(_sfc_main$i, [["ssrRender", _sfc_ssrRender$h]]);
const _sfc_main$h = {
  components: {
    // Active,
    PrimevueAvatar,
    PrimevueButton
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  inject: ["actionHandler", "i18n"],
  props: {
    action: {
      type: [Object, String],
      default: null
    },
    active: {
      type: Boolean,
      default: null
    },
    avatar: {
      type: Object,
      required: true
    },
    border: {
      type: Boolean,
      default: false
    },
    editable: {
      type: Boolean,
      default: false
    },
    greyscale: {
      type: Boolean,
      default: false
    },
    greyscaleDark: {
      type: Boolean,
      default: false
    },
    greyscaleLight: {
      type: Boolean,
      default: false
    },
    hover: {
      type: Boolean,
      default: false
    },
    size: {
      type: String,
      default: ""
    }
  },
  computed: {
    backgroundClass() {
      return {
        "cursor-pointer": this.action || this.hover,
        "greyscale-dark": this.greyscale || this.greyscaleDark,
        "greyscale-light": this.greyscaleLight,
        "has-border": this.border,
        "p-avatar-sm": this.size === "sm",
        "p-avatar-md": this.size === "md",
        "p-avatar-lg": this.size === "lg",
        "p-avatar-xl": this.size === "xl",
        "p-avatar-xx": this.size === "xx"
      };
    },
    backgroundColor() {
      return `background-color:${this.avatar.color};`;
    }
  },
  methods: {
    clicked() {
      const event = "avatar:clicked";
      if (this.action) {
        this.actionHandler(this.action, event);
      } else {
        this.$emit(event);
      }
    }
  }
};
function _sfc_ssrRender$g(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_button = resolveComponent("primevue-button");
  const _component_primevue_avatar = resolveComponent("primevue-avatar");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(`<div${ssrRenderAttrs(mergeProps({
    class: ["avatar inline-block relative", { "editable": $props.editable }]
  }, _attrs))}>`);
  if ($props.editable) {
    _push(ssrRenderComponent(_component_primevue_button, mergeProps({
      class: "absolute p-button-icon-only p-button-rounded p-button-xs p-button-success",
      icon: "pi pi-pencil",
      style: { "top": "0", "right": "0" },
      onClick: $options.clicked
    }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("Update this avatar"), void 0, { top: true })), null, _parent));
  } else {
    _push(`<!---->`);
  }
  if ($props.avatar.file) {
    _push(ssrRenderComponent(_component_primevue_avatar, {
      shape: "circle",
      class: $options.backgroundClass,
      image: $props.avatar.file.uri,
      onClick: $options.clicked
    }, null, _parent));
  } else {
    _push(ssrRenderComponent(_component_primevue_avatar, {
      shape: "circle",
      class: $options.backgroundClass,
      label: $props.avatar.chars,
      style: $options.backgroundColor,
      onClick: $options.clicked
    }, null, _parent));
  }
  _push(`</div>`);
}
const _sfc_setup$h = _sfc_main$h.setup;
_sfc_main$h.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/ui/avatars/Avatar.vue");
  return _sfc_setup$h ? _sfc_setup$h(props, ctx) : void 0;
};
const Avatar = /* @__PURE__ */ _export_sfc(_sfc_main$h, [["ssrRender", _sfc_ssrRender$g]]);
const _sfc_main$g = {
  components: {
    Avatar
  },
  emits: ["auth:close", "auth:toggle"],
  inject: ["i18n", "user"],
  methods: {
    close() {
      this.$emit("auth:close");
    },
    get(url) {
      this.close();
      this.$inertia.get(url);
    },
    logout() {
      router.delete("/logout");
    },
    match(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    }
  }
};
function _sfc_ssrRender$f(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_avatar = resolveComponent("avatar");
  _push(`<nav${ssrRenderAttrs(mergeProps({
    class: "text-50",
    refs: "nav"
  }, _attrs))}><header class="header profile">`);
  _push(ssrRenderComponent(_component_avatar, {
    size: "xx",
    avatar: $options.user.avatar,
    onClick: ($event) => $options.get("/my/profile/avatar")
  }, null, _parent));
  _push(`<h4 class="name">${ssrInterpolate($options.user.profile.name)}</h4></header><ul class="options"><li class="action item"><dl class="option"><dt class="icon"><i class="pi pi-user"></i></dt><dl class="text">${ssrInterpolate($options.i18n("Profile"))}</dl></dl></li><li class="action item"><dl class="option"><dt class="icon"><i class="pi pi-file"></i></dt><dl class="text">${ssrInterpolate($options.i18n("Files"))}</dl></dl></li><li class="action item"><dl class="option"><dt class="icon"><i class="pi pi-sign-out"></i></dt><dl class="text">${ssrInterpolate($options.i18n("Logout"))}</dl></dl></li></ul><div class="block flex-grow-1"></div><footer class="footer"><div class="action" refs="navToggle"><i class="pi pi-bars"></i></div></footer></nav>`);
}
const _sfc_setup$g = _sfc_main$g.setup;
_sfc_main$g.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/panels/AuthPanel.vue");
  return _sfc_setup$g ? _sfc_setup$g(props, ctx) : void 0;
};
const AuthPanel = /* @__PURE__ */ _export_sfc(_sfc_main$g, [["ssrRender", _sfc_ssrRender$f]]);
const _sfc_main$f = {
  inject: ["menu", "closeMainPanel", "isMobile"],
  methods: {
    navigate(item) {
      for (const key of Object.keys(this.menu)) {
        if (this.menu[key].menu && key !== item) {
          this.menu[key].open = false;
        }
      }
      if (this.isMobile) {
        this.closeMainPanel();
      }
    }
  },
  render() {
    return this.$slots.default({
      menu: this.menu,
      navigate: this.navigate
    });
  }
};
const _sfc_setup$f = _sfc_main$f.setup;
_sfc_main$f.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/menus/core/MenuHandler.vue");
  return _sfc_setup$f ? _sfc_setup$f(props, ctx) : void 0;
};
const _sfc_main$e = {
  components: {
    MenuItem: defineAsyncComponent(() => Promise.resolve().then(() => MenuItem$1))
  },
  props: {
    menu: {
      type: Object,
      required: true
    },
    open: {
      type: Boolean,
      default: false
    }
  }
};
function _sfc_ssrRender$e(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_menu_item = resolveComponent("menu-item");
  _push(`<ul${ssrRenderAttrs(mergeProps({
    class: ["options sub-menu", { "is-open": $props.open }]
  }, _attrs))}><!--[-->`);
  ssrRenderList($props.menu, (item, name) => {
    _push(ssrRenderComponent(_component_menu_item, {
      key: name,
      item,
      name,
      "onMenu:navigate": ($event) => _ctx.$emit("menu:navigate")
    }, null, _parent));
  });
  _push(`<!--]--></ul>`);
}
const _sfc_setup$e = _sfc_main$e.setup;
_sfc_main$e.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/ui/menus/MenuGroup.vue");
  return _sfc_setup$e ? _sfc_setup$e(props, ctx) : void 0;
};
const MenuGroup = /* @__PURE__ */ _export_sfc(_sfc_main$e, [["ssrRender", _sfc_ssrRender$e]]);
const _sfc_main$d = {
  components: {
    MenuGroup
  },
  inject: ["i18n"],
  props: {
    item: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      required: true
    }
  },
  data: () => ({
    active: false
  }),
  computed: {
    current() {
      return this.$page.url === this.item.route;
    },
    page() {
      return this.$page.url.substr(1);
    }
  },
  methods: {
    handle() {
      if (this.item.menu) {
        this.item.open = !this.item.open;
      } else {
        this.$emit("menu:navigate");
        this.$inertia.get(this.item.route);
      }
    }
  }
};
function _sfc_ssrRender$d(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_menu_group = resolveComponent("menu-group");
  _push(`<li${ssrRenderAttrs(mergeProps({ class: "item" }, _attrs))}><dl class="${ssrRenderClass([{ "has-children": $props.item.menu, "is-active": $options.current, "is-open": $props.item.open }, "option cursor-pointer"])}"><dt class="icon"><i class="${ssrRenderClass($props.item.icon)}"></i></dt><dl class="text">${ssrInterpolate($options.i18n($props.name))}</dl>`);
  if ($props.item.menu) {
    _push(`<dt class="icon open-indicator">`);
    if ($props.item.open) {
      _push(`<i class="pi pi-angle-down"></i>`);
    } else {
      _push(`<i class="pi pi-angle-up"></i>`);
    }
    _push(`</dt>`);
  } else {
    _push(`<!---->`);
  }
  _push(`</dl>`);
  if ($props.item.menu) {
    _push(ssrRenderComponent(_component_menu_group, {
      menu: $props.item.menu,
      open: $props.item.open,
      "onMenu:navigate": ($event) => _ctx.$emit("menu:navigate")
    }, null, _parent));
  } else {
    _push(`<!---->`);
  }
  _push(`</li>`);
}
const _sfc_setup$d = _sfc_main$d.setup;
_sfc_main$d.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/ui/menus/MenuItem.vue");
  return _sfc_setup$d ? _sfc_setup$d(props, ctx) : void 0;
};
const MenuItem = /* @__PURE__ */ _export_sfc(_sfc_main$d, [["ssrRender", _sfc_ssrRender$d]]);
const MenuItem$1 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: MenuItem
}, Symbol.toStringTag, { value: "Module" }));
const _sfc_main$c = {
  components: {
    MenuHandler: _sfc_main$f,
    MenuItem
  }
};
function _sfc_ssrRender$c(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_menu_handler = resolveComponent("menu-handler");
  const _component_menu_item = resolveComponent("menu-item");
  _push(ssrRenderComponent(_component_menu_handler, _attrs, {
    default: withCtx(({ menu, navigate }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<ul class="options top-menu"${_scopeId}><!--[-->`);
        ssrRenderList(menu, (item, name, index) => {
          _push2(ssrRenderComponent(_component_menu_item, {
            item,
            key: index,
            name,
            "onMenu:navigate": ($event) => navigate(name)
          }, null, _parent2, _scopeId));
        });
        _push2(`<!--]--></ul>`);
      } else {
        return [
          createVNode("ul", { class: "options top-menu" }, [
            (openBlock(true), createBlock(Fragment, null, renderList(menu, (item, name, index) => {
              return openBlock(), createBlock(_component_menu_item, {
                item,
                key: index,
                name,
                "onMenu:navigate": ($event) => navigate(name)
              }, null, 8, ["item", "name", "onMenu:navigate"]);
            }), 128))
          ])
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$c = _sfc_main$c.setup;
_sfc_main$c.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/menus/MainMenu.vue");
  return _sfc_setup$c ? _sfc_setup$c(props, ctx) : void 0;
};
const MainMenu = /* @__PURE__ */ _export_sfc(_sfc_main$c, [["ssrRender", _sfc_ssrRender$c]]);
const _sfc_main$b = {
  components: {
    MainMenu
  },
  emits: ["menu:toggle"],
  inject: ["meta"]
};
function _sfc_ssrRender$b(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_main_menu = resolveComponent("main-menu");
  _push(`<nav${ssrRenderAttrs(mergeProps({
    class: "text-50",
    refs: "nav"
  }, _attrs))}><header class="header"><dl class="branding"><dt class="icon"><i class="pi pi-circle" style="${ssrRenderStyle({ "color": "orange", "font-size": "1.25rem", "line-height": "1.75rem" })}"></i></dt><dd class="text">${ssrInterpolate($options.meta.app_name)}</dd></dl></header>`);
  _push(ssrRenderComponent(_component_main_menu, null, null, _parent));
  _push(`<div class="block flex-grow-1"></div><footer class="footer"><div class="action" refs="navToggle"><i class="pi pi-bars"></i></div></footer></nav>`);
}
const _sfc_setup$b = _sfc_main$b.setup;
_sfc_main$b.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/panels/MainPanel.vue");
  return _sfc_setup$b ? _sfc_setup$b(props, ctx) : void 0;
};
const MainPanel = /* @__PURE__ */ _export_sfc(_sfc_main$b, [["ssrRender", _sfc_ssrRender$b]]);
const _sfc_main$a = {
  emits: ["auth:toggle", "menu:toggle"],
  inject: ["stopImpersonating", "user"],
  components: {
    Avatar
  }
};
function _sfc_ssrRender$a(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_avatar = resolveComponent("avatar");
  _push(`<nav${ssrRenderAttrs(mergeProps({ class: "nav top" }, _attrs))}><div class="inline action"><i class="pi pi-bars"></i></div><div class="block"></div>`);
  if ($options.user.is_impersonating) {
    _push(`<div class="inline action impersonating"><i class="pi pi-user-minus"></i></div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`<div class="inline action">`);
  _push(ssrRenderComponent(_component_avatar, {
    avatar: $options.user.avatar,
    hover: "",
    size: "md"
  }, null, _parent));
  _push(`</div></nav>`);
}
const _sfc_setup$a = _sfc_main$a.setup;
_sfc_main$a.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/menus/TopNav.vue");
  return _sfc_setup$a ? _sfc_setup$a(props, ctx) : void 0;
};
const TopNav = /* @__PURE__ */ _export_sfc(_sfc_main$a, [["ssrRender", _sfc_ssrRender$a]]);
const ProgressSpinner_vue_vue_type_style_index_0_lang = "";
const _sfc_main$9 = {
  name: "ProgressSpinner",
  props: {
    strokeWidth: {
      type: String,
      default: "2"
    },
    fill: {
      type: String,
      default: "none"
    },
    animationDuration: {
      type: String,
      default: "2s"
    }
  },
  computed: {
    svgStyle() {
      return {
        "animation-duration": this.animationDuration
      };
    }
  }
};
function _sfc_ssrRender$9(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<div${ssrRenderAttrs(mergeProps({
    class: "p-progress-spinner",
    role: "progressbar"
  }, _attrs))}><svg class="p-progress-spinner-svg" viewBox="25 25 50 50" style="${ssrRenderStyle($options.svgStyle)}"><circle class="p-progress-spinner-circle" cx="50" cy="50" r="20"${ssrRenderAttr("fill", $props.fill)}${ssrRenderAttr("stroke-width", $props.strokeWidth)} strokeMiterlimit="10"></circle></svg></div>`);
}
const _sfc_setup$9 = _sfc_main$9.setup;
_sfc_main$9.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/progressspinner/ProgressSpinner.vue");
  return _sfc_setup$9 ? _sfc_setup$9(props, ctx) : void 0;
};
const VueProgressSpinner = /* @__PURE__ */ _export_sfc(_sfc_main$9, [["ssrRender", _sfc_ssrRender$9]]);
const _sfc_main$8 = {
  components: {
    AppState: _sfc_main$j,
    AuthPanel,
    MainPanel,
    TopNav,
    VueProgressSpinner
  },
  inject: [
    "clientSize"
  ],
  data: () => ({
    uri: "/api/app/state"
  })
};
function _sfc_ssrRender$8(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_app_state = resolveComponent("app-state");
  const _component_main_panel = resolveComponent("main-panel");
  const _component_top_nav = resolveComponent("top-nav");
  const _component_auth_panel = resolveComponent("auth-panel");
  const _component_vue_progress_spinner = resolveComponent("vue-progress-spinner");
  _push(ssrRenderComponent(_component_app_state, mergeProps({ api: _ctx.uri }, _attrs), {
    default: withCtx(({
      classes,
      menu,
      ready,
      closeAuth,
      closeMenu,
      toggleAuth,
      toggleMenu,
      user
    }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(``);
        if (ready) {
          _push2(`<div class="${ssrRenderClass([[classes, $options.clientSize], "default layout"])}"${_scopeId}>`);
          _push2(ssrRenderComponent(_component_main_panel, {
            class: "main panel",
            ref: "mainPanel",
            "onMenu:toggle": toggleMenu
          }, null, _parent2, _scopeId));
          _push2(`<div class="main page"${_scopeId}>`);
          _push2(ssrRenderComponent(_component_top_nav, {
            "onAuth:toggle": toggleAuth,
            "onMenu:toggle": toggleMenu
          }, null, _parent2, _scopeId));
          ssrRenderSlot(_ctx.$slots, "default", {}, null, _push2, _parent2, _scopeId);
          _push2(`</div>`);
          _push2(ssrRenderComponent(_component_auth_panel, {
            class: "auth panel",
            ref: "authPanel",
            "onAuth:close": closeAuth,
            "onAuth:toggle": toggleAuth
          }, null, _parent2, _scopeId));
          _push2(`</div>`);
        } else {
          _push2(`<div class="default overlay"${_scopeId}>`);
          _push2(ssrRenderComponent(_component_vue_progress_spinner, null, null, _parent2, _scopeId));
          _push2(`</div>`);
        }
      } else {
        return [
          createVNode(Transition, {
            "enter-active-class": "fadein",
            "leave-active-class": "fadeout"
          }, {
            default: withCtx(() => [
              ready ? (openBlock(), createBlock("div", {
                class: ["default layout", [classes, $options.clientSize]],
                key: "layout"
              }, [
                createVNode(_component_main_panel, {
                  class: "main panel",
                  ref: "mainPanel",
                  "onMenu:toggle": toggleMenu
                }, null, 8, ["onMenu:toggle"]),
                createVNode("div", {
                  class: "main page",
                  ref: "mainPage"
                }, [
                  createVNode(_component_top_nav, {
                    "onAuth:toggle": toggleAuth,
                    "onMenu:toggle": toggleMenu
                  }, null, 8, ["onAuth:toggle", "onMenu:toggle"]),
                  renderSlot(_ctx.$slots, "default")
                ], 512),
                createVNode(_component_auth_panel, {
                  class: "auth panel",
                  ref: "authPanel",
                  "onAuth:close": closeAuth,
                  "onAuth:toggle": toggleAuth
                }, null, 8, ["onAuth:close", "onAuth:toggle"])
              ], 2)) : (openBlock(), createBlock("div", {
                class: "default overlay",
                key: "overlay"
              }, [
                createVNode(_component_vue_progress_spinner)
              ]))
            ]),
            _: 2
          }, 1024)
        ];
      }
    }),
    _: 3
  }, _parent));
}
const _sfc_setup$8 = _sfc_main$8.setup;
_sfc_main$8.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/states/AuthState.vue");
  return _sfc_setup$8 ? _sfc_setup$8(props, ctx) : void 0;
};
const AuthState = /* @__PURE__ */ _export_sfc(_sfc_main$8, [["ssrRender", _sfc_ssrRender$8]]);
const _sfc_main$7 = {
  components: {
    AppState: _sfc_main$j,
    VueProgressSpinner
  },
  data: () => ({
    uri: "/api/guest/state"
  })
};
function _sfc_ssrRender$7(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_app_state = resolveComponent("app-state");
  const _component_vue_progress_spinner = resolveComponent("vue-progress-spinner");
  _push(ssrRenderComponent(_component_app_state, mergeProps({ api: _ctx.uri }, _attrs), {
    default: withCtx(({ ready }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(``);
        if (ready) {
          _push2(`<div class="guest layout"${_scopeId}><div class="container bg-bluegray-800"${_scopeId}>`);
          ssrRenderSlot(_ctx.$slots, "default", {}, null, _push2, _parent2, _scopeId);
          _push2(`</div></div>`);
        } else {
          _push2(`<div class="default overlay"${_scopeId}>`);
          _push2(ssrRenderComponent(_component_vue_progress_spinner, null, null, _parent2, _scopeId));
          _push2(`</div>`);
        }
      } else {
        return [
          createVNode(Transition, {
            "enter-active-class": "fadein",
            "leave-active-class": "fadeout"
          }, {
            default: withCtx(() => [
              ready ? (openBlock(), createBlock("div", {
                key: 0,
                class: "guest layout"
              }, [
                createVNode("div", { class: "container bg-bluegray-800" }, [
                  renderSlot(_ctx.$slots, "default")
                ])
              ])) : (openBlock(), createBlock("div", {
                class: "default overlay",
                key: "overlay"
              }, [
                createVNode(_component_vue_progress_spinner)
              ]))
            ]),
            _: 2
          }, 1024)
        ];
      }
    }),
    _: 3
  }, _parent));
}
const _sfc_setup$7 = _sfc_main$7.setup;
_sfc_main$7.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/states/GuestState.vue");
  return _sfc_setup$7 ? _sfc_setup$7(props, ctx) : void 0;
};
const GuestState = /* @__PURE__ */ _export_sfc(_sfc_main$7, [["ssrRender", _sfc_ssrRender$7]]);
const _sfc_main$6 = {
  name: "ConfirmDialog",
  props: {
    group: String,
    breakpoints: {
      type: Object,
      default: null
    }
  },
  confirmListener: null,
  closeListener: null,
  data() {
    return {
      visible: false,
      confirmation: null
    };
  },
  mounted() {
    this.confirmListener = (options) => {
      if (!options) {
        return;
      }
      if (options.group === this.group) {
        this.confirmation = options;
        if (this.confirmation.onShow) {
          this.confirmation.onShow();
        }
        this.visible = true;
      }
    };
    this.closeListener = () => {
      this.visible = false;
      this.confirmation = null;
    };
    ConfirmationEventBus.on("confirm", this.confirmListener);
    ConfirmationEventBus.on("close", this.closeListener);
  },
  beforeUnmount() {
    ConfirmationEventBus.off("confirm", this.confirmListener);
    ConfirmationEventBus.off("close", this.closeListener);
  },
  methods: {
    accept() {
      if (this.confirmation.accept) {
        this.confirmation.accept();
      }
      this.visible = false;
    },
    reject() {
      if (this.confirmation.reject) {
        this.confirmation.reject();
      }
      this.visible = false;
    },
    onHide() {
      if (this.confirmation.onHide) {
        this.confirmation.onHide();
      }
      this.visible = false;
    }
  },
  computed: {
    header() {
      return this.confirmation ? this.confirmation.header : null;
    },
    message() {
      return this.confirmation ? this.confirmation.message : null;
    },
    blockScroll() {
      return this.confirmation ? this.confirmation.blockScroll : true;
    },
    position() {
      return this.confirmation ? this.confirmation.position : null;
    },
    iconClass() {
      return ["p-confirm-dialog-icon", this.confirmation ? this.confirmation.icon : null];
    },
    acceptLabel() {
      return this.confirmation ? this.confirmation.acceptLabel || this.$primevue.config.locale.accept : null;
    },
    rejectLabel() {
      return this.confirmation ? this.confirmation.rejectLabel || this.$primevue.config.locale.reject : null;
    },
    acceptIcon() {
      return this.confirmation ? this.confirmation.acceptIcon : null;
    },
    rejectIcon() {
      return this.confirmation ? this.confirmation.rejectIcon : null;
    },
    acceptClass() {
      return ["p-confirm-dialog-accept", this.confirmation ? this.confirmation.acceptClass : null];
    },
    rejectClass() {
      return ["p-confirm-dialog-reject", this.confirmation ? this.confirmation.rejectClass || "p-button-text" : null];
    },
    autoFocusAccept() {
      return this.confirmation.defaultFocus === void 0 || this.confirmation.defaultFocus === "accept" ? true : false;
    },
    autoFocusReject() {
      return this.confirmation.defaultFocus === "reject" ? true : false;
    },
    closeOnEscape() {
      return this.confirmation ? this.confirmation.closeOnEscape : true;
    }
  },
  components: {
    CDialog: Dialog,
    CDButton: Button
  }
};
function _sfc_ssrRender$6(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_CDialog = resolveComponent("CDialog");
  const _component_CDButton = resolveComponent("CDButton");
  _push(ssrRenderComponent(_component_CDialog, mergeProps({
    visible: $data.visible,
    "onUpdate:visible": [($event) => $data.visible = $event, $options.onHide],
    role: "alertdialog",
    class: "p-confirm-dialog",
    modal: true,
    header: $options.header,
    blockScroll: $options.blockScroll,
    position: $options.position,
    breakpoints: $props.breakpoints,
    closeOnEscape: $options.closeOnEscape
  }, _attrs), {
    footer: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_CDButton, {
          label: $options.rejectLabel,
          icon: $options.rejectIcon,
          class: $options.rejectClass,
          onClick: ($event) => $options.reject(),
          autofocus: $options.autoFocusReject
        }, null, _parent2, _scopeId));
        _push2(ssrRenderComponent(_component_CDButton, {
          label: $options.acceptLabel,
          icon: $options.acceptIcon,
          class: $options.acceptClass,
          onClick: ($event) => $options.accept(),
          autofocus: $options.autoFocusAccept
        }, null, _parent2, _scopeId));
      } else {
        return [
          createVNode(_component_CDButton, {
            label: $options.rejectLabel,
            icon: $options.rejectIcon,
            class: $options.rejectClass,
            onClick: ($event) => $options.reject(),
            autofocus: $options.autoFocusReject
          }, null, 8, ["label", "icon", "class", "onClick", "autofocus"]),
          createVNode(_component_CDButton, {
            label: $options.acceptLabel,
            icon: $options.acceptIcon,
            class: $options.acceptClass,
            onClick: ($event) => $options.accept(),
            autofocus: $options.autoFocusAccept
          }, null, 8, ["label", "icon", "class", "onClick", "autofocus"])
        ];
      }
    }),
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        if (!_ctx.$slots.message) {
          _push2(`<!--[-->`);
          if ($data.confirmation.icon) {
            _push2(`<i class="${ssrRenderClass($options.iconClass)}"${_scopeId}></i>`);
          } else {
            _push2(`<!---->`);
          }
          _push2(`<span class="p-confirm-dialog-message"${_scopeId}>${ssrInterpolate($options.message)}</span><!--]-->`);
        } else {
          ssrRenderVNode(_push2, createVNode(resolveDynamicComponent(_ctx.$slots.message), { message: $data.confirmation }, null), _parent2, _scopeId);
        }
      } else {
        return [
          !_ctx.$slots.message ? (openBlock(), createBlock(Fragment, { key: 0 }, [
            $data.confirmation.icon ? (openBlock(), createBlock("i", {
              key: 0,
              class: $options.iconClass
            }, null, 2)) : createCommentVNode("", true),
            createVNode("span", { class: "p-confirm-dialog-message" }, toDisplayString($options.message), 1)
          ], 64)) : (openBlock(), createBlock(resolveDynamicComponent(_ctx.$slots.message), {
            key: 1,
            message: $data.confirmation
          }, null, 8, ["message"]))
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$6 = _sfc_main$6.setup;
_sfc_main$6.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/confirmdialog/ConfirmDialog.vue");
  return _sfc_setup$6 ? _sfc_setup$6(props, ctx) : void 0;
};
const ConfirmDialog = /* @__PURE__ */ _export_sfc(_sfc_main$6, [["ssrRender", _sfc_ssrRender$6]]);
const Message_vue_vue_type_style_index_0_lang = "";
const _sfc_main$5 = {
  name: "Message",
  emits: ["close"],
  props: {
    severity: {
      type: String,
      default: "info"
    },
    closable: {
      type: Boolean,
      default: true
    },
    sticky: {
      type: Boolean,
      default: true
    },
    life: {
      type: Number,
      default: 3e3
    },
    icon: {
      type: String,
      default: null
    },
    closeIcon: {
      type: String,
      default: "pi pi-times"
    },
    closeButtonProps: {
      type: null,
      default: null
    }
  },
  timeout: null,
  data() {
    return {
      visible: true
    };
  },
  mounted() {
    if (!this.sticky) {
      this.x();
    }
  },
  methods: {
    close(event) {
      this.visible = false;
      this.$emit("close", event);
    },
    x() {
      setTimeout(() => {
        this.visible = false;
      }, this.life);
    }
  },
  computed: {
    containerClass() {
      return "p-message p-component p-message-" + this.severity;
    },
    iconClass() {
      return [
        "p-message-icon pi",
        this.icon ? this.icon : {
          "pi-info-circle": this.severity === "info",
          "pi-check": this.severity === "success",
          "pi-exclamation-triangle": this.severity === "warn",
          "pi-times-circle": this.severity === "error"
        }
      ];
    },
    closeAriaLabel() {
      return this.$primevue.config.locale.aria ? this.$primevue.config.locale.aria.close : void 0;
    }
  },
  directives: {
    ripple: Ripple
  }
};
function _sfc_ssrRender$5(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _directive_ripple = resolveDirective("ripple");
  _push(`<div${ssrRenderAttrs(mergeProps({
    style: $data.visible ? null : { display: "none" },
    class: $options.containerClass,
    role: "alert",
    "aria-live": "assertive",
    "aria-atomic": "true"
  }, _attrs))}><div class="p-message-wrapper"><span class="${ssrRenderClass($options.iconClass)}"></span><div class="p-message-text">`);
  ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
  _push(`</div>`);
  if ($props.closable) {
    _push(`<button${ssrRenderAttrs(mergeProps({
      class: "p-message-close p-link",
      "aria-label": $options.closeAriaLabel,
      type: "button"
    }, $props.closeButtonProps, ssrGetDirectiveProps(_ctx, _directive_ripple)))}><i class="${ssrRenderClass(["p-message-close-icon", $props.closeIcon])}"></i></button>`);
  } else {
    _push(`<!---->`);
  }
  _push(`</div></div>`);
}
const _sfc_setup$5 = _sfc_main$5.setup;
_sfc_main$5.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/message/Message.vue");
  return _sfc_setup$5 ? _sfc_setup$5(props, ctx) : void 0;
};
const PrimevueMessage = /* @__PURE__ */ _export_sfc(_sfc_main$5, [["ssrRender", _sfc_ssrRender$5]]);
const _sfc_main$4 = {
  components: {
    PrimevueMessage
  },
  inject: ["i18n"],
  props: {
    index: {
      type: Number,
      required: true
    },
    message: {
      type: Object,
      required: true
    }
  },
  data: () => ({
    expiryTimer: null,
    fadeOut: false,
    ready: false
  }),
  computed: {
    multipleContent() {
      return typeof this.message.content == "object";
    }
  },
  beforeUnmount() {
    this.expiryTimer = null;
  },
  created() {
    this.ready = true;
  },
  mounted() {
    this.expiryTimer = setTimeout(() => this.timerExpired(), this.message.expiry);
  },
  methods: {
    timerExpired() {
      this.fadeOut = true;
      this.expiryTimer = setTimeout(() => this.$emit("unflash"), this.message.expiry);
    }
  }
};
function _sfc_ssrRender$4(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_message = resolveComponent("primevue-message");
  _push(ssrRenderComponent(_component_primevue_message, mergeProps({
    class: ["message", { "fade-out": _ctx.fadeOut }],
    ref: "message",
    index: $props.index,
    severity: $props.message.severity,
    sticky: true,
    onMouseenter: ($event) => {
      _ctx.fadeOut = false;
      _ctx.expiryTimer = null;
    }
  }, _attrs), {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate($options.i18n($props.message.content))}`);
      } else {
        return [
          createTextVNode(toDisplayString($options.i18n($props.message.content)), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$4 = _sfc_main$4.setup;
_sfc_main$4.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/notifications/flash/Message.vue");
  return _sfc_setup$4 ? _sfc_setup$4(props, ctx) : void 0;
};
const FlashMessage = /* @__PURE__ */ _export_sfc(_sfc_main$4, [["ssrRender", _sfc_ssrRender$4]]);
const _sfc_main$3 = {
  components: {
    FlashMessage
  },
  props: {
    messages: {
      type: Array,
      default: []
    }
  }
};
function _sfc_ssrRender$3(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_flash_message = resolveComponent("flash-message");
  if ($props.messages.length) {
    _push(`<div${ssrRenderAttrs(mergeProps({ class: "fixed flash messages" }, _attrs))}><!--[-->`);
    ssrRenderList($props.messages, (message, index) => {
      _push(ssrRenderComponent(_component_flash_message, {
        index,
        message,
        onUnflash: ($event) => _ctx.$emit("unflash", index)
      }, null, _parent));
    });
    _push(`<!--]--></div>`);
  } else {
    _push(`<!---->`);
  }
}
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/notifications/FlashMessages.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const FlashMessages = /* @__PURE__ */ _export_sfc(_sfc_main$3, [["ssrRender", _sfc_ssrRender$3]]);
const _sfc_main$2 = {
  components: {
    AuthState,
    ConfirmDialog,
    GuestState,
    FlashMessages
  },
  data: () => ({
    clientWidth: document.documentElement.clientWidth,
    flashMessages: []
  }),
  computed: {
    clientSize() {
      const size = {
        xs: this.clientWidth < 417,
        sm: this.clientWidth > 416 && this.clientWidth < 577,
        md: this.clientWidth > 576 && this.clientWidth < 993,
        lg: this.clientWidth > 992 && this.clientWidth < 1185,
        xl: this.clientWidth > 1184 && this.clientWidth < 1535,
        xxl: this.clientWidth > 1536
      };
      return Object.keys(size).filter((value) => size[value] === true).join("");
    },
    isAuthenticated() {
      return this.$page.props.auth;
    },
    isMobile() {
      return ["sm", "xs"].includes(this.clientSize);
    },
    isTablet() {
      return ["lg", "md"].includes(this.clientSize);
    }
  },
  created() {
    this.documentSize();
  },
  mounted() {
    this.eventsAttach();
  },
  unmounted() {
    this.eventsDetach();
  },
  methods: {
    actionHandler(action, name) {
      if (typeof action === "string") {
        this.$inertia.get(action);
      } else if (typeof action.uri !== "undefined") {
        const method = action.method || "get";
        this.$inertia[method](action.uri);
      } else {
        const actionName = name || "action";
        this.$emit(actionName);
      }
    },
    documentSize() {
      this.clientWidth = document.documentElement.clientWidth;
    },
    errorHandler(error) {
    },
    eventsAttach() {
      window.addEventListener("resize", this.documentSize);
    },
    eventsDetach() {
      window.removeEventListener("resize", this.documentSize);
    },
    flash(message) {
      if (typeof message === "object") {
        this.flashMessages.push(message);
      } else {
        this.flashSuccess(message);
      }
    },
    flashError(message) {
      this.flashMessages.push({ severity: "error", content: message, expiry: 3e3 });
    },
    flashInfo(message) {
      this.flashMessages.push({ severity: "info", content: message, expiry: 3e3 });
    },
    flashSuccess(message) {
      this.flashMessages.push({ severity: "success", content: message, expiry: 3e3 });
    },
    flashWarning(message) {
      this.flashMessages.push({ severity: "warn", content: message, expiry: 3e3 });
    },
    formatDate(value, format$1) {
      if (typeof format$1 === "undefined") {
        format$1 = "yyyy-MM-dd";
      }
      return format(value, format$1);
    },
    isSuccess(status) {
      return status >= 200 && status < 300;
    },
    newDate(date) {
      return new Date(`${date} 00:00:00`);
    },
    padNumber(value) {
      const number = parseInt(value, 10);
      return (number < 10 ? `0${number}` : number).toString();
    },
    unflash(index) {
      this.flashMessages.splice(index, 1);
    }
  },
  provide() {
    return {
      actionHandler: this.actionHandler,
      clientSize: computed(() => this.clientSize),
      clientWidth: computed(() => this.clientWidth),
      errorHandler: this.errorHandler,
      flash: this.flash,
      flashError: this.flashError,
      flashInfo: this.flashInfo,
      flashSuccess: this.flashSuccess,
      flashWarning: this.flashWarning,
      formatDate: this.formatDate,
      i18n: this.$t,
      isMobile: computed(() => this.isMobile),
      isSuccess: this.isSuccess,
      isTablet: computed(() => this.isTablet),
      newDate: this.newDate
    };
  },
  watch: {
    "$page.props.flash": {
      handler() {
        const flash = this.$page.props.flash;
        if (flash.message) {
          this.flash(flash.message);
        }
        if (flash.success) {
          this.flash(flash.success);
        }
      },
      deep: true
    }
  }
};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_auth_state = resolveComponent("auth-state");
  const _component_guest_state = resolveComponent("guest-state");
  const _component_confirm_dialog = resolveComponent("confirm-dialog");
  const _component_flash_messages = resolveComponent("flash-messages");
  _push(`<!--[-->`);
  if ($options.isAuthenticated) {
    _push(ssrRenderComponent(_component_auth_state, null, {
      default: withCtx((_, _push2, _parent2, _scopeId) => {
        if (_push2) {
          ssrRenderSlot(_ctx.$slots, "default", {}, null, _push2, _parent2, _scopeId);
        } else {
          return [
            renderSlot(_ctx.$slots, "default")
          ];
        }
      }),
      _: 3
    }, _parent));
  } else {
    _push(ssrRenderComponent(_component_guest_state, null, {
      default: withCtx((_, _push2, _parent2, _scopeId) => {
        if (_push2) {
          ssrRenderSlot(_ctx.$slots, "default", {}, null, _push2, _parent2, _scopeId);
        } else {
          return [
            renderSlot(_ctx.$slots, "default")
          ];
        }
      }),
      _: 3
    }, _parent));
  }
  _push(ssrRenderComponent(_component_confirm_dialog, null, null, _parent));
  _push(ssrRenderComponent(_component_flash_messages, {
    messages: _ctx.flashMessages,
    onUnflash: $options.unflash
  }, null, _parent));
  _push(`<!--]-->`);
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/layouts/App.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const App = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$2]]);
const _sfc_main$1 = {
  components: {
    PrimevueButton
  },
  inject: ["i18n"],
  props: {
    actions: {
      type: Object,
      default: {}
    },
    backButton: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    history() {
      return window.history.length > 0;
    }
  },
  methods: {
    back() {
      window.history.go(-1);
    },
    click(action) {
      this.$inertia.get(action.uri);
    },
    show(action) {
      return action.class && action.icon;
    }
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_button = resolveComponent("primevue-button");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "actions" }, _attrs))}><!--[-->`);
  ssrRenderList($props.actions, (action, index) => {
    _push(`<div class="action">`);
    if ($options.show(action)) {
      _push(ssrRenderComponent(_component_primevue_button, {
        class: ["button", action.class],
        icon: action.icon,
        label: $options.i18n(action.label),
        onClick: ($event) => $options.click(action)
      }, null, _parent));
    } else {
      _push(`<!---->`);
    }
    _push(`</div>`);
  });
  _push(`<!--]-->`);
  if ($props.backButton && $options.history) {
    _push(`<div class="action go-back">`);
    _push(ssrRenderComponent(_component_primevue_button, {
      class: "button p-button-info p-button-text",
      icon: "pi pi-angle-double-left",
      label: $options.i18n("Back")
    }, null, _parent));
    _push(`</div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`</div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/ui/pages/PageActions.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const PageActions = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  components: {
    Head,
    PageActions
  },
  inject: ["i18n"],
  props: {
    actions: {
      type: Object,
      default: []
    },
    backButton: {
      type: Boolean,
      default: false
    },
    fixed: {
      type: Boolean,
      default: false
    },
    heading: {
      type: String,
      default: null
    },
    title: {
      type: String,
      required: true
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Head = resolveComponent("Head");
  const _component_page_actions = resolveComponent("page-actions");
  _push(`<header${ssrRenderAttrs(mergeProps({
    class: ["header", { fixed: $props.fixed }]
  }, _attrs))}>`);
  _push(ssrRenderComponent(_component_Head, {
    title: $options.i18n($props.title)
  }, null, _parent));
  _push(`<h1>${ssrInterpolate($options.i18n($props.heading || $props.title))}</h1>`);
  _push(ssrRenderComponent(_component_page_actions, {
    actions: $props.actions,
    "back-button": $props.backButton
  }, null, _parent));
  _push(`</header>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/ui/pages/PageHeader.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PageHeader = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  App as A,
  PageHeader as P,
  Avatar as a,
  PrimevueMessage as b
};
