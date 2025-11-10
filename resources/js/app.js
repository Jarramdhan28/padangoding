import "./bootstrap";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import toast from "./alpinejs/plugins/toast.js";
import submit from "./alpinejs/plugins/submit.js";
import deleteData from "./alpinejs/plugins/delete.js";
import timeFormat from "./alpinejs/plugins/date-format.js";
import categoriesStore from "./alpinejs/stores/categories.js";

/** Alpine Add Page Components */
import "./alpinejs/auth.js";
import "./alpinejs/pages/admin/category.js";
import "./alpinejs/pages/admin/tag.js";
import "./alpinejs/pages/admin/user-management.js";
import "./alpinejs/pages/admin/article.js";
/** Creator */
import "./alpinejs/pages/creator/article.js";

/** Add import alpine component */
Alpine.plugin(collapse);
Alpine.plugin(toast);
Alpine.plugin(submit);
Alpine.plugin(deleteData);
Alpine.plugin(timeFormat);

/** Start store alpine */
categoriesStore();

window.Alpine = Alpine;

Alpine.start();
