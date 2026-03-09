document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("searchInput");
    const table = document.getElementById("ledenTable");
    const noResults = document.getElementById("noResults");

    if (!input || !table) return;

    const rows = table.getElementsByTagName("tr");

    input.addEventListener("keyup", function () {
        const filter = input.value.toLowerCase();
        let visibleCount = 0;

        for (let i = 1; i < rows.length; i++) {
            const achternaamCell = rows[i].getElementsByTagName("td")[1];
            if (achternaamCell) {
                const text = achternaamCell.textContent.toLowerCase();
                const match = text.includes(filter);

                rows[i].style.display = match ? "" : "none";

                if (match) visibleCount++;
            }
        }

        // Geen resultaten → unhappy scenario
        noResults.classList.toggle("hidden", visibleCount > 0);
    });
});
