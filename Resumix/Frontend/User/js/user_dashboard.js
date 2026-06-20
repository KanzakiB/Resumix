document.addEventListener("DOMContentLoaded", function () {
    const actionsConfig = {
        Rename: {
            defaultIcon: "http://localhost/Resumix/Images/rename_b.png",
            hoverIcon: "http://localhost/Resumix/Images/rename_bl.png",
            hoverColor: "#00085C", 
        },
        Edit: {
            defaultIcon: "http://localhost/Resumix/Images/edit_b.png",
            hoverIcon: "http://localhost/Resumix/Images/edit_bl.png",
            hoverColor: "#00085C",
        },
        Share: {
            defaultIcon: "http://localhost/Resumix/Images/share_b.png",
            hoverIcon: "http://localhost/Resumix/Images/share_bl.png",
            hoverColor: "#00085C",
        },
        Download: {
            defaultIcon: "http://localhost/Resumix/Images/download_b.png",
            hoverIcon: "http://localhost/Resumix/Images/download_bl.png",
            hoverColor: "#00085C",
        },
        Delete: {
            defaultIcon: "http://localhost/Resumix/Images/archive_b.png",
            hoverIcon: "http://localhost/Resumix/Images/delete_r.png",
            hoverColor: "red",
        },
    };

    document.querySelectorAll(".resume-actions li a").forEach(link => {
        const textNode = link.textContent.trim();
        const img = link.querySelector("img");

        if (actionsConfig[textNode]) {
            const { defaultIcon, hoverIcon, hoverColor } = actionsConfig[textNode];

            const originalColor = link.style.color || "inherit";

            link.addEventListener("mouseenter", () => {
                img.src = hoverIcon;
                link.style.color = hoverColor;
            });

            link.addEventListener("mouseleave", () => {
                img.src = defaultIcon;
                link.style.color = originalColor;
            });
        }
    });
});
