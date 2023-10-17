<p align="center" style="margin: 24px;">
    <a href="https://docs.ismodular.com" target="_blank">
    <img src="art/modular-logo.svg" width="320" height="320"></a>
</p>

<center>

[![Laravel v10.x](https://img.shields.io/badge/Laravel-v10.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Vue v3.x](https://img.shields.io/badge/Vue.js-v3.x-2f4053?style=for-the-badge&logo=vue.js&logoColor=39af78)](https://vuejs.org/)
[![Inertia.js v1.x](https://img.shields.io/badge/Inertia.js-v1.x-6765ea?style=for-the-badge&logo=inertia&logoColor=ffffff)](https://inertiajs.com/)
[![Tailwind CSS v3.x](https://img.shields.io/badge/Tailwind%20CSS-v3.x-31b5f7?style=for-the-badge&logo=tailwind-css&logoColor=ffffff)](https://tailwindcss.com/)
[![Tests passing](https://img.shields.io/badge/Tests-passing-green?style=for-the-badge&logo=github)](https://github.com/daniel-cintra/modular/tree/main/stubs/tests)

</center>

## Why Modular?

When starting a new web application, you are likely to encounter common tasks such as:

-   Structuring and organizing your application for scalability
-   Implementing a granular ACL (Access Control List) system for managing users and roles
-   Customizing an Admin Panel for building your application
-   Adopting or developing a UI Toolkit to accelerate frontend development and ensure consistency across pages
-   Connecting your frontend and backend in a simple, maintainable, and intuitive manner
-   Keeping an Activity Log to audit operations performed by users
-   Managing the build steps of your frontend application with the right tooling and stack
-   Abstracting common functionality (and components) for reuse, like data search, pagination, flash messages, etc.
-   Adopting testing frameworks to ensure your application functions as expected
-   Maintaining a clean mental model of how all these elements work together

Moreover, you might face more complex scenarios like having multiple dashboards according to the user type/profile, translations, etc.

## About Modular

This project prioritizes developer experience and offers a straightforward way to integrate different parts of your applications.

Modular is built atop the following frameworks and tools:

-   [Laravel 10](https://laravel.com/) (For the backend)
-   [Vue 3](https://vuejs.org/) (For custom frontend components)
-   [Vite](https://vitejs.dev/) (For frontend tooling)
-   [Inertia.js](https://inertiajs.com/) (For simplifying the connection between frontend and backend)
-   [Tailwind CSS 3](https://tailwindcss.com/) (For styling)

Upon installing Modular in your Laravel Application, you will receive out of the box:

-   A **Themed Admin Panel** fully integrated with Tailwind CSS for building your application
-   A granular **ACL (Access Control List) System** for managing users and roles
-   Auto-loaded **Custom Vue 3 Components**, written in **JavaScript**, styled with Tailwind CSS
-   Vite for **lightning-fast frontend development**
-   Inertia.js for a seamless **frontend and backend connection**, with easier routing, flash messages (back to front), permissions, etc.
-   A **tailor-made CLI** for generating new modules
-   A complete **translation system** for your application (if needed)
-   **Build steps** for your frontend application, with the right tooling and stack, **ready, configured, and working from the first minute**
-   A **developer experience** that leaves you smiling at the end of the day ;)

## Custom Vue 3 Components

In previous versions of Modular, I utilized robust UI Toolkits like Vuetify and Prime Vue. While they are excellent, I desired more control over the components, guided by these requirements:

-   Utilize Vue 3 as the main JavaScript framework.
-   Employ Tailwind CSS as the primary styling framework.
-   Easily integrate the Custom Vue 3 Components with the Tailwind Theme System.
-   Customize components by simply opening them (not in the node_modules, but at `./resources/js/Components`), modifying the Tailwind CSS classes, and saving. Done.
-   No Sass, Less, Stylus, etc. Just Tailwind CSS.
-   No TypeScript. Just JavaScript.
-   Light and very simple Common Components. If needed, you can extend them per project to add more functionality.

Currently, Modular provides the following Custom Vue 3 Components:

```bash
./resources/js/Components
├── AppAlert.vue
├── AppAuthLogo.vue
├── AppAuthShell.vue
├── AppBreadCrumb.vue
├── AppBreadCrumbItem.vue
├── AppButton.vue
├── AppCard.vue
├── AppCheckbox.vue
├── AppConfirmDialog.vue
├── AppDataSearch.vue
├── AppDataTable.vue
├── AppDataTableData.vue
├── AppDataTableHead.vue
├── AppDataTableRow.vue
├── AppFlashMessage.vue
├── AppFormErrors.vue
├── AppInputPassword.vue
├── AppInputText.vue
├── AppLabel.vue
├── AppLink.vue
├── AppMenu.vue
├── AppMenuItem.vue
├── AppMenuSection.vue
├── AppModal.vue
├── AppPaginator.vue
├── AppSectionHeader.vue
├── AppSideBar.vue
├── AppTipTap.vue
├── AppToast.vue
├── AppTooltip.vue
├── AppTopBar.vue
└── TipTap (Custom WYSIWYG Rich Text Editor)
    ├── TipTapButton.vue
    └── TipTapDivider.vue
```

All these components are designed to integrate seamlessly with Modular, ensuring the easiest possible developer experience.

## Documentation

You can find the Modular documentation at [https://docs.ismodular.com](https://docs.ismodular.com).

## License

The Modular Project is open-source software licensed under the [MIT license](LICENSE.md).
