<template>
    <main class="form-signin w-100">
        <form>
            <h1>&#xF24A;</h1>

            <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

            <div class="form-floating">
                <input type="email"
                       class="form-control"
                       id="floatingInput"
                       placeholder="Введите email"
                       v-model="mail">
                <label for="floatingInput">Aдрес электронной почты</label>
            </div>
            <div class="form-floating">
                <input type="password"
                       class="form-control"
                       id="floatingPassword"
                       placeholder="Пароль"
                       v-model="password">
                <label for="floatingPassword">Пароль</label>
            </div>

            <div class="checkbox mb-3">
            </div>

            <a class="w-100 btn btn-info"
               @click="createUser()">Войти</a>

            <div style="font-size: 13px; display: flex; justify-content: space-between; padding: 10px;">
                <router-link :to="'/recover'">Восстановить пароль</router-link>

                <router-link :to="'/'">Войти</router-link>
            </div>

            <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
        </form>

    </main>
</template>

<script>
export default {
    name: "CreateUser",

    components: {},
    data() {
        return {
            password: '',
            mail: '',
        }
    },
    methods: {

        createUser() {
            let formData = new FormData();
            formData.append("password", this.password);
            formData.append("mail", this.mail);

            axios.post('http://zi.loc/create.php',
                formData,
                {
                    headers: {"Content-type": "application/json",},
                })
                .then((res) => {
                    console.log(res.data)
                    let type = res.data.status === 'ok' ? 'success' : 'error';
                    toast.open({
                        message: res.data.message,
                        type: type,
                        duration: 3000
                    });
                })
        }
    }
}
</script>

<style scoped>

</style>
