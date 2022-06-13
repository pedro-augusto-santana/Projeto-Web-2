<style>
    <?php require_once __DIR__ . "/login.css"; ?>
</style>

<div class="login-page__full">
    <div class="login-page__content">
        <div class="login-page__header-container">
            <div class="login-header">Crood - Sistema de Controle de Estoque</div>
        </div>
        <div class="login-page__form-container">
            <form action="login" class="login-page__login-form" id="login-form">
                <label for="email" class="form-lbl">Email</label>
                <input type="text" name="email" class="login-text-input" id="login-email" placeholder="Insira seu email">
                <label for="passwd" class="form-lbl">Senha</label>
                <input type="password" name="passwd" class="login-text-input" id="login-passwd" placeholder="Insira sua senha">
                <button type="submit" class="do-login-button" id="do-login">Login</button>
                <div class="bottom-actions">
                    <span class="login-forgot-passwd" id="login-forgot-passwd">Esqueci minha senha</span>
                    <div class="call-to-signup">Não tem acesso? <span id="goto-signup">Criar conta</span></div>
                </div>
            </form>
        </div>

    <?php include_once dirname(__DIR__) . "/templates/login_modal.php"; ?>
    </div>

    <script src="/pages/login.js"></script>
    <script src="/utils/utils.js"></script>
</div>
