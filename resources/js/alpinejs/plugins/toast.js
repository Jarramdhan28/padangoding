export default function (Alpine) {
    Alpine.magic("toast", () => {
        return (message, type = "success") => {
            const el = document.createElement("div");
            let icon = "";

            if (type === "success") {
                icon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4 mr-1">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>`;
            } else if (type === "error") {
                icon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4 mr-1">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                        </svg>`;
            }

            el.className = `
                fixed top-3 right-4 px-4 py-2 rounded-lg border border-gray-200 shadow-lg bg-white text-sm text-black z-50
                flex items-center transition-all duration-1000 ease-out
                opacity-0 transform -translate-y-3
            `;

            el.innerHTML = `${icon}<span>${message}</span>`;
            document.body.appendChild(el);

            requestAnimationFrame(() => {
                el.classList.remove("opacity-0", "-translate-y-3");
                el.classList.add("opacity-100", "translate-y-0");
            });

            setTimeout(() => {
                el.classList.remove("opacity-100", "translate-y-0");
                el.classList.add("opacity-0", "-translate-y-3");
                setTimeout(() => el.remove(), 300);
            }, 3000);
        };
    });
}
