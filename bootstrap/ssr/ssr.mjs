import { createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { renderToString } from "@vue/server-renderer";
import { createSSRApp, h } from "vue";
async function resolvePageComponent(path, pages) {
  const page = pages[path];
  if (typeof page === "undefined") {
    throw new Error(`Page not found: ${path}`);
  }
  return typeof page === "function" ? page() : page;
}
createServer(
  (page) => createInertiaApp({
    page,
    render: renderToString,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, /* @__PURE__ */ Object.assign({ "./pages/Dashboard.vue": () => import("./assets/Dashboard-9bb083ed.mjs"), "./pages/Welcome.vue": () => import("./assets/Welcome-eaf6b0f8.mjs"), "./pages/auth/Agreement.vue": () => import("./assets/Agreement-2523fcee.mjs"), "./pages/auth/Login.vue": () => import("./assets/Login-90a1fcb0.mjs"), "./pages/auth/PasswordConfirm.vue": () => import("./assets/PasswordConfirm-82989323.mjs"), "./pages/auth/PasswordForgot.vue": () => import("./assets/PasswordForgot-9d6a245b.mjs"), "./pages/auth/PasswordReset.vue": () => import("./assets/PasswordReset-58d3f8b9.mjs"), "./pages/auth/Register.vue": () => import("./assets/Register-7cec7232.mjs"), "./pages/auth/VerifyEmail.vue": () => import("./assets/VerifyEmail-1b4038ae.mjs"), "./pages/users/Create.vue": () => import("./assets/Create-b9b7e7e1.mjs"), "./pages/users/Edit.vue": () => import("./assets/Edit-781b3598.mjs"), "./pages/users/Index.vue": () => import("./assets/Index-c35d9487.mjs"), "./pages/users/Show.vue": () => import("./assets/Show-d3681051.mjs"), "./pages/users/avatar/Edit.vue": () => import("./assets/Edit-2e8c984a.mjs"), "./pages/users/files/Index.vue": () => import("./assets/Index-4a4ec214.mjs"), "./pages/users/login/Edit.vue": () => import("./assets/Edit-b7c72d3b.mjs"), "./pages/users/profiles/Edit.vue": () => import("./assets/Edit-244db372.mjs"), "./pages/users/profiles/Show.vue": () => import("./assets/Show-365ec135.mjs"), "./pages/users/settings/Edit.vue": () => import("./assets/Edit-731cf814.mjs") })),
    setup({ app, props, plugin }) {
      return createSSRApp({ render: () => h(app, props) }).use(plugin);
    }
  })
);
