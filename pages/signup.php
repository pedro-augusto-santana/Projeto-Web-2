<style>
    <?php require_once __DIR__ . "/signup.css"; ?>
</style>

<div class="signup-page__full">
    <div class="signup-page__content">
        <div class="signup-page__header-container">
            <div class="signup-header">Crood - Sistema de Controle de Estoque</div>
        </div>
        <div class="signup-page__form-container">
            <form action="signup" class="signup-page__signup-form" id="signup-form">
                <label for="email" class="form-lbl">Email</label>
                <input type="text" name="email" class="signup-text-input" id="signup-email" placeholder="Insira seu email" required>
                <label for="name" class="form-lbl">Nome</label>
                <input type="text" name="name" class="signup-text-input" id="signup-name" placeholder="Insira seu nome" required>
                <label for="passwd" class="form-lbl">Senha</label>
                <input type="password" name="passwd" class="signup-text-input" id="signup-passwd" placeholder="Insira sua senha" required>
                <select name="role-selector" class="role-select" required>
                    <option value="4" selected>Usuário</option>
                    <option value="1">Administrador</option>
                    <option value="2">Gerente</option>
                    <option value="3">Supervisor</option>
                </select>
                <button type="submit" class="do-signup-button" id="do-signup">Criar Conta</button>
                <span class="goto-login" id="goto-login">Fazer Login</span>
            </form>
        </div>

        <?php include_once dirname(__DIR__) . "/templates/login_modal.php"; ?>
    </div>

    <script src="/pages/signup.js"></script>
    <script src="/utils/utils.js"></script>
</div>
