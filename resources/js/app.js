import "./bootstrap";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import toast from "./alpinejs/plugins/toast.js";
import submit from "./alpinejs/plugins/submit.js";
import deleteData from "./alpinejs/plugins/delete.js";
import timeFormat from "./alpinejs/plugins/date-format.js";

/** Alpine Add Page Components */
import "./alpinejs/auth.js";
import "./alpinejs/pages/admin/category.js";
import "./alpinejs/pages/admin/tag.js";
import "./alpinejs/pages/admin/user-management.js";

/** Add import alpine component */
Alpine.plugin(collapse);
Alpine.plugin(toast);
Alpine.plugin(submit);
Alpine.plugin(deleteData);
Alpine.plugin(timeFormat);

window.Alpine = Alpine;

Alpine.start();
