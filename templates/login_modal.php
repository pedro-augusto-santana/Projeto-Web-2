<style>
    .login-modal {
        position: absolute;
        top: 15px;
        right: 30px;
        width: 275px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 15px;
    }

    .modal-content {
        font-weight: bolder;
        color: white;
        font-size: 14px;
    }

    .modal-close {
        font-weight: bolder;
        color: white;
        cursor: pointer;
    }

    .success {
        background-color: lightgreen;
    }

    .error {
        background-color: tomato;
    }
</style>

<div class="login-modal hidden" id="login-modal">
</div>
