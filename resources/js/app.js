import "./bootstrap";
import $ from "jquery";

document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");
    const toggleBtn = document.getElementById("toggle-btn");
    const closeAdmin = document.getElementById("close-btn");

    function toggleSidebar() {
        if (window.innerWidth >= 768) {
            if (sidebar.classList.contains("lg:ml-0")) {
                sidebar.classList.remove("lg:ml-0");
                sidebar.classList.add("lg:-ml-72");
                mainContent.classList.add("lg:ml-0");
            } else {
                sidebar.classList.add("lg:ml-0");
                sidebar.classList.remove("lg:-ml-72");
                mainContent.classList.remove("lg:ml-0");
            }
        } else {
            sidebar.classList.toggle("ml-0");
        }
    }

    function closeSidebar() {
        if (window.innerWidth < 768) {
            sidebar.classList.remove("ml-0");
            overlay.classList.add("hidden");
        }
    }

    toggleBtn.addEventListener("click", toggleSidebar);

    closeAdmin.addEventListener("click", closeSidebar);

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            overlay.classList.add("hidden");
            sidebar.classList.remove("ml-0");
            if (!sidebar.classList.contains("lg:-ml-72")) {
                mainContent.classList.remove("lg:ml-0");
            }
        } else {
            sidebar.classList.remove("lg:-ml-72");
            sidebar.classList.add("lg:ml-0");
            mainContent.classList.remove("lg:ml-0");
            if (!sidebar.classList.contains("ml-0")) {
                overlay.classList.add("hidden");
            }
        }
    });
});
