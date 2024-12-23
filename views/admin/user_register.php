<?php

require '../../vendor/autoload.php';

?>

<?php include '../navbar.php'; ?>
<div class="container mt-2">
    <h2>Cadastro de Usuário</h2>
    <form method="POST" @submit="validatePasswords">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" v-model="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" v-model="email" autocomplete="new-email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" v-model="senha" autocomplete="new-password" required>
        </div>
        <div class="form-group">
            <label for="confirmar_senha">Confirmar Senha</label>
            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" v-model="confirmar_senha" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<?php include '../footer.php'; ?>


<script>
    new Vue({
        el: '#app',
        data: {
            nome: '',
            email: '',
            senha: '',
            confirmar_senha: ''
        },
        methods: {
            validatePasswords: function(event) {
                event.preventDefault();
                if (this.senha !== this.confirmar_senha) {
                    alert('As senhas não coincidem!');
                } else {
                    this.submitUserRegistration();
                }
            },
            submitUserRegistration: function() {
                const userData = {
                    nome: this.nome,
                    email: this.email,
                    senha: this.senha
                };

                axios.post('user_register_handler.php', userData)
                    .then((response) => {
                        console.log('Server response:', response);

                        if (response.data.mensagem === 'Usuário cadastrado com sucesso.') {
                            this.nome = '';
                            this.email = '';
                            this.senha = '';
                            this.confirmar_senha = '';

                            alert('Usuário cadastrado com sucesso!');
                        } else {
                            alert(response.data.mensagem);
                        }
                    })
                    .catch((error) => {
                        console.log('Error:', error);
                        alert('Houve um erro ao cadastrar o usuário.');
                    });
            }
        }
    });
</script>