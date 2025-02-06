<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © General Register- Developed & Managed By TUSHAR  SURYAWANSHI  MANAGEMENT
            </div>
          
        </div>
    </div>
</footer>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Select the `a` tag with `aria-controls="sidebarMore"` inside a `li.nav-item`
    const navItemLink = document.querySelector('li.nav-item a[aria-controls="sidebarMore"]');
    if (navItemLink) {
        // Ensure the parent `li.nav-item` is not hidden
        const liElement = navItemLink.closest('li.nav-item');
        if (liElement) {
            liElement.style.display = "none"; // Explicitly set to block
            console.log("Visible `li.nav-item`:", liElement);
        }
    } else {
        console.log("`a` tag with `aria-controls='sidebarMore'` not found.");
    }

    // Select the `div` with id="sidebarMore`
    const sidebarMoreDiv = document.getElementById("sidebarMore");
    if (sidebarMoreDiv) {
        // Ensure the `div` is not hidden
        sidebarMoreDiv.style.display = "none"; // Explicitly set to block
        console.log("Visible `div#sidebarMore`:", sidebarMoreDiv);
    } else {
        console.log("`div#sidebarMore` not found.");
    }
});


</script>