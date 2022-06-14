<script>
    window.onload = (e) => {
        const userGreet = document.getElementById("user-greet");
        userGreet.innerText = sessionStorage.getItem("name");
    }
</script>

<header class="header-container">
    <div class="navbar-container">
        <div class="add-new-dropdown navbar-item">Criar produto +</div>
        <div class="user-section navbar-item">
            <div class="user-actions-container">Olá! <span id="user-greet"></span></div>
            <span class="material-symbols-outlined user-icon"> person </span>
        </div>
    </div>
</header>
